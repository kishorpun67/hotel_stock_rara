<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CashHand;
class CashHandController extends Controller
{
    public function cashHand()
    {
        $bank = CashHand::get();
        return response()->json($bank, 200);
    }

    public function singCashHand($id=null)
    {
        $bankCount = CashHand::where('id', $id)->count();
        if($bankCount==0){
            return response()->json('record not match!' ,200);
        }

        $bank = CashHand::where('id', $id)->first();
        return  response($bank,200);
    }

    public function addCashHand(Request $request)
    {

        $data=  $request->all();

        
        if(empty($data['opening_balance']))
        {
            $data['opening_balance'] = "";
        }
        if(empty($data['closing_balance']))
        {
            $data['closing_balance'] = "";
        }
        // if(empty($data['parent_id']))
        // {
        //     $data['parent_id'] = "";
        // }
        $cashHand = new CashHand();
        $cashHand->admin_id = auth()->user()->id;
        $cashHand->opening_balance = $data['opening_balance'];
        $cashHand->closing_balance = $data['closing_balance'];
        $cashHand->save();
        return  response('sucess',200);

    }

    public function updateCashHand(Request $request)
    {
        $data=  $request->all();
        
        if(empty($data['opening_balance']))
        {
            $data['opening_balance'] = "";
        }
        if(empty($data['closing_balance']))
        {
            $data['closing_balance'] = "";
        }
        
        $cashHand =  CashHand::find($data['id']);
        $cashHand->admin_id = auth()->user()->id;
        $cashHand->opening_balance = $data['opening_balance'];
        $cashHand->closing_balance = $data['closing_balance'];
        $cashHand->save();
        return  response('sucess',200);

    }

    public function deleteCashHand()
    {
        $id =CashHand::find(request('id'));
        if(empty($id)){
          return response()->json('Id is not found',200);
        }
        $id->delete();
        return response()->json('success',200);
  
    }
}
