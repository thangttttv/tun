<?php

use Illuminate\Database\Schema\Blueprint;
use LaravelRocket\Foundation\Database\Migration;

class CreateSequenceCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sequence_customers', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedInteger('sequence_id')->default(0)->index();
            $table->unsignedInteger('customer_id')->default(0)->index();

            $table->timestamps();
	        $table->unique(["sequence_id","customer_id"],"sequence_customer");
        });

        $this->updateTimestampDefaultValue('sequence_customers', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sequence_customers');
    }
}
