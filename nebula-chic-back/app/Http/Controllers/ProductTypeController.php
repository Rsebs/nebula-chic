<?php

namespace App\Http\Controllers;

use App\Models\ProductType;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Helpers\PaginationHelper;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\ProductTypeResource;
use App\Http\Requests\StoreProductTypeRequest;
use App\Http\Requests\UpdateProductTypeRequest;

class ProductTypeController extends Controller
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

			$oData = ProductType::paginate($nPage);
			$oPaginate = PaginationHelper::createPagination(ProductType::paginate($nPage));

			return $this->successResponse(ProductTypeResource::collection($oData), $oPaginate);
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
	public function store(StoreProductTypeRequest $request)
	{
		try {
			DB::beginTransaction();

			ProductType::create($request->all());

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
			$oData = ProductType::findOrFail($id);

			return $this->successResponse(ProductTypeResource::make($oData));
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
	public function update(UpdateProductTypeRequest $request, $id)
	{
		try {
			DB::beginTransaction();

			$oData = ProductType::findOrFail($id);
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

			$oData = ProductType::findOrFail($id);
			$oData->delete();

			DB::commit();

			return $this->successResponse([], null, 'Deleted!');
		} catch (\Throwable) {
			DB::rollBack();

			return $this->errorResponse([], 'Something went wrong!', 404);
		}
	}
}
