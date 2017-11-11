<?php
namespace App\Services;

use LaravelRocket\Foundation\Services\BaseServiceInterface;

interface FcmServiceInterface extends BaseServiceInterface
{
    public function sendMessageToDevice($deviceTokens, $notification);

    public function sendMessageToTopic($topicName, $notification);

    public function subscribeTopic($topicName, $deviceTokens);

    public function unsubscribeTopic($topicName, $deviceTokens);
}
