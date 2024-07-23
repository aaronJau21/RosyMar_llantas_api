<?php

namespace App\Http\Controllers\Tires;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tires\TiresRequest;
use App\Http\Requests\Tires\TiresUpdate;
use App\Models\Tire;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TireController extends Controller
{
  public function create(TiresRequest $tiresRequest): JsonResponse
  {

    try {
      $user = $tiresRequest->user();

      $tire = Tire::create([
        'posicion' => $tiresRequest->input('posicion'),
        'KM_actutal' => $tiresRequest->input('KM_actutal'),
        'brand_id' => $tiresRequest->input('brand_id'),
        'trucks_id' => $tiresRequest->input('trucks_id'),
        'modelo' => $tiresRequest->input('modelo'),
        'medida' => $tiresRequest->input('medida'),
        'R1' => $tiresRequest->input('R1'),
        'R2' => $tiresRequest->input('R2'),
        'R3' => $tiresRequest->input('R3'),
        'estado' => $tiresRequest->input('estado'),
        'observaciones' => $tiresRequest->input('observaciones'),
        'presion_aire' => $tiresRequest->input('presion_aire'),
        'accion' => $tiresRequest->input('accion'),
        'user_name_insert' => $user->name
      ]);

      return response()->json([
        'tire' => $tire
      ]);
    } catch (\Exception $th) {
      return $this->responseErrorServer($th);
    }
  }

  public function getAllTires(): JsonResponse
  {
    try {
      $tires = Tire::with(['truck', 'brandTire'])->get();

      return response()->json([
        'tires' => $tires
      ]);
    } catch (\Exception $th) {
      return $this->responseErrorServer($th);
    }
  }

  public function getTiresById(int $id): JsonResponse
  {

    try {
      $tire = Tire::with(['truck', 'brandTire'])->findOrFail($id);

      return response()->json([
        'tire' => $tire
      ]);
    } catch (ModelNotFoundException $e) {
      return $this->responseNotFound($e, $id);
    } catch (\Exception $th) {
      return $this->responseErrorServer($th);
    }
  }

  public function updateTire(TiresUpdate $tiresUpdate, int $id): JsonResponse
  {
    try {
      $tire = Tire::findOrFail($id);
      $user = $tiresUpdate->user();

      $tire->update([
        'posicion' => $tiresUpdate->input('posicion', $tire->posicion),
        'brand_id' => $tiresUpdate->input('brand_id', $tire->brand_id),
        'trucks_id' => $tiresUpdate->input('trucks_id', $tire->trucks_id),
        'modelo' => $tiresUpdate->input('modelo', $tire->modelo),
        'medida' => $tiresUpdate->input('medida', $tire->medida),
        'R1' => $tiresUpdate->input('R1', $tire->R1),
        'R2' => $tiresUpdate->input('R2', $tire->R2),
        'R3' => $tiresUpdate->input('R3', $tire->R3),
        'estado' => $tiresUpdate->input('estado', $tire->estado),
        'observaciones' => $tiresUpdate->input('observaciones', $tire->observaciones),
        'presion_aire' => $tiresUpdate->input('presion_aire', $tire->presion_aire),
        'user_name_insert' => $user->name
      ]);

      return response()->json([
        'tire' => $tire
      ]);
    } catch (ModelNotFoundException $e) {
      return $this->responseNotFound($e, $id);
    } catch (\Exception $th) {
      return $this->responseErrorServer($th);
    }
  }

  public function deleteTire(int $id): JsonResponse
  {
    try {
      $tire = Tire::findOrFail($id);
      $tire->delete();

      return response()->json([
        'msg' => 'Se elimino correctamente'
      ]);
    } catch (ModelNotFoundException $e) {
      return $this->responseNotFound($e, $id);
    } catch (\Exception $th) {
      return $this->responseErrorServer($th);
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
