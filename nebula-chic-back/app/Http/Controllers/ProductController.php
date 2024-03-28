<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Helpers\PaginationHelper;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\ProductResource;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
  use ApiResponse;

  /**
   * Display a listing of the resource.
   *
   * @param \Illuminate\Http\Request $request
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function index(Request $request)
  {
    try {
      $perPage = $request->perPage ?? 25;

      if ($request->type) {
        $data = Product::where('product_type_id', $request->type)->paginate($perPage);
        $paginate = PaginationHelper::createPagination(Product::where('product_type_id', $request->type)->paginate($perPage));
      } else {
        $data = Product::paginate($perPage);
        $paginate = PaginationHelper::createPagination(Product::paginate($perPage));
      }

      return $this->successResponse(ProductResource::collection($data), $paginate);
    } catch (\Throwable) {
      return $this->errorResponse([], 'Something went wrong!', 500);
    }
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param \App\Http\Requests\StoreProductTypeRequest $request
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function store(StoreProductRequest $request)
  {
    try {
      DB::beginTransaction();

      Product::create($request->all());

      DB::commit();

      return $this->successResponse([], null, 'Created!', 201);
    } catch (\Throwable) {
      DB::rollBack();

      return $this->errorResponse([], 'Something went wrong!');
    }
  }

  /**
   * Display the specified resource.
   *
   * @param int $id
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function show(int $id)
  {
    try {
      $data = Product::findOrFail($id);

      return $this->successResponse(ProductResource::make($data));
    } catch (\Throwable) {
      return $this->errorResponse([], 'Something went wrong!', 404);
    }
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Http\Requests\UpdateProductTypeRequest  $request
   * @param  int  $id
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function update(UpdateProductRequest $request, int $id)
  {
    try {
      DB::beginTransaction();

      $data = Product::findOrFail($id);
      $data->update($request->all());

      DB::commit();

      return $this->successResponse([], null, 'Updated!');
    } catch (\Throwable) {
      DB::rollBack();

      return $this->errorResponse([], 'Something went wrong!', 404);
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function destroy(int $id)
  {
    try {
      DB::beginTransaction();

      $data = Product::findOrFail($id);
      $data->delete();

      DB::commit();

      return $this->successResponse([], null, 'Deleted!');
    } catch (\Throwable) {
      DB::rollBack();

      return $this->errorResponse([], 'Something went wrong!', 404);
    }
  }
}
