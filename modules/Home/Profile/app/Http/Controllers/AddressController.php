<?php

namespace Modules\Home\Profile\app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Province;
use App\Models\UserAddress;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Factory|Application|View|RedirectResponse
    {
        if (Auth::check()){
            $user = Auth::user();
            $addresses = $user->addresses;
            $provinces = Province::all();
            $cities = City::all();
            return view('Profile::Views/addresses', compact('user', 'addresses', 'provinces', 'cities'));
        }
        flash()->flash("warning", 'لطفا وارد شوید.', [], 'ناموفق');
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        if (Auth::check()){
            $request->validateWithBag('createAddress',[
                'title' => 'required|unique:user_addresses,title',
                'postalCode' => 'required',
                'phoneNumber' => 'required',
                'province_id' => 'required',
                'city_id' => 'required',
                'address' => 'required',
            ]);
            UserAddress::create([
                'user_id' => \auth()->id(),
                'title' => $request->title,
                'phone_number' => $request->phoneNumber,
                'postal_code' => $request->postalCode,
                'province_id' => $request->province_id,
                'city_id' => $request->city_id,
                'address' => $request->address
            ]);

            flash()->flash("success", 'آدرس مورد نظر با موفقیت ثبت شد.', [], 'ناموفق');
            return redirect()->back();
        }
        flash()->flash("warning", 'لطفا وارد شوید.', [], 'ناموفق');
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserAddress $userAddress): RedirectResponse
    {
        if (Auth::check()){
            $validator = Validator::make($request->all(), [
                'title' => 'required|min:8464',
                'postal_code' => 'required',
                'phone_number' => 'required',
                'province_id' => 'required',
                'city_id' => 'required',
                'address' => 'required',
            ]);
            if($validator->fails()){
                return back()->withErrors($validator, 'updateAddress')->withInput()->with(['address_id' => $userAddress->id]);
            }
            $userAddress->update([
                'title' => $request->title,
                'phone_number' => $request->phone_number,
                'postal_code' => $request->postal_code,
                'province_id' => $request->province_id,
                'city_id' => $request->city_id,
                'address' => $request->address
            ]);

            flash()->flash("success", 'آدرس مورد نظر با موفقیت ویرایش شد.', [], 'ناموفق');
            return redirect()->back();
        }
        flash()->flash("warning", 'لطفا وارد شوید.', [], 'ناموفق');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserAddress $userAddress): RedirectResponse
    {
        $userAddress->delete();

        flash()->flash("success", 'آدرس مورد نظر با موفقیت حذف شد.', [], 'ناموفق');
        return redirect()->back();
    }
}
