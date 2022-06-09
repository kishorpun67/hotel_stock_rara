<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Liabilities;

class LiabilitiesController extends Controller
{
    public function liabilities()
    {
        $bank = Liabilities::get();
        return response()->json($bank, 200);
    }

    public function singLiabilities($id=null)
    {
        $bankCount = Liabilities::where('id', $id)->count();
        if($bankCount==0){
            return response()->json('record not match!' ,200);
        }

        $bank = Liabilities::where('id', $id)->first();
        return  response($bank,200);
    }

    public function addLiabilities(Request $request)
    {

        $data=  $request->all();

        
        if(empty($data['liabilities_name']))
        {
            $data['liabilities_name'] = "";
        }
        if(empty($data['amount']))
        {
            $data['amount'] = "";
        }
        // if(empty($data['parent_id']))
        // {
        //     $data['parent_id'] = "";
        // }
        $cashHand = new Liabilities();
        $cashHand->admin_id = auth()->user()->id;
        $cashHand->liabilities_name = $data['liabilities_name'];
        $cashHand->amount = $data['amount'];
        $cashHand->save();
        return  response('sucess',200);

    }

    public function updateLiabilities(Request $request)
    {
        $data=  $request->all();
        
        if(empty($data['liabilities_name']))
        {
            $data['liabilities_name'] = "";
        }
        if(empty($data['amount']))
        {
            $data['amount'] = "";
        }
        
        $cashHand =  Liabilities::find($data['id']);
        $cashHand->admin_id = auth()->user()->id;
        $cashHand->liabilities_name = $data['liabilities_name'];
        $cashHand->amount = $data['amount'];
        $cashHand->save();
        return  response('sucess',200);

    }

    public function deleteLiabilities()
    {
        $id = Liabilities::find(request('id'));
        if(empty($id)){
          return response()->json('Id is not found',200);
        }
        $id->delete();
        return response()->json('success',200);
  
    }
}
