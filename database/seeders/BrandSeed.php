<?php

namespace Database\Seeders;

use App\Models\BrandTire;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeed extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    BrandTire::create([
      'nombre' => 'AMBERTONE',
      'modelo' => '785',
      'user_name_insert' => 'Sthefano Avila'
    ]);

    BrandTire::create([
      'nombre' => 'ARMORSTEEL',
      'modelo' => '785',
      'user_name_insert' => 'Sthefano Avila'
    ]);


    BrandTire::create([
      'nombre' => 'AUFINE',
      'modelo' => 'AF177',
      'user_name_insert' => 'Sthefano Avila'
    ]);


    BrandTire::create([
      'nombre' => 'AUSTONE',
      'modelo' => 'AT 115 A',
      'user_name_insert' => 'Sthefano Avila'
    ]);
  }
}
