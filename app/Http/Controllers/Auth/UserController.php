<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
  public function getAllUsers(): JsonResponse
  {
    try {
      $users = User::select(['id', 'name', 'dni', 'role'])->get();
      return response()->json([
        'users' => $users
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'error' => $e->getMessage()
      ]);
    }
  }

  public function createUser(UserRequest $userRequest): JsonResponse
  {
    try {
      $users = User::create([
        'name' => $userRequest->input('name'),
        'dni' => $userRequest->input('dni'),
        'password' => $userRequest->input('password'),
        'role' => $userRequest->input('role'),
      ]);
      return response()->json([
        'users' => $users
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'error' => $e->getMessage()
      ]);
    }
  }

  public function getUserById(int $id)
  {
    try {
      $user = User::select(['id', 'name', 'dni', 'role'])->find($id);

      return response()->json([
        'user' => $user
      ]);
    } catch (ModelNotFoundException $e) {
      return $this->responseNotFound($e, $id);
    } catch (\Exception $th) {
      return $this->responseErrorServer($th);
    }
  }

  public function editUser(UserUpdateRequest $userUpdateRequest, int $id): JsonResponse
  {
    try {
      $user = User::findOrFail($id);
      $user->update($userUpdateRequest->only(['name', 'dni', 'role']));

      return response()->json([
        'message' => 'Usuario actualizado con éxito',
        'user' => $user
      ]);
    } catch (ModelNotFoundException $e) {
      return response()->json([
        'message' => 'Usuario no encontrado',
        'error' => $e->getMessage()
      ], 404);
    } catch (\Exception $th) {
      return response()->json([
        'message' => 'Error al actualizar el usuario',
        'error' => $th->getMessage()
      ], 500);
    }
  }

  public function deleteUser(int $id)
  {

    try {
      $user = User::findOrFail($id);
      $user->delete();

      return response()->json([
        'message' => 'El usuario fue eliminado',
      ]);
    } catch (ModelNotFoundException $e) {
      return response()->json([
        'message' => 'Usuario no encontrado',
        'error' => $e->getMessage()
      ], 404);
    } catch (\Exception $th) {
      return response()->json([
        'message' => 'Error al actualizar el usuario',
        'error' => $th->getMessage()
      ], 500);
    }
  }


  // Private
  private function responseErrorServer(\Exception $e): JsonResponse
  {
    return response()->json([
      'msg' => 'Error del servidor',
      'error' => $e->getMessage()
    ], 500);
  }

  private function responseNotFound(ModelNotFoundException $e, int $id)
  {
    return response()->json([
      'msg' => 'No existe el Camión con el id:' . $id,
      'error' => $e
    ], 404);
  }
}
