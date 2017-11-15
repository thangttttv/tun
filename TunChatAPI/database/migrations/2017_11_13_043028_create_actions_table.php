<?php

use Illuminate\Database\Schema\Blueprint;
use LaravelRocket\Foundation\Database\Migration;

class CreateActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('actions', function (Blueprint $table) {
		    $table->bigIncrements('id');
		    $table->string('code',150)->unique();
		    $table->string('title',500);
		    $table->string('description',500);
		    $table->tinyInteger('status')->default(1);
		    $table->timestamps();

	    });
	    $this->updateTimestampDefaultValue('actions', ['updated_at'], ['created_at']);
    }

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('actions');
	}
}
