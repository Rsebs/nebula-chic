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
            DB::beginTransaction();

            $page = $request->perPage ?? 25;

            $data = Image::paginate($page);
            $paginate = PaginationHelper::createPagination(Image::paginate($page));

            DB::commit();

            return $this->successResponse(ImageResource::collection($data), $paginate);
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
    public function store(StoreImageRequest $request)
    {
        try {
            DB::beginTransaction();

            $image = $request->file("file")->store("public/images/products");

            $path = Storage::url($image);

            $data = Image::create([
                "path" => $path,
                "product_id" => $request->product_id,
            ]);

            DB::commit();

            return $this->successResponse(ImageResource::make($data), null, "Created!", 201);
        } catch (\Throwable $t) {
            DB::rollBack();

            return $this->errorResponse([$t->getMessage()], "Something went wrong");
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

            $data = Image::findOrFail($id);

            DB::commit();

            return $this->successResponse(ImageResource::make($data));
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
    public function update(UpdateImageRequest $request, $id)
    {
        try {
            DB::beginTransaction();

            $data = Image::findOrFail($id);

            FileHelper::deleteFileStorage($data->path);

            $image = $request->file("file")->store("public/images/products");

            $path = Storage::url($image);

            $data->update([
                "path" => $path,
                "product_id" => $request->product_id,
            ]);

            DB::commit();

            return $this->successResponse(ImageResource::make($data), null, "Update!");
        } catch (\Throwable $e) {
            DB::rollBack();

            return $this->errorResponse([$e->getMessage()], "Something went wrong.", 404);
        } catch (\Throwable $t) {
            DB::rollBack();

            return $this->errorResponse([$t->getMessage()], "Something went wrong.", 404);
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

            $data = Image::findOrFail($id);

            FileHelper::deleteFileStorage($data->path);

            $data->delete();

            DB::commit();

            return $this->successResponse(ImageResource::make($data), null, "Delete!");
        } catch (\Throwable $e) {
            DB::rollBack();

            return $this->errorResponse([$e->getMessage()], "Something went wrong.", 404);
        } catch (\Throwable $t) {
            DB::rollBack();

            return $this->errorResponse([$t->getMessage()], "Something went wrong.", 404);
        }
    }
}
