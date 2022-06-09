<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\IngredientCategory;


class IngredientCategoryController extends Controller
{
    public function ingredientCategories()
    {
        $ingredientCategories = IngredientCategory::get();
        return response()->json($ingredientCategories, 200);
    }

    public function addIngredientCategory(Request $request)
    {
        
        if($request->isMethod('post')) {
            $data = $request->all();
            // dd($data);
            if(empty($data['category'])){
                return response()->json('Category name is required !', 200);
            }
            
            if(empty($data['description']))
            {
                $data['description'] = "";
            }
       
            $ingredientCategory = new IngredientCategory;
            $ingredientCategory->admin_id = auth()->user()->id;
            $ingredientCategory->category = $data['category'];
            $ingredientCategory->description = $data['description'];
            $ingredientCategory->save();
            return  response('sucess',200);
            // Session::flash('success_message', $message);
        }
    }
    public function editIngredientCategory(Request $request)
    {
        
        if($request->isMethod('post')) {
            $data = $request->all();
            // dd($data);
            if(empty($data['category'])){
                return response()->json('Category name is required !', 200);
            }
            
            if(empty($data['description']))
            {
                $data['description'] = "";
            }
       
            $ingredientCategory =  IngredientCategory::find($data['id']);
            $ingredientCategory->admin_id = auth()->user()->id;
            $ingredientCategory->category = $data['category'];
            $ingredientCategory->description = $data['description'];
            $ingredientCategory->save();
            return  response('sucess',200);
            // Session::flash('success_message', $message);
        }
    }

    public function deleteIngredientCategory($id)
    {
      $id =IngredientCategory::find($id);
      $id->delete();
      return redirect()->back()->with('success_message', 'Ingredient Category has been deleted successfully!');

    }
}
