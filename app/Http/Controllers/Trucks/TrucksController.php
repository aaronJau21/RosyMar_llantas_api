<?php

namespace App\Http\Controllers\Trucks;

use App\Exports\TrucksExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Trucks\TrucksRequest;
use App\Http\Requests\Trucks\TrucksUpdate;
use App\Models\Truck;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TrucksController extends Controller
{
  public function createTrucks(TrucksRequest $trucksRequest): JsonResponse
  {
    try {
      $user = $trucksRequest->user();

      $trucks = Truck::create([
        'marca' => $trucksRequest->input('marca'),
        'placa' => $trucksRequest->input('placa'),
        'cantidad_llantas' => $trucksRequest->input('cantidad_llantas'),
        'observation' => $trucksRequest->input('observation'),
        'user_name_insert' => $user->name
      ]);

      return response()->json([
        'msg' => 'Creado Correctamente',
        'camion' => $trucks
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'msg' => 'Error al crear el camión',
        'error' => $e->getMessage()
      ], 500);
    }
  }

  public function getAllTruks(): JsonResponse
  {

    try {
      $trucks = Truck::select(['id', 'marca', 'placa', 'cantidad_llantas'])->get();

      return response()->json([
        'trucks' => $trucks
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'msg' => 'Error al crear el camión',
        'error' => $e->getMessage()
      ], 500);
    }
  }

  public function trunkById(int $id): JsonResponse
  {
    try {
      $truck = Truck::findOrFail($id);

      return response()->json([
        'camion' => $truck
      ], 200);
    } catch (ModelNotFoundException $e) {
      return response()->json([
        'msg' => 'No existe el Camión con el id:' . $id
      ], 404);
    } catch (\Exception $e) {
      return response()->json([
        'msg' => 'Error al crear el camión',
        'error' => $e->getMessage()
      ], 500);
    }
  }

  public function updatedTruck(int $id, TrucksUpdate $trucksRequest): JsonResponse
  {
    try {
      $user = $trucksRequest->user();

      $truck = Truck::findOrFail($id);

      $truck->update([
        'marca' => $trucksRequest->input('marca', $truck->marca),
        'placa' => $trucksRequest->input('placa', $truck->placa),
        'cantidad_llantas' => $trucksRequest->input('cantidad_llantas', $truck->cantidad_llantas),
        'observation' => $trucksRequest->input('observation', $truck->observation),
        'user_name_insert' => $user->name
      ]);

      return response()->json([
        'truck' =>  $truck
      ]);
    } catch (ModelNotFoundException $e) {
      return response()->json([
        'msg' => 'No existe el Camión con el id:' . $id
      ], 404);
    } catch (\Exception $e) {
      return response()->json([
        'msg' => 'Error al crear el camión',
        'error' => $e->getMessage()
      ], 500);
    }
  }


  public function deleteTruck(int $id): JsonResponse
  {
    try {
      $truck = Truck::findOrFail($id);

      $truck->delete();

      return response()->json([
        'msg' => 'Se Elimino correctamente'
      ]);
    } catch (ModelNotFoundException $e) {
      return response()->json([
        'msg' => 'No existe el Camión con el id:' . $id
      ], 404);
    } catch (\Exception $e) {
      return response()->json([
        'msg' => 'Error al eliminar el camión',
        'error' => $e->getMessage()
      ], 500);
    }
  }

  public function getPlaca(): JsonResponse
  {
    try {
      $placas = Truck::select(['id', 'placa'])->get();
      return response()->json([
        'placa' => $placas
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'msg' => 'Error Del servidor',
        'error' => $e->getMessage()
      ], 500);
    }
  }

  public function exportTruck()
  {
    return Excel::download(new TrucksExport, 'trucks.xlsx');
  }
}
