<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\FoodCategory;
use Session;

class FoodCategoryController extends Controller
{
    public function foodCategories()
    {
        $foodCategories = FoodCategory::get();
        Session::flash('page', 'foodCategory');
        return view('admin.foodCategories.view_food_categories', compact('foodCategories'));
    }

    public function addEditFoodCategory(Request $request, $id=null)
    {
        if($id=="") {
            $title = "Add Food Categories";
            $button ="Submit";
            $foodCategory = new FoodCategory;
            $foodCategoriesData = array();
            $message = "food category has been added sucessfully";
        }else{
            $title = "Edit Food Categories";
            $button ="Update";
            $foodCategoriesData = FoodCategory::where('admin_id',auth('admin')->user()->id)->where('id',$id)->first();
            $foodCategoriesData= json_decode(json_encode($foodCategoriesData),true);
            $foodCategory = FoodCategory::find($id);
            $message = "Food Categories has been updated sucessfully";
        }
        if($request->isMethod('post')) {
            $data = $request->all();
            //dd($data);
            if(empty($data['category_name'])){
                return redirect()->back()->with('error_message', 'category name is required !');
            }
            
            if(empty($data['description']))
            {
                $data['description'] = "";
            }
            // if(empty($data['user_id']))
            // {
            //     $data['user_id'] = "";
            // }
            // if(empty($data['parent_id']))
            // {
            //     $data['parent_id'] = "";
            // }
            $foodCategory->admin_id = auth('admin')->user()->id;
            $foodCategory->category_name = $data['category_name'];
            $foodCategory->description = $data['description'];
            $foodCategory->save();
            Session::flash('success_message', $message);
            return redirect('admin/food-categories');
        }
        Session::flash('page', 'foodCategory');
        return view('admin.foodCategories.add_edit_food_categories', compact('title','button','foodCategoriesData'));
    }
    public function deleteFoodCategory($id)
    {
      $id =FoodCategory::find($id);
      $id->delete();
      return redirect()->back()->with('success_message', 'Delete Category has been deleted successfully!');

    }
}
