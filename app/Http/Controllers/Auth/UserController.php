<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
}
