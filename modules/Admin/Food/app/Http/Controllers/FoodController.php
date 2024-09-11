<?php

namespace Modules\Admin\Food\app\Http\Controllers;

use App\Models\Category;
use App\Models\Food;
use App\Models\FoodImage;
use App\Models\Ingredient;
use App\Models\Shop;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FoodController
{
    public function index(): View|Factory|Application
    {
        $foods = Food::latest()->with('ingredients', 'shop', 'images')->paginate(10);
        $ingredients = Ingredient::all();
        $categories = Category::status()->get();
        $shops = Shop::status()->get();
        return view('AdminFood::Views/index', compact('foods', 'ingredients', 'categories', 'shops'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validateWithBag('createFood', [
            'title' => 'required|min:3|max:18',
            'category_id' => 'required',
            'ingredient_ids' => 'required',
            'ingredient_ids.*' => 'required',
            'shop_id' => 'required',
            'is_vegan' => 'nullable',
            'sku' => 'required',
            'price' => 'required|integer',
            'status' => 'required',
            'description' => 'required',
            'primary_image' => 'required|mimes:jpg,jpeg,png,svg',
            'other_images' => 'required',
            'other_images.*' => 'mimes:jpg,jpeg,png,svg',
        ]);

        try {
            DB::beginTransaction();

            $productImageController = new FoodImageController();
            $imagesName = $productImageController->upload($request->primary_image , $request->other_images);

            $food = Food::create([
                'title' => $request->title,
                'category_id' => $request->category_id,
                'shop_id' => $request->shop_id,
                'sku' => $request->sku,
                'price' => $request->price,
                'primary_image' => $imagesName['primary_image'],
                'description' => $request->description,
                'status' => $request->status,
                'is_vegan' => $request->is_vegan ? 1 : 0,
            ]);

            foreach($imagesName['other_images'] as $imageName){
                FoodImage::create([
                    'image' => $imageName,
                    'food_id' => $food->id
                ]);
            }

            $food->ingredients()->attach($request->ingredient_ids);

            DB::commit();
        }catch (Exception $ex) {
            DB::rollBack();
            flash()->flash("error", $ex->getMessage(), [], 'مشکلی پیش آمد');
            return redirect()->back();
        }

        flash()->flash("success", 'با موفقیت به غذا ها اضافه شد.', [], 'موفقیت آمیز');
        return redirect()->back();
    }

    public function update(Request $request, Food $food): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3|max:18',
            'category_id' => 'required',
            'ingredient_ids' => 'required',
            'ingredient_ids.*' => 'required',
            'shop_id' => 'required',
            'is_vegan' => 'nullable',
            'sku' => 'required',
            'price' => 'required|integer',
            'status' => 'required',
            'description' => 'required',
            'discounted_price' => 'nullable|integer',
            'discounted_quantity' => 'nullable|integer',
            'date_on_sale_from' => 'nullable|date',
            'date_on_sale_to' => 'nullable|date',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator, 'updateFood')->withInput()->with(['food_id' => $food->id]);
        }

        try {
            DB::beginTransaction();

            $food->update([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'shop_id' => $request->shop_id,
            'sku' => $request->sku,
            'price' => $request->price,
            'description' => $request->description,
            'status' => $request->status,
            'is_vegan' => $request->is_vegan ? 1 : 0,
            'discounted_price' => $request->discounted_price,
            'discounted_quantity' => $request->discounted_quantity,
            'date_on_sale_from' => convertToGregorianDate($request->date_on_sale_from),
            'date_on_sale_to' => convertToGregorianDate($request->date_on_sale_to)
        ]);

            $food->ingredients()->sync($request->ingredient_ids);

            DB::commit();
        }catch (Exception $ex) {
            DB::rollBack();
            flash()->flash("error", $ex->getMessage(), [], 'مشکلی پیش آمد');
            return redirect()->back();
        }

        flash()->flash("success", 'غذای مورد نظر با موفقیت ویرایش شد!', [], 'موفقیت آمیز');
        return redirect()->back();
    }

    public function destroy(Request $request): RedirectResponse
    {
        Food::destroy($request->food->id);

        flash()->flash("success", 'غذای مورد نظر با موفقیت حذف شد!', [], 'موفقیت آمیز');
        return redirect()->back();
    }

    public function search(): View|Factory|Application
    {
        $keyword = request()->keyword;
        if (request()->has('keyword') && trim($keyword) != ''){
            $foods = Food::where('title', 'like', '%' . $keyword . '%')->orWhere('sku', 'like', '%' . $keyword . '%')->latest()->paginate(10);
        }else{
            $foods = Food::latest()->paginate(10);
        }
        $ingredients = Ingredient::all();
        $categories = Category::status()->get();
        $shops = Shop::status()->get();
        return view('AdminFood::Views/index' , compact('foods', 'ingredients', 'categories', 'shops'));
    }
}
