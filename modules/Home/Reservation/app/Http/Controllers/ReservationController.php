<?php

namespace Modules\Home\Reservation\app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Ceremony;
use App\Models\Food;
use App\Models\Reservation;
use App\Models\Shop;
use App\Models\Table;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    public function index(Shop $shop): View|Factory|Application
    {
        $tables = Table::status()->get();
        $ceremonies = Ceremony::status()->get();
        return view('Reservation::Views/index', compact('shop','ceremonies' , 'tables'));
    }

    public function reserve(Request $request)
    {
        $request->validateWithBag('createReservation', [
            'ceremony_id' => 'required',
            'shop_id' => 'required',
            'table_id' => 'required',
            'date' => 'required|date',
            'paying_price' => 'required|integer',
            'phone_number' => 'required|min:10|max:10',
            'description' => 'required|min:3|max:255'
        ]);

        try {
            DB::beginTransaction();

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
}
