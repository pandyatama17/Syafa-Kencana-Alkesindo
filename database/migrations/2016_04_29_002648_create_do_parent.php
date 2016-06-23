<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoParent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('do_parents',function($table)
      {
        $table->string('id')->primary();
        $table->date('do_date');
        $table->date('due_date');
        $table->date('delivery_date');
        $table->string('user_id');
        $table->string('customer_id');
        // $table->foreign('customer_id')->references('id')->on('customers');
        $table->integer('sales_id');
        $table->enum('payment',['cash','transfer']);
        $table->bigInteger('total');
        $table->integer('pic');
        $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('do_parents');
    }
}
