<?php

use Illuminate\Database\Schema\Blueprint;
use LaravelRocket\Foundation\Database\Migration;

class CreateMessageLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('message_logs', function (Blueprint $table) {
		    $table->bigIncrements('id');
		    $table->string('sender_id', 150);
		    $table->string('recipient_id', 150);
		    $table->string('message')->default(0);
		    $table->timestamp('sent_at');
		    $table->timestamps();
	    });
	    $this->updateTimestampDefaultValue('message_logs', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::dropIfExists('message_logs');
    }
}
