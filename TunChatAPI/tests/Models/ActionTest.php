<?php

namespace Tests\Models;

use App\Models\Action;
use Tests\TestCase;

class ActionTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\Action $action */
        $action = new Action();
        $this->assertNotNull($action);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\Action $action */
        $actionModel = new Action();

        $actionData = factory(Action::class)->make();
        foreach( $actionData->toFillableArray() as $key => $value ) {
            $actionModel->$key = $value;
        }
        $actionModel->save();

        $this->assertNotNull(Action::find($actionModel->id));
    }

}
