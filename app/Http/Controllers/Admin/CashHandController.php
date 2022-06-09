<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CashHand;
use Session;

class CashHandController extends Controller
{
    public function cashHand()
    {
        $cashHand = CashHand::get();
        Session::flash('page', 'cashHand');
        return view('admin.cashHand.view_cashHand', compact('cashHand'));
    }

    public function addEditCashHand(Request $request, $id=null)
    {
        if($id=="") {
            $title = "Add CashHand";
            $button ="Submit";
            $cashHand = new CashHand;
            $cashHanddata = array();
            $message = "CashHand has been added sucessfully";
        }else{
            $title = "Edit CashHand";
            $button ="Update";
            $cashHanddata = CashHand::where('admin_id',auth('admin')->user()->id)->where('id',$id)->first();
            $cashHanddata= json_decode(json_encode($cashHanddata),true);
            $cashHand = CashHand::find($id);
            $message = "CashHand has been updated sucessfully";
        }
        if($request->isMethod('post')) {
            $data = $request->all();
        //dd($data);
           
            if(empty($data['opening_balance']))
            {
                $data['opening_balance'] = "";
            }
            if(empty($data['closing_balance']))
            {
                $data['closing_balance'] = "";
            }

         
            // if(empty($data['user_id']))
            // {
            //     $data['user_id'] = "";
            // }
            // if(empty($data['parent_id']))
            // {
            //     $data['parent_id'] = "";
            // }
            $cashHand->admin_id = auth('admin')->user()->id;
            $cashHand->opening_balance = $data['opening_balance'];
            $cashHand->closing_balance = $data['closing_balance'];
            $cashHand->save();
            Session::flash('success_message', $message);
            return redirect('admin/cashHand');
        }
        Session::flash('page', 'cashHand');
        return view('admin.cashHand.add_edit_cashHand', compact('title','button','cashHanddata'));
    }

    public function deleteCashHand($id)
    {
      $id =CashHand::find($id);
      $id->delete();
      return redirect()->back()->with('success_message', 'CashHand has been deleted successfully!');
    }
}
