<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductType;
use App\Models\Size;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class SelectController extends Controller
{
  use ApiResponse;

  public function selectProductTypes()
  {
    try {
      $data = ProductType::select('id', 'name')
        ->get();

      return $this->successResponse($data);
    } catch (\Throwable) {
      return $this->errorResponse([], 'Something went wrong!');
    }
  }

  public function selectSizes()
  {
    try {
      $data = Size::select('id', 'name')
        ->get();

      return $this->successResponse($data);
    } catch (\Throwable) {
      return $this->errorResponse([], 'Something went wrong!');
    }
  }
}
