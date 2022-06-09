<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Purchase;
use App\Supplier;
use App\IngredientUnit;
use App\IngredientItem;
use App\IngredientCart;
use App\IngredientCategory;
use Session;
use App\PurchaseItem;
use DB;
class PurchaseController extends Controller
{
    public function purchase()
    {
        $purchase = Purchase::with('purchase_item','supplierName')->get();
        Session::flash('page', 'purchase');
        return view('admin.purchase.view_purchase', compact('purchase'));
    }

    public function addEditPurchase(Request $request, $id=null)
    {
        if($id=="") {
            $title = "Add Purchase";
            $button ="Submit";
            $purchase = new Purchase;
            $purchasedata = array();
            $message = "Purchase has been added sucessfully";
        }else{
            $title = "Edit Purchase";
            $button ="Update";
            $purchasedata = Purchase::with('purchase_item')->where('id',$id)->first();
            
            $purchasedata= json_decode(json_encode($purchasedata),true);
            // return $purchasedata['purchase_item'];
            $purchase = Purchase::find($id);
            $message = "purchase has been updated sucessfully";
        }
        if($request->isMethod('post')) {
           $data = $request->all();
        //dd($data);
            if(empty($data['supplier_id'])){
                return redirect()->back()->with('error_message', 'Supplier id is required !');
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
           
            $purchase->admin_id = auth('admin')->user()->id;
            $purchase->supplier_id = $data['supplier_id'];
            $purchase->date = $data['date'];
            $purchase->code = $data['code'];
            $purchase->total = $data['total'];
            $purchase->paid = $data['paid'];
            $purchase->due = $data['due'];

            $purchase->save();
            if(empty($id)){
                $id = DB::getPdo()->lastInsertId();
                foreach($data['id'] as $key=> $val)
                {
                    $newPurchaseItem = new PurchaseItem;
                    $newPurchaseItem->ingredient_id = $data['ingredient_id'][$key];
                    $newPurchaseItem->purchase_id = $id;
                    $newPurchaseItem->ingredient= $data['ingredient'][$key];
                    $newPurchaseItem->quantity = $data['quantity'][$key];
                    $newPurchaseItem->price = $data['price'][$key];
                    $newPurchaseItem->ingredientUnit_id =  $data['ingredientUnit_id'][$key];
                    $newPurchaseItem->total = $data['price'][$key] *$data['quantity'][$key];
                    $newPurchaseItem->save();
                    IngredientItem::where('id',$data['ingredient_id'][$key])->increment('quantity',$data['quantity'][$key]);
                    IngredientCart::where('id', $val)->delete();
                }
                
            }else{
                foreach($data['id'] as $key=> $val)
                {
                    $newPurchaseItem =  PurchaseItem::find($val);
                    $newPurchaseItem->quantity = $data['quantity'][$key];
                    $newPurchaseItem->total = $data['price'][$key] *$data['quantity'][$key];
                    $newPurchaseItem->save();
                }

            }
            Session::flash('success_message', $message);
            return redirect('admin/purchase');
        }
        $supplier = Supplier::get();
        $ingredientCategory = IngredientCategory::get();
        $ingredientItem = IngredientItem::get();
        $ingredientUnit = IngredientUnit::get();
        $ingredientcart = IngredientCart::get();
        Session::flash('page', 'purchase');
        return view('admin.purchase.add_edit_purchase', compact('title','button','purchasedata','ingredientCategory','ingredientItem','ingredientUnit','supplier','ingredientcart'));
    }

    public function ajaxPurchaseTable(Request $request)
    {
        $data = $request->all();
        $ingredientCount = IngredientCart::where('ingredient_id', $data['purchase_id'])->count();
        if ($ingredientCount ==0) {
            $ingredientItem = IngredientItem::where('id', $data['purchase_id'])->first();
            $ingredientcart = new IngredientCart;
            // $ingredientcart->item_id = $data['item_id'];
            $ingredientcart->admin_id = auth('admin')->user()->id;
            $ingredientcart->ingredient_id =  $ingredientItem->id;
            $ingredientcart->ingredientUnit_id =  $ingredientItem->ingredientUnit_id;
            $ingredientcart->name =  $ingredientItem->name;
            $ingredientcart->price =$ingredientItem->purchase_price;
            $ingredientcart->quantity =$ingredientItem->alert_qty;
            $ingredientcart->save();
            $ingredientcart  = IngredientCart::get();
            return view('admin.purchase.ajax_purchase_table',compact('ingredientcart'));
        } else {
            return response()->json(['message'=>"exsist"],200);
            
        }
        
        
    }

    public function deletePurchaseCart(Request $request)
    {
        
      $data = $request->all();
      IngredientCart::where('id', $data['ingredient_id'])->delete();
      $ingredientcart  = IngredientCart::get();
      return view('admin.purchase.ajax_purchase_table',compact('ingredientcart'));
    }

    //ajax check current amount
    public function chkCurrentAmount(Request $request){
        $data= $request->all();
        IngredientCart::where('id', $data['ingredientCart_id'])->update(['quantity'=>$data['quantity']]);
        $ingredientcart  = IngredientCart::get();
        return view('admin.purchase.ajax_purchase_table',compact('ingredientcart'));
    }


    public function purchaseReport()
    {
        $purchase = Purchase::get();
        return view('admin.purchase.purchase_report',compact('purchase'));
    }


    public function deletePurchase($id)
    {
      $id =Purchase::find($id);
      $id->delete();
      return redirect()->back()->with('success_message', 'Purchase has been deleted successfully!');

    }
}
