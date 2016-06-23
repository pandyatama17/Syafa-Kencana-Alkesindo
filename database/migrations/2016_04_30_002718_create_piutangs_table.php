<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePiutangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::create('piutangs',function($table)
         {
           $table->increments('id');
           $table->string('invoice_id');
          //  $table->foreign('invoice_id')->references('id')->on('invoice_parents');
           $table->bigInteger('total');
           $table->boolean('status')->default(false);
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
         Schema::drop('piutangs');
     }
}
