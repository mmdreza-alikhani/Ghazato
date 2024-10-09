<?php

namespace Modules\Admin\Banner\app\Http\Controllers;

use App\Models\Banner;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class BannerController
{
    public function index(): View|Factory|Application
    {
        $banners = Banner::latest()->paginate(10);
        return view('AdminBanner::Views/index', compact('banners'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validateWithBag('createBanner', [
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

        try {
            DB::beginTransaction();

            $imageName = generateFileName($request->image->getClientOriginalName());
            $request->image->move(storage_path(env('BANNER_IMAGE_UPLOAD_PATH')), $imageName);

            Banner::create([
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
            flash()->flash("error", $ex->getMessage(), [], 'مشکلی پیش آمد');
            return redirect()->back();
        }

        flash()->flash("success", 'با موفقیت به بنر ها اضافه شد.', [], 'موفقیت آمیز');
        return redirect()->back();
    }

    public function update(Request $request, Banner $banner): RedirectResponse
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
            return back()->withErrors($validator, 'updateBanner')->withInput()->with(['banner_id' => $banner->id]);
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
            flash()->flash("error", $ex->getMessage(), [], 'مشکلی پیش آمد');
            return redirect()->back();
        }

        flash()->flash("success", 'بنر مورد نظر با موفقیت ویرایش شد!', [], 'موفقیت آمیز');
        return redirect()->back();
    }

    public function destroy(Request $request): RedirectResponse
    {
        Banner::find($request->banner)->update(['status' => 0]);
        Banner::destroy($request->banner);
        flash()->flash("success", 'بنر مورد نظر با موفقیت حذف شد!', [], 'موفقیت آمیز');
        return redirect()->back();
    }

    public function search(): View|Factory|Application
    {
        $keyword = request()->keyword;
        if (request()->has('keyword') && trim($keyword) != ''){
            $banners = Banner::where('title', 'LIKE', '%'.trim($keyword).'%')->latest()->paginate(10);
        }else{
            $banners = Banner::latest()->paginate(10);
        }
        return view('AdminBanner::Views/index' , compact('banners'));
    }

    public function searchFromTrash(): View|Factory|Application
    {
        $keyword = request()->keyword;
        if (request()->has('keyword') && trim($keyword) != ''){
            $banners = Banner::onlyTrashed()->where('title', 'LIKE', '%'.trim($keyword).'%')->latest()->paginate(10);
        }else{
            $banners = Banner::onlyTrashed()->latest()->paginate(10);
        }
        return view('AdminBanner::Views/trash' , compact('banners'));
    }

    public function trash(): View|Factory|Application
    {
        $banners = Banner::onlyTrashed()->orderBy('status', 'desc')->paginate(10);
        return view('AdminBanner::Views/trash', compact('banners'));
    }

    public function forceDelete(Request $request): RedirectResponse
    {
        Banner::onlyTrashed()->find($request->banner)->forceDelete();
        flash()->flash("success", 'بنر مورد نظر با موفقیت کامل حذف شد!', [], 'موفقیت آمیز');
        return redirect()->back();
    }

    public function restore(Request $request): RedirectResponse
    {
        Banner::onlyTrashed()->find($request->banner)->restore();
        flash()->flash("success", 'بنر مورد نظر با موفقیت بازگردانی حذف شد!', [], 'موفقیت آمیز');
        return redirect()->back();
    }
}
