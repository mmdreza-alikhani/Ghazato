<?php

namespace Modules\Api\V1\Category\app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\Api\V1\Category\app\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $categories = Category::orderBy('status', 'desc')->paginate(2);
        return successResponse([
            'data' => CategoryResource::collection($categories),
            'links' => CategoryResource::collection($categories)->response()->getData()->links,
            'meta' => CategoryResource::collection($categories)->response()->getData()->meta
        ], 200, 'دسته بندی ها با موفقیت دریافت شد.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3|max:18',
            'status' => 'required',
            'icon' => 'required'
        ]);

        if ($validator->fails()) {
            return errorResponse(422, $validator->messages());
        }

        $category = Category::create([
            'title' => $request->title,
            'status' => $request->status,
            'icon' => $request->icon
        ]);

        return successResponse($category, 200, 'دسته بندی با موفقیت ایجاد شد.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category): JsonResponse
    {
        return successResponse(new CategoryResource($category), 200, 'دسته بندی با موفقیت دریافت شد.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3|max:18',
            'status' => 'required',
            'icon' => 'required',
        ]);

        if($validator->fails()){
            return ErrorResponse(422, $validator->messages());
        }

        $category->update([
            'title' => $request->title,
            'status' => $request->status,
            'icon' => $request->icon
        ]);

        return successResponse(new CategoryResource($category), 200, 'دسته بندی مورد نظر با موفقیت ویرایش شد!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category): JsonResponse
    {
        $category->delete();

        return successResponse(new CategoryResource($category), 200, 'دسته بندی مورد نظر با موفقیت حذف شد!');
    }
}
