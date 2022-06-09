<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\IngredientItem;
use App\IngredientUnit;
use App\IngredientCategory;
// use App\Purchase;
use Session;

class IngredientItemsController extends Controller
{
    public function ingredientItems()
    {
        $ingredientItems = IngredientItem::with('ingredientCategory','ingredientUnit')->get();
        Session::flash('page', 'ingredientItem');
        return view('admin.ingredientItems.view_ingredient_items', compact('ingredientItems'));
    }

    public function addEditIngredientItem(Request $request, $id=null)
    {
        if($id=="") {
            $title = "Add Ingredient Items";
            $button ="Submit";
            $ingredientItem = new IngredientItem;
            $ingredientItemsData = array();
            $message = "Ingredient units has been added sucessfully";
        }else{
            $title = "Edit Ingredient Items";
            $button ="Update";
            $ingredientItemsData = IngredientItem::where('admin_id',auth('admin')->user()->id)->where('id',$id)->first();
            $ingredientItemsData= json_decode(json_encode($ingredientItemsData),true);
            $ingredientItem = ingredientItem::find($id);
            $message = "Ingredient Items has been updated sucessfully";
        }
        if($request->isMethod('post')) {
           $data = $request->all();
            // dd($data);
            if(empty($data['name'])){
                return redirect()->back()->with('error_message', 'Unit name is required !');
            }
            if(empty($data['purchase_price']))
            {
                $data['purchase_price'] = "";
            }
            if(empty($data['category_id']))
            {
                return redirect()->back()->with('error_message', 'Category name is required !');
            }
            if(empty($data['alert_qty']))
            {
                $data['alert_qty'] = "";
            }
            if(empty($data['unit_id']))
            {
                return redirect()->back()->with('error_message', 'Unit is required !');
            }
            if(empty($data['code']))
            {
                $data['code'] = "";
            }
           
            $ingredientItem->admin_id = auth('admin')->user()->id;
            $ingredientItem->name = $data['name'];
            $ingredientItem->purchase_price = $data['purchase_price'];
            $ingredientItem->category_id = $data['category_id'];
            $ingredientItem->alert_qty = $data['alert_qty'];
            $ingredientItem->ingredientUnit_id = $data['unit_id'];
            $ingredientItem->code = $data['code'];
            $ingredientItem->save();
            Session::flash('success_message', $message);
            return redirect('admin/ingredient-items');
        }
        $ingredientCategory = IngredientCategory::get();
        $ingredientUnit = IngredientUnit::get();
        // $purchase = Purchase::get();
        Session::flash('page', 'ingredientItem');
        return view('admin.ingredientItems.add_edit_ingredient_items', compact('title','button','ingredientItemsData','ingredientCategory','ingredientUnit'));
    }

    public function stockReport()
    {
        $ingredientItem = IngredientItem::get();
        Session::flash('page', 'stock');
        return view('admin.stock.stock_report',compact('ingredientItem'));
    }

    public function deleteIngredientItem($id)
    {
      $id =IngredientItem::find($id);
      $id->delete();
      return redirect()->back()->with('success_message', 'Ingredient Items has been deleted successfully!');

    }
}
