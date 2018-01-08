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
		    $table->string('type',150);
		    $table->integer('sent')->default(0);
		    $table->integer('delivered')->default(0);
		    $table->integer('opened')->default(0);
		    $table->integer('clicked')->default(0);
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
