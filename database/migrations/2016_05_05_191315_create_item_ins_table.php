<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemInsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_in_parents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_id');
            $table->string('supplier_do');
            $table->string('date');
            $table->integer('supplier_id');
            $table->timestamps();
        });
        Schema::create('transaction_in_childs', function(Blueprint $table)
        {
          $table->increments('id');
          $table->integer('parent_id');
          $table->integer('item_id');
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
        Schema::drop('transaction_in_parents');
        Schema::drop('transaction_in_childs');
    }
}
