<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Internet;

class InternetController extends Controller
{
    public function internet()
    {
        $electricity = Internet::get();
        return response()->json($electricity, 200);
    }

    public function singleInternet($id=null)
    {
        $bankCount = Internet::where('id', $id)->count();
        if($bankCount==0){
            return response()->json('record not match!' ,200);
        }

        $bank = Internet::where('id', $id)->first();
        return  response($bank,200);
    }

    public function addInternet(Request $request)
    {

        $data=  $request->all();

        
        if(empty($data['internet_uses'])){
            return response()->json('Internet Uses is required!');
        }
        
        if(empty($data['internet_mbps']))
        {
            $data['internet_mbps'] = "";
        }
        if(empty($data['internet_month']))
        {
            $data['internet_month'] = "";
        }
        if(empty($data['internet_total']))
        {
            $data['internet_total'] = "";
        }
        $internet = new Internet();
        $internet->admin_id = auth()->user()->id;
        $internet->internet_uses = $data['internet_uses'];
        $internet->internet_mbps = $data['internet_mbps'];
        $internet->internet_month = $data['internet_month'];
        $internet->internet_total = $data['internet_total'];
        $internet->save();
        return  response('sucess',200);

    }

    public function updateInternet(Request $request)
    {
        $data=  $request->all();
        
        if(empty($data['internet_uses'])){
            return response()->json('Internet Uses is required!');
        }
        
        if(empty($data['internet_mbps']))
        {
            $data['internet_mbps'] = "";
        }
        if(empty($data['internet_month']))
        {
            $data['internet_month'] = "";
        }
        if(empty($data['internet_total']))
        {
            $data['internet_total'] = "";
        }
        
        $internet =  Internet::find($data['id']);
        $internet->admin_id = auth()->user()->id;
        $internet->internet_uses = $data['internet_uses'];
        $internet->internet_mbps = $data['internet_mbps'];
        $internet->internet_month = $data['internet_month'];
        $internet->internet_total = $data['internet_total'];
        $internet->save();
        return  response('sucess',200);

    }

    public function deleteInternet()
    {
        $id = Internet::find(request('id'));
        if(empty($id)){
          return response()->json('Id is not found',200);
        }
        $id->delete();
        return response()->json('success',200);
  
    }
}
