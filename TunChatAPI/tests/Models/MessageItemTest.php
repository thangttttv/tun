<?php

namespace Tests\Models;

use App\Models\MessageItem;
use Tests\TestCase;

class MessageItemTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\MessageItem $messageItem */
        $messageItem = new MessageItem();
        $this->assertNotNull($messageItem);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\MessageItem $messageItem */
        $messageItemModel = new MessageItem();

        $messageItemData = factory(MessageItem::class)->make();
        foreach( $messageItemData->toFillableArray() as $key => $value ) {
            $messageItemModel->$key = $value;
        }
        $messageItemModel->save();

        $this->assertNotNull(MessageItem::find($messageItemModel->id));
    }

}
