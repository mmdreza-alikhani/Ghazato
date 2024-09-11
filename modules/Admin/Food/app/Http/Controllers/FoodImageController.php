<?php

namespace Modules\Admin\Food\app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Food;
use App\Models\FoodImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class FoodImageController extends Controller
{
    public function upload($primary_image , $other_images)
    {
        $primaryImageFileName = generateFileName($primary_image->getClientOriginalName());
        $primary_image->move(public_path(env('FOOD_IMAGE_UPLOAD_PATH')) , $primaryImageFileName);

        $otherImagesFileNames = [];
        foreach ($other_images as $image){
            $otherImagesFileName = generateFileName($image->getClientOriginalName());
            $image->move(public_path(env('FOOD_IMAGE_UPLOAD_PATH')) , $otherImagesFileName);
            array_push($otherImagesFileNames , $otherImagesFileName);
        }

        return ['primary_image' => $primaryImageFileName , 'other_images' => $otherImagesFileNames];
    }

    public function destroy(Request $request, Food $food)
    {
        $validator = Validator::make($request->all(), [
           'image_id' => 'required',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator, 'updateFoodImages')->withInput()->with(['food_id' => $food->id]);
        }

        FoodImage::destroy($request->image_id);

        File::delete(public_path('/uploads/foods/images/'. $request->image_name));

        flash()->flash("success", 'تصویر مورد نظر با موفقیت حذف شد!', [], 'موفقیت آمیز');
        return redirect()->back();
    }

    public function set_primary(Request $request, Food $food)
    {
        $validator = Validator::make($request->all(), [
            'image_id' => 'required',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator, 'updateFoodImages')->withInput()->with(['food_id' => $food->id]);
        }

        $food_image = FoodImage::findOrFail($request->image_id);

        $food->update([
           'primary_image' => $food_image->image
        ]);

        flash()->flash("success", 'تصویر مورد نظر با موفقیت ویرایش شد!', [], 'موفقیت آمیز');
        return redirect()->back();

    }

    public function add(Request $request, Food $food)
    {
        $validator = Validator::make($request->all(), [
            'primary_image' => 'nullable|mimes:jpg,jpeg,png,svg',
            'other_images.*' => 'nullable|mimes:jpg,jpeg,png,svg',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator, 'updateFoodImages')->withInput()->with(['food_id' => $food->id]);
        }

        if ($request->primary_img == null && $request->other_imgs == null){
            return back()->withErrors(['msg' => 'تصویر یا تصاویر محصول الزامی است' ], 'updateFoodImages')->withInput()->with(['food_id' => $food->id]);
        }
        try {
            DB::beginTransaction();

            if ($request->has("primary_image")) {
                $primaryImageFileName = generateFileName($request->primary_image->getClientOriginalName());
                $request->primary_image->move(public_path(env('FOOD_IMAGE_UPLOAD_PATH')), $primaryImageFileName);

                $food->update([
                    'primary_image' => $primaryImageFileName
                ]);
            }

            if ($request->has("other_imgs")) {
                foreach ($request->other_images as $otherImage) {
                    $otherImageFileName = generateFileName($otherImage->getClientOriginalName());
                    $otherImage->move(public_path(env('FOOD_OTHER_IMAGES_UPLOAD_PATH')), $otherImageFileName);
                    FoodImage::create([
                        'image' => $otherImageFileName,
                        'product_id' => $food->id
                    ]);
                }
            }

            DB::commit();
        } catch (\Exception $ex){
            DB::rollBack();
            flash()->flash("error", $ex->getMessage(), [], 'مشکلی پیش آمد');
            return redirect()->back();
        }
        flash()->flash("success", 'تصویر یا تصاویر مورد نظر با موفقیت ویرایش شد!', [], 'موفقیت آمیز');
        return redirect()->back();
    }
}


