<?php

namespace Modules\Home\Profile\app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Bookmark;
use App\Models\Category;
use App\Models\Feedback;
use App\Models\Food;
use App\Models\Order;
use App\Models\Shop;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{

    public function info(): Factory|Application|View|RedirectResponse
    {
        if (Auth::check()){
            $user = Auth::user();
            return view('Profile::Views/info', compact('user'));
        }
        flash()->flash("warning", 'لطفا وارد شوید.', [], 'ناموفق');
        return redirect()->back();
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'username' => ['required',Rule::unique('users')->ignore($request->user_id)],
            'firstname' => 'nullable|min:3|max:16',
            'lastname' => 'nullable|min:3|max:16',
            'phone_number' => ['nullable',Rule::unique('users')->ignore($request->user_id),'min:10','max:10'],
            'avatar' => 'nullable|mimes:jpg,jpeg,png,svg',
            'email' => ['required', 'email', Rule::unique('users')->ignore($request->user_id)]
        ]);

        try {
            DB::beginTransaction();

            if ($request->avatar) {
                $avatarName = generateFileName($request->avatar->getClientOriginalName());
//                $resized = $manager->read($request->avatar)->resize(100,100)->save(storage_path(env('USER_AVATAR_UPLOAD_PATH')) , $avatarName);
                $request->avatar->move(storage_path(env('USER_AVATAR_UPLOAD_PATH')) , $avatarName);
                $user->update([
                    'avatar' => $avatarName
                ]);
            }

            if ($request->email) {
                $user->update([
                   'email_verified_at' => null,
                ]);
            }

            $user->update([
                'username' => $request->username,
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'phone_number' => $request->phone_number,
                'email' => $request->email
            ]);

            DB::commit();
        }catch (\Exception $ex) {
            DB::rollBack();
            flash()->flash("warning", $ex->getMessage(), [], 'ناموفق');
            return redirect()->back();
        }

        flash()->flash("success", 'اطلاعات مورد نظر با موفقیت ویرایش شد.', [], 'موفق');
        return redirect()->back();
    }

    public function orders(): Factory|Application|View|RedirectResponse
    {
        if (Auth::check()){
            $user = Auth::user();
            $orders = Order::where('user_id', '=', $user->id)->latest()->paginate();
            return view('Profile::Views/Orders/index', compact('user', 'orders'));
        }
        flash()->flash("warning", 'لطفا وارد شوید.', [], 'ناموفق');
        return redirect()->back();
    }

    public function showOrder(Order $order): Factory|Application|View|RedirectResponse
    {
        if (Auth::check()){
            if ($order->user_id != \auth()->id()){
                return redirect()->back();
            }
            $user = Auth::user();
            $transaction = Transaction::where('order_id', $order->id)->first();
            return view('Profile::Views/Orders/show', compact('user', 'order', 'transaction'));
        }
        flash()->flash("warning", 'لطفا وارد شوید.', [], 'ناموفق');
        return redirect()->back();
    }

    public function bookmarks(): Factory|Application|View|RedirectResponse
    {
        if (Auth::check()){
            $user = Auth::user();
            return view('Profile::Views/bookmarks', compact('user'));
        }
        flash()->flash("warning", 'لطفا وارد شوید.', [], 'ناموفق');
        return redirect()->back();
    }

    public function comments(): Factory|Application|View|RedirectResponse
    {
        if (Auth::check()){
            $user = Auth::user();
            return view('Profile::Views/comments', compact('user'));
        }
        flash()->flash("warning", 'لطفا وارد شوید.', [], 'ناموفق');
        return redirect()->back();
    }

}
