<?php

use Illuminate\Database\Schema\Blueprint;
use LaravelRocket\Foundation\Database\Migration;

class CreatePageUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_users', function (Blueprint $table) {
	        $table->bigIncrements('id');

	        $table->unsignedInteger('user_id')->default(0)->index();
	        $table->unsignedInteger('page_id')->default(0)->index();

	        $table->timestamps();
        });

	    $this->updateTimestampDefaultValue('page_users', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('page_users');
    }
}
