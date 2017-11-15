<?php

/**
 * Created by PhpStorm.
 * User: ThangTT
 * Date: 15/11/2017
 * Time: 2:59 CH.
 */
use Illuminate\Database\Seeder;

class ActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        /** @var \App\Repositories\ActionRepositoryInterface $actionRepository */
        $actionRepository = \App::make('App\Repositories\ActionRepositoryInterface');

        $action = $actionRepository->create([
            'code'            => 'TAG_ADD',
            'title'           => 'Add Tag',
            'description'     => '',
            'status'          => '1',
        ]);

        $action = $actionRepository->create([
            'code'            => 'TAG_REMOVE',
            'title'           => 'Remove Tag',
            'description'     => 'Bo tag',
            'status'          => '1',
        ]);

        $action = $actionRepository->create([
            'code'            => 'SEQ_SUB',
            'title'           => 'Subscribe to Sequence',
            'description'     => '',
            'status'          => '1',
        ]);

        $action = $actionRepository->create([
            'code'            => 'SEQ_UNSUB',
            'title'           => 'Unsubscribe from Sequence',
            'description'     => '',
            'status'          => '1',
        ]);

        $action = $actionRepository->create([
            'code'            => 'CONVERSATION_OPEN',
            'title'           => 'Open conversation',
            'description'     => '',
            'status'          => '1',
        ]);

        $action = $actionRepository->create([
            'code'            => 'ADMIN_NOTIFY',
            'title'           => 'Notify Admins',
            'description'     => '',
            'status'          => '1',
        ]);

        $action = $actionRepository->create([
            'code'            => 'CUSTOM_FIELD_SET',
            'title'           => 'Set subscriber Custom Field',
            'description'     => '',
            'status'          => '1',
        ]);

        $action = $actionRepository->create([
            'code'            => 'CUSTOM_FIELD_CLEAR',
            'title'           => 'Clear subscriber Custom Field',
            'description'     => '',
            'status'          => '1',
        ]);

        $action = $actionRepository->create([
            'code'            => 'BOT_SUB',
            'title'           => 'Subscribe to bot',
            'description'     => '',
            'status'          => '1',
        ]);

        $action = $actionRepository->create([
            'code'            => 'BOT_UNSUB',
            'title'           => 'Unsubscribe from bot',
            'description'     => '',
            'status'          => '1',
        ]);
    }
}
