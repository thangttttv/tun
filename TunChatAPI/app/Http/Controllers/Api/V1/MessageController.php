<?php

namespace App\Http\Controllers\Api\V1;

use App\Exceptions\APIErrorException;
use App\Http\Responses\Api\V1\Message;
use App\Repositories\MessageItemRepositoryInterface;
use App\Repositories\MessageRepositoryInterface;
use App\Services\APIUserServiceInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{

	/** @var APIUserServiceInterface */
	protected $userService;

	/** @var MessageRepositoryInterface */
	protected $messageRepository;

	/** @var MessageItemRepositoryInterface */
	protected $messageItemRepository;

	public function __construct(
		MessageRepositoryInterface $messageRepository,
		APIUserServiceInterface $userService,
		MessageItemRepositoryInterface $messageItemRepository
	) {
		$this->messageRepository           = $messageRepository;
		$this->userService                  = $userService;
		$this->messageItemRepository           = $messageItemRepository;

	}

	//
	public function store($page_id, Request $request)
	{
		/** @var \App\Models\User $user */
		$user               = $this->userService->getUser();
		$message = null;
		$data = $request->json()->all();
		$message_title = $data["message"]["title"];
		$items = $data["items"];

		if(empty($message_title)){
			throw new APIErrorException('wrongParameter', 'Message title not found', []);
		}

		$message = $this->messageRepository->create(["title"=>$message_title,"page_id"=>$page_id]);

		if(($items==null)){
			throw new APIErrorException('wrongParameter', 'Item messages not found', []);
		}

		foreach ($items as $item){
			$type = $item["type"];
			switch ($type){
				case "text":
					$this->processMessageText($message->id, $item);
					break;
				case "button":
					$this->processMessageButton($message->id, $item);
					break;
				case "list":
					$this->processMessageList($message->id, $item);
					break;
				case "generic":
					$this->processMessageGeneric($message->id, $item);
					break;
				case "file":
					$this->processMessageFile($message->id, $item);
					break;
				case "image":
					$this->processMessageImage($message->id, $item);
					break;
				case "Video":
					$this->processMessageVideo($message->id, $item);
					break;
				case "audio":
					$this->processMessageAudio($message->id, $item);
					break;
				case "quick_replies":
					$this->processMessageQuickReply($message->id, $item);
					break;
			}
		}

		if (empty($message)) {
			throw new APIErrorException('unknown', 'Message Creation Failed', []);
		}else{
			return Message::updateWithModel($message)->withStatus(201)->response();
		}
	}

	public function processMessageText($message_id, $message){
			$text = $message["text"];
			$object = (object) ['text' => $text];
			$this->messageItemRepository->create(["message_id"=>$message_id,"type"=>"text","message"=>json_encode($object)]);
	}

	public function processMessageButton($message_id, $message){
		$text = $message["text"];
		$buttons = $message["buttons"];
		$object = (object) ['text' => $text,'buttons'=>$buttons];
		$this->messageItemRepository->create(["message_id"=>$message_id,"type"=>"button","message"=>json_encode($object)]);
	}

	public function processMessageList($message_id, $message){
		$top_element_style = $message["top_element_style"];
		$elements = $message["elements"];
		$object = (object) ['top_element_style' => $top_element_style,'elements'=>$elements];
		$this->messageItemRepository->create(["message_id"=>$message_id,"type"=>"list","message"=>json_encode($object)]);
	}

	public function processMessageGeneric($message_id, $message){
		$elements = $message["elements"];
		$object = (object) ['elements'=>$elements];
		$this->messageItemRepository->create(["message_id"=>$message_id,"type"=>"generic","message"=>json_encode($object)]);
	}

	public function processMessageFile($message_id, $message){
		$url = $message["url"];
		$object = (object) ['url'=>$url];
		$this->messageItemRepository->create(["message_id"=>$message_id,"type"=>"file","message"=>json_encode($object)]);
	}

	public function processMessageImage($message_id, $message){
		$url = $message["url"];
		$object = (object) ['url'=>$url];
		$this->messageItemRepository->create(["message_id"=>$message_id,"type"=>"image","message"=>json_encode($object)]);
	}

	public function processMessageAudio($message_id, $message){
		$url = $message["url"];
		$object = (object) ['url'=>$url];
		$this->messageItemRepository->create(["message_id"=>$message_id,"type"=>"audio","message"=>json_encode($object)]);
	}

	public function processMessageVideo($message_id, $message){
		$url = $message["url"];
		$object = (object) ['url'=>$url];
		$this->messageItemRepository->create(["message_id"=>$message_id,"type"=>"video","message"=>json_encode($object)]);
	}

	public function processMessageQuickReply($message_id, $message){
		$text = $message["text"];
		$quick_replies = $message["quick_replies"];
		$object = (object) ['text'=>$text,"quick_replies"=>$quick_replies];
		$this->messageItemRepository->create(["message_id"=>$message_id,"type"=>"video","message"=>json_encode($object)]);
	}

}
