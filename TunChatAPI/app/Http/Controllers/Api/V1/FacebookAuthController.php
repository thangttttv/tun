<?php
namespace App\Http\Controllers\Api\V1;

use App\Exceptions\APIErrorException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\FacebookSigninRequest;
use App\Http\Requests\Api\V1\PsrServerRequest;
use App\Http\Responses\Api\V1\AccessToken;
use App\Repositories\UserRepositoryInterface;
use App\Services\OAuthServiceInterface;
use App\Services\UserServiceAuthenticationServiceInterface;
use App\Services\UserServiceInterface;
use League\OAuth2\Server\AuthorizationServer;
use Zend\Diactoros\Response as Psr7Response;

class FacebookAuthController extends Controller
{
    /** @var \App\Services\UserServiceAuthenticationServiceInterface $serviceAuthenticationService */
    protected $serviceAuthenticationService;

    /** @var \App\Services\UserServiceInterface $userService */
    protected $userService;

    /** @var \App\Repositories\UserRepositoryInterface $userRepository */
    protected $userRepository;

    /** @var \App\Services\OAuthServiceInterface $oauthService */
    protected $oauthService;

    /** @var AuthorizationServer */
    protected $server;

    public function __construct(
        UserServiceInterface $userService,
        UserServiceAuthenticationServiceInterface $serviceAuthenticationService,
        UserRepositoryInterface $userRepository,
        OAuthServiceInterface $oauthService,
        AuthorizationServer $server
    ) {
        $this->userService                  = $userService;
        $this->serviceAuthenticationService = $serviceAuthenticationService;
        $this->userRepository               = $userRepository;
        $this->oauthService                 = $oauthService;
        $this->server                       = $server;
    }

    public function facebookSignIn(FacebookSigninRequest $request)
    {
        /* @var \App\Models\User $authUser */
        $this->userService->checkClient($request, 'password');
        $authUser = $this->serviceAuthenticationService->facebookSignIn($request->get('facebook_token'));
        if (empty($authUser)) {
            throw new APIErrorException('authFailed', 'Register failed', []);
        }
        $password          = $authUser->password;
        $temporaryPassword = str_random(16);
        $this->userRepository->update($authUser, [
            'password' => $temporaryPassword,
        ]);
        $params = [
                'username'   => $authUser->email,
                'password'   => $temporaryPassword,
                'grant_type' => 'password',
            ] + $request->all();
        try {
            $serverRequest = PsrServerRequest::createFromRequest($request, $params);
            $response      = $this->server->respondToAccessTokenRequest($serverRequest, new Psr7Response);
            $this->userRepository->updateRawPassword($authUser, $password);
        } catch (\Exception $e) {
            $this->userRepository->updateRawPassword($authUser, $password);
            throw $e;
        }

        return AccessToken::updateWithResponse($response)->response();
    }
}
