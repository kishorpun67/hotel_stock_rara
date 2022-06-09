<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Bank;
class BankController extends Controller
{
    public function bank()
    {
        $bank = Bank::get();
        return response()->json($bank, 200);
    }

    public function singBank($id=null)
    {
        $bankCount = Bank::where('id', $id)->count();
        if($bankCount==0){
            return response()->json('record not match!' ,200);
        }

        $bank = Bank::where('id', $id)->first();
        return  response($bank,200);
    }

    public function addBank(Request $request)
    {

        $data=  $request->all();

        if(empty($data['bank_name'])){
            $data['bank_name'] = "";
        }

        if(empty($data['cheque_number']))
        {
            $data['cheque_number'] = "";
        }
        if(empty($data['purpose']))
        {
            $data['purpose'] = "";
        }
        if(empty($data['amount']))
        {
            $data['amount'] = "";
        }
        // if(empty($data['parent_id']))
        // {
        //     $data['parent_id'] = "";
        // }
        $bank = new Bank();
        $bank->admin_id = auth()->user()->id;
        $bank->bank_name = $data['bank_name'];
        $bank->cheque_number = $data['cheque_number'];
        $bank->purpose = $data['purpose'];
        $bank->amount = $data['amount'];
        $bank->save();
        return  response('sucess',200);

    }

    public function updateBank(Request $request)
    {
        $data=  $request->all();
        
        if(empty($data['bank_name'])){
            $data['bank_name'] = "";
        }

        if(empty($data['cheque_number']))
        {
            $data['cheque_number'] = "";
        }
        if(empty($data['purpose']))
        {
            $data['purpose'] = "";
        }
        if(empty($data['amount']))
        {
            $data['amount'] = "";
        }
        // if(empty($data['parent_id']))
        // {
        //     $data['parent_id'] = "";
        // }
        $bank =  Bank::find($data['id']);
        $bank->admin_id = auth()->user()->id;
        $bank->bank_name = $data['bank_name'];
        $bank->cheque_number = $data['cheque_number'];
        $bank->purpose = $data['purpose'];
        $bank->amount = $data['amount'];
        $bank->save();
        return  response('sucess',200);

    }

    public function deleteBank()
    {
        $id =Bank::find(request('id'));
        if(empty($id)){
          return response()->json('Id is not found',200);
        }
        $id->delete();
        return response()->json('success',200);
  
    }
}
