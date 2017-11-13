<?php
namespace App\Http\Controllers\Api\V1;

use App\Exceptions\APIErrorException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\PaginationRequest;
use App\Http\Requests\Api\V1\SequenceRequest;
use App\Http\Responses\Api\V1\Sequence;
use App\Http\Responses\Api\V1\Sequences;
use App\Http\Responses\Api\V1\Status;
use App\Repositories\SequenceCustomerRepositoryInterface;
use App\Repositories\SequenceMessageRepositoryInterface;
use App\Repositories\SequenceRepositoryInterface;
use App\Services\APIUserServiceInterface;

class SequenceController extends Controller
{
    /** @var \App\Repositories\SequenceRepositoryInterface */
    protected $sequenceRepository;

    /** @var \App\Repositories\SequenceMessageRepositoryInterface */
    protected $sequenceMessageRepository;

    /** @var \App\Repositories\SequenceCustomerRepositoryInterface */
    protected $sequenceCustomerRepository;

    /** @var APIUserServiceInterface */
    protected $userService;

    public function __construct(
        SequenceRepositoryInterface $sequenceRepository,
        SequenceMessageRepositoryInterface $sequenceMessageRepository,
        SequenceCustomerRepositoryInterface $sequenceCustomerRepository,
        APIUserServiceInterface $userService
    ) {
        $this->sequenceRepository                                      = $sequenceRepository;
        $this->userService                                             = $userService;
        $this->sequenceMessageRepository                               = $sequenceMessageRepository;
        $this->sequenceCustomerRepository                              = $sequenceCustomerRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param int               $page_id
     * @param PaginationRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($page_id, PaginationRequest $request)
    {
        $offset             = $request->offset();
        $limit              = $request->limit();
        $status             = $request->get('status');
        $filters            = [];
        $filters['page_id'] = $page_id;
        if (!empty($status)) {
            $filters['status'] = $status;
        }

        $sequences  = $this->sequenceRepository->getByFilter($filters, $request->order(), $request->direction(), $offset, $limit + 1);
        $hasNext    = false;

        if (count($sequences) > $limit) {
            $hasNext    = true;
            $sequences  = $sequences->slice(0, $limit);
        }

        return Sequences::updateListWithModel($sequences, $offset, $limit, $hasNext)->response();
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $sequence = $this->sequenceRepository->find($id);
        if (empty($sequence)) {
            throw new APIErrorException('notFound', 'Sequence Not Found', []);
        }

        return Sequence::updateWithModel($sequence)->response();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SequenceRequest $request
     * @param int             $page_id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(SequenceRequest $request, $page_id)
    {
        /** @var \App\Models\User $user */
        $user             = $this->userService->getUser();
        $input            = $request->only(['title', 'sent_date', 'sent_time_from', 'sent_time_to']);
        $input['page_id'] = $page_id;
        // create sequence
        $sequence = $this->sequenceRepository->create($input);
        if (empty($sequence)) {
            throw new APIErrorException('unknown', 'Sequence Creation Failed', []);
        } else {
            return Sequence::updateWithModel($sequence)->response();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SequenceRequest $request
     * @param int             $id
     * @param int             $page_id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(SequenceRequest $request, $page_id, $id)
    {
        /** @var \App\Models\User $user */
        $user                       = $this->userService->getUser();
        $input                      = $request->only(['title', 'sent_date', 'sent_time_from', 'sent_time_to']);
        $input['page_id']           = $page_id;
        $input['id']                = $id;
        $sequence_message_ids       = $request->get('sequence_message_ids', []);
        $send_after_days            = $request->get('send_after_days', []);
        $messageIds                 = $request->get('messageIds', []);
        // update sequence
        $sequence = $this->sequenceRepository->find($id);
        if (!empty($sequence)) {
            if ((count($sequence_message_ids) + count($send_after_days) + count($messageIds)) / 3 != count($sequence_message_ids)) {
                throw new APIErrorException('wrongParameter', 'Parameter wrong', []);
            }
            $sequence = $this->sequenceRepository->update($sequence, $input);
            $i        = 0;
            // add message
            foreach ($sequence_message_ids as $seqMesId) {
                $inputMessage = ['sequence_id'=>$id, 'message_id'=>$messageIds[$i], 'sent_after_day'=>$send_after_days[$i]];
                if (intval($seqMesId) == 0) {
                    $this->sequenceMessageRepository->create($inputMessage);
                } else {
                    $sequenceMessage = $this->sequenceMessageRepository->find($seqMesId);
                    $this->sequenceMessageRepository->update($sequenceMessage, $inputMessage);
                }
                $i++;
            }
        }

        if (empty($sequence)) {
            throw new APIErrorException('unknown', 'Sequence Update Failed', []);
        } else {
            return Sequence::updateWithModel($sequence)->response();
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
        $sequence     = $this->sequenceRepository->find($id);
        if (!empty($sequence)) {
            $deleted = $this->sequenceRepository->delete($sequence);
            if ($deleted) {
                $messages = $this->sequenceMessageRepository->allByFilter(['sequence_id'=>$id]);
                foreach ($messages as $message) {
                    $this->sequenceMessageRepository->delete($message);
                }

                $customers = $this->sequenceCustomerRepository->allByFilter(['sequence_id'=>$id]);
                foreach ($customers as $customer) {
                    $this->sequenceCustomerRepository->delete($customer);
                }
            }
        }
        if ($deleted) {
            return Status::ok('Sequence deleted')->response();
        } else {
            throw new APIErrorException('unknown', 'Sequence delete Failed', []);
        }
    }
}
