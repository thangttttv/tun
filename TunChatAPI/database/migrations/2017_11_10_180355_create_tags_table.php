<?php

use Illuminate\Database\Schema\Blueprint;
use LaravelRocket\Foundation\Database\Migration;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	public function up()
	{
		Schema::create('tags', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('page_id');
			$table->string('tag',50);
			$table->integer('matched')->default(0);
			$table->timestamps();

			$table->unique(array('page_id', 'tag'),"page_tag");
		});
		$this->updateTimestampDefaultValue('tags', ['updated_at'], ['created_at']);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('tags');
	}
}
