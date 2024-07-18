<?php

namespace App\Http\Requests\Tires;

use App\Enum\TireEstadoEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class TiresUpdate extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    return [
      'posicion' => ['integer'],
      'fecha_inspeccion' => ['string'],
      'brand_id' => ['integer', 'exists:brand_tires,id'],
      'trucks_id' => ['integer', 'exists:trucks,id'],
      'modelo' => ['string'],
      'medida' => [],
      'R1' => ['integer'],
      'R2' => ['integer'],
      'R3' => ['integer'],
      'estado' => [new Enum(TireEstadoEnum::class)],
      'observaciones' => ['nullable'],
      'presion_aire' => ['nullable'],
      'rotaciones' => ['nullable']
    ];
  }
}
