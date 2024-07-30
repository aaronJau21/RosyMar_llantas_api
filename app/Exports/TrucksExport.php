<?php

namespace App\Exports;

use App\Models\Truck;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TrucksExport implements FromView
{
  /**
   * @return \Illuminate\Support\Collection
   */
  public function view(): View
  {
    return view('exporTrucks', [
      'trucks' => Truck::all()
    ]);
  }
}
