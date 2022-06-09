<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Supplier;

class SupplierController extends Controller
{
    public function supplier()
    {
        $suplliers = Supplier::orderBy('id', 'DESC')->get();
        return response()->json($suplliers, 200);
    }
    public function singleSupplier($id=null)
    {
        $supplierCount = Supplier::where('id', $id)->count();
        if($supplierCount==0){
            return response()->json('record not match!' ,200);
        }

        $supplier = Supplier::where('id', $id)->first();
        return  response($supplier,200);
    }
    public function addSupplier(Request $request)
    {
        
        if($request->isMethod('post')) {
            $data = $request->all();
            // dd($data);
            if(empty($data['name'])){
                return response()->json('supplier name is required !',200);
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
       
            $supplier = new Supplier;
            $supplier->admin_id = auth()->user()->id;
            $supplier->name = $data['name'];
            $supplier->address = $data['address'];
            $supplier->contact_person = $data['contact_person'];
            $supplier->phone = $data['phone'];
            $supplier->email = $data['email'];
            $supplier->description = $data['description'];
            $supplier->save();
            return  response('sucess',200);
            // Session::flash('success_message', $message);
        }
    }
    public function editSupplier(Request $request)
    {
        
        if($request->isMethod('post')) {
            $data = $request->all();
            // dd($data);
            // return response()->json($data,200);

            if(empty($data['name'])){
                return response()->json('supplier name is required !',200);
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
            $supplier =  Supplier::find($data['id']);
            $supplier->name = $data['name'];
            $supplier->address = $data['address'];
            $supplier->contact_person = $data['contact_person'];
            $supplier->phone = $data['phone'];
            $supplier->email = $data['email'];
            $supplier->description = $data['description'];
            $supplier->save();
            return  response('sucess',200);
            // Session::flash('success_message', $message);
        }
    }

    public function deleteSupplier()
    {
      $id =Supplier::find(request('id'));
      if(empty($id)){
        return response()->json('Id is not found',200);
      }
      $id->delete();
      return response()->json('success',200);


    }
}
