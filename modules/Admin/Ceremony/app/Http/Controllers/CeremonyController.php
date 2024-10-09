<?php

namespace Modules\Admin\Ceremony\app\Http\Controllers;

use App\Models\Ceremony;
use App\Models\Ingredient;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CeremonyController
{
    public function index(): View|Factory|Application
    {
        $ceremonies = Ceremony::latest()->paginate(10);
        return view('AdminCeremony::Views/index', compact('ceremonies'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validateWithBag('createCeremony', [
            'title' => 'required|min:3|max:18',
            'description' => 'required|min:10',
            'price' => 'required|integer',
            'status' => 'required'
        ]);

        Ceremony::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'status' => $request->status
        ]);

        flash()->flash("success", 'با موفقیت به مراسمات اضافه شد.', [], 'موفقیت آمیز');
        return redirect()->back();
    }

    public function update(Request $request, Ceremony $ceremony): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'min:3', 'max:18',Rule::unique('ceremonies')->ignore($request->ceremony->id)],
            'description' => 'required|min:10',
            'price' => 'required|integer',
            'status' => 'required'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator, 'updateCeremony')->withInput()->with(['ceremony_id' => $ceremony->id]);
        }

        $ceremony->update([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'status' => $request->status
        ]);

        flash()->flash("success", 'مراسم مورد نظر با موفقیت ویرایش شد!', [], 'موفقیت آمیز');
        return redirect()->back();
    }

    public function destroy(Request $request): RedirectResponse
    {
        Ceremony::find($request->ceremony)->update(['status' => 0]);
        Ceremony::destroy($request->ceremony);
        flash()->flash("success", 'مراسم مورد نظر با موفقیت حذف شد!', [], 'موفقیت آمیز');
        return redirect()->back();
    }

    public function search(): View|Factory|Application
    {
        $keyword = request()->keyword;
        if (request()->has('keyword') && trim($keyword) != ''){
            $ceremonies = Ceremony::where('title', 'LIKE', '%'.trim($keyword).'%')->latest()->paginate(10);
        }else{
            $ceremonies = Ceremony::latest()->paginate(10);
        }
        return view('AdminCeremony::Views/index' , compact('ceremonies'));
    }

    public function searchFromTrash(): View|Factory|Application
    {
        $keyword = request()->keyword;
        if (request()->has('keyword') && trim($keyword) != ''){
            $ceremonies = Ceremony::onlyTrashed()->where('title', 'LIKE', '%'.trim($keyword).'%')->latest()->paginate(10);
        }else{
            $ceremonies = Ceremony::onlyTrashed()->latest()->paginate(10);
        }
        return view('AdminCeremony::Views/trash' , compact('ceremonies'));
    }

    public function trash(): View|Factory|Application
    {
        $ceremonies = Ceremony::onlyTrashed()->orderBy('status', 'desc')->paginate(10);
        return view('AdminCeremony::Views/trash', compact('ceremonies'));
    }

    public function forceDelete(Request $request): RedirectResponse
    {
        Ceremony::onlyTrashed()->find($request->ceremony)->forceDelete();
        flash()->flash("success", 'مراسم مورد نظر با موفقیت کامل حذف شد!', [], 'موفقیت آمیز');
        return redirect()->back();
    }

    public function restore(Request $request): RedirectResponse
    {
        Ceremony::onlyTrashed()->find($request->ceremony)->restore();
        flash()->flash("success", 'مراسم مورد نظر با موفقیت بازگردانی حذف شد!', [], 'موفقیت آمیز');
        return redirect()->back();
    }
}
