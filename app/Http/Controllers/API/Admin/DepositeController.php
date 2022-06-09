<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BankDeposit;

class DepositeController extends Controller
{
    public function bankDeposite()
    {
        $bankDeposite = BankDeposit::get();
        return response()->json($bankDeposite, 200);
    }

    public function singBankDeposite($id=null)
    {
        $bankDepositeCount = BankDeposit::where('id', $id)->count();
        if($bankDepositeCount==0){
            return response()->json('record not match!' ,200);
        }

        $bankDeposite = BankDeposit::where('id', $id)->first();
        return  response($bankDeposite,200);
    }

    public function addBankDeposite(Request $request)
    {

        $data=  $request->all();

        if(empty($data['bank_name']))
        {
            $data['bank_name'] = "";
        }
        
        if(empty($data['cash_or_cheque']))
        {
            $data['cash_or_cheque'] = "";
        }
        if(empty($data['deposite']))
        {
            $data['deposite'] = "";
        }
        if(empty($data['cheque_number']))
        {
            $data['cheque_number'] = "";
        }
        if(empty($data['client']))
        {
            $data['client'] = "";
        }
        if(empty($data['amount']))
        {
            $data['amount'] = "";
        }
        // if(empty($data['parent_id']))
        // {
        //     $data['parent_id'] = "";
        // }
        $bankDeposit = new BankDeposit();
        $bankDeposit->admin_id = auth()->user()->id;
        $bankDeposit->date = $data['date'];
        $bankDeposit->bank_name = $data['bank_name'];
        $bankDeposit->cash_or_cheque = $data['cash_or_cheque'];
        $bankDeposit->deposite = $data['deposite'];
        $bankDeposit->cheque_number = $data['cheque_number'];
        $bankDeposit->client = $data['client'];
        $bankDeposit->amount = $data['amount'];
        $bankDeposit->save();
        return  response('sucess',200);

    }

    public function updateBankDeposite(Request $request)
    {
        $data=  $request->all();
        if(empty($data['bank_name']))
        {
            $data['bank_name'] = "";
        }
        
        if(empty($data['cash_or_cheque']))
        {
            $data['cash_or_cheque'] = "";
        }
        if(empty($data['deposite']))
        {
            $data['deposite'] = "";
        }
        if(empty($data['cheque_number']))
        {
            $data['cheque_number'] = "";
        }
        if(empty($data['client']))
        {
            $data['client'] = "";
        }
        if(empty($data['amount']))
        {
            $data['amount'] = "";
        }
        // if(empty($data['parent_id']))
        // {
        //     $data['parent_id'] = "";
        // }
        $bankDeposit =  BankDeposit::find($data['id']);
        $bankDeposit->admin_id = auth()->user()->id;
        $bankDeposit->date = $data['date'];
        $bankDeposit->bank_name = $data['bank_name'];
        $bankDeposit->cash_or_cheque = $data['cash_or_cheque'];
        $bankDeposit->deposite = $data['deposite'];
        $bankDeposit->cheque_number = $data['cheque_number'];
        $bankDeposit->client = $data['client'];
        $bankDeposit->amount = $data['amount'];
        $bankDeposit->save();
        return  response('sucess',200);

    }

    public function deleteBankDeposite()
    {
        $id =BankDeposit::find(request('id'));
        if(empty($id)){
          return response()->json('Id is not found',200);
        }
        $id->delete();
        return response()->json('success',200);
  
    }
}
