<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Table;

class TableController extends Controller
{
    public function table()
    {
        $table = Table::get();
        return response()->json($table, 200);
    }

    public function addTable(Request $request)
    {
        
        if($request->isMethod('post')) {
            $data = $request->all();
            if(empty($data['table_name']))
            {
                $data['table_name'] = "";
            }
            if(empty($data['seat_capacity']))
            {
                $data['seat_capacity'] = "";
            }
            if(empty($data['table_no']))
            {
                $data['table_no'] = "";
            }
            $table = new Table;
            $table->admin_id = auth()->user()->id;
            $table->table_name = $data['table_name'];
            $table->seat_capacity = $data['seat_capacity'];
            $table->table_no = $data['table_no'];
            $table->save();
            return  response('sucess',200);
            // Session::flash('success_message', $message);
        }
    }
    public function editTable(Request $request)
    {
        
        if($request->isMethod('post')) {
            $data = $request->all();

            if(empty($data['table_name']))
            {
                $data['table_name'] = "";
            }
            if(empty($data['seat_capacity']))
            {
                $data['seat_capacity'] = "";
            }
            if(empty($data['table_no']))
            {
                $data['table_no'] = "";
            }
            $table =  Table::find($data['id']);
            $table->admin_id = auth()->user()->id;
            $table->table_name = $data['table_name'];
            $table->seat_capacity = $data['seat_capacity'];
            $table->table_no = $data['table_no'];
            $table->save();
            return  response('sucess',200);
            // Session::flash('success_message', $message);
        }
    }

    public function deleteTable()
    {
      $id =Table::find(request('id'));
      if(empty($id)){
        return response()->json('Id is not found',200);
      }
      $id->delete();
      return response()->json('success',200);
    }
}
