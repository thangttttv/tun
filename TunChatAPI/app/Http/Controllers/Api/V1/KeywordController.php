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
use App\Repositories\CustomerCustomFieldRepositoryInterface;
use App\Repositories\CustomerRepositoryInterface;
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

    /** @var \App\Repositories\CustomerCustomFieldRepositoryInterface */
    protected $customerCustomFieldRepository;

    /** @var \App\Repositories\CustomerRepositoryInterface */
    protected $customerRepository;

    /** @var APIUserServiceInterface */
    protected $userService;

    public function __construct(
        KeywordRepositoryInterface $keywordRepository,
        KeywordActionRepositoryInterface $keywordActionRepository,
        MessageRepositoryInterface $messageRepository,
        ActionRepositoryInterface $actionRepository,
        TagRepositoryInterface $tagRepository,
        SequenceRepositoryInterface $sequenceRepository,
        CustomerCustomFieldRepositoryInterface $customerCustomFieldRepository,
        CustomerRepositoryInterface $customerRepository,
        APIUserServiceInterface $userService
    ) {
        $this->keywordRepository                               = $keywordRepository;
        $this->userService                                     = $userService;
        $this->keywordActionRepository                         = $keywordActionRepository;
        $this->messageRepository                               = $messageRepository;
        $this->actionRepository                                = $actionRepository;
        $this->tagRepository                                   = $tagRepository;
        $this->sequenceRepository                              = $sequenceRepository;
        $this->customerCustomFieldRepository                   = $customerCustomFieldRepository;
        $this->customerRepository                              = $customerRepository;
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

        $keyAction=$this->keywordActionRepository->findByKeywordIdAndActionId($id, $action_id);
        if ($keyAction != null) {
            throw new APIErrorException('unknown', 'Action had assign', []);
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
                $objPara    = (object) ['action' => $action->code, 'data'=>$obj];
                $parameters = json_encode($objPara);

                $keyAction  = $this->keywordActionRepository->create(['keyword_id'=> $id, 'action_id'=>$action_id,
                    'parameters'                                                  => $parameters, ]);
                break;
            case 'TAG_REMOVE':
                $tag_id               = $request->get('tag_id');
                $tag                  = $this->tagRepository->find($tag_id);
                if (empty($tag)) {
                    throw new APIErrorException('unknown', 'Tag Not Found', []);
                }
                $obj        = (object) ['tag_id' => $tag_id];
                $objPara    = (object) ['action' => $action->code, 'data'=>$obj];
                $parameters = json_encode($objPara);

                $keyAction  = $this->keywordActionRepository->create(['keyword_id'=> $id, 'action_id'=>$action_id,
                    'parameters'                                                  => $parameters, ]);
                break;
            case 'SEQ_SUB':
                $seq_id               = $request->get('seq_id');
                $seq                  = $this->sequenceRepository->find($seq_id);
                if (empty($seq)) {
                    throw new APIErrorException('unknown', 'Sequence Not Found', []);
                }
                $obj        = (object) ['seq_id' => $seq_id];
                $objPara    = (object) ['action' => $action->code, 'data'=>$obj];
                $parameters = json_encode($objPara);

                $keyAction  = $this->keywordActionRepository->create(['keyword_id'=> $id, 'action_id'=>$action_id,
                    'parameters'                                                  => $parameters, ]);
                break;
            case 'SEQ_UNSUB':
                $seq_id               = $request->get('seq_id');
                $seq                  = $this->sequenceRepository->find($seq_id);
                if (empty($seq)) {
                    throw new APIErrorException('unknown', 'Sequence Not Found', []);
                }
                $obj        = (object) ['seq_id' => $seq_id];
                $objPara    = (object) ['action' => $action->code, 'data'=>$obj];
                $parameters = json_encode($objPara);

                $keyAction  = $this->keywordActionRepository->create(['keyword_id'=> $id, 'action_id'=>$action_id,
                    'parameters'                                                  => $parameters, ]);
                break;
            case 'CONVERSATION_OPEN':
                $user_facebook_id               = $request->get('user_facebook_id');
                $obj                            = (object) ['user_facebook_id' => $user_facebook_id];
                $objPara                        = (object) ['action' => $action->code, 'data'=>$obj];
                $parameters                     = json_encode($objPara);

                $keyAction                      = $this->keywordActionRepository->create(['keyword_id'=> $id, 'action_id'=>$action_id,
                    'parameters'                                                                      => $parameters, ]);
                break;
            case 'ADMIN_NOTIFY':
                $content_notify               = $request->get('content_notify');
                $user_ids                     = $request->get('user_ids', []);
                $is_emails                    = $request->get('is_emails', []);
                $is_messengers                = $request->get('is_messengers', []);

                if (empty($content_notify)) {
                    throw new APIErrorException('unknown', 'Content notify not blank', []);
                }

                if (count($user_ids) == 0) {
                    throw new APIErrorException('unknown', 'Admin not choice', []);
                }

                $i = 0;

                foreach ($user_ids as $user_id) {
                    if (intval($user_id) > 0) {
                        if (intval($is_emails[$i]) == 0 && intval($is_messengers[$i]) == 0) {
                            throw new APIErrorException('unknown', 'Notify message or email must choice', []);
                        }
                    }
                    $i++;
                }

                $i          = 0;
                $parameters = [];
                foreach ($user_ids as $user_id) {
                    if (intval($user_id) > 0) {
                        $obj            = (object) ['user_id' => $user_id, 'is_email' => $is_emails[$i], 'is_messenger' => $is_messengers[$i]];
                        $parameters[$i] = $obj;
                    }
                    $i++;
                }

                $objPara    = (object) ['action' => $action->code, 'data'=>$parameters];
                $parameters = json_encode($objPara);
                $keyAction  = $this->keywordActionRepository->create(['keyword_id'=> $id, 'action_id'=>$action_id,
                    'parameters'                                                  => $parameters, ]);
                break;
            case 'CUSTOM_FIELD_SET':
                $field_id                  = $request->get('field_id');
                $field_value               = $request->get('field_value');
                $field                     = $this->customerCustomFieldRepository->find($field_id);
                if (empty($field)) {
                    throw new APIErrorException('unknown', 'Field not found', []);
                }
                if (empty($field_value)) {
                    throw new APIErrorException('unknown', 'Field value not blank.', []);
                }
                $obj        = (object) ['field_id' => $field_id, 'field_value'=>$field_value];
                $objPara    = (object) ['action' => $action->code, 'data'=>$obj];
                $parameters = json_encode($objPara);

                $keyAction  = $this->keywordActionRepository->create(['keyword_id'=> $id, 'action_id'=>$action_id,
                    'parameters'                                                  => $parameters, ]);
                break;
            case 'CUSTOM_FIELD_CLEAR':
                $field_id               = $request->get('field_id');
                $field                  = $this->customerCustomFieldRepository->find($field_id);
                if (empty($field)) {
                    throw new APIErrorException('unknown', 'Field not found', []);
                }
                $obj        = (object) ['field_id' => $field_id];
                $objPara    = (object) ['action' => $action->code, 'data'=>$obj];
                $parameters = json_encode($objPara);

                $keyAction  = $this->keywordActionRepository->create(['keyword_id'=> $id, 'action_id'=>$action_id,
                    'parameters'                                                  => $parameters, ]);
                break;
            case 'BOT_SUB':
                $obj        = (object) ['subscribe' => 'true'];
                $objPara    = (object) ['action' => $action->code, 'data'=>$obj];
                $parameters = json_encode($objPara);

                $keyAction  = $this->keywordActionRepository->create(['keyword_id'=> $id, 'action_id'=>$action_id,
                    'parameters'                                                  => $parameters, ]);
                break;
            case 'BOT_UNSUB':
                $obj        = (object) ['unSubscribe' => 'true'];
                $objPara    = (object) ['action' => $action->code, 'data'=>$obj];
                $parameters = json_encode($objPara);

                $keyAction  = $this->keywordActionRepository->create(['keyword_id'=> $id, 'action_id'=>$action_id,
                    'parameters'                                                  => $parameters, ]);
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
