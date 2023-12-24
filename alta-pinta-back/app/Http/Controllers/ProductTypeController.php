<?php

namespace App\Http\Controllers;

use App\Helpers\PaginationHelper;
use App\Models\ProductType;
use App\Http\Requests\StoreProductTypeRequest;
use App\Http\Requests\UpdateProductTypeRequest;
use App\Http\Resources\ProductTypeResource;
use App\Traits\ApiResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            DB::beginTransaction();

            $page = $request->perPage ?? 15;

            $data = ProductTypeResource::collection(ProductType::paginate($page));
            $paginate = PaginationHelper::createPagination(ProductType::paginate($page));

            DB::commit();

            return $this->successResponse($data, $paginate);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->errorResponse($e->getMessage());
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

            $data = ProductType::create($request->all());

            DB::commit();

            return $this->successResponse($data, null, "Created!", 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->errorResponse($e->getMessage());
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
            DB::beginTransaction();

            $productType = ProductTypeResource::make(ProductType::findOrFail($id));

            DB::commit();

            return $this->successResponse($productType);
        } catch (ModelNotFoundException) {
            DB::rollBack();
            return $this->errorResponse(["Not Found"], "Resource Not Found", 404);
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

            $productType = ProductType::findOrFail($id);
            $data = $productType->update($request->all());

            DB::commit();

            return $this->successResponse($data, null, "Update!");
        } catch (ModelNotFoundException) {
            DB::rollBack();
            return $this->errorResponse(["Not Found"], "Resource Not Found", 404);
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

            $data = ProductType::findOrFail($id);
            $data->delete();

            DB::commit();

            return $this->successResponse($data, null, "Deleted!");
        } catch (ModelNotFoundException) {
            DB::rollBack();
            return $this->errorResponse(["Not Found"], "Resource Not Found", 404);
        }
    }
}
