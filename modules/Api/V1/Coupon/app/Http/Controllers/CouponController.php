<?php

namespace Modules\Api\V1\Coupon\app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Modules\Api\V1\Coupon\app\Http\Resources\CouponResource;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $coupons = Coupon::latest()->paginate(10);
        return successResponse([
            'data' => CouponResource::collection($coupons),
            'links' => CouponResource::collection($coupons)->response()->getData()->links,
            'meta' => CouponResource::collection($coupons)->response()->getData()->meta
        ], 200, 'کد های تخفیف با موفقیت دریافت شد.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Coupon $coupon): JsonResponse
    {
        return successResponse(new CouponResource($coupon), 200, 'کد تخفیف با موفقیت دریافت شد.');
    }


    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3|max:20',
            'shop_id' => 'required',
            'code' => 'required|unique:coupons,code',
            'type' => 'required',
            'amount' => 'required_if:type,=,amount',
            'percentage' => 'required_if:type,=,percentage',
            'status' => 'required',
            'max_percentage_amount' => 'required_if:type,=,percentage',
            'expired_at' => 'required|date',
            'description' => 'required|min:3|max:100',
        ]);

        if ($validator->fails()) {
            return errorResponse(422, $validator->messages());
        }

        try {
            DB::beginTransaction();

            $coupon = Coupon::create([
                'title' => $request->title,
                'shop_id' => $request->shop_id == 0 ? null : $request->shop_id,
                'code' => $request->code,
                'type' => $request->type,
                'status' => $request->status,
                'amount' => $request->amount,
                'percentage' => $request->percentage,
                'max_percentage_amount' => $request->max_percentage_amount,
                'expired_at' => convertToGregorianDate($request->expired_at),
                'description' => $request->description,
            ]);

            DB::commit();
        }catch (Exception $ex) {
            DB::rollBack();
            return errorResponse(422, $ex->getMessage());
        }

        return successResponse(new CouponResource($coupon), 200, 'کد تخفیف با موفقیت ایجاد شد.');
    }

    public function update(Request $request, Coupon $coupon): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'min:3', 'max:20', Rule::unique('coupons')->ignore($coupon->id)],
            'code' => ['required', Rule::unique('coupons')->ignore($coupon->id)],
            'shop_id' => 'required',
            'type' => 'required',
            'status' => 'required',
            'amount' => 'required_if:type,=,amount',
            'percentage' => 'required_if:type,=,percentage',
            'max_percentage_amount' => 'required_if:type,=,percentage',
            'expired_at' => 'required|date',
            'description' => 'required|min:3|max:100',
        ]);

        if ($validator->fails()) {
            return errorResponse(422, $validator->messages());
        }

        try {
            DB::beginTransaction();

            $coupon->update([
                'title' => $request->title,
                'shop_id' => $request->shop_id == 0 ? null : $request->shop_id,
                'code' => $request->code,
                'type' => $request->type,
                'status' => $request->status,
                'amount' => $request->amount,
                'percentage' => $request->percentage,
                'max_percentage_amount' => $request->max_percentage_amount,
                'expired_at' => convertToGregorianDate($request->expired_at),
                'description' => $request->description,
            ]);

            DB::commit();
        }catch (Exception $ex) {
            DB::rollBack();
            return errorResponse(422, $ex->getMessage());
        }

        return successResponse(new CouponResource($coupon), 200, 'کد تخفیف با موفقیت ویرایش شد.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupon $coupon): JsonResponse
    {
        $coupon->delete();

        return successResponse(new CouponResource($coupon), 200, 'نظر مورد نظر با موفقیت حذف شد!');
    }
}
