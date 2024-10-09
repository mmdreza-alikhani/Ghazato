<?php

namespace Modules\Admin\Table\app\Http\Controllers;

use App\Models\Shop;
use App\Models\Table;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TableController
{
    public function index(): View|Factory|Application
    {
        $shops = Shop::status()->get();
        $tables = Table::latest()->paginate(10);
        return view('AdminTable::Views/index', compact('shops', 'tables'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validateWithBag('createTable', [
            'title' => 'required|min:3|max:18',
            'shop_id' => 'required|exists:shops,id',
            'seats' => 'required|numeric|min:1|max:50',
            'price' => 'required|integer',
            'status' => 'required'
        ]);

        Table::create([
            'title' => $request->title,
            'shop_id' => $request->shop_id,
            'seats' => $request->seats,
            'price' => $request->price,
            'status' => $request->status
        ]);

        flash()->flash("success", 'با موفقیت به میز ها اضافه شد.', [], 'موفقیت آمیز');
        return redirect()->back();
    }

    public function update(Request $request, Table $table): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'min:3', 'max:18',Rule::unique('tables')->ignore($request->table->id)],
            'shop_id' => 'required|exists:shops,id',
            'seats' => 'required|numeric|min:1|max:50',
            'price' => 'required|integer',
            'status' => 'required'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator, 'updateTable')->withInput()->with(['table_id' => $table->id]);
        }

        $table->update([
            'title' => $request->title,
            'shop_id' => $request->shop_id,
            'seats' => $request->seats,
            'price' => $request->price,
            'status' => $request->status
        ]);

        flash()->flash("success", 'میز مورد نظر با موفقیت ویرایش شد!', [], 'موفقیت آمیز');
        return redirect()->back();
    }

    public function destroy(Request $request): RedirectResponse
    {
        Table::find($request->table)->update(['status' => 0]);
        Table::destroy($request->table);
        flash()->flash("success", 'میز مورد نظر با موفقیت حذف شد!', [], 'موفقیت آمیز');
        return redirect()->back();
    }

    public function search(): View|Factory|Application
    {
        $keyword = request()->keyword;
        if (request()->has('keyword') && trim($keyword) != ''){
            $tables = Table::where('title', 'LIKE', '%'.trim($keyword).'%')->latest()->paginate(10);
        }else{
            $tables = Table::latest()->paginate(10);
        }
        return view('AdminTable::Views/index' , compact('tables'));
    }

    public function searchFromTrash(): View|Factory|Application
    {
        $keyword = request()->keyword;
        if (request()->has('keyword') && trim($keyword) != ''){
            $tables = Table::onlyTrashed()->where('title', 'LIKE', '%'.trim($keyword).'%')->latest()->paginate(10);
        }else{
            $tables = Table::onlyTrashed()->latest()->paginate(10);
        }
        return view('AdminTable::Views/trash' , compact('tables'));
    }

    public function trash(): View|Factory|Application
    {
        $tables = Table::onlyTrashed()->orderBy('status', 'desc')->paginate(10);
        return view('AdminTable::Views/trash', compact('tables'));
    }

    public function forceDelete(Request $request): RedirectResponse
    {
        Table::onlyTrashed()->find($request->table)->forceDelete();
        flash()->flash("success", 'میز مورد نظر با موفقیت کامل حذف شد!', [], 'موفقیت آمیز');
        return redirect()->back();
    }

    public function restore(Request $request): RedirectResponse
    {
        Table::onlyTrashed()->find($request->table)->restore();
        flash()->flash("success", 'میز مورد نظر با موفقیت بازگردانی حذف شد!', [], 'موفقیت آمیز');
        return redirect()->back();
    }
}
