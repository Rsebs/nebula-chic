<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StorePurchaseRequest;

class PurchaseController extends Controller
{
  use ApiResponse;

  /**
   * Display a listing of the resource.
   */
  public function index()
  {
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StorePurchaseRequest $request)
  {
    try {
      DB::beginTransaction();

      foreach ($request->cart as $purchase) {
        Purchase::create($purchase);
      }

      DB::commit();

      return $this->successResponse([], null, 'Purchase made! Your order will arrive soon', 201);
    } catch (\Throwable) {
      DB::rollBack();

      return $this->errorResponse([], 'Something went wrong!');
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(int $id)
  {
  }

  /**
   * Update the specified resource in storage.
   */
  public function update()
  {
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(int $id)
  {
  }
}
