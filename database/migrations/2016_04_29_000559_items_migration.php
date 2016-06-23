<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ItemsMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('items', function($table)
      {
        $table->string('id')->primary();
        $table->string('name',50);
        $table->integer('qty');
        $table->integer('supplier_id');
        $table->bigInteger('supplier_price');
        $table->bigInteger('resell_price');
        $table->string('image',100);
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
      Schema::drop('items');
    }
}
