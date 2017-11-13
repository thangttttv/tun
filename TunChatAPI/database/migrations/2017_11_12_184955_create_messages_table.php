<?php

use Illuminate\Database\Schema\Blueprint;
use LaravelRocket\Foundation\Database\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('messages', function (Blueprint $table) {
		    $table->bigIncrements('id');
		    $table->integer('page_id');
		    $table->string('title', 150);
		    $table->string('content',4000);
		    $table->integer('sent');
		    $table->integer('delivered');
		    $table->integer('opened');
		    $table->integer('clicked');
		    $table->timestamps();
	    });
	    $this->updateTimestampDefaultValue('messages', ['updated_at'], ['created_at']);
    }

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('messages');
	}
}
