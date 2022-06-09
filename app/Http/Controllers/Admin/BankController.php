<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Bank;
use Session;

class BankController extends Controller
{
    public function bank()
    {
        $bank = Bank::get();
        Session::flash('page', 'bank');
        return view('admin.bank.view_bank', compact('bank'));
    }

    public function addEditBank(Request $request, $id=null)
    {
        if($id=="") {
            $title = "Add Bank";
            $button ="Submit";
            $bank = new Bank;
            $bankdata = array();
            $message = "Bank into Deposit has been added sucessfully";
        }else{
            $title = "Edit Bank";
            $button ="Update";
            $bankdata = Bank::where('admin_id',auth('admin')->user()->id)->where('id',$id)->first();
            $bankdata= json_decode(json_encode($bankdata),true);
            $bank = Bank::find($id);
            $message = "Bank has been updated sucessfully";
        }
        if($request->isMethod('post')) {
           return $data = $request->all();
        //dd($data);
            if(empty($data['bank_name'])){
                return redirect()->back()->with('error_message', 'Bank Name is required !');
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
            $bank->admin_id = auth('admin')->user()->id;
            $bank->bank_name = $data['bank_name'];
            $bank->cheque_number = $data['cheque_number'];
            $bank->purpose = $data['purpose'];
            $bank->amount = $data['amount'];
            $bank->save();
            Session::flash('success_message', $message);
            return redirect('admin/bank');
        }
        Session::flash('page', 'bank');
        return view('admin.bank.add_edit_bank', compact('title','button','bankdata'));
    }

    public function deleteBank($id)
    {
      $id =Bank::find($id);
      $id->delete();
      return redirect()->back()->with('success_message', 'Bank has been deleted successfully!');
    }
}

