<?php

namespace Modules\Admin\Comment\app\Http\Controllers;

use App\Models\Comment;
use App\Models\Ingredient;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController
{
    public function index(): View|Factory|Application
    {
        // We only retrieve Undecided Comments which their status is equal to = 0
        $comments = Comment::undecided()->latest()->paginate(10);
        return view('AdminComment::Views/index', compact('comments'));
    }

    public function reject(Request $request, Comment $comment): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'text' => 'required',
            'reason_for_rejection' => 'required'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator, 'rejectComment')->withInput()->with(['comment_id' => $comment->id]);
        }

        $comment->update([
            'status' => 2,
            'reason_for_rejection' => $request->reason_for_rejection
        ]);

        flash()->flash("success", 'نظر مورد نظر با موفقیت رد شد!', [], 'موفقیت آمیز');
        return redirect()->back();
    }

    public function approve(Request $request, Comment $comment): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'text' => 'required'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator, 'showComment')->withInput()->with(['comment_id' => $comment->id]);
        }

        $comment->update([
           'status' => 1
        ]);

        flash()->flash("success", 'نظر مورد نظر با موفقیت تایید شد!', [], 'موفقیت آمیز');
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
