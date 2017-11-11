<?php

use Illuminate\Database\Schema\Blueprint;
use LaravelRocket\Foundation\Database\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
	        $table->bigIncrements('id');
	        $table->string('facebook_id',50)->unique();
	        $table->string('name',150);
	        $table->string('access_token',500);
	        $table->string('page_token',150);
	        $table->string('category',150);
	        $table->string('picture_url',500)->nullable();
	        $table->tinyInteger('subscribed')->default(1)->comment("1: subscribed , 0 Unsubscribed");

            $table->timestamps();
        });
	    $this->updateTimestampDefaultValue('pages', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
