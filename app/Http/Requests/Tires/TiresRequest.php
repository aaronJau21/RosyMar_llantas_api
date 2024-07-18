<?php

namespace App\Http\Requests\Tires;

use App\Enum\TireEstadoEnum;
use App\Models\BrandTire;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class TiresRequest extends FormRequest
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
      'fecha_inspeccion' => ['required', 'string'],
      'brand_id' => ['required', 'integer', 'exists:brand_tires,id'],
      'trucks_id' => ['required', 'integer', 'exists:trucks,id'],
      'modelo' => ['required', 'string'],
      'medida' => ['required'],
      'R1' => ['required', 'integer'],
      'R2' => ['required', 'integer'],
      'R3' => ['required', 'integer'],
      'estado' => ['required', new Enum(TireEstadoEnum::class)],
      'observaciones' => ['nullable'],
      'presion_aire' => ['nullable'],
      'rotaciones' => ['nullable']
    ];
  }
}
