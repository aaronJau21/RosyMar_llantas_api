<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tire extends Model
{
  use HasFactory;
  protected $table = 'tires';
  protected $guarded = [];

  public function truck(): BelongsTo
  {
    return $this->belongsTo(Truck::class, 'trucks_id');
  }

  public function brandTire(): BelongsTo
  {
    return $this->belongsTo(BrandTire::class, 'brand_id');
  }

  protected $casts = [
    'posicion' => 'integer',
    'brand_id' => 'integer',
    'trucks_id' => 'integer',
    'R1' => 'integer',
    'R2' => 'integer',
    'R3' => 'integer',
  ];
}
