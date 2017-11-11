<?php
namespace App\Services\Production;

use App\Services\FcmServiceInterface;
use LaravelRocket\Foundation\Services\Production\BaseService;
use sngrl\PhpFirebaseCloudMessaging\Client;
use sngrl\PhpFirebaseCloudMessaging\Message;
use sngrl\PhpFirebaseCloudMessaging\Notification;
use sngrl\PhpFirebaseCloudMessaging\Recipient\Device;
use sngrl\PhpFirebaseCloudMessaging\Recipient\Topic;

class FcmService extends BaseService implements FcmServiceInterface
{
    protected $fcmClient;

    public function __construct(
    ) {
        $this->fcmClient = new Client();
        $this->fcmClient->setApiKey(config('services.fcm.server_key'));
        $this->fcmClient->injectGuzzleHttpClient(new \GuzzleHttp\Client());
    }

    public function sendMessageToDevice($deviceTokens, $notification)
    {
        $message = new Message();
        $message->setPriority('high');
        foreach ($deviceTokens as $token) {
            $message->addRecipient(new Device($token));
        }
        $notification = new Notification($notification['title'], $notification['body']);
        $message->setNotification($notification);

        return $this->fcmClient->send($message);
    }

    public function sendMessageToTopic($topicName, $notification)
    {
        $message = new Message();
        $message->setPriority('high');
        $message->addRecipient(new Topic($topicName));
        $notification = new Notification($notification['title'], $notification['body']);
        $message->setNotification($notification);

        return $this->fcmClient->send($message);
    }

    public function subscribeTopic($topicName, $deviceTokens)
    {
        return $this->fcmClient->addTopicSubscription($topicName, $deviceTokens);
    }

    public function unsubscribeTopic($topicName, $deviceTokens)
    {
        return $this->fcmClient->removeTopicSubscription($topicName, $deviceTokens);
    }
}
