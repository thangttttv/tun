var firebase = require("firebase-admin");
var async = require("neo-async");

const DATABASE_URL = process.env.DATABASE_URL || 'https://actisso-test.firebaseio.com';
const MESSAGE_LIMIT = 10; //parseInt(process.env.MESSAGE_LIMIT, 10);
const PARALLEL_LIMIT = parseInt(process.env.PARALLEL_LIMIT, 10);
const NOTIFICATION_PRIORITY = process.env.NOTIFICATION_PRIORITY || 'high';
const NOTIFICATION_TLL = parseInt(process.env.NOTIFICATION_TLL, 60 * 60 * 24);

firebase.initializeApp({
    credential: firebase.credential.cert({
        "private_key": process.env.FIREBASE_PRIVATE_KEY.replace(/\\n/g, '\n'),
        "client_email": process.env.FIREBASE_CLIENT_EMAIL,
    }),
    databaseURL: DATABASE_URL
});

function startListeners() {
    var ref = firebase.database().ref('notifications');
    var parallel = [];
    ref.on("value", function(snapshot) {
        var updates = {};
        snapshot.forEach(function(notification) {
            var key = notification.key;
            var message = notification.val();
            if (!!message.sent_at || !message.group_id) {
                return;
            }
            var groupId = message.group_id;

            //   console.log(`${key}:${value}:{groupId}:{message}`);
            message.sent_at = firebase.database.ServerValue.TIMESTAMP;
            updates[key] = message;

            parallel.push(function(done) {
                sendGroupPushNotification(groupId, message, done);
            });
        });

        if (parallel.length === 0) {
            console.log('Notifications list is empty. Skip.');
        }

        async.parallel(parallel, function(err) {
            if (err) {
                console.log('Send all notification failed.');
            }
            parallel = []
            console.log('Send all notification successfully.');
            ref.update(updates);
        });
    });
}

function sendGroupPushNotification(groupId, message, cb) {
    // Send a message to devices subscribed to the provided topic.
    // The topic name can be optionally prefixed with "/topics/".
    message = message || {};
    var topic = `/topics/group_${groupId}`;
    var body = `${message.user_name}`;
    var type = message.type || 'text';
    var body_loc_key;
    var body_loc_args;
    if (type === 'image') {
        body = `${message.user_name} added an image in ${message.group_name}!`;
        body_loc_key = 'fcm_notification_add_image';
        body_loc_args = `[\"${message.user_name}\",\"${message.group_name}\"]`;
    } else if (type === 'poll') {
        body = `${message.user_name} created a poll in ${message.group_name}!`;
        body_loc_key = 'fcm_notification_create_poll';
        body_loc_args = `[\"${message.user_name}\",\"${message.group_name}\"]`;
    } else if (type === 'event') {
        body = `${message.user_name} created an event in ${message.group_name}!`;
        body_loc_key = 'fcm_notification_create_event';
        body_loc_args = `[\"${message.user_name}\",\"${message.group_name}\"]`;
    } else {
        body = `${message.user_name}: ${message.content}!`;
        body_loc_key = 'fcm_notification_send_message';
        body_loc_args = `[\"${message.user_name}\",\"${message.content}\"]`;
    }

    var payload = {
        notification: {
            body: body,
            title: `${message.group_name}`,
            body_loc_key: `${body_loc_key}`,
            body_loc_args: `${body_loc_args}`
        },
        data: {
            group_id: `${message.group_id}`
        }
    };
    // Set the message as high priority and have it expire after 24 hours.
    var options = {
        priority: NOTIFICATION_PRIORITY || "high",
        timeToLive: NOTIFICATION_TLL || 60 * 60 * 24
    };

    firebase.messaging().sendToTopic(topic, payload, options)
        .then(function(response) {
            // See the MessagingTopicResponse reference documentation for the
            // contents of response.
            console.log('Successfully sent message:', response);
            return cb(null);
        })
        .catch(function(error) {
            console.log('Error sending message:', error);
            return cb(error);
        });
}

startListeners();