<?php

use Illuminate\Database\Schema\Blueprint;
use LaravelRocket\Foundation\Database\Migration;

class CreateKeywordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keywords', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('page_id');
            $table->string('title', 150);
            $table->string('keyword_only', 4000);
            $table->tinyInteger('keyword_only_status')->default(1);
            $table->string('keyword_in', 4000);
            $table->tinyInteger('keyword_in_status')->default(1);
            $table->string('keyword_a_and_b', 4000);
            $table->tinyInteger('keyword_a_and_b_status')->default(1);
            $table->string('keyword_a_not_b', 4000);
            $table->tinyInteger('keyword_a_not_b_status')->default(1);
            $table->integer('message_id')->default(0);
            $table->timestamps();
        });
        $this->updateTimestampDefaultValue('keywords', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('keywords');
    }
}
