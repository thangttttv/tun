<?php
namespace App\Http\Controllers\Api\V1;

use App\Exceptions\APIErrorException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\KeywordRequest;
use App\Http\Requests\Api\V1\PaginationRequest;
use App\Http\Requests\Api\V1\Request;
use App\Http\Responses\Api\V1\Keyword;
use App\Http\Responses\Api\V1\KeywordAction;
use App\Http\Responses\Api\V1\Keywords;
use App\Http\Responses\Api\V1\Status;
use App\Repositories\ActionRepositoryInterface;
use App\Repositories\KeywordActionRepositoryInterface;
use App\Repositories\KeywordRepositoryInterface;
use App\Repositories\MessageRepositoryInterface;
use App\Repositories\SequenceRepositoryInterface;
use App\Repositories\TagRepositoryInterface;
use App\Services\APIUserServiceInterface;

class KeywordController extends Controller
{
    /** @var \App\Repositories\KeywordRepositoryInterface */
    protected $keywordRepository;

    /** @var \App\Repositories\KeywordActionRepositoryInterface */
    protected $keywordActionRepository;

    /** @var \App\Repositories\MessageRepositoryInterface */
    protected $messageRepository;

    /** @var \App\Repositories\ActionRepositoryInterface */
    protected $actionRepository;

    /** @var \App\Repositories\TagRepositoryInterface */
    protected $tagRepository;

    /** @var \App\Repositories\SequenceRepositoryInterface */
    protected $sequenceRepository;

    /** @var APIUserServiceInterface */
    protected $userService;

    public function __construct(
        KeywordRepositoryInterface $keywordRepository,
        KeywordActionRepositoryInterface $keywordActionRepository,
        MessageRepositoryInterface $messageRepository,
        ActionRepositoryInterface $actionRepository,
        TagRepositoryInterface $tagRepository,
        SequenceRepositoryInterface $sequenceRepository,
        APIUserServiceInterface $userService
    ) {
        $this->keywordRepository                    = $keywordRepository;
        $this->userService                          = $userService;
        $this->keywordActionRepository              = $keywordActionRepository;
        $this->messageRepository                    = $messageRepository;
        $this->actionRepository                     = $actionRepository;
        $this->tagRepository                        = $tagRepository;
        $this->sequenceRepository                   = $sequenceRepository;
    }

    public function index(PaginationRequest $request, $page_id)
    {
        $offset             = $request->offset();
        $limit              = $request->limit();
        $filters            = [];
        $filters['page_id'] = $page_id;

        $keywords   = $this->keywordRepository->getByFilter($filters, $request->order(), $request->direction(), $offset, $limit + 1);
        $hasNext    = false;

        if (count($keywords) > $limit) {
            $hasNext    = true;
            $keywords   = $keywords->slice(0, $limit);
        }

        return Keywords::updateListWithModel($keywords, $offset, $limit, $hasNext)->response();
    }

    /**
     * @param $id,
     * @param $page_id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($page_id, $id)
    {
        $keyword = $this->keywordRepository->find($id);
        if (empty($keyword)) {
            throw new APIErrorException('notFound', 'Keyword Not Found', []);
        }

        return Keyword::updateWithModel($keyword)->response();
    }

    /**
     * @param $request
     * @param $page_id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store($page_id, KeywordRequest $request)
    {
        /** @var \App\Models\User $user */
        $user  = $this->userService->getUser();
        $input = $request->only(['title', 'keyword_only', 'keyword_only_status', 'keyword_in', 'keyword_in_status', 'keyword_a_and_b', 'keyword_a_and_b_status',
            'keyword_a_not_b', 'keyword_a_not_b_status', 'message_id', ]);
        $input['page_id'] = $page_id;

        // create keyword
        $keyword = null;
        try {
            $keyword = $this->keywordRepository->create($input);

            return Keyword::updateWithModel($keyword)->response();
        } catch (\Exception $exception) {
            $keyword = null;
        }

