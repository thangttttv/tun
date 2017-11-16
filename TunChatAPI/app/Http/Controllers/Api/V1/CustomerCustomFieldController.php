<?php
namespace App\Http\Controllers\Api\V1;

use App\Exceptions\APIErrorException;
use App\Http\Controllers\Controller;
use App\Http\Responses\Api\V1\CustomerCustomField;
use App\Http\Responses\Api\V1\CustomerCustomFields;
use App\Http\Responses\Api\V1\Status;
use App\Repositories\CustomerCustomFieldRepositoryInterface;
use App\Services\APIUserServiceInterface;
use Illuminate\Http\Request;

class CustomerCustomFieldController extends Controller
{
    /** @var \App\Repositories\CustomerCustomFieldRepositoryInterface */
    protected $customerCustomFieldRepository;

    /** @var APIUserServiceInterface */
    protected $userService;

    public function __construct(
        CustomerCustomFieldRepositoryInterface $customerCustomFieldRepository,
        APIUserServiceInterface $userService
    ) {
        $this->customerCustomFieldRepository            = $customerCustomFieldRepository;
        $this->userService                              = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param $page_id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($page_id)
    {
        $customFields = $this->customerCustomFieldRepository->allByFilter(['page_id'=>$page_id]);

        return CustomerCustomFields::updateListWithModel($customFields, $offset = 0, count($customFields), false)->response();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param $page_id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store($page_id, Request $request)
    {
        /** @var \App\Models\User $user */
        $user             = $this->userService->getUser();
        $input            = $request->only(['field', 'type', 'description', 'status']);
        $input['page_id'] = $page_id;
        // create field
        $field = $this->customerCustomFieldRepository->create($input);
        if (empty($field)) {
            throw new APIErrorException('unknown', 'Field Creation Failed', []);
        } else {
            return CustomerCustomField::updateWithModel($field)->response();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     * @param int                      @page_id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($page_id, $id, Request $request)
    {
        /** @var \App\Models\User $user */
        $user             = $this->userService->getUser();
        $input            = $request->only(['field', 'type', 'description', 'status']);
        $input['page_id'] = $page_id;
        // create field
        $field = null;
        $field = $this->customerCustomFieldRepository->find($id);
        $field = $this->customerCustomFieldRepository->update($field, $input);
        if (empty($field)) {
            throw new APIErrorException('unknown', 'Field Update Failed', []);
        } else {
            return CustomerCustomField::updateWithModel($field)->response();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($page_id, $id)
    {
        $deleted = false;
        $field   = $this->customerCustomFieldRepository->find($id);
        if (!empty($field)) {
            $deleted = $this->customerCustomFieldRepository->delete($field);
        }
        if ($deleted) {
            return Status::ok('Field deleted')->response();
        } else {
            throw new APIErrorException('unknown', 'Field delete Failed', []);
        }
    }
}
