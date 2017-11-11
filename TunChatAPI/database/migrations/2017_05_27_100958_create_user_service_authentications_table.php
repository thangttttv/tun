<?php

use Illuminate\Database\Schema\Blueprint;
use LaravelRocket\Foundation\Database\Migration;

class CreateUserServiceAuthenticationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_service_authentications', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('user_id')->index();

            $table->string('name');
            $table->string('email');

            $table->string('service')->comment('service name , facebook, google ...');
            $table->string('service_id')->comment('service user id. It must be string');

            $table->timestamps();

         //   $table->index(['service', 'service_id']);
        });

        $this->updateTimestampDefaultValue('user_service_authentications', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_service_authentications');
    }
}
