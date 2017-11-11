<?php
namespace App\Services;

use LaravelRocket\Foundation\Services\BaseServiceInterface;

interface PushNotificationServiceInterface extends BaseServiceInterface
{
    /**
     * @param $topicName
     * @param array $deviceTokens
     *
     * @return mixed
     */
    public function subscribeTopic($topicName, $deviceTokens);

    /**
     * @param $topicName
     * @param array $deviceTokens
     *
     * @return mixed
     */
    public function unsubscribeTopic($topicName, $deviceTokens);

    /**
     * @param int    $userId
     * @param string $message
     *
     * @return mixed
     */
    public function sendMessageToUser($userId, $message);

    /**
     * @param int $groupId
     * @param int $userId
     *
     * @return mixed
     */
    public function subscribeUserToGroup($groupId, $userId);

    /**
     * @param int $groupId
     * @param int $userId
     *
     * @return mixed
     */
    public function unsubscribeUserFromGroup($groupId, $userId);

    /**
     * @param array  $groupIds
     * @param string $deviceToken
     *
     * @return mixed
     */
    public function subscribeDeviceToGroups($groupIds, $deviceToken);
}
