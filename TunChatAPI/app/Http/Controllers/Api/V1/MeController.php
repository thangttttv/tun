<?php
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

use App\Http\Requests\Api\V1\MeUpdateRequest;
use App\Http\Requests\Api\V1\UserDeviceRequest;
use App\Http\Responses\Api\V1\Me;
use App\Http\Responses\Api\V1\Status;
use App\Repositories\FileRepositoryInterface;
use App\Repositories\GroupUserRepositoryInterface;
use App\Repositories\PushNotificationDeviceRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\Services\APIUserServiceInterface;
use App\Services\FileServiceInterface;
use App\Services\MessagingServiceInterface;
use App\Services\PushNotificationServiceInterface;

class MeController extends Controller
{
    /** @var APIUserServiceInterface */
    protected $userService;

    /** @var UserRepositoryInterface */
    protected $userRepository;

    /** @var FileServiceInterface $fileService */
    protected $fileService;

    /** @var FileRepositoryInterface $fileRepository */
    protected $fileRepository;

    /** @var GroupUserRepositoryInterface $groupUserRepository */
    protected $groupUserRepository;

    /** @var PushNotificationDeviceRepositoryInterface $pushNotificationDeviceRepository */
    protected $pushNotificationDeviceRepository;

    /** @var PushNotificationServiceInterface $pushNotificationService */
    protected $pushNotificationService;

    /** @var MessagingServiceInterface $messagingService */
    protected $messagingService;

    public function __construct(
        APIUserServiceInterface $userService,
        UserRepositoryInterface $userRepository,
        FileServiceInterface $fileService,
        FileRepositoryInterface $fileRepository,
        GroupUserRepositoryInterface $groupUserRepository,
        PushNotificationServiceInterface $pushNotificationService,
        PushNotificationDeviceRepositoryInterface $pushNotificationDeviceRepository,
        MessagingServiceInterface $messagingService
    ) {
        $this->userService                                   = $userService;
        $this->userRepository                                = $userRepository;
        $this->fileRepository                                = $fileRepository;
        $this->fileService                                   = $fileService;
        $this->groupUserRepository                           = $groupUserRepository;
        $this->pushNotificationService                       = $pushNotificationService;
        $this->pushNotificationDeviceRepository              = $pushNotificationDeviceRepository;
        $this->messagingService                              = $messagingService;
    }

    public function getMe()
    {
        /** @var \App\Models\User $user */
        $user = $this->userService->getUser();

        return Me::updateWithModel($user)->response();
    }

    public function updateMe(MeUpdateRequest $request)
    {
        $user  = $this->userService->getUser();
        $input = $request->onlyNonNull([
            'name',
            'email',
            'phone_number',
        ]);

        if ($request->hasFile('profile_image')) {
            $image = $user->profileImage;
            if (!empty($image)) {
                $this->fileService->delete($image);
            }

            $file                      = $request->file('profile_image');
            $mediaType                 = $file->getClientMimeType();
            $path                      = $file->getPathname();
            $image                     = $this->fileService->upload('profile-image', $path, $mediaType, []);
            $input['profile_image_id'] = $image->id;
        }

        if (!empty($request->get('password'))) {
            $input['password'] = $request->get('password');
        }
        $user = $this->userRepository->update($user, $input);
        $this->messagingService->updateUser($user);

        return Me::updateWithModel($user)->response();
    }

    public function addDevice(UserDeviceRequest $request)
    {
        $user                         = $this->userService->getUser();
        $input                        = $request->onlyNonNull(['token', 'type']);
        $input['user_id']             = $user->id;

        $device = $this->pushNotificationDeviceRepository->findByUserIdAndToken(
            $user->id, $input['token']);
        if (empty($device)) {
            $this->pushNotificationDeviceRepository->create($input);
        }

        $groupUsers = $this->groupUserRepository->allByUserId($user->id);
        $groupIds   = $groupUsers->pluck('group_id')->toArray();
        $this->pushNotificationService->subscribeDeviceToGroups($groupIds, $input['token']);

        return Status::ok()->withStatus(201)->response();
    }
}
