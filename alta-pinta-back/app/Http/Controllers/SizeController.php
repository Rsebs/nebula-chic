<?php

namespace App\Http\Controllers;

use App\Helpers\PaginationHelper;
use App\Models\Size;
use App\Http\Requests\StoreSizeRequest;
use App\Http\Requests\UpdateSizeRequest;
use App\Http\Resources\SizeResource;
use App\Traits\ApiResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            DB::beginTransaction();

            $page = $request->perPage ?? 25;

            $data = Size::paginate($page);
            $paginate = PaginationHelper::createPagination(Size::paginate($page));

            DB::commit();

            return $this->successResponse(SizeResource::collection($data), $paginate);
        } catch (\Throwable) {
            DB::rollBack();

            return $this->errorResponse([], "Something went wrong");
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

            $data = Size::create($request->all());

            DB::commit();

            return $this->successResponse(SizeResource::make($data), null, "Created!", 201);
        } catch (\Throwable $t) {
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

            $data = Size::findOrFail($id);

            DB::commit();

            return $this->successResponse(SizeResource::make($data));
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
    public function update(UpdateSizeRequest $request, $id)
    {
        try {
            DB::beginTransaction();

            $data = Size::findOrFail($id);
            $data->update($request->all());

            DB::commit();

            return $this->successResponse(SizeResource::make($data), null, "Update!");
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

            $data = Size::findOrFail($id);
            $data->delete();

            DB::commit();

            return $this->successResponse(SizeResource::make($data), null, "Delete!");
        } catch (ModelNotFoundException) {
            DB::rollBack();

            return $this->errorResponse(["Not Found"], "Resource Not Found", 404);
        }
    }
}
