<?php

namespace App\Http\Controllers;

use App\Models\Size;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Helpers\PaginationHelper;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\SizeResource;
use App\Http\Requests\StoreSizeRequest;
use App\Http\Requests\UpdateSizeRequest;

class SizeController extends Controller
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
      $nPage = $request->perPage ?? 25;

      $oData = Size::paginate($nPage);
      $oPaginate = PaginationHelper::createPagination(Size::paginate($nPage));

      return $this->successResponse(SizeResource::collection($oData), $oPaginate);
    } catch (\Throwable) {
      return $this->errorResponse([], 'Something went wrong!');
    }
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param \App\Http\Requests\StoreProductTypeRequest $request
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function store(StoreSizeRequest $request)
  {
    try {
      DB::beginTransaction();

      Size::create($request->all());

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
  public function show($id)
  {
    try {
      $oData = Size::findOrFail($id);

      return $this->successResponse(SizeResource::make($oData));
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
  public function update(UpdateSizeRequest $request, $id)
  {
    try {
      DB::beginTransaction();

      $oData = Size::findOrFail($id);
      $oData->update($request->all());

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
  public function destroy($id)
  {
    try {
      DB::beginTransaction();

      $oData = Size::findOrFail($id);
      $oData->delete();

      DB::commit();

      return $this->successResponse([], null, 'Deleted!');
    } catch (\Throwable) {
      DB::rollBack();

      return $this->errorResponse([], 'Something went wrong!', 404);
    }
  }
}
