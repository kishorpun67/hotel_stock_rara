<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Asset;
use Session;

class AssetsController extends Controller
{
    public function assets()
    {
        $assets = Asset::get();
        Session::flash('page', 'assets');
        return view('admin.assets.view_assets', compact('assets'));
    }

    public function addEditAssets(Request $request, $id=null)
    {
        if($id=="") {
            $title = "Add Assets";
            $button ="Submit";
            $assets = new Asset;
            $assetsdata = array();
            $message = "Assets has been added sucessfully";
        }else{
            $title = "Edit Assets";
            $button ="Update";
            $assetsdata = Asset::where('admin_id',auth('admin')->user()->id)->where('id',$id)->first();
            $assetsdata= json_decode(json_encode($assetsdata),true);
            $assets = Asset::find($id);
            $message = "Assets has been updated sucessfully";
        }
        if($request->isMethod('post')) {
            $data = $request->all();
        //dd($data);
            if(empty($data['assets_name'])){
                return redirect()->back()->with('error_message', 'assets Name is required !');
            }

            if(empty($data['amount']))
            {
                $data['amount'] = "";
            }
            // if(empty($data['parent_id']))
            // {
            //     $data['parent_id'] = "";
            // }
            $assets->admin_id = auth('admin')->user()->id;
            $assets->assets_name = $data['assets_name'];
            $assets->amount = $data['amount'];
            $assets->save();
            Session::flash('success_message', $message);
            return redirect('admin/assets');
        }
        Session::flash('page', 'assets');
        return view('admin.assets.add_edit_assets', compact('title','button','assetsdata'));
    }

    public function deleteAssets($id)
    {
      $id =Asset::find($id);
      $id->delete();
      return redirect()->back()->with('success_message', 'Assets has been deleted successfully!');
    }
}
