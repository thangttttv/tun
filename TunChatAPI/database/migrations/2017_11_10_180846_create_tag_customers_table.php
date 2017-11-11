<?php

use Illuminate\Database\Schema\Blueprint;
use LaravelRocket\Foundation\Database\Migration;

class CreateTagCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	public function up()
	{
		Schema::create('tag_customers', function (Blueprint $table) {
			$table->bigIncrements('id');

			$table->unsignedInteger('tag_id')->default(0)->index();
			$table->unsignedInteger('customer_id')->default(0)->index();

			$table->timestamps();
			$table->unique(array('tag_id', 'customer_id'),"tag_cus");
		});

		$this->updateTimestampDefaultValue('tag_customers', ['updated_at'], ['created_at']);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('tag_customers');
	}
}
