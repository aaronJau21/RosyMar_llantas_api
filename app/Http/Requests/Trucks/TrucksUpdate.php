<?php

namespace App\Http\Requests\Trucks;

use Illuminate\Foundation\Http\FormRequest;

class TrucksUpdate extends FormRequest
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
      'marca' => ['string'],
      'modelo' => ['string'],
      'placa' => ['string'],
      'dueno' => ['nullable'],
      'tolerancia_delantera' => ['nullable'],
      'tolerancia_trasera' => ['nullable'],
    ];
  }
}
