<?php

namespace Modules\Admin\Feedback\app\Http\Controllers;

use App\Models\Comment;
use App\Models\Feedback;
use App\Models\Ingredient;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FeedbackController
{
    public function index(): View|Factory|Application
    {
        // We only retrieve Undecided Feedbacks which they haven't been answered
        $feedbacks = Feedback::unanswered()->latest()->paginate(10);
        return view('AdminFeedback::Views/index', compact('feedbacks'));
    }

    public function response(Request $request, Feedback $feedback): RedirectResponse
    {
        // ادمین ایدی رو بذار و تو کامنتم باید برای ریجکت ادمین ایدی بذاری
        $validator = Validator::make($request->all(), [
            'response' => 'required'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator, 'responseFeedback')->withInput()->with(['feedback_id' => $feedback->id]);
        }

        $feedback->update([
            'response' => $request->response
        ]);

        flash()->flash("success", 'فیدبک مورد نظر با موفقیت پاسخ داده شد!', [], 'موفقیت آمیز');
        return redirect()->back();
    }


    public function destroy(Request $request): RedirectResponse
    {
        Feedback::destroy($request->feedback);

        flash()->flash("success", 'فیدبک مورد نظر با موفقیت حذف شد!', [], 'موفقیت آمیز');
        return redirect()->back();
    }

    public function search(): View|Factory|Application
    {
        $keyword = request()->keyword;
        if (request()->has('keyword') && trim($keyword) != ''){
            $feedbacks = Feedback::where('subject', 'like', '%' . $keyword . '%')->unanswered()->latest()->paginate(10);
        }else{
            $feedbacks = Feedback::unanswered()->latest()->paginate(10);
        }
        return view('AdminFeedback::Views/index' , compact('feedbacks'));
    }
}
