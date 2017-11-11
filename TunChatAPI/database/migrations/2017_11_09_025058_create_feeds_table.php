<?php

use Illuminate\Database\Schema\Blueprint;
use LaravelRocket\Foundation\Database\Migration;

class CreateFeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feeds', function (Blueprint $table) {
	        $table->bigIncrements('id');
	        $table->integer('page_id');
	        $table->string('feed_facebook_id',50);
	        $table->string('message',4000);
	        $table->string('description',4000)->nullable();
	        $table->string('picture',500)->nullable();
	        $table->string('full_picture',500)->nullable();
	        $table->string('caption',150)->nullable();
	        $table->string('admin_creator_name',150)->nullable();
	        $table->string('admin_creator_id',50)->nullable();
	        $table->timestamp('created_time')->nullable();
	        $table->string('link',500)->nullable();
	        $table->string('from_name',150)->nullable();
	        $table->string('from_id',50)->nullable();
	        $table->tinyInteger('is_hidden')->default(1)->comment("1: hidden ");
	        $table->tinyInteger('is_published')->default(1)->comment("1: publish");
	        $table->tinyInteger('is_popular')->default(1)->comment("1: popular");
	        $table->tinyInteger('is_expired')->default(1)->comment("1: expired");
	        $table->tinyInteger('is_spherical')->default(1)->comment("1: spherical");
	        $table->tinyInteger('subscribed')->default(1)->comment("1: subscribed");

	        $table->timestamps();

	        $table->unique(array('feed_facebook_id', 'page_id'),"facebook_page");
        });
	    $this->updateTimestampDefaultValue('feeds', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feeds');
    }
}
