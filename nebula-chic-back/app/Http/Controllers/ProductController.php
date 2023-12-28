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
            DB::beginTransaction();

            $page = $request->perPage ?? 25;

            $data = Product::paginate($page);
            $paginate = PaginationHelper::createPagination(Product::paginate($page));

            DB::commit();

            return $this->successResponse(ProductResource::collection($data), $paginate);
        } catch (\Throwable $e) {
            DB::rollBack();

            return $this->errorResponse([$e->getMessage()], "Something went wrong");
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

            $data = Product::create($request->all());

            DB::commit();

            return $this->successResponse(ProductResource::make($data), null, "Created!", 201);
        } catch (\Throwable) {
            DB::rollBack();

            return $this->errorResponse([], "Something went wrong");
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

            $data = Product::findOrFail($id);

            DB::commit();

            return $this->successResponse(ProductResource::make($data));
        } catch (\Throwable $e) {
            DB::rollBack();

            return $this->errorResponse([$e->getMessage()], "Something went wrong.", 404);
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
    public function update(UpdateProductRequest $request, $id)
    {
        try {
            DB::beginTransaction();

            $data = Product::findOrFail($id);
            $data->update($request->all());

            DB::commit();

            return $this->successResponse(ProductResource::make($data), null, "Update!");
        } catch (\Throwable $e) {
            DB::rollBack();

            return $this->errorResponse([$e->getMessage()], "Something went wrong.", 404);
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

            $data = Product::findOrFail($id);
            $data->delete();

            DB::commit();

            return $this->successResponse(ProductResource::make($data), null, "Delete!");
        } catch (\Throwable $e) {
            DB::rollBack();

            return $this->errorResponse([$e->getMessage()], "Something went wrong.", 404);
        }
    }
}
