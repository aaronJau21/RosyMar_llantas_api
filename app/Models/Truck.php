<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Truck extends Model
{
  use HasFactory;

  protected $table = 'trucks';
  protected $guarded = [];

  protected $casts = [
    'cantidad_llantas' => 'integer'
  ];
}
