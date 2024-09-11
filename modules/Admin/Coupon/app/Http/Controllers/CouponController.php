<?php

namespace Modules\Admin\Coupon\app\Http\Controllers;

use App\Models\Coupon;
use App\Models\Shop;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CouponController
{
    public function index(): View|Factory|Application
    {
        $coupons = Coupon::latest()->paginate(10);
        $shops = Shop::status()->get();
        return view('AdminCoupon::Views/index', compact('coupons', 'shops'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validateWithBag('createCoupon', [
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

        try {
            DB::beginTransaction();

            Coupon::create([
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
            flash()->flash("error", $ex->getMessage(), [], 'مشکلی پیش آمد');
            return redirect()->back();
        }

        flash()->flash("success", 'با موفقیت به کد های تخفیف اضافه شد.', [], 'موفقیت آمیز');
        return redirect()->back();
    }

    public function update(Request $request, Coupon $coupon): RedirectResponse
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

        if($validator->fails()){
            return back()->withErrors($validator, 'updateCoupon')->withInput()->with(['coupon_id' => $coupon->id]);
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
            flash()->flash("error", $ex->getMessage(), [], 'مشکلی پیش آمد');
            return redirect()->back();
        }

        flash()->flash("success", 'کد تخفیف مورد نظر با موفقیت ویرایش شد!', [], 'موفقیت آمیز');
        return redirect()->back();
    }

    public function destroy(Request $request): RedirectResponse
    {
        Coupon::destroy($request->coupon);

        flash()->flash("success", 'کد تخفیف مورد نظر با موفقیت حذف شد!', [], 'موفقیت آمیز');
        return redirect()->back();
    }

    public function search(): View|Factory|Application
    {
        $keyword = request()->keyword;
        if (request()->has('keyword') && trim($keyword) != ''){
            $coupons = Coupon::where('title', 'like', '%' . $keyword . '%')->latest()->paginate(10);
        }else{
            $coupons = Coupon::latest()->paginate(10);
        }
        $shops = Shop::where('status' , '=' , '1')->get();
        return view('AdminCoupon::Views/index' , compact('coupons', 'shops'));
    }
}
