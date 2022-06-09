<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\FoodCategory;

class FoodCategoryController extends Controller
{
    public function foodCategory()
    {
        $ingredientCategories = FoodCategory::get();
        return response()->json($ingredientCategories, 200);
    }

    public function addFoodCategory(Request $request)
    {
        
        if($request->isMethod('post')) {
            $data = $request->all();
            // dd($data);
            if(empty($data['category_name'])){
                return response()->json('Category name is required !', 200);
            }
            
            if(empty($data['description']))
            {
                $data['description'] = "";
            }
       
            $FoodCategory = new FoodCategory;
            $FoodCategory->admin_id = auth()->user()->id;
            $FoodCategory->category_name = $data['category_name'];
            $FoodCategory->description = $data['description'];
            $FoodCategory->save();
            return  response('sucess',200);
            // Session::flash('success_message', $message);
        }
    }
    public function editFoodCategory(Request $request)
    {
        
        if($request->isMethod('post')) {
            $data = $request->all();
            // dd($data);
            if(empty($data['category_name'])){
                return response()->json('Category name is required !', 200);
            }
            
            if(empty($data['description']))
            {
                $data['description'] = "";
            }
       
            $foodCategory =  FoodCategory::find($data['id']);
            $foodCategory->admin_id = auth()->user()->id;
            $foodCategory->category_name = $data['category_name'];
            $foodCategory->description = $data['description'];
            $foodCategory->save();
            return  response('sucess',200);
            // Session::flash('success_message', $message);
        }
    }

    public function deleteFoodCategory()
    {
      $id =FoodCategory::find(request('id'));
      if(empty($id)){
        return response()->json('Id is not found',200);

      }
      $id->delete();
      return response()->json('success',200);

    }
}
