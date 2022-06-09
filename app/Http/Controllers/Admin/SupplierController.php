<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Supplier;
use App\Purchase;
use Session;

class SupplierController extends Controller
{
    public function Supplier()
    {
        $supplier = Supplier::get();
        Session::flash('page', 'supplier');
        return view('admin.supplier.view_supplier', compact('supplier'));
    }
    public function addEditSupplier(Request $request, $id=null)
    {
        if($id=="") {
            $title = "Add Supplier";
            $button ="Submit";
            $supplier = new Supplier;
            $supplierdata = array();
            $message = "supplier has been added sucessfully";
        }else{
            $title = "Edit supplier";
            $button ="Update";
            $supplierdata = supplier::where('admin_id',auth('admin')->user()->id)->where('id',$id)->first();
            $supplierdata= json_decode(json_encode($supplierdata),true);
            $supplier = Supplier::find($id);
            $message = "supplier has been updated sucessfully";
        }
        if($request->isMethod('post')) {
           $data = $request->all();
        //dd($data);
            if(empty($data['name'])){
                return redirect()->back()->with('error_message', 'supplier name is required !');
            }
            
            if(empty($data['address']))
            {
                $data['address'] = "";
            }

            if(empty($data['contact_person']))
            {
                $data['contact_person'] = "";
            }
            if(empty($data['phone']))
            {
                $data['phone'] = "";
            }
            if(empty($data['email']))
            {
                $data['email'] = "";
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
            $supplier->admin_id = auth('admin')->user()->id;
            $supplier->name = $data['name'];
            $supplier->address = $data['address'];
            $supplier->contact_person = $data['contact_person'];
            $supplier->phone = $data['phone'];
            $supplier->email = $data['email'];
            $supplier->description = $data['description'];
            $supplier->save();
            Session::flash('success_message', $message);
            return redirect()->back();
        }
        Session::flash('page', 'supplier');
        return view('admin.supplier.add_edit_supplier', compact('title','button','supplierdata'));
    }

    public function viewSupplierDeuPayment()
    {
        $supplier = Purchase::get();
        $supplier = Purchase::with('supplierName')->where('due', '!=', "")->get();
        return view('admin.supplierDeuPayments.view_supplierDeuPayments',compact('supplier'));
    }


    public function deleteSupplier($id)
    {
      $id =Supplier::find($id);
      $id->delete();
      return redirect()->back()->with('success_message', 'supplier has been deleted successfully!');
    }
}

