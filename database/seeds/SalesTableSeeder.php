<?php

use Illuminate\Database\Seeder;

class SalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      App\Sales::create([
          'name' => 'Bangkring',
      ]);

      // sample customer
      App\Sales::create([
          'name' => 'Parjo',
      ]);
    }
}
