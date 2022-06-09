<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\IngredientUnit;
use Session;

class ingredientUnitsController extends Controller
{
    public function ingredientUnits()
    {
        $ingredientUnits = IngredientUnit::get();
        Session::flash('page', 'ingredientUnit');
        return view('admin.ingredientUnits.view_ingredient_units', compact('ingredientUnits'));
    }

    public function addEditIngredientUnit(Request $request, $id=null)
    {
        if($id=="") {
            $title = "Add Ingredient Units";
            $button ="Submit";
            $ingredientUnit = new IngredientUnit;
            $ingredientUnitsData = array();
            $message = "Ingredient units has been added sucessfully";
        }else{
            $title = "Edit Ingredient Categories";
            $button ="Update";
            $ingredientUnitsData = IngredientUnit::where('admin_id',auth('admin')->user()->id)->where('id',$id)->first();
            $ingredientUnitsData= json_decode(json_encode($ingredientUnitsData),true);
            $ingredientUnit = ingredientUnit::find($id);
            $message = "Ingredient Units has been updated sucessfully";
        }
        if($request->isMethod('post')) {
            $data = $request->all();
            // dd($data);
            if(empty($data['unit_name'])){
                return redirect()->back()->with('error_message', 'Unit name is required !');
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
            $ingredientUnit->admin_id = auth('admin')->user()->id;
            $ingredientUnit->unit_name = $data['unit_name'];
            $ingredientUnit->description = $data['description'];
            $ingredientUnit->save();
            Session::flash('success_message', $message);
            return redirect('admin/ingredient-units');
        }
        Session::flash('page', 'ingredientUnit');
        return view('admin.ingredientUnits.add_edit_ingredient_units', compact('title','button','ingredientUnitsData','ingredientUnit'));
    }

    public function deleteIngredientUnit($id)
    {
      $id =IngredientUnit::find($id);
      $id->delete();
      return redirect()->back()->with('success_message', 'Ingredient Units has been deleted successfully!');

    }
}
