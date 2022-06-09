<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Water;
use Session;

class WaterController extends Controller
{
    public function water()
    {
        $water = Water::get();
        Session::flash('page', 'water');
        return view('admin.water.view_water', compact('water'));
    }

    public function addEditwater(Request $request, $id=null)
    {
        if($id=="") {
            $title = "Add Water";
            $button ="Submit";
            $water = new Water;
            $waterdata = array();
            $message = "Water has been added sucessfully";
        }else{
            $title = "Edit Water";
            $button ="Update";
            $waterdata = Water::where('id',$id)->first();
            $waterdata= json_decode(json_encode($waterdata),true);
            $water = Water::find($id);
            $message = "Water has been updated sucessfully";
        }
        if($request->isMethod('post')) {
            $data = $request->all();
            if(empty($data['water_uses'])){
                return redirect()->back()->with('error_message', 'water Name is required !');
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
           
            $water->admin_id = auth('admin')->user()->id;
            $water->water_uses = $data['water_uses'];
            $water->water_unit = $data['water_unit'];
            $water->water_month = $data['water_month'];
            $water->water_total = $data['water_total'];
            $water->save();
            Session::flash('success_message', $message);
            return redirect('admin/water');
        }
        Session::flash('page', 'water');
        return view('admin.water.add_edit_water', compact('title','button','waterdata'));
    }

    public function waterReport()
    {
        $water = Water::get();
        Session::flash('page', 'water');
        return view('admin.report.water_report',compact('water'));
    }
    public function deleteWater($id)
    {
      $id =Water::find($id);
      $id->delete();
      return redirect()->back()->with('success_message', 'Water has been deleted successfully!');
    }
}