        if (empty($keyword)) {
            throw new APIErrorException('unknown', 'Keyword Creation Failed', []);
        }
    }

    /**
     * @param $request
     * @param $page_id
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($page_id, $id, KeywordRequest $request)
    {
        /** @var \App\Models\User $user */
        $user  = $this->userService->getUser();
        $input = $request->only(['title', 'keyword_only', 'keyword_only_status', 'keyword_in', 'keyword_in_status', 'keyword_a_and_b', 'keyword_a_and_b_status',
            'keyword_a_not_b', 'keyword_a_not_b_status', 'message_id', ]);
        $input['page_id'] = $page_id;
        $input['id']      = $id;
        $keyword          = $this->keywordRepository->find($id);
        if (empty($keyword)) {
            throw new APIErrorException('unknown', 'Keyword Not Found', []);
        }

        // update keyword
        try {
            $keyword = $this->keywordRepository->update($keyword, $input);

            return Keyword::updateWithModel($keyword)->response();
        } catch (\Exception $exception) {
            $keyword = null;
        }

        if (empty($keyword)) {
            throw new APIErrorException('unknown', 'Keyword Update Failed', []);
        }
    }

    /**
     * @param $message_id
     * @param $page_id
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeMessage($page_id, $id, $message_id)
    {
        /** @var \App\Models\User $user */
        $user                     = $this->userService->getUser();
        $input['page_id']         = $page_id;
        $input['id']              = $id;
        $input['message_id']      = $message_id;
        $keyword                  = $this->keywordRepository->find($id);
        if (empty($keyword)) {
            throw new APIErrorException('unknown', 'Keyword Not Found', []);
        }
        $message          = $this->messageRepository->find($message_id);
        if (empty($message)) {
            throw new APIErrorException('unknown', 'Message Not Found', []);
        }

        // update keyword
        try {
            $keyword = $this->keywordRepository->update($keyword, $input);

            return Keyword::updateWithModel($keyword)->response();
        } catch (\Exception $exception) {
            $keyword = null;
        }

        if (empty($keyword)) {
            throw new APIErrorException('unknown', 'Keyword Add Message Failed', []);
        }
    }

    /**
     * @param $page_id
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeMessage($page_id, $id)
    {
        /** @var \App\Models\User $user */
        $user                     = $this->userService->getUser();
        $input['page_id']         = $page_id;
        $input['id']              = $id;
        $input['message_id']      = 0;
        $keyword                  = $this->keywordRepository->find($id);
        if (empty($keyword)) {
            throw new APIErrorException('unknown', 'Keyword Not Found', []);
        }

        // update keyword
        try {
            $keyword = $this->keywordRepository->update($keyword, $input);

            return Keyword::updateWithModel($keyword)->response();
        } catch (\Exception $exception) {
            $keyword = null;
        }

        if (empty($keyword)) {
            throw new APIErrorException('unknown', 'Keyword Remove Message Failed', []);
        }
    }

    /**
     * @param $action_id
     * @param $page_id
     * @param $id
     * @param $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function addAction($page_id, $id, $action_id, Request $request)
    {
        /** @var \App\Models\User $user */
        $user                     = $this->userService->getUser();
        $input['page_id']         = $page_id;
        $input['id']              = $id;

        $keyword                  = $this->keywordRepository->find($id);
        if (empty($keyword)) {
            throw new APIErrorException('unknown', 'Keyword Not Found', []);
        }
        $action                  = $this->actionRepository->find($action_id);
        if (empty($action)) {
            throw new APIErrorException('unknown', 'Action Not Found', []);
        }

        $keyAction = null;
        switch ($action->code) {
            case 'TAG_ADD':
                $tag_id               = $request->get('tag_id');
                $tag                  = $this->tagRepository->find($tag_id);
                if (empty($tag)) {
                    throw new APIErrorException('unknown', 'Tag Not Found', []);
                }
                $obj        = (object) ['tag_id' => $tag_id];
                $parameters = json_encode($obj);
                $keyAction  = $this->keywordActionRepository->create(['keyword_id'=> $id, 'action_id'=>$action_id, 'parameters'                                                => $parameters]);
                break;
            case 'TAG_REMOVE':
                $keyword_action_id               = $request->get('keyword_action_id');
                $keyAction                       = $this->keywordActionRepository->find($keyword_action_id);
                if (empty($keyAction)) {
                    throw new APIErrorException('unknown', 'Action not available', []);
                }

                $this->keywordActionRepository->delete($keyAction);
                break;
            case 'SEQ_SUB':
                break;
            case 'SEQ_UNSUB':
                break;
            case 'CONVERSATION_OPEN':
                break;
            case 'ADMIN_NOTIFY':
                break;
            case 'CUSTOM_FIELD_SET':
                break;
            case 'CUSTOM_FIELD_CLEAR':
                break;
            case 'BOT_SUB':
                break;
            case 'BOT_UNSUB':
                break;
        }

        if (empty($keyAction)) {
            throw new APIErrorException('unknown', 'Keyword Add Action Failed', []);
        } else {
            return KeywordAction::updateWithModel($keyAction)->response();
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
        $deleted      = false;
        $keyword      = $this->keywordRepository->find($id);
        if (!empty($keyword)) {
            $deleted = $this->keywordRepository->delete($keyword);
            if ($deleted) {
                $actions = $this->keywordActionRepository->allByFilter(['keyword_id'=>$id]);
                foreach ($actions as $action) {
                    $this->keywordActionRepository->delete($action);
                }
            }
        }
        if ($deleted) {
            return Status::ok('Keyword deleted')->response();
        } else {
            throw new APIErrorException('unknown', 'Keyword delete Failed', []);
        }
    }
}
