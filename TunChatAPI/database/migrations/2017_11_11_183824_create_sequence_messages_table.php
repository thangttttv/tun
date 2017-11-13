<?php

use Illuminate\Database\Schema\Blueprint;
use LaravelRocket\Foundation\Database\Migration;

class CreateSequenceMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sequence_messages', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedInteger('sequence_id')->default(0)->index();
            $table->unsignedInteger('message_id')->default(0)->index();
            $table->integer('sent_after_day')->default(0)->comment('Gui sau n ngay, 0 gui ngay hom nay');
            $table->integer('send')->default(0);
            $table->integer('opened')->default(0);
            $table->integer('clicked')->default(0);
            $table->timestamps();
	        $table->unique(["sequence_id","message_id"],"sequence_message");
        });

        $this->updateTimestampDefaultValue('sequence_messages', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sequence_messages');
    }
}
