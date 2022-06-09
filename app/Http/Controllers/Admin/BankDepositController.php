<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BankDeposit;
use Session;

class BankDepositController extends Controller
{
    public function bankDeposit()
    {
       $bankDeposit = BankDeposit::get();
        Session::flash('page', 'bankDeposit');
        return view('admin.bankDeposit.view_bankDeposit', compact('bankDeposit'));
    }

    public function addEditBankDeposit(Request $request, $id=null)
    {
        if($id=="") {
            $title = "Add Bank Into Deposit";
            $button ="Submit";
            $bankDeposit = new BankDeposit;
            $bankDepositdata = array();
            $message = "Bank into Deposit has been added sucessfully";
        }else{
            $title = "Edit bankDeposit";
            $button ="Update";
            $bankDepositdata = BankDeposit::where('admin_id',auth('admin')->user()->id)->where('id',$id)->first();
            $bankDepositdata= json_decode(json_encode($bankDepositdata),true);
            $bankDeposit = BankDeposit::find($id);
            $message = "Bank into Deposit has been updated sucessfully";
        }
        if($request->isMethod('post')) {
            $data = $request->all();
        //dd($data);
            if(empty($data['date'])){
                return redirect()->back()->with('error_message', 'date is required !');
            }

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
            $bankDeposit->admin_id = auth('admin')->user()->id;
            $bankDeposit->date = $data['date'];
            $bankDeposit->bank_name = $data['bank_name'];
            $bankDeposit->cash_or_cheque = $data['cash_or_cheque'];
            $bankDeposit->deposite = $data['deposite'];
            $bankDeposit->cheque_number = $data['cheque_number'];
            $bankDeposit->client = $data['client'];
            $bankDeposit->amount = $data['amount'];
            $bankDeposit->save();
            Session::flash('success_message', $message);
            return redirect('admin/bankDeposit');
        }
        Session::flash('page', 'bankDeposit');
        return view('admin.bankDeposit.add_edit_bankDeposit', compact('title','button','bankDepositdata'));
    }

    public function deleteBankDeposit($id)
    {
      $id =BankDeposit::find($id);
      $id->delete();
      return redirect()->back()->with('success_message', 'Bank into Deposit has been deleted successfully!');
    }
}
