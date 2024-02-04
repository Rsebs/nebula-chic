<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Helpers\FileHelper;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Helpers\PaginationHelper;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\ImageResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreImageRequest;
use App\Http\Requests\UpdateImageRequest;

class ImageController extends Controller
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
      $oData = Image::paginate($nPage);
      $oPaginate = PaginationHelper::createPagination(Image::paginate($nPage));

      return $this->successResponse(ImageResource::collection($oData), $oPaginate);
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
  public function store(StoreImageRequest $request)
  {
    try {
      DB::beginTransaction();

      $oImage = $request->file('file')->store('public/images/products');
      $sPath = Storage::url($oImage);

      Image::create([
        'path' => $sPath,
        'product_id' => $request->product_id,
      ]);

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
      $oData = Image::findOrFail($id);

      return $this->successResponse(ImageResource::make($oData));
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
  public function update(UpdateImageRequest $request, $id)
  {
    try {
      DB::beginTransaction();

      $oData = Image::findOrFail($id);
      $oImage = $request->file('file')->store('public/images/products');
      $sPath = Storage::url($oImage);

      FileHelper::deleteFileStorage($oData->path);

      $oData->update([
        'path' => $sPath,
        'product_id' => $request->product_id,
      ]);

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

      $oData = Image::findOrFail($id);
      
      FileHelper::deleteFileStorage($oData->path);
      $oData->delete();

      DB::commit();

      return $this->successResponse([], null, 'Deleted!');
    } catch (\Throwable) {
      DB::rollBack();

      return $this->errorResponse([], 'Something went wrong!', 404);
    }
  }
}
