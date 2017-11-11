<?php

use Illuminate\Database\Schema\Blueprint;
use LaravelRocket\Foundation\Database\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('account_id');
            $table->string('facebook_id');
            $table->string('email');
	        $table->string('password');
            $table->string('full_name');
            $table->string('avatar')->nullable();
            $table->string('mobile')->nullable();
            $table->integer('is_owner')->default(0);

            $table->rememberToken();
            $table->timestamps();
        });
        $this->updateTimestampDefaultValue('users', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
