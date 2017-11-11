<?php

use Illuminate\Database\Schema\Blueprint;
use LaravelRocket\Foundation\Database\Migration;

class CreateCustomersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customers', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('page_id');
			$table->string('facebook_id',50);
			$table->string('name',250);
			$table->string('email',50)->nullable();
			$table->string('mobile',25)->nullable();
			$table->string('gender',25)->nullable();
			$table->string('opted_in_through',250)->nullable();
			$table->timestamp('time_subscribed')->nullable();
			$table->string('avatar_url',500)->nullable();
			$table->tinyInteger('subscribed')->default(1)->comment("1: Subscribed , 0 Un Subscribed");
			$table->tinyInteger('can_reply')->default(1)->comment("1: can reply , 0 cant reply");
			$table->string('country',50)->nullable();
			$table->string('address',150)->nullable();

			$table->timestamps();

			$table->unique(array('facebook_id', 'page_id'),"facebook_page");
			$table->unique(array('email', 'page_id'),"email_page");

		});
		$this->updateTimestampDefaultValue('customers', ['updated_at'], ['created_at']);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('customers');
	}
}
