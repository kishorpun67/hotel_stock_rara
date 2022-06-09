<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Asset;
class AssetController extends Controller
{
    public function asset()
    {
        $asset = Asset::get();
        return response()->json($asset, 200);
    }

    public function singAsset($id=null)
    {
        $assetCount = Asset::where('id', $id)->count();
        if($assetCount==0){
            return response()->json('record not match!' ,200);
        }

        $asset = Asset::where('id', $id)->first();
        return  response($asset,200);
    }

    public function addAsset(Request $request)
    {

        $data=  $request->all();

      

        if(empty($data['assets_name']))
        {
            $data['assets_name'] = "";
        }

        if(empty($data['amount']))
        {
            $data['amount'] = "";
        }
        // if(empty($data['parent_id']))
        // {
        //     $data['parent_id'] = "";
        // }
        $assets = new Asset();
        $assets->admin_id = auth()->user()->id;
        $assets->assets_name = $data['assets_name'];
        $assets->amount = $data['amount'];
        $assets->save();
        return  response('sucess',200);

    }

    public function updateAsset(Request $request)
    {
        $data=  $request->all();

        if(empty($data['assets_name']))
        {
            $data['assets_name'] = "";
        }

        if(empty($data['amount']))
        {
            $data['amount'] = "";
        }
        
        $assets =  Asset::find($data['id']);
        $assets->admin_id = auth()->user()->id;
        $assets->assets_name = $data['assets_name'];
        $assets->amount = $data['amount'];
        $assets->save();
        return  response('sucess',200);

    }

    public function deleteAsset()
    {
        $id = Asset::find(request('id'));
        if(empty($id)){
          return response()->json('Id is not found',200);
        }
        $id->delete();
        return response()->json('success',200);
    }
}
