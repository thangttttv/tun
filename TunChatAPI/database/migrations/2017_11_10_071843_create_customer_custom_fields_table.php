<?php

use Illuminate\Database\Schema\Blueprint;
use LaravelRocket\Foundation\Database\Migration;

class CreateCustomerCustomFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('customer_custom_fields', function (Blueprint $table) {
		    $table->bigIncrements('id');
		    $table->integer('page_id');
		    $table->string('field',25);
		    $table->string('type');
		    $table->string('description',500)->nullable();
		    $table->tinyInteger('status');
		    $table->timestamps();
		    $table->unique(array('page_id', 'field'),"field_page");
	    });
	    $this->updateTimestampDefaultValue('customer_custom_fields', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::dropIfExists('customers');
    }
}
