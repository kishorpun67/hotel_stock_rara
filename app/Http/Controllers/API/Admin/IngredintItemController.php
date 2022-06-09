<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\IngredientItem;
class IngredintItemController extends Controller
{
    public function ingredientItem()
    {
        $ingredientItem = IngredientItem::get();
        return response()->json($ingredientItem, 200);
    }

    public function addIngredientItem(Request $request)
    {
        
        if($request->isMethod('post')) {
            $data = $request->all();
            // dd($data);
            if(empty($data['name'])){
                return response('Item name is required');
            }
            if(empty($data['price']))
            {
                $data['price'] = "";
            }
            if(empty($data['purchase_price']))
            {
                $data['purchase_price'] = "";
            }
            if(empty($data['category_id']))
            {
                return response('Ingredient Category is required');
            }
            if(empty($data['alert_qty']))
            {
                $data['alert_qty'] = "";
            }
            if(empty($data['ingredient_id']))
            {
                return response('Ingredient Unit is required');
            }
            if(empty($data['code']))
            {
                $data['code'] = "";
            }
            $ingredientItem = new IngredientItem;
            $ingredientItem->name = $data['name'];
            $ingredientItem->purchase_price = $data['purchase_price'];
            $ingredientItem->category_id = $data['category_id'];
            $ingredientItem->alert_qty = $data['alert_qty'];
            $ingredientItem->ingredient_id = $data['ingredient_id'];
            $ingredientItem->code = $data['code'];
            $ingredientItem->save();
            return  response('sucess',200);
            // Session::flash('success_message', $message);
        }
    }
    public function editIngredientItem(Request $request)
    {
        
        if($request->isMethod('post')) {
            $data = $request->all();
            // dd($data);
            if(empty($data['name'])){
                return response('Item name is required');
            }
            if(empty($data['price']))
            {
                $data['price'] = "";
            }
            if(empty($data['purchase_price']))
            {
                $data['purchase_price'] = "";
            }
            if(empty($data['category_id']))
            {
                return response('Ingredient Category is required');
            }
            if(empty($data['alert_qty']))
            {
                $data['alert_qty'] = "";
            }
            if(empty($data['ingredient_id']))
            {
                return response('Ingredient Unit is required');
            }
            if(empty($data['code']))
            {
                $data['code'] = "";
            }
            $ingredientItem = IngredientItem::find($data['id']);
            $ingredientItem->name = $data['name'];
            $ingredientItem->purchase_price = $data['purchase_price'];
            $ingredientItem->category_id = $data['category_id'];
            $ingredientItem->alert_qty = $data['alert_qty'];
            $ingredientItem->ingredient_id = $data['ingredient_id'];
            $ingredientItem->code = $data['code'];
            $ingredientItem->save();

            return  response('sucess',200);
            // Session::flash('success_message', $message);
        }
    }

    public function deleteIngredientItem($id)
    {
      $id =IngredientItem::find($id);
      $id->delete();
      return redirect()->back()->with('success_message', 'Ingredient Item has been deleted successfully!');
    }
}
