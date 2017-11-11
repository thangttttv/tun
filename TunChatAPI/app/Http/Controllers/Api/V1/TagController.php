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
     * @return \Illuminate\Http\Response
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
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /** @var \App\Models\User $user */
        $user  = $this->userService->getUser();
        $input = $request->only(['page_id', 'tag']);
	    $input["matched"] = 0;
        // create tag
        $tag = $this->tagRepository->create($input);
        if (empty($tag)) {
            throw new APIErrorException('unknown', 'Tag Creation Failed', []);
        } else {
            return Tag::updateWithModel($tag)->response();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $customer_id
     * @param int $tag_id
     *
     * @return \Illuminate\Http\Response
     */
    public function removeTag($customer_id,$tag_id)
    {
	    $tagCustomer = $this->tagCustomerRepository->findByTagIdAndCustomerId($tag_id,$customer_id);
	    if(!empty($tagCustomer)){
		    $this->tagCustomerRepository->delete($tagCustomer);
		    return Status::ok("Tag remove success")->response();
	    }else{
		    return Status::error("unknown","Tag remove failed")->response();
	    }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $customer_id
     * @param int $tag_id
     *
     * @return \Illuminate\Http\Response
     */
    public function tag($customer_id,$tag_id)
    {
        $tagCustomer = $this->tagCustomerRepository->create(["customer_id"=>$customer_id,"tag_id"=>$tag_id]);
        if(empty($tagCustomer)){
        	return Status::error("unknown","Tag failed")->response();
        }else{
        	// count update
	        return Status::ok("Tag success")->response();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /** @var \App\Models\User $user */
        $user  = $this->userService->getUser();
        $input = $request->only(['page_id', 'tag']);
        // update tag
        $tag = null;
        $tag = $this->tagRepository->find($id);
        if(!empty($tag)){
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
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
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
