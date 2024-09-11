<?php

namespace Modules\Admin\Ingredient\app\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IngredientController
{
    public function index(): View|Factory|Application
    {
        $ingredients = Ingredient::latest()->paginate(10);
        return view('AdminIngredient::Views/index', compact('ingredients'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validateWithBag('createIngredient', [
            'title' => 'required|min:3|max:18'
        ]);

        Ingredient::create([
            'title' => $request->title
        ]);

        flash()->flash("success", 'با موفقیت به ترکیبات اضافه شد.', [], 'موفقیت آمیز');
        return redirect()->back();
    }

    public function update(Request $request, Ingredient $ingredient): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3|max:18|unique:ingredients'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator, 'updateIngredient')->withInput()->with(['ingredient_id' => $ingredient->id]);
        }

        $ingredient->update([
            'title' => $request->title
        ]);

        flash()->flash("success", 'ترکیب مورد نظر با موفقیت ویرایش شد!', [], 'موفقیت آمیز');
        return redirect()->back();
    }

    public function destroy(Request $request): RedirectResponse
    {
        Ingredient::destroy($request->ingredient);

        flash()->flash("success", 'ترکیب مورد نظر با موفقیت حذف شد!', [], 'موفقیت آمیز');
        return redirect()->back();
    }

    public function search(): View|Factory|Application
    {
        $keyword = request()->keyword;
        if (request()->has('keyword') && trim($keyword) != ''){
            $ingredients = Ingredient::where('title', 'LIKE', '%'.trim($keyword).'%')->latest()->paginate(10);
        }else{
            $ingredients = Ingredient::latest()->paginate(10);
        }
        return view('AdminIngredient::Views/index' , compact('ingredients'));
    }
}
