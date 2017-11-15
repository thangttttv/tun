<?php

use Illuminate\Database\Schema\Blueprint;
use LaravelRocket\Foundation\Database\Migration;

class CreateKeywordActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('keyword_actions', function (Blueprint $table) {
		    $table->bigIncrements('id');

		    $table->unsignedInteger('keyword_id')->default(0)->index();
		    $table->unsignedInteger('action_id')->default(0)->index();
		    $table->string('parameters',4000);
		    $table->timestamps();
		    $table->unique(array('keyword_id', 'action_id'),"keyword_action");
	    });

	    $this->updateTimestampDefaultValue('keyword_actions', ['updated_at'], ['created_at']);
    }

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('keyword_actions');
	}
}
