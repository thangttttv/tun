<?php
namespace App\Services\Production;

use App\Repositories\PushNotificationDeviceRepositoryInterface;
use App\Services\FcmServiceInterface;
use App\Services\PushNotificationServiceInterface;

use LaravelRocket\Foundation\Services\Production\BaseService;

class PushNotificationService extends BaseService implements PushNotificationServiceInterface
{
    protected $groupTopicPrefix = 'group_';

    protected $generalTopic = 'general';

    protected $fcmService;

    protected $pushNotificationDeviceRepository;

    public function __construct(
        FcmServiceInterface $fcmService,
        PushNotificationDeviceRepositoryInterface $pushNotificationDeviceRepository
    ) {
        $this->fcmService                       = $fcmService;
        $this->pushNotificationDeviceRepository = $pushNotificationDeviceRepository;
    }

    /**
     * @param $topicName
     * @param $deviceTokens
     *
     * @return mixed
     */
    public function subscribeTopic($topicName, $deviceTokens)
    {
        if (count($deviceTokens) == 0) {
            return false;
        }

        return $this->fcmService->subscribeTopic($topicName, $deviceTokens);
    }

    /**
     * @param $topicName
     * @param $deviceTokens
     *
     * @return mixed
     */
    public function unsubscribeTopic($topicName, $deviceTokens)
    {
        if (count($deviceTokens) == 0) {
            return false;
        }

        return $this->fcmService->unsubscribeTopic($topicName, $deviceTokens);
    }

    /**
     * @param string $userId
     * @param string $message
     *
     * @return mixed
     */
    public function sendMessageToUser($userId, $message)
    {
        $userDevices  = $this->pushNotificationDeviceRepository->allByUserId($userId);
        $deviceTokens = $userDevices->pluck('token')->toArray();
        if (count($deviceTokens) == 0) {
            return false;
        }

        return $this->fcmService->sendMessageToDevice($deviceTokens, $message);
    }

    /**
     * @param string $groupId
     * @param array  $message
     *
     * @return mixed
     */
    public function sendMessageToGroup($groupId, $message)
    {
        $topicName = $this->groupTopicPrefix.$groupId;

        return $this->fcmService->sendMessageToTopic($topicName, $message);
    }

    /**
     * @param $groupId
     * @param $userId
     *
     * @return mixed
     */
    public function subscribeUserToGroup($groupId, $userId)
    {
        $topicName    = $this->groupTopicPrefix.$groupId;
        $userDevices  = $this->pushNotificationDeviceRepository->allByUserId($userId);
        $deviceTokens = $userDevices->pluck('token')->toArray();
        if (count($deviceTokens) == 0) {
            return false;
        }

        return $this->subscribeTopic($topicName, $deviceTokens);
    }

    /**
     * @param $groupId
     * @param $userId
     *
     * @return mixed
     */
    public function unsubscribeUserFromGroup($groupId, $userId)
    {
        $topicName    = $this->groupTopicPrefix.$groupId;
        $userDevices  = $this->pushNotificationDeviceRepository->allByUserId($userId);
        $deviceTokens = $userDevices->pluck('token')->toArray();
        if (count($deviceTokens) == 0) {
            return false;
        }

        return $this->unsubscribeTopic($topicName, $deviceTokens);
    }

    /**
     * @param $groupIds
     * @param $deviceToken
     *
     * @return mixed
     */
    public function subscribeDeviceToGroups($groupIds, $deviceToken)
    {
        foreach ($groupIds as $groupId) {
            $topicName = $this->groupTopicPrefix.$groupId;
            $response  = $this->fcmService->subscribeTopic($topicName, [$deviceToken]);
        }
    }
}
