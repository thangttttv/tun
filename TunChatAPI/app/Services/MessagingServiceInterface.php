<?php
namespace App\Services;

use LaravelRocket\Foundation\Services\BaseServiceInterface;

interface MessagingServiceInterface extends BaseServiceInterface
{
    public function createConversation($group, $userId);

    public function updateConversation($group);

    public function addUserToConversation($conversationId, $userId, $favorite, $last_sent_at, $new_message_count);

    public function removeUserFromConversation($conversationId, $userId);

    public function createUser($user);

    public function updateUser($user);

    public function createMessage($conversationId, $message);

    public function getUser($userId);

    public function getConversation($ConversationId);

    public function createEvent($eventId, $eventData);

    public function updateEvent($eventId, $eventData);

    public function getEvent($eventId);

    public function checkUserInConversation($conversationId, $userId);
}
