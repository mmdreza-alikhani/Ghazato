<?php

namespace Modules\Admin\Reservation\app\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReservationController
{
    public function index(): View|Factory|Application
    {
        $reservations = Reservation::latest()->paginate(10);
        return view('AdminReservation::Views/index', compact('reservations'));
    }

    public function update(Request $request, Reservation $reservation): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator, 'updateReservation')->withInput()->with(['reservation_id' => $reservation->id]);
        }

        $reservation->update([
            'status' => $request->status
        ]);

        flash()->flash("success", 'رزرو مورد نظر با موفقیت ویرایش شد!', [], 'موفقیت آمیز');
        return redirect()->back();
    }

    public function destroy(Request $request): RedirectResponse
    {
        Reservation::destroy($request->reservation);

        flash()->flash("success", 'رزرو مورد نظر با موفقیت حذف شد!', [], 'موفقیت آمیز');
        return redirect()->back();
    }
}
