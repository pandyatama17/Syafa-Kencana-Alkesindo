<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_parents',function($table)
        {
          $table->increments('id');
          $table->string('order_id')->unique();
          $table->date('order_date');
          $table->date('due_date');
          $table->date('delivery_date');
          $table->string('supplier_id');
         //  $table->foreign('customer_id')->references('id')->on('customers');
          $table->enum('payment',['cash','transfer']);
          $table->bigInteger('total');
          $table->integer('pic');
          $table->timestamps();
        });

        Schema::create('order_childs',function($table)
        {
          $table->increments('id');
          $table->string('parent_id');
         //  $table->foreign('parent_id')->references('id')->on('invoice_parents');
          $table->string('item_id');
         //  $table->foreign('item_id')->references('id')->on('items');
          $table->integer('qty');
          $table->bigInteger('subtotal');
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
      Schema::drop('order_parents');
      Schema::drop('order_childs');
    }
}
