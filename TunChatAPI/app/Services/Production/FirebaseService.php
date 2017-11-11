<?php
namespace App\Services\Production;

use App\Repositories\GroupRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\Services\FirebaseServiceInterface;
use Carbon\Carbon;
use Firebase\FirebaseLib;
use LaravelRocket\Foundation\Services\Production\BaseService;

class FirebaseService extends BaseService implements FirebaseServiceInterface
{
    const USER_PATH        ='/users';
    const CONVERSATION_PATH='/conversations';
    const MESSAGE_PATH     ='/messages';
    const EVENT_PATH       ='/events';

    /** @var \App\Repositories\GroupRepositoryInterface */
    protected $groupRepository;

    /** @var \App\Repositories\UserRepositoryInterface */
    protected $userRepository;

    /** @var \Firebase\FirebaseLib */
    protected $firebase;

    public function __construct(
        GroupRepositoryInterface $groupRepository,
        UserRepositoryInterface $userRepository
    ) {
        $this->firebase       =new FirebaseLib(config('services.firebase.firebase_url'), config('services.firebase.firebase_token'));
        $this->groupRepository=$groupRepository;
        $this->userRepository =$userRepository;
    }

    public function createConversation($group, $userId)
    {
        $conversationId   = $group->id;
        $now              = Carbon::now();
        $conversationData = [
            'created_at'    => $now->timestamp,
            'description'   => '',
            'group_type'    => $group->type,
            'image'         => $group->image != null ? $group->image->url : '',
            'last_message'  => '',
            'title'         => $group->name,
            'update_at'     => $now->timestamp,
        ];

        $response=$this->firebase->set(self::CONVERSATION_PATH.'/'.$conversationId, $conversationData);

        // check user
        $messageUser=$this->getUser($userId);
        if (empty($messageUser) || $messageUser == 'null') {
            $user =$this->userRepository->find($userId);
            $input=[
                'avatar'        => isset($user->profileImage) ? $user->profileImage->url : '',
                'birthday'      => '',
                'email'         => $user->email,
                'name'          => $user->name,
            ];

            $this->createUser($user);
        }

        $favorite         =false;
        $last_sent_at     =Carbon::now()->timestamp;
        $new_message_count=0;
        $this->addUserToConversation($conversationId, $userId, $favorite, $last_sent_at, $new_message_count);

        return $response;
    }

    public function updateConversation($group)
    {
        $conversationId       = $group->id;
        $conversationResponse = $this->getConversation($conversationId);
        $conversation         = json_decode($conversationResponse);

        $conversationData = [
            'created_at'    => $conversation->created_at,
            'description'   => $conversation->description,
            'group_type'    => $group->type,
            'image'         => $group->image != null ? $group->image->url : '',
            'last_message'  => $conversation->last_message,
            'title'         => $group->name,
            'update_at'     => Carbon::now()->timestamp,
        ];

        $response=$this->firebase->update(self::CONVERSATION_PATH.'/'.$conversationId, $conversationData);

        return $response;
    }

    public function addUserToConversation($conversationId, $userId, $favorite, $last_sent_at, $new_message_count)
    {
        $this->firebase->set(self::CONVERSATION_PATH.'/'.$conversationId.'/users/'.$userId, Carbon::now()->timestamp);
        $userConversation=['favorite'=>$favorite, 'last_sent_at'=>$last_sent_at, 'new_message_count'=>$new_message_count];
        $this->firebase->set(self::USER_PATH.'/'.$userId.'/conversations/'.$conversationId, $userConversation);
    }

    public function removeUserFromConversation($conversationId, $userId)
    {
        $this->firebase->delete(self::CONVERSATION_PATH.'/'.$conversationId.'/users/'.$userId);
        $this->firebase->delete(self::USER_PATH.'/'.$userId.'/conversations/'.$conversationId);
    }

    public function createUser($user)
    {
        $userData =  [
            'avatar'        => isset($user->profileImage) ? $user->profileImage->url : '',
            'birthday'      => '',
            'email'         => $user->email,
            'name'          => $user->name,
        ];
        $response=$this->firebase->set(self::USER_PATH.'/'.$user->id, $userData);

        return $response;
    }

    public function updateUser($user)
    {
        $userData =  [
            'avatar'        => isset($user->profileImage) ? $user->profileImage->url : '',
            'birthday'      => '',
            'email'         => $user->email,
            'name'          => $user->name,
        ];

        $response=$this->firebase->update(self::USER_PATH.'/'.$user->id, $userData);

        return $response;
    }

    public function createMessage($conversationId, $message)
    {
        $response=$this->firebase->push(self::MESSAGE_PATH.'/'.$conversationId, $message);

        return $response;
    }

    public function getUser($userId)
    {
        $response=$this->firebase->get(self::USER_PATH.'/'.$userId);

        return $response;
    }

    public function getConversation($conversationId)
    {
        $response=$this->firebase->get(self::CONVERSATION_PATH.'/'.$conversationId);

        return $response;
    }

    public function createEvent($eventId, $eventData)
    {
        $response=$this->firebase->set(self::EVENT_PATH.'/'.$eventId, $eventData);

        return $response;
    }

    public function updateEvent($eventId, $eventData)
    {
        $response=$this->firebase->update(self::EVENT_PATH.'/'.$eventId, $eventData);

        return $response;
    }

    public function getEvent($eventId)
    {
        $response=$this->firebase->get(self::EVENT_PATH.'/'.$eventId);

        return $response;
    }

    public function checkUserInConversation($conversationId, $userId)
    {
        $response                        =$this->firebase->get(self::CONVERSATION_PATH.'/'.$conversationId.'/'.'users/'.$userId);
        $checked                         = false;
        if ($response != 'null') {
            $checked = true;
        }

        return $checked;
    }
}
