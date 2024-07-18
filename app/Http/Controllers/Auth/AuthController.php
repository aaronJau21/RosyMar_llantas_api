<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\loginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
  public function Login(loginRequest $loginRequest): JsonResponse
  {
    $data = $loginRequest->validated();

    if (!Auth::attempt($data)) {
      return response()->json([
        'errors' => 'El dni o el Password esta mal'
      ], 409);
    }

    $user = $loginRequest->user();

    $userData = $user->only(['name', 'dni', 'role']);

    return response()->json([
      'token' => $user->createToken('token')->plainTextToken,
      'user' => $userData
    ]);
  }

  public function logout(Request $request): JsonResponse
  {
    $user = $request->user();

    $user->currentAccessToken()->delete();

    return response()->json([
      'msg' => 'Good Bye'
    ]);
  }
}
