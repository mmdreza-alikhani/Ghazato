<?php

namespace Modules\Api\V1\Banner\app\Http\Controllers;

use App\Models\Banner;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Modules\Api\V1\Banner\app\Http\Resources\CeremonyResource;

class BannerController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $banners = Banner::latest()->paginate(10);
        return successResponse([
            'data' => CeremonyResource::collection($banners),
            'links' => CeremonyResource::collection($banners)->response()->getData()->links,
            'meta' => CeremonyResource::collection($banners)->response()->getData()->meta
        ], 200, 'بنر با موفقیت دریافت شد.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3|max:20',
            'text' => 'required',
            'status' => 'required',
            'type' => 'required',
            'button_text' => 'required',
            'button_link' => 'required',
            'button_icon' => 'required',
            'priority' => 'required|integer',
            'image' => 'required|mimes:jpg,jpeg,png,svg'
        ]);

        if ($validator->fails()) {
            return ErrorResponse(422, $validator->messages());
        }

        try {
            DB::beginTransaction();

            $imageName = generateFileName($request->image->getClientOriginalName());
            $request->image->move(storage_path(env('BANNER_IMAGE_UPLOAD_PATH')), $imageName);

            $banner = Banner::create([
                'title' => $request->title,
                'text' => $request->text,
                'status' => $request->status,
                'type' => $request->type,
                'button_text' => $request->button_text,
                'button_link' => $request->button_link,
                'button_icon' => $request->button_icon,
                'priority' => $request->priority,
                'image' => $imageName,
            ]);

            DB::commit();
        }catch (Exception $ex) {
            DB::rollBack();
            return errorResponse(422, $ex->getMessage());
        }

        return successResponse(new CeremonyResource($banner), 200, 'بنر با موفقیت ایجاد شد.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Banner $banner): JsonResponse
    {
        return successResponse(new CeremonyResource($banner), 200, 'دسته بندی با موفقیت دریافت شد.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banner $banner): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3|max:20',
            'text' => 'required',
            'status' => 'required',
            'type' => 'required',
            'button_text' => 'required',
            'button_link' => 'required',
            'button_icon' => 'required',
            'priority' => 'required|integer',
            'image' => 'nullable|mimes:jpg,jpeg,png,svg'
        ]);

        if($validator->fails()){
            return errorResponse(422, $validator->messages());
        }

        try {
            DB::beginTransaction();

            if ($request->image) {
                File::delete(storage_path('/banners/images/'. $banner->image));
                $imageName = generateFileName($request->image->getClientOriginalName());
                $request->image->move(storage_path(env('BANNER_IMAGE_UPLOAD_PATH')), $imageName);
            }

            $banner->update([
                'title' => $request->title,
                'text' => $request->text,
                'status' => $request->status,
                'type' => $request->type,
                'button_text' => $request->button_text,
                'button_link' => $request->button_link,
                'button_icon' => $request->button_icon,
                'priority' => $request->priority,
                'image' => $request->image ? $imageName : $banner->image,
            ]);

            DB::commit();
        }catch (Exception $ex) {
            DB::rollBack();
            return errorResponse(422, $ex->getMessage());
            return redirect()->back();
        }

        return successResponse(new CeremonyResource($banner), 200, 'بنر مورد نظر با موفقیت ویرایش شد!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner): JsonResponse
    {
        $banner->delete();

        return successResponse(new CeremonyResource($banner), 200, 'بنر مورد نظر با موفقیت حذف شد!');
    }
}
