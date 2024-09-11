<?php

namespace Modules\Admin\Setting\app\Http\Controllers;

use App\Models\Setting;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingController
{
    public function index(): View|Factory|Application
    {
        $setting = Setting::first();
        return view('AdminSetting::Views/index', compact('setting'));
    }

    public function update(Request $request, Setting $setting): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'address' => 'nullable|string|max:255',
            'telephone' => 'nullable',
            'telephone2' => 'nullable',
            'instagram' => 'nullable|string|max:255',
            'telegram' => 'nullable|string|max:255',
            'github' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
            'about' => 'nullable|string',
            'delivery_amount' => 'required|integer',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator, 'updateSetting')->withInput()->with(['setting_id' => $setting->id]);
        }

        $setting->update([
            'address' => $request->address,
            'telephone' => $request->telephone,
            'telephone2' => $request->telephone2,
            'instagram' => $request->instagram,
            'telegram' => $request->telegram,
            'github' => $request->github,
            'linkedin' => $request->linkedin,
            'about' => $request->about,
            'delivery_amount' => $request->delivery_amount,
        ]);

        flash()->flash("success", 'تنظیمات با موفقیت ویرایش شد!', [], 'موفقیت آمیز');
        return redirect()->back();
    }
}
