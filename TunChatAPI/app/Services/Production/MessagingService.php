<?php
namespace App\Services\Production;

use App\Services\FirebaseServiceInterface;
use App\Services\MessagingServiceInterface;
use LaravelRocket\Foundation\Services\Production\BaseService;

class MessagingService extends BaseService implements MessagingServiceInterface
{
    protected $firebaseService;

    public function __construct(
        FirebaseServiceInterface $firebaseService
    ) {
        $this->firebaseService = $firebaseService;
    }

    public function createConversation($group, $userId)
    {
        $conversation = $this->firebaseService->createConversation($group, $userId);

        return $conversation;
    }

    public function updateConversation($group)
    {
        $conversation = $this->firebaseService->updateConversation($group);

        return $conversation;
    }

    public function addUserToConversation($conversationId, $userId, $favorite, $last_sent_at, $new_message_count)
    {
        $this->firebaseService->addUserToConversation($conversationId, $userId, $favorite, $last_sent_at, $new_message_count);
    }

    public function removeUserFromConversation($conversationId, $userId)
    {
        $this->firebaseService->removeUserFromConversation($conversationId, $userId);
    }

    public function createUser($user)
    {
        $user = $this->firebaseService->createUser($user);

        return $user;
    }

    public function updateUser($user)
    {
        $user = $this->firebaseService->updateUser($user);

        return $user;
    }

    public function createMessage($conversationId, $message)
    {
        $message = $this->firebaseService->createMessage($conversationId, $message);

        return $message;
    }

    public function getUser($userId)
    {
        $user = $this->firebaseService->getUser($userId);

        return $user;
    }

    public function getConversation($conversationId)
    {
        $conversation = $this->firebaseService->getConversation($conversationId);

        return $conversation;
    }

    public function createEvent($eventId, $eventData)
    {
        $event = $this->firebaseService->createEvent($eventId, $eventData);

        return $event;
    }

    public function updateEvent($eventId, $eventData)
    {
        $event = $this->firebaseService->updateEvent($eventId, $eventData);

        return $event;
    }

    public function getEvent($eventId)
    {
        $event = $this->firebaseService->getEvent($eventId);

        return $event;
    }

    public function checkUserInConversation($conversationId, $userId)
    {
        return $this->firebaseService->checkUserInConversation($conversationId, $userId);
    }
}
