<?php

namespace App\Http\Controllers;

use Error;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;

class UserController extends Controller
{
  use ApiResponse;

  public function createUser(StoreUserRequest $request)
  {
    try {
      DB::beginTransaction();

      User::create($request->all());

      DB::commit();

      return $this->successResponse(null, null, 'User created!');
    } catch (\Throwable) {
      DB::rollBack();
      return $this->errorResponse([], 'Something went wrong!', 500);
    }
  }

  public function login(Request $request)
  {
    try {
      $data = User::where('email', $request->email)->first();

      if (is_null($data))
        throw new Error('The email is not registered', 404);

      if (!Hash::check($request->password, $data->password))
        throw new Error('Incorrect password', 422);

      return $this->successResponse($data, null, 'Welcome!');
    } catch (\Throwable $err) {
      return $this->errorResponse([], $err->getMessage(), $err->getCode());
    }
  }
}
