<?php

namespace App\Exports;

use App\Models\Tire;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TiresExport implements FromView
{
  /**
   * @return \Illuminate\Support\Collection
   */
  public function view(): View
  {
    return view('exporTires', [
      'tire' => Tire::with(['truck', 'brandTire'])->get()
    ]);
  }
}
