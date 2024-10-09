<?php

namespace Modules\Api\V1\Comment\app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ceremony;
use App\Models\Comment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Modules\Api\V1\Comment\app\Http\Resources\CouponResource;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        // We only retrieve Undecided Comments which their status is equal to = 0
        $comments = Comment::undecided()->latest()->paginate(10);
        return successResponse([
            'data' => CouponResource::collection($comments),
            'links' => CouponResource::collection($comments)->response()->getData()->links,
            'meta' => CouponResource::collection($comments)->response()->getData()->meta
        ], 200, 'نظرات پاسخ داده نشده با موفقیت دریافت شد.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment): JsonResponse
    {
        return successResponse(new CouponResource($comment), 200, 'نظر با موفقیت دریافت شد.');
    }

    public function reject(Request $request, Comment $comment): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'reason_for_rejection' => 'required'
        ]);

        if($validator->fails()){
            return errorResponse(422, $validator->messages());
        }

        $comment->update([
            'status' => 2,
            'reason_for_rejection' => $request->reason_for_rejection
        ]);

        return successResponse(new CouponResource($comment), 200, 'نظر با موفقیت رد شد.');
    }

    public function approve(Request $request, Comment $comment): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'text' => 'required'
        ]);

        if($validator->fails()){
            return errorResponse(422, $validator->messages());
        }

        $comment->update([
            'status' => 1
        ]);

        return successResponse(new CouponResource($comment), 200, 'نظر با موفقیت تایید شد.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment): JsonResponse
    {
        $comment->delete();

        return successResponse(new CouponResource($comment), 200, 'نظر مورد نظر با موفقیت حذف شد!');
    }
}
