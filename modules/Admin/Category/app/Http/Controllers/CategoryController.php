<?php

namespace Modules\Admin\Category\app\Http\Controllers;

use App\Models\Category;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController
{
    public function index(): View|Factory|Application
    {
        $categories = Category::orderBy('status', 'desc')->paginate(10);
        return view('AdminCategory::Views/index', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validateWithBag('createCategory', [
            'title' => 'required|min:3|max:18',
            'status' => 'required',
            'icon' => 'required',
        ]);

        Category::create([
            'title' => $request->title,
            'status' => $request->status,
            'icon' => $request->icon,
        ]);

        flash()->flash("success", 'با موفقیت به دسته بندی ها اضافه شد.', [], 'موفقیت آمیز');
        return redirect()->back();
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3|max:18',
            'status' => 'required',
            'icon' => 'required',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator, 'updateCategory')->withInput()->with(['category_id' => $category->id]);
        }

        $category->update([
            'title' => $request->title,
            'status' => $request->status,
            'icon' => $request->icon
        ]);

        flash()->flash("success", 'دسته بندی مورد نظر با موفقیت ویرایش شد!', [], 'موفقیت آمیز');
        return redirect()->back();
    }

    public function destroy(Request $request): RedirectResponse
    {
        Category::destroy($request->category);
        flash()->flash("success", 'دسته بندی مورد نظر با موفقیت حذف شد!', [], 'موفقیت آمیز');
        return redirect()->back();
    }

    public function search(): View|Factory|Application
    {
        $keyword = request()->keyword;
        if (request()->has('keyword') && trim($keyword) != ''){
            $categories = Category::where('title', 'LIKE', '%'.trim($keyword).'%')->latest()->paginate(10);
        }else{
            $categories = Category::latest()->paginate(10);
        }
        return view('AdminCategory::Views/index' , compact('categories'));
    }
}
