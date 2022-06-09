<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Purchase;
use DB;
use App\PurchaseItem;
use App\IngredientItem;


class PurchaseController extends Controller
{
    public function purchase()
    {
        $suplliers = Purchase::orderBy('id', 'DESC')->with('purchase_item','supplierName')->get();
        return response()->json($suplliers, 200);
    }
    public function singlePurchase($id=null)
    {
        $supplierCount = Purchase::where('id', $id)->count();
        if($supplierCount==0){
            return response()->json('record not match!' ,200);
        }

        $supplier = Purchase::where('id', $id)->with('purchase_item','supplierName')->first();
        return  response($supplier,200);
    }

    public function addPurchase()
    {
        $data = request()->all();
        if(empty($data['supplier_id'])){
            return response()->json('Supplier id is required !' ,200);
        }
        if(empty($data['date']))
        {
            $data['date'] = "";
        }

        if(empty($data['total']))
        {
            $data['total'] = "";
        }
        if(empty($data['paid']))
        {
            $data['paid'] = "";
        }
        if(empty($data['due']))
        {
            $data['due'] = "";
        }
        if(empty($data['code']))
        {
            $data['code'] = "";
        }
        $purchase = new Purchase();
        $purchase->admin_id = auth()->user()->id;
        $purchase->supplier_id = $data['supplier_id'];
        $purchase->date = $data['date'];
        $purchase->code = $data['code'];
        $purchase->total = $data['total'];
        $purchase->paid = $data['paid'];
        $purchase->due = $data['due'];
        $purchase->save();
        $id = DB::getPdo()->lastInsertId();
        foreach($data['ingredient_id'] as $key=> $val)
        {
            $newPurchaseItem = new PurchaseItem;
            $newPurchaseItem->ingredient_id = $val;
            $newPurchaseItem->purchase_id = $id;
            $newPurchaseItem->ingredient= $data['ingredient'][$key];
            $newPurchaseItem->quantity = $data['quantity'][$key];
            $newPurchaseItem->price = $data['price'][$key];
            $newPurchaseItem->ingredientUnit_id =  $data['ingredientUnit_id'][$key];
            $newPurchaseItem->total = $data['price'][$key] *$data['quantity'][$key];
            $newPurchaseItem->save();
            IngredientItem::where('id',$data['ingredient_id'][$key])->increment('quantity',$data['quantity'][$key]);
        }
        return  response('sucess',200);

    }

    public function editPurchase()
    {
        $data = request()->all();
        if(empty($data['supplier_id'])){
            return response()->json('Supplier id is required !' ,200);
        }
        if(empty($data['date']))
        {
            $data['date'] = "";
        }

        if(empty($data['total']))
        {
            $data['total'] = "";
        }
        if(empty($data['paid']))
        {
            $data['paid'] = "";
        }
        if(empty($data['due']))
        {
            $data['due'] = "";
        }
        if(empty($data['code']))
        {
            $data['code'] = "";
        }
        $purchase =  Purchase::find($data['id']);
        $purchase->admin_id = auth()->user()->id;
        $purchase->supplier_id = $data['supplier_id'];
        $purchase->date = $data['date'];
        $purchase->code = $data['code'];
        $purchase->total = $data['total'];
        $purchase->paid = $data['paid'];
        $purchase->due = $data['due'];
        $purchase->save();
        $id = DB::getPdo()->lastInsertId();
        foreach($data['purchase_item_id'] as $key=> $val)
        {
            $newPurchaseItem =  PurchaseItem::find($val);
            $newPurchaseItem->quantity = $data['quantity'][$key];
            $newPurchaseItem->total = $data['price'][$key] *$data['quantity'][$key];
            $newPurchaseItem->save();
        }
        return  response('sucess',200);

    }
    public function deletePurchase()
    {
        $id =Purchase::find(request('id'));
        if(empty($id)){
          return response()->json('Id is not found',200);
        }
        $id->delete();
        return response()->json('success',200);
  
  
    }
}
