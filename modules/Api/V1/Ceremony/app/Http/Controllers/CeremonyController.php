<?php

namespace Modules\Api\V1\Ceremony\app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ceremony;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Modules\Api\V1\Ceremony\app\Http\Resources\CommentResource;

class CeremonyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $ceremonies = Ceremony::latest()->paginate(10);
        return successResponse([
            'data' => CommentResource::collection($ceremonies),
            'links' => CommentResource::collection($ceremonies)->response()->getData()->links,
            'meta' => CommentResource::collection($ceremonies)->response()->getData()->meta
        ], 200, 'مراسمات با موفقیت دریافت شد.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3|max:18',
            'description' => 'required|min:10',
            'price' => 'required|integer',
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            return errorResponse(422, $validator->messages());
        }

        $ceremony = Ceremony::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'status' => $request->status
        ]);

        return successResponse(new CommentResource($ceremony), 200, 'مراسم با موفقیت ایجاد شد.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ceremony $ceremony): JsonResponse
    {
        return successResponse(new CommentResource($ceremony), 200, 'مراسم با موفقیت دریافت شد.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ceremony $ceremony): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'min:3', 'max:18',Rule::unique('ceremonies')->ignore($request->ceremony->id)],
            'description' => 'required|min:10',
            'price' => 'required|integer',
            'status' => 'required'
        ]);

        if($validator->fails()){
            return errorResponse(422, $validator->messages());
        }

        $ceremony->update([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'status' => $request->status
        ]);

        return successResponse(new CommentResource($ceremony), 200, 'مراسم مورد نظر با موفقیت ویرایش شد!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ceremony $ceremony): JsonResponse
    {
        $ceremony->delete();

        return successResponse(new CommentResource($ceremony), 200, 'مراسم مورد نظر با موفقیت حذف شد!');
    }
}
