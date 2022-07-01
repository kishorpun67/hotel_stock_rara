<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Admin\TentType;
use App\Admin\Tent;

class TentController extends Controller
{
    public function tent()
    {
        $tents =Tent::with('tentType')->get();
        Session::flash('page', 'tent');
        return view('admin.tent.view_tent', compact('tents'));
    }

    public function addEditTent(Request $request, $id=null)
    {
        if($id=="") {
            $title = "Add Tent";
            $button ="Submit";
            $tent = new Tent;
            $tentData = array();
            $message = "Tent has been added sucessfully";
        }else{
            $title = "Edit Tent";
            $button ="Update";
            $tentData = Tent::where('id',$id)->first();
            $tentData= json_decode(json_encode($tentData),true);
            $tent = Tent::find($id);
            $message = "Tent has been updated sucessfully";
        }
        if($request->isMethod('post')) {
           $data = $request->all();
        // return($data);
            $rules = [
                'name' => 'required',
                'tent_type_id' =>'required',
                'price' =>'required|numeric',
            ];

            $customMessages = [
                'name.required' => 'Name is required',
                'tent_type_id.required' => 'Tent Type of is required',
                'price.required' => 'Price is required',
                'price.numeric' => 'Price is invalid ',
            ];
            $this->validate($request, $rules, $customMessages);
            if(empty($data['description']))
            {
                $data['description'] = "";
            }
            $tent->admin_id = auth('admin')->user()->id;
            $tent->tent_type_id = $data['tent_type_id'];
            $tent->name = $data['name'];
            $tent->price = $data['price'];
            $tent->description = $data['description'];
            $tent->save();
            Session::flash('success_message', $message);
            return redirect()->route('admin.tent');
        }
        $tentTypes = TentType::get();
        Session::flash('page', 'tent');
        return view('admin.tent.add_edit_tent', compact('title','button','tentData', 'tentTypes'));
    }

    public function deleteTent($id=null)
    {
        Tent::where('id', $id)->delete();
        return redirect()->back()->with('success_message', 'Tent  has been deleted successfully');
    }
}
