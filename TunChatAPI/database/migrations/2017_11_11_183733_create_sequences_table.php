<?php

use Illuminate\Database\Schema\Blueprint;
use LaravelRocket\Foundation\Database\Migration;

class CreateSequencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sequences', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('page_id');
            $table->string('title', 50);
            $table->string('sent_date')->default('All')->comment('Ngay gui trong tuan thu 2 - cn');
            $table->string('sent_time_from')->default('9:00')->comment('Thoi gian gui tu');
            $table->string('sent_time_to')->default('17:00')->comment('Thoi gian ket thuc gui');
            $table->tinyInteger('status')->default(1)->comment('1: active, 0: Inactive ');
            $table->integer('embedded');
            $table->integer('message');
            $table->integer('opened');
            $table->integer('clicked');
            $table->timestamps();
        });
        $this->updateTimestampDefaultValue('sequences', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sequences');
    }
}
