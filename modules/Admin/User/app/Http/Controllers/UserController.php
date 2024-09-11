<?php

namespace Modules\Admin\User\app\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController
{
    public function index(): View|Factory|Application
    {
        $users = User::latest()->paginate(10);
        return view('AdminUser::Views/index', compact('users'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validateWithBag('createUser', [
            'username' => ['required',Rule::unique('users'), 'min:5', 'max:30'],
            'firstname' => ['nullable', 'min:3', 'max:30'],
            'lastname' => ['nullable', 'min:3', 'max:30'],
            'email' => ['required', 'email:dns', 'min:5', 'max:255', Rule::unique('users')],
            'phone_number' => ['nullable',Rule::unique('users'), 'min:10', 'max:10'],
            'password' => 'required|string|min:8|max:255|confirmed',
            'status' => 'required'
        ]);

        try {
            DB::beginTransaction();

            User::create([
                'firstname' => $request->firstname ? $request->firstname : null,
                'lastname' => $request->lastname ? $request->lastname : null,
                'username' => $request->username,
                'email' => $request->email,
                'phone_number' => $request->phone_number ? $request->phone_number : null,
                'password' => Hash::make($request->password),
                'status' => $request->status,
                'provider_name' => 'manual'
            ]);

            DB::commit();
        }catch (Exception $ex) {
            DB::rollBack();
            flash()->flash("error", $ex->getMessage(), [], 'مشکلی پیش آمد');
            return redirect()->back();
        }

        flash()->flash("success", 'با موفقیت به کاربران اضافه شد.', [], 'موفقیت آمیز');
        return redirect()->back();
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'username' => ['required',Rule::unique('users')->ignore($request->user->id), 'min:5', 'max:30'],
            'firstname' => ['nullable', 'min:3', 'max:30'],
            'lastname' => ['nullable', 'min:3', 'max:30'],
            'email' => ['required', 'email:dns', 'min:5', 'max:255', Rule::unique('users')->ignore($request->user->id)],
            'phone_number' => ['nullable',Rule::unique('users')->ignore($request->user->id), 'min:10', 'max:10'],
            'password' => 'nullable|string|min:8|max:255|confirmed',
            'status' => 'required'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator, 'updateUser')->withInput()->with(['user_id' => $user->id]);
        }

        try {
            DB::beginTransaction();

            $user->update([
                'username' => $request->username,
                'firstname' => $request->first_name ? $request->first_name : $user->first_name,
                'lastname' => $request->last_name ? $request->last_name : $user->last_name,
                'email' => $request->email,
                'phone_number' => $request->phone_number ? $request->phone_number : $user->phone_number,
                'status' => $request->status
            ]);

            if ($request->password){
                $user->update([
                    'password' => Hash::make($request->password)
                ]);
            }

            DB::commit();
        }catch (Exception $ex) {
            DB::rollBack();
            flash()->flash("error", $ex->getMessage(), [], 'مشکلی پیش آمد');
            return redirect()->back();
        }

        flash()->flash("success", 'کاربر مورد نظر با موفقیت ویرایش شد!', [], 'موفقیت آمیز');
        return redirect()->back();
    }

    public function destroy(Request $request): RedirectResponse
    {
        User::destroy($request->user->id);

        flash()->flash("success", 'کاربر مورد نظر با موفقیت حذف شد!', [], 'موفقیت آمیز');
        return redirect()->back();
    }

    public function search(): View|Factory|Application
    {
        $keyword = request()->keyword;
        if (request()->has('keyword') && trim($keyword) != ''){
            $users = User::where('username', 'like', '%' . $keyword . '%')->latest()->paginate(10);
        }else{
            $users = User::latest()->paginate(10);
        }
        return view('AdminUser::Views/index' , compact('users'));
    }
}
