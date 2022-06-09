<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\IngredientUnit;

class IngredintUnitController extends Controller
{
    public function ingredientUnit()
    {
        $ingredientUnit = IngredientUnit::get();
        return response()->json($ingredientUnit, 200);
    }

    public function addIngredientUnit(Request $request)
    {
        
        if($request->isMethod('post')) {
            $data = $request->all();
            // dd($data);
            if(empty($data['unit_name'])){
                return response()->json('Unit name is required !', 200);
            }
            
            if(empty($data['description']))
            {
                $data['description'] = "";
            }
       
            $ingredientUnit = new IngredientUnit;
            $ingredientUnit->admin_id = auth()->user()->id;
            $ingredientUnit->unit_name = $data['unit_name'];
            $ingredientUnit->description = $data['description'];
            $ingredientUnit->save();
            return  response('sucess',200);
            // Session::flash('success_message', $message);
        }
    }
    public function editIngredientUnit(Request $request)
    {
        
        if($request->isMethod('post')) {
            $data = $request->all();
            // dd($data);
            if(empty($data['unit_name'])){
                return response()->json('Unit name is required !', 200);
            }
            
            if(empty($data['description']))
            {
                $data['description'] = "";
            }
       
            $ingredientUnit =  IngredientUnit::find($data['id']);
            $ingredientUnit->admin_id = auth()->user()->id;
            $ingredientUnit->unit_name = $data['unit_name'];
            $ingredientUnit->description = $data['description'];
            $ingredientUnit->save();
            return  response('sucess',200);
            // Session::flash('success_message', $message);
        }
    }

    public function deleteIngredientUnit($id)
    {
      $id =IngredientUnit::find($id);
      $id->delete();
      return redirect()->back()->with('success_message', 'Ingredient Unit has been deleted successfully!');

    }
}
