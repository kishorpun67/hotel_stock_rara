<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Income;
use Session;

class IncomeController extends Controller
{
    public function income()
    {
        $income = Income::get();
        Session::flash('page', 'income');
        return view('admin.income.view_income', compact('income'));
    }

    public function addEditIncome(Request $request, $id=null)
    {
        if($id=="") {
            $title = "Add Income";
            $button ="Submit";
            $income = new Income;
            $incomedata = array();
            $message = "Income has been added sucessfully";
        }else{
            $title = "Edit Income";
            $button ="Update";
            $incomedata = Income::where('admin_id',auth('admin')->user()->id)->where('id',$id)->first();
            $incomedata= json_decode(json_encode($incomedata),true);
            $income = Income::find($id);
            $message = "Income has been updated sucessfully";
        }
        if($request->isMethod('post')) {
            $data = $request->all();
        //dd($data);
            if(empty($data['income_heading'])){
                return redirect()->back()->with('error_message', 'Income Heading is required !');
            }

            if(empty($data['source']))
            {
                $data['source'] = "";
            }
    
            if(empty($data['amount']))
            {
                $data['amount'] = "";
            }
            // if(empty($data['parent_id']))
            // {
            //     $data['parent_id'] = "";
            // }
            $income->admin_id = auth('admin')->user()->id;
            $income->income_heading = $data['income_heading'];
            $income->source = $data['source'];
            $income->amount = $data['amount'];
            $income->save();
            Session::flash('success_message', $message);
            return redirect('admin/income');
        }
        Session::flash('page', 'income');
        return view('admin.income.add_edit_income', compact('title','button','incomedata'));
    }

    public function deleteIncome($id)
    {
      $id =Income::find($id);
      $id->delete();
      return redirect()->back()->with('success_message', 'Income has been deleted successfully!');
    }
}
