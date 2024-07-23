<?php

namespace App\Http\Controllers\Tires;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tires\BrandTiresRequest;
use App\Http\Requests\Tires\BrandTiresUpdate;
use App\Models\BrandTire;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BrandTireController extends Controller
{
  public function createBrandTire(BrandTiresRequest $brandTiresRequest): JsonResponse
  {

    try {
      $user = $brandTiresRequest->user();

      $brandTire = BrandTire::create([
        'nombre' => $brandTiresRequest->input('nombre'),
        'modelo' => $brandTiresRequest->input('modelo'),
        'user_name_insert' => $user->name
      ]);

      return response()->json([
        'msg' => 'Se Creo Correctamente',
        'brand_tire' => $brandTire
      ]);
    } catch (\Exception $e) {
      return $this->responseErrorServer($e);
    }
  }

  public function getAllBrandTires(): JsonResponse
  {
    try {
      $brandTires = BrandTire::select(['id', 'nombre', 'modelo'])->get();

      return response()->json([
        'brand_tires' => $brandTires
      ]);
    } catch (\Exception $e) {
      return $this->responseErrorServer($e);
    }
  }

  public function getBrandTireById(int $id): JsonResponse
  {
    try {
      $brandTire = BrandTire::findOrFail($id);

      return response()->json([
        'brand_tire' => $brandTire
      ]);
    } catch (ModelNotFoundException $e) {
      return $this->responseNotFound($e, $id);
    } catch (\Exception $e) {
      return $this->responseErrorServer($e);
    }
  }

  public function bandTireUpdate(BrandTiresUpdate $brandTiresUpdate, int $id): JsonResponse
  {
    try {
      $brandTire = BrandTire::findOrFail($id);
      $user = $brandTiresUpdate->user();

      $brandTire->update([
        'nombre' => $brandTiresUpdate->input('nombre', $brandTire->nombre),
        'modelo' => $brandTiresUpdate->input('modelo', $brandTire->modelo),
        'user_name_insert' => $user->name
      ]);

      return response()->json([
        'brand_tire' => $brandTire
      ]);
    } catch (ModelNotFoundException $e) {
      return $this->responseNotFound($e, $id);
    } catch (\Exception $e) {
      return $this->responseErrorServer($e);
    }
  }

  public function deleteBrandTire(int $id): JsonResponse
  {
    try {
      $brandTire = BrandTire::findOrFail($id);

      $brandTire->delete();

      return response()->json([
        'msg' => 'Se elimino correctamente'
      ]);
    } catch (ModelNotFoundException $e) {
      return $this->responseNotFound($e, $id);
    } catch (\Exception $e) {
      return $this->responseErrorServer($e);
    }
  }



  // Private
  private function responseErrorServer(\Exception $e): JsonResponse
  {
    return response()->json([
      'msg' => 'Error del servidor',
      'error' => $e->getMessage()
    ]);
  }

  private function responseNotFound(ModelNotFoundException $e, int $id)
  {
    return response()->json([
      'msg' => 'No existe el Camión con el id:' . $id,
      'error' => $e
    ], 404);
  }
}
