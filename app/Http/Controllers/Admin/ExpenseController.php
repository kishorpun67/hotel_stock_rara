<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Waste;
use App\Expense;
use App\IngredientCategory;
use Session;

class expenseController extends Controller
{
    public function Expense()
    {
        $expense = Expense::with('ingredientCategory','waste')->get();
        Session::flash('page', 'expense');
        return view('admin.expense.view_expense', compact('expense'));
    }

    public function addEditExpense(Request $request, $id=null)
    {
        if($id=="") {
            $title = "Add Expense";
            $button ="Submit";
            $expense = new Expense;
            $expensedata = array();
            $message = "Expenses has been added sucessfully";
        }else{
            $title = "Edit Expense";
            $button ="Update";
            $expensedata = Expense::where('admin_id',auth('admin')->user()->id)->where('id',$id)->first();
            $expensedata= json_decode(json_encode($expensedata),true);
            $expense = Expense::find($id);
            $message = "Expenses has been updated sucessfully";
        }
        if($request->isMethod('post')) {
            $data = $request->all();
            // dd($data);
            if(empty($data['date'])){
                return redirect()->back()->with('error_message', 'Date is required !');
            }
            
            if(empty($data['amount']))
            {
                $data['amount'] = "";
            }
            if(empty($data['category_id']))
            {
                $data['category_id'] = "";
            }
            if(empty($data['waste_id']))
            {
                $data['waste_id'] = "";
            }
            if(empty($data['note']))
            {
                $data['note'] = "";
            }
           
            $expense->admin_id = auth('admin')->user()->id;
            $expense->date = $data['date'];
            $expense->amount = $data['amount'];
            // $expense->category_id = $data['category_id'];
            $expense->waste_id = $data['waste_id'];
            $expense->note = $data['note'];
            $expense->save();
            Session::flash('success_message', $message);
            return redirect('admin/expense');
        }
        $ingredientCategory = IngredientCategory::get();
        $waste = Waste::get();
        Session::flash('page', 'expense');
        return view('admin.expense.add_edit_expense', compact('title','button','expensedata','ingredientCategory','waste'));
    }

    public function deleteExpense($id)
    {
      $id =Expense::find($id);
      $id->delete();
      return redirect()->back()->with('success_message', 'Expense has been deleted successfully!');

    }
}
