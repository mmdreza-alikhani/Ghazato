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
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
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

    public function reserve(Request $request): RedirectResponse
    {
        $request->validateWithBag('createReservation', [
            'ceremony_id' => 'required',
            'table_id' => 'required',
            'date' => 'required|date',
//            'paying_price' => 'required|integer',
            'phone_number' => 'required|min:10|max:10',
            'description' => 'required|min:3|max:255'
        ]);

        try {
            DB::beginTransaction();

//            $isTableFree = Reservation::where('table_id', '=', $request->table_id)->where('date', '=', convertJalaliDateToGregorianDate($request->date))->get();
//
//            if($isTableFree == null){
                Reservation::create([
                    'user_id' => 5,
                    'ceremony_id' => $request->ceremony_id,
                    'table_id' => $request->table_id,
                    'shop_id' => $request->shop_id,
                    'date' => convertJalaliDateToGregorianDate($request->date),
                    'paying_price' => '800000',
                    'phone_number' => $request->phone_number,
                    'description' => $request->description,
                    'status' => '1',
                ]);
//            }else{
//                flash()->flash("error", 'زمان انتخابی اشتباه است.', [], 'ناموفق');
//                return redirect()->back();
//            }

            DB::commit();
        }catch (Exception $ex) {
            DB::rollBack();
            flash()->flash("error", $ex->getMessage(), [], 'مشکلی پیش آمد');
            return redirect()->back();
        }

        flash()->flash("success", 'با موفقیت به رزرو ها اضافه شد.', [], 'موفقیت آمیز');
        return redirect()->back();
    }
}
