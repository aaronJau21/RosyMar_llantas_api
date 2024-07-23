<?php

namespace Database\Seeders;

use App\Models\Truck;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrucksSeed extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    Truck::create([
      'marca' => 'HINO',
      'placa' => 'ACE872',
      'cantidad_llantas' => 6,
      'user_name_insert' => 'Sthefano Avila'
    ]);

    Truck::create([
      'marca' => 'MERCEDES BENZ',
      'placa' => 'ACL795',
      'cantidad_llantas' => 6,
      'user_name_insert' => 'Sthefano Avila'
    ]);


    Truck::create([
      'marca' => 'ISUZU LOCAL',
      'placa' => 'AJH832',
      'cantidad_llantas' => 6,
      'user_name_insert' => 'Sthefano Avila'
    ]);

    Truck::create([
      'marca' => 'ISUZU LOCAL',
      'placa' => 'AJH858',
      'cantidad_llantas' => 6,
      'user_name_insert' => 'Sthefano Avila'
    ]);


    Truck::create([
      'marca' => 'ISUZU LOCAL',
      'placa' => 'AJH896',
      'cantidad_llantas' => 6,
      'user_name_insert' => 'Sthefano Avila'
    ]);
  }
}
