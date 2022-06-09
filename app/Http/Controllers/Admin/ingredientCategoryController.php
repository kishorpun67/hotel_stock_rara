<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\IngredientCategory;
use Session;

class ingredientCategoryController extends Controller
{
    public function ingredientCategories()
    {
        $ingredientCategories = IngredientCategory::get();
        Session::flash('page', 'ingredientCategory');
        return view('admin.ingredientCategories.view_ingredient_categories', compact('ingredientCategories'));
    }

    public function addEditIngredientCategory(Request $request, $id=null)
    {
        if($id=="") {
            $title = "Add Ingredient Categories";
            $button ="Submit";
            $ingredientCategory = new IngredientCategory;
            $ingredientCategoriesData = array();
            $message = "Ingredient categoriey has been added sucessfully";
        }else{
            $title = "Edit Ingredient Categories";
            $button ="Update";
            $ingredientCategoriesData = IngredientCategory::where('admin_id',auth('admin')->user()->id)->where('id',$id)->first();
            $ingredientCategoriesData= json_decode(json_encode($ingredientCategoriesData),true);
            $ingredientCategory = IngredientCategory::find($id);
            $message = "Ingredient Categories has been updated sucessfully";
        }
        if($request->isMethod('post')) {
            $data = $request->all();
            // dd($data);
            if(empty($data['category'])){
                return redirect()->back()->with('error_message', 'Category name is required !');
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
            $ingredientCategory->admin_id = auth('admin')->user()->id;
            $ingredientCategory->category = $data['category'];
            $ingredientCategory->description = $data['description'];
            $ingredientCategory->save();
            Session::flash('success_message', $message);
            return redirect('admin/ingredient-categories');
        }
        Session::flash('page', 'ingredientCategory');
        return view('admin.ingredientCategories.add_edit_ingredient_categories', compact('title','button','ingredientCategoriesData','ingredientCategory'));
    }

    public function deleteIngredientCategory($id)
    {
      $id =IngredientCategory::find($id);
      $id->delete();
      return redirect()->back()->with('success_message', 'Ingredient Category has been deleted successfully!');

    }
}
