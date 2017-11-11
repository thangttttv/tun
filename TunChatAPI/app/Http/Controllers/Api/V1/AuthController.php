<?php
namespace App\Http\Controllers\Api\V1;

use App\Exceptions\APIErrorException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\PsrServerRequest;
use App\Http\Requests\Api\V1\Request;
use App\Http\Requests\Api\V1\SignInRequest;
use App\Http\Requests\Api\V1\SignUpRequest;
use App\Http\Responses\Api\V1\AccessToken;
use App\Http\Responses\Api\V1\Status;
use App\Services\UserServiceInterface;

use League\OAuth2\Server\AuthorizationServer;
use Zend\Diactoros\Response as Psr7Response;

class AuthController extends Controller
{
    /** @var \App\Services\UserServiceInterface $userService */
    protected $userService;

    /** @var AuthorizationServer */
    protected $server;

    public function __construct(
        UserServiceInterface $userService,
        AuthorizationServer $server
    ) {
        $this->userService = $userService;
        $this->server      = $server;
    }

    public function postSignUp(SignUpRequest $request)
    {
        $this->userService->checkClient($request, 'password');
        $input = $request->only([
            'name',
            'email',
            'password',
            'password_confirmation ',
        ]);

        /** @var \App\Models\User $user */
        $user = $this->userService->signUp($input);
        if (empty($user)) {
            throw new APIErrorException('authFailed', 'Register failed', []);
        }

        $params               = $request->all();
        $params['username']   = $params['email'];
        $params['grant_type'] = 'password';
        $params['scope']      = '';

        $serverRequest = PsrServerRequest::createFromRequest($request, $params);

        $response = $this->server->respondToAccessTokenRequest($serverRequest, new Psr7Response);

        return AccessToken::updateWithResponse($response)->withStatus(201)->response();
    }

    public function postSignIn(SignInRequest $request)
    {
        $this->userService->checkClient($request, 'password');
        $inputCheckUser             = $request->only('email', 'password');
        $inputCheckUser['username'] = $inputCheckUser['email'];
        $user                       = $this->userService->signIn($inputCheckUser);
        if (empty($user)) {
            throw new APIErrorException('signInFailed', '', []);
        }
        $serverRequest = PsrServerRequest::createFromRequest($request, $request->all() + [
                'username'   => $request->get('email', ''),
                'grant_type' => 'password',
                'scope'      => '',
            ]);
        $response = $this->server->respondToAccessTokenRequest($serverRequest, new Psr7Response);

        return AccessToken::updateWithResponse($response)->response();
    }

    public function refreshToken(Request $request)
    {

        $serverRequest = PsrServerRequest::createFromRequest($request, $request->all() + [
                'refresh_token'   => $request->get('refresh_token', ''),
                'grant_type' => 'refresh_token',
                'scope'      => '',
            ]);
        $response = $this->server->respondToAccessTokenRequest($serverRequest, new Psr7Response);

        return AccessToken::updateWithResponse($response)->response();
    }

    public function postSignOut()
    {
        $user = $this->userService->signOut();

        return Status::ok()->response();
    }
}
