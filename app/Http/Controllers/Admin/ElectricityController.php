<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Electricity;
use Session;

class ElectricityController extends Controller
{
    public function electricity()
    {
        $electricity = Electricity::get();
        Session::flash('page', 'electricity');
        return view('admin.electricity.view_electricity', compact('electricity'));
    }

    public function addEditElectricity(Request $request, $id=null)
    {
        if($id=="") {
            $title = "Add Electricity";
            $button ="Submit";
            $electricity = new Electricity;
            $electricitydata = array();
            $message = "Electricity has been added sucessfully";
            $lastestElectricityUses = Electricity::latest('created_at')->first();
            $previousData = array();
        }else{
            $title = "Edit Electricity";
            $button ="Update";
            $prev_id = Electricity::where('id', '<', $id)->max('id');
            $electricitydata = Electricity::where('id',$id)->first();
            $electricitydata= json_decode(json_encode($electricitydata),true);
            $electricity = Electricity::find($id);
            $message = "Electricity has been updated sucessfully";
            $lastestElectricityUses = array();
            $previousData = Electricity::where('id', $prev_id)->first();
        }
        if($request->isMethod('post')) {
          $data = $request->all();
        //dd($data);
            if(empty($data['electricity_uses'])){
                return redirect()->back()->with('error_message', 'Electricity Name is required !');
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
            if(empty($data['electricity_paid']))
            {
                $data['electricity_paid'] = "";
            }
            if(empty($data['early_electricity_consumption']))
            {
                $data['early_electricity_consumption'] = "";
            }
            if(empty($data['electricity_due']))
            {
                $data['electricity_due'] = "";
            }
            if($id==null && !empty($data['early_electricity_consumption'])){
                $lastestElectricityUses = Electricity::latest('created_at')->first();
                Electricity::where('id', $lastestElectricityUses->id)->update([
                    'electricity_due'=>0,
                ]);
                $electricity->electricity_uses = $data['early_electricity_consumption'];
            } elseif (!empty($id) && !empty($data['early_electricity_consumption'])){
                $electricity->electricity_uses = $data['early_electricity_consumption'];
            }else{
                $electricity->electricity_uses = $data['electricity_uses'];
            }
                
            $electricity->admin_id = auth('admin')->user()->id;
            
            $electricity->electricity_unit = $data['electricity_unit'];
            $electricity->electricity_month = $data['electricity_month'];
            $electricity->electricity_total = $data['electricity_total'];
            $electricity->electricity_paid = $data['electricity_paid'];
            $electricity->electricity_due = $data['electricity_due'];

            $electricity->save();
            Session::flash('success_message', $message);
            return redirect('admin/electricity');
        }
        $count  = Electricity::first();
        // if($count>=2){

        // }
        Session::flash('page', 'electricity');
        return view('admin.electricity.add_edit_electricity', compact('title','button','electricitydata', 'lastestElectricityUses', 'previousData', 'count'));
    }

    public function electricityReport()
    {
        $electricity = Electricity::get();
        Session::flash('page', 'salary');
        return view('admin.report.electricity_report',compact('electricity'));
    }


    public function deleteElectricity($id)
    {
      $id =Electricity::find($id);
      $id->delete();
      return redirect()->back()->with('success_message', 'Electricity has been deleted successfully!');
    }
}

