<?php
/**
 * Created by PhpStorm.
 * User: ThangTT
 * Date: 31/08/2017
 * Time: 1:35 SA
 */

namespace App\Http\Middleware\Api\V1;

use App\Exceptions\APIErrorException;
use App\Services\APIUserServiceInterface;
use Closure;
use Illuminate\Http\Request;

class CheckClient
{
	/** @var APIUserServiceInterface */
	protected $userService;

	/**
	 * Create a new filter instance.
	 *
	 * @param APIUserServiceInterface $userService
	 */
	public function __construct(APIUserServiceInterface $userService)
	{
		$this->userService = $userService;
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param \Closure                 $next
	 *
	 * @return mixed
	 *
	 * @throws APIErrorException
	 */
	public function handle(Request $request, Closure $next)
	{
		/* @var \App\Models\User $authUser */
		$this->userService->checkClient($request, 'password');

		return $next($request);
	}
}