<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Electricity;

class ElectionController extends Controller
{
    public function electricty()
    {
        $electricity = Electricity::get();
        return response()->json($electricity, 200);
    }

    public function singleElectricty($id=null)
    {
        $bankCount = Electricity::where('id', $id)->count();
        if($bankCount==0){
            return response()->json('record not match!' ,200);
        }

        $bank = Electricity::where('id', $id)->first();
        return  response($bank,200);
    }

    public function addElectricty(Request $request)
    {

        $data=  $request->all();

        
        if(empty($data['electricity_uses'])){
            return response()->json('Electricity Uses is required!');
        }
        
        if(empty($data['electricity_unit']))
        {
            $data['electricity_unit'] = "";
        }
        if(empty($data['electricity_month']))
        {
            $data['electricity_month'] = "";
        }
        if(empty($data['electricity_total']))
        {
            $data['electricity_total'] = "";
        }
        $electricity = new Electricity();
        $electricity->admin_id = auth()->user()->id;
        $electricity->electricity_uses = $data['electricity_uses'];
        $electricity->electricity_unit = $data['electricity_unit'];
        $electricity->electricity_month = $data['electricity_month'];
        $electricity->electricity_total = $data['electricity_total'];
        $electricity->save();
        return  response('sucess',200);

    }

    public function updateElectricty(Request $request)
    {
       return $data=  $request->all();
        
        if(empty($data['electricity_uses'])){
            return response()->json('Electricity Uses is required!');
        }
        
        if(empty($data['electricity_unit']))
        {
            $data['electricity_unit'] = "";
        }
        if(empty($data['electricity_month']))
        {
            $data['electricity_month'] = "";
        }
        if(empty($data['electricity_total']))
        {
            $data['electricity_total'] = "";
        }
        
        $electricity =  Electricity::find($data['id']);
        $electricity->admin_id = auth()->user()->id;
        $electricity->electricity_uses = $data['electricity_uses'];
        $electricity->electricity_unit = $data['electricity_unit'];
        $electricity->electricity_month = $data['electricity_month'];
        $electricity->electricity_total = $data['electricity_total'];
        $electricity->save();
        return  response('sucess',200);

    }

    public function deleteElectricty()
    {
        $id = Electricity::find(request('id'));
        if(empty($id)){
          return response()->json('Id is not found',200);
        }
        $id->delete();
        return response()->json('success',200);
    }
}
