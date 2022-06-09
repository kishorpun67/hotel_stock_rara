<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Water;
class WasterController extends Controller
{
    public function water()
    {
        $electricity = Water::get();
        return response()->json($electricity, 200);
    }

    public function singleWater($id=null)
    {
        $bankCount = Water::where('id', $id)->count();
        if($bankCount==0){
            return response()->json('record not match!' ,200);
        }

        $bank = Water::where('id', $id)->first();
        return  response($bank,200);
    }

    public function addWater(Request $request)
    {

        $data=  $request->all();

        if(empty($data['water_uses'])){
            return response()->json('Water Uses is required!');
        }
        if(empty($data['water_unit']))
        {
            $data['water_unit'] = "";
        }
        if(empty($data['water_month']))
        {
            $data['water_month'] = "";
        }
        if(empty($data['water_total']))
        {
            $data['water_total'] = "";
        }
          
        $water = new Water();
        $water->admin_id = auth()->user()->id;
        $water->water_uses = $data['water_uses'];
        $water->water_unit = $data['water_unit'];
        $water->water_month = $data['water_month'];
        $water->water_total = $data['water_total'];
        $water->save();
        return  response('sucess',200);

    }

    public function updateWater(Request $request)
    {
        $data=  $request->all();
        
        if(empty($data['water_uses'])){
            return response()->json('Water Uses is required!');
        }
        if(empty($data['water_unit']))
        {
            $data['water_unit'] = "";
        }
        if(empty($data['water_month']))
        {
            $data['water_month'] = "";
        }
        if(empty($data['water_total']))
        {
            $data['water_total'] = "";
        }
          
        $water =  Water::find($data['id']);
        $water->admin_id = auth()->user()->id;
        $water->water_uses = $data['water_uses'];
        $water->water_unit = $data['water_unit'];
        $water->water_month = $data['water_month'];
        $water->water_total = $data['water_total'];
        $water->save();
        return  response('sucess',200);

    }

    public function deleteWater()
    {
        $id = Water::find(request('id'));
        if(empty($id)){
          return response()->json('Id is not found',200);
        }
        $id->delete();
        return response()->json('success',200);
  
    }
}
