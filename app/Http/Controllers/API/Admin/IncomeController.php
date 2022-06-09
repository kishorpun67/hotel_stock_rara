<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Income;

class IncomeController extends Controller
{
    public function income()
    {
        $bank = Income::get();
        return response()->json($bank, 200);
    }

    public function singIncome($id=null)
    {
        $bankCount = Income::where('id', $id)->count();
        if($bankCount==0){
            return response()->json('record not match!' ,200);
        }

        $bank = Income::where('id', $id)->first();
        return  response($bank,200);
    }

    public function addIncome(Request $request)
    {

        $data=  $request->all();

        
        if(empty($data['income_heading'])){
            return response()->json('Income Heading is required !');
        }

        if(empty($data['source']))
        {
            $data['source'] = "";
        }

        if(empty($data['amount']))
        {
            $data['amount'] = "";
        }
        // if(empty($data['parent_id']))
        // {
        //     $data['parent_id'] = "";
        // }
        $income = new Income();
        $income->admin_id = auth()->user()->id;
        $income->income_heading = $data['income_heading'];
        $income->source = $data['source'];
        $income->amount = $data['amount'];
        $income->save();
        return  response('sucess',200);

    }

    public function updateIncome(Request $request)
    {
        $data=  $request->all();
        
        if(empty($data['income_heading'])){
            return response()->json('Income Heading is required !');
        }

        if(empty($data['source']))
        {
            $data['source'] = "";
        }

        if(empty($data['amount']))
        {
            $data['amount'] = "";
        }
        
        $income =  Income::find($data['id']);
        $income->admin_id = auth()->user()->id;
        $income->income_heading = $data['income_heading'];
        $income->source = $data['source'];
        $income->amount = $data['amount'];
        $income->save();
        return  response('sucess',200);

    }

    public function deleteIncome()
    {
        $id = Income::find(request('id'));
        if(empty($id)){
          return response()->json('Id is not found',200);
        }
        $id->delete();
        return response()->json('success',200);
  
    }
}
