<?php
namespace App\Http\Controllers\Api\V1;

use App\Exceptions\APIErrorException;
use App\Http\Controllers\Controller;
use App\Http\Responses\Api\V1\Status;
use App\Http\Responses\Api\V1\Tag;
use App\Http\Responses\Api\V1\Tags;
use App\Repositories\TagCustomerRepositoryInterface;
use App\Repositories\TagRepositoryInterface;
use App\Services\APIUserServiceInterface;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /** @var \App\Repositories\TagRepositoryInterface */
    protected $tagRepository;

    /** @var \App\Repositories\TagCustomerRepositoryInterface */
    protected $tagCustomerRepository;

    /** @var APIUserServiceInterface */
    protected $userService;

    public function __construct(
        TagRepositoryInterface $tagRepository,
        TagCustomerRepositoryInterface $tagCustomerRepository,
        APIUserServiceInterface $userService
    ) {
        $this->tagRepository                                      = $tagRepository;
        $this->userService                                        = $userService;
        $this->tagCustomerRepository                              = $tagCustomerRepository;
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
        $tags = $this->tagRepository->allByFilter(['page_id'=>$page_id]);

        return Tags::updateListWithModel($tags, $offset = 0, count($tags), false)->response();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param $page_id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store($page_id, Request $request)
    {
        /** @var \App\Models\User $user */
        $user             = $this->userService->getUser();
        $input            = $request->only(['tag']);
        $input['matched'] = 0;
        $input['page_id'] =$page_id;
        // create tag
        $tag = $this->tagRepository->create($input);
        if (empty($tag)) {
            throw new APIErrorException('unknown', 'Tag Creation Failed', []);
        } else {
            return Tag::updateWithModel($tag)->response();
        }
    }

    /**
     * Customer remove tag
     *
     * @param int $customer_id
     * @param int $tag_id
     * @param int $page_id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeTag($page_id, $tag_id, Request $request)
    {
        $customer_ids = $request->get('customer_ids', []);
        if (empty($customer_ids)) {
            throw new APIErrorException('unknown', 'Customer not choice', []);
        }

        foreach ($customer_ids as $customer_id) {
            $customerTag = $this->tagCustomerRepository->findByCustomerIdAndTagId($customer_id, $tag_id);
            if (empty($customerTag)) {
                $this->tagCustomerRepository->delete($customerTag);
            }
        }

        return Status::ok('Tag remove success')->response();
    }

    /**
     * Customer add tag
     *
     * @param Request $request
     * @param int     $tag_id
     * @param int     $page_id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function tag($page_id, $tag_id, Request $request)
    {
        $customer_ids = $request->get('customer_ids', []);
        if (empty($customer_ids)) {
            throw new APIErrorException('unknown', 'Customer not choice', []);
        }

        foreach ($customer_ids as $customer_id) {
            $customerTag = $this->tagCustomerRepository->findByCustomerIdAndTagId($customer_id, $tag_id);
            if (empty($customerTag)) {
                $this->tagCustomerRepository->create(['tag_id'=>$tag_id, 'customer_id'=>$customer_id]);
            }
        }

        return Status::ok('Tag success')->response();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     * @param int                      $page_id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($page_id, $id, Request $request)
    {
        /** @var \App\Models\User $user */
        $user             = $this->userService->getUser();
        $input            = $request->only(['tag']);
        $input['page_id'] = $page_id;
        // update tag
        $tag = null;
        $tag = $this->tagRepository->find($id);
        if (!empty($tag)) {
            $tag = $this->tagRepository->update($tag, $input);
        }

        if (empty($tag)) {
            throw new APIErrorException('unknown', 'Tag Update Failed', []);
        } else {
            return Tag::updateWithModel($tag)->response();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @param int $page_id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($page_id, $id)
    {
        $deleted = false;
        $tag     = $this->tagRepository->find($id);
        if (!empty($tag)) {
            $deleted = $this->tagRepository->delete($tag);
        }
        if ($deleted) {
            return Status::ok('Tag deleted')->response();
        } else {
            throw new APIErrorException('unknown', 'Tag delete Failed', []);
        }
    }
}
