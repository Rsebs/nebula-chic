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
			$perPage = $request->perPage ?? 25;

			$data = ProductType::paginate($perPage);
			$paginate = PaginationHelper::createPagination(ProductType::paginate($perPage));

			return $this->successResponse(ProductTypeResource::collection($data), $paginate);
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
	public function show(int $id)
	{
		try {
			$data = ProductType::findOrFail($id);

			return $this->successResponse(ProductTypeResource::make($data));
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
	public function update(UpdateProductTypeRequest $request, int $id)
	{
		try {
			DB::beginTransaction();

			$data = ProductType::findOrFail($id);
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

			$data = ProductType::findOrFail($id);
			$data->delete();

			DB::commit();

			return $this->successResponse([], null, 'Deleted!');
		} catch (\Throwable) {
			DB::rollBack();

			return $this->errorResponse([], 'Something went wrong!', 404);
		}
	}
}
