<?php
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Request;
use App\Http\Responses\Api\V1\Actions;
use App\Repositories\ActionRepositoryInterface;
use App\Services\APIUserServiceInterface;

class ActionController extends Controller
{
    /** @var \App\Repositories\ActionRepositoryInterface */
    protected $actionRepository;

    /** @var APIUserServiceInterface */
    protected $userService;

    public function __construct(
        ActionRepositoryInterface $actionRepository,
        APIUserServiceInterface $userService
    ) {
        $this->actionRepository             = $actionRepository;
        $this->userService                  = $userService;
    }

    public function index(Request $request)
    {
        $filters            = ["status"=>1];

        $actions  = $this->actionRepository->allByFilter($filters);
        $hasNext    = false;

        return Actions::updateListWithModel($actions, 0, count($actions), $hasNext)->response();
    }
}
