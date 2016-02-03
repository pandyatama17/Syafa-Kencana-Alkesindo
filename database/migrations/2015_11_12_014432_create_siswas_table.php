<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiswasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		
		Schema::create('siswas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('nama');
			$table->text('kelas');
			$table->text('jurusan');
			$table->text('tempat_lahir');
			$table->date('tanggal_lahir');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('siswas');
	}

}
