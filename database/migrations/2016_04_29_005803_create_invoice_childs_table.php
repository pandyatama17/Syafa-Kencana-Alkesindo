<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceChildsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::create('invoice_childs',function($table)
         {
           $table->increments('id');
           $table->string('parent_id');
          //  $table->foreign('parent_id')->references('id')->on('invoice_parents');
           $table->string('item_id');
          //  $table->foreign('item_id')->references('id')->on('items');
           $table->integer('qty');
           $table->bigInteger('subtotal');
           $table->integer('discount');
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
         Schema::drop('invoice_childs');
     }
}
