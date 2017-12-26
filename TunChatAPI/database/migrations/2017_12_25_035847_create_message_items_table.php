<?php

use Illuminate\Database\Schema\Blueprint;
use LaravelRocket\Foundation\Database\Migration;

class CreateMessageItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_items', function (Blueprint $table) {
            $table->bigIncrements('id');
	        $table->bigInteger('message_id');
	        $table->String('type');
	        $table->string('message', 4000);
	        $table->timestamps();
        });
	    $this->updateTimestampDefaultValue('message_items', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('message_items');
    }
}
