<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('invoice_parents');
        Schema::create('invoice_parents',function($table)
        {
          $table->increments('id');
          $table->string('invoice_id')->unique();
          $table->date('invoice_date');
          $table->date('due_date');
          $table->date('delivery_date');
          $table->string('customer_id');
         //  $table->foreign('customer_id')->references('id')->on('customers');
          $table->integer('sales_id');
          $table->enum('payment',['cash','transfer']);
          $table->bigInteger('total');
          $table->integer('pic');
          $table->timestamps();
        });
        Schema::drop('do_parents');
        Schema::create('do_parents',function($table)
        {
          $table->increments('id');
          $table->string('do_id')->unique();
          $table->date('do_date');
          $table->date('due_date');
          $table->date('delivery_date');
          $table->string('customer_id');
         //  $table->foreign('customer_id')->references('id')->on('customers');
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
        //
    }
}
