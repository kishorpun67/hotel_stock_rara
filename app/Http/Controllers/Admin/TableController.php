<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Table;
use Session;

class TableController extends Controller
{
    public function table()
    {
        $table = table::get();
        Session::flash('page', 'table');
        return view('admin.table.view_table', compact('table'));
    }

    public function addEdittable(Request $request, $id=null)
    {
        if($id=="") {
            $title = "Add Table";
            $button ="Submit";
            $table = new table;
            $tabledata = array();
            $message = "table has been added sucessfully";
        }else{
            $title = "Edit table";
            $button ="Update";
            $tabledata = table::where('admin_id',auth('admin')->user()->id)->where('id',$id)->first();
            $tabledata= json_decode(json_encode($tabledata),true);
            $table = table::find($id);
            $message = "table has been updated sucessfully";
        }
        if($request->isMethod('post')) {
            $data = $request->all();
        //dd($data);
            if(empty($data['table_name'])){
                return redirect()->back()->with('error_message', 'table name is required !');
            }
            
            if(empty($data['seat_capacity']))
            {
                $data['seat_capacity'] = "";
            }
            if(empty($data['table_no']))
            {
                $data['table_no'] = "";
            }

            // if(empty($data['user_id']))
            // {
            //     $data['user_id'] = "";
            // }
            // if(empty($data['parent_id']))
            // {
            //     $data['parent_id'] = "";
            // }
            $table->admin_id = auth('admin')->user()->id;
            $table->table_name = $data['table_name'];
            $table->seat_capacity = $data['seat_capacity'];
            $table->table_no = $data['table_no'];
            $table->save();
            Session::flash('success_message', $message);
            return redirect('admin/table');
        }
        Session::flash('page', 'table');
        return view('admin.table.add_edit_table', compact('title','button','tabledata'));
    }

    public function deletetable($id)
    {
      $id =table::find($id);
      $id->delete();
      return redirect()->back()->with('success_message', 'table has been deleted successfully!');
    }
}
