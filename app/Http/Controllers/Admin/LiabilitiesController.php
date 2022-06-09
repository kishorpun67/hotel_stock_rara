<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Liabilities;
use Session;

class LiabilitiesController extends Controller
{
    public function liabilities()
    {
        $liabilities = liabilities::get();
        Session::flash('page', 'liabilities');
        return view('admin.liabilities.view_liabilities', compact('liabilities'));
    }

    public function addEditLiabilities(Request $request, $id=null)
    {
        if($id=="") {
            $title = "Add Liabilities";
            $button ="Submit";
            $liabilities = new Liabilities;
            $liabilitiesdata = array();
            $message = "Liabilities has been added sucessfully";
        }else{
            $title = "Edit Liabilities";
            $button ="Update";
            $liabilitiesdata = Liabilities::where('admin_id',auth('admin')->user()->id)->where('id',$id)->first();
            $liabilitiesdata= json_decode(json_encode($liabilitiesdata),true);
            $liabilities = Liabilities::find($id);
            $message = "Liabilities has been updated sucessfully";
        }
        if($request->isMethod('post')) {
            $data = $request->all();
        //dd($data);
            if(empty($data['liabilities_name'])){
                return redirect()->back()->with('error_message', 'Liabilities Name is required !');
            }

            if(empty($data['amount']))
            {
                $data['amount'] = "";
            }
            // if(empty($data['parent_id']))
            // {
            //     $data['parent_id'] = "";
            // }
            $liabilities->admin_id = auth('admin')->user()->id;
            $liabilities->liabilities_name = $data['liabilities_name'];
            $liabilities->amount = $data['amount'];
            $liabilities->save();
            Session::flash('success_message', $message);
            return redirect('admin/liabilities');
        }
        Session::flash('page', 'liabilities');
        return view('admin.liabilities.add_edit_liabilities', compact('title','button','liabilitiesdata'));
    }

    public function deleteLiabilities($id)
    {
      $id =Liabilities::find($id);
      $id->delete();
      return redirect()->back()->with('success_message', 'Liabilities has been deleted successfully!');
    }
}
