<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Purchase;
use App\Order;
use App\Waste;
use App\Expense;
use App\Attendance;
use App\Consumption;
use App\Miscellaneous;
use App\OrderDetail;
use App\IngredientItem;
use App\Leave;
use App\Sale;
use Carbon\Carbon;
use App\Task;
use App\PurchaseItem;
use Illuminate\Support\Arr;
use App\Customer;

class ReportController extends Controller
{
    public function plAccountReport()
    {
        $current_day_sales = Order::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->whereDay('created_at', Carbon::now()->day)->sum('total');
    	$last_day_sales = Order::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->whereDay('created_at', Carbon::now()->subDay(1))->sum('total');
        $current_day_purchase = Purchase::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->whereDay('created_at', Carbon::now()->day)->sum('total');
    	$last_day_purchase = Purchase::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->whereDay('created_at', Carbon::now()->subDay(1))->sum('total');
        $data =array('today_day'=> $current_day_sales, "last_day_sale"=> $last_day_sales, 'today_pruchase'=>$current_day_purchase, 'last_day_purchase'=> $last_day_purchase);
        return response()->json($data,200);
    }
    public function dailySummaryReport()
    {
        $purchase = Purchase::with('supplierName')->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->whereDay('created_at', Carbon::now()->day)->get();
        $supplierDuePurchase = Purchase::with('supplierName')->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->whereDay('created_at', Carbon::now()->day)->where('due', "!=", "")->get();
        $sales = Order::with('customer')->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->whereDay('created_at', Carbon::now()->day)->get();
        $customerDueOrder = Order::with('customer')->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->whereDay('created_at', Carbon::now()->day)->where('due', "!=", "")->get();
        $expense = Expense::with('ingredientCategory', 'waste')->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->whereDay('created_at', Carbon::now()->day)->get();
        $waste = Waste::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->whereDay('created_at', Carbon::now()->day)->get();
        $data =array('purchase'=> $purchase, "supplier_due_purchase"=> $supplierDuePurchase, 
        'sales'=>$sales, 'customer_due_order'=> $customerDueOrder,'expense'=>$expense, 'waste'=>$waste);
        return response()->json($data,200);
    }
    public function purchaseReport()
    {
        $purchase = Purchase::with('supplierName', 'purchase_item')->get();
        $supplierDuePurchase = Purchase::with('supplierName', 'purchase_item')->where('due', "!=", "")->get();
        $data =array('purchase'=>$purchase, 'supplier_due_purchase'=>$supplierDuePurchase);
        return response()->json($data,200);
    }

    public function attendanceReport()
    {
        $attendance = Attendance::with('staff')->get();
        return response()->json($attendance,200);
    }
    public function saleReport()
    {
        $sales = Order::with('customer','ordrDetails')->get();
        $customerDueOrder = Order::with('customer')->where('due', "!=", "")->get();
        $data =array('sales'=>$sales, 'customer_due_order'=>$customerDueOrder);
        return response()->json($data,200);

    }

    public function miscellaneousReport()
    {
        $miscellaneous = Miscellaneous::get();
        return response()->json($miscellaneous,200);
     
    }
    public function stockReport()
    {
       $stocks = IngredientItem::with('ingredientCategory', 'ingredientUnit')->get();
       return response()->json($stocks,200);
       
    }
    public function consumptionReport()
    {
         $consumption = Consumption::with('ingredientUnit')->get();
         return response()->json($consumption,200);

    }

    public function lowInventoryReport()
    {
       $stocks = IngredientItem::with('ingredientCategory','ingredientUnit')->where('quantity','<=',5)->get();
       return response()->json($stocks,200);

        
    }
    public function leaveReport()
    {
        $leave = Leave::with('employee')->get();
        return response()->json($leave,200);

    }
    public function salaryReport()
    {
        $salary = Attendance::with('staff')->get();
        return response()->json($salary,200);

    }
    public function taxReport()
    {
        $tax = Order::where('tax' ,'!=', "")->get();
        return response()->json($tax,200);
    }
    
    public function taskReport()
    {
        $task = Task::get();
        return response()->json($task,200);
    }

    public function wasteReport()
    {
        $waste = Waste::get();
        return response()->json($waste,200);

    }
    public function customerReport()
    {
        $customer = Customer::get();
        return response()->json($customer,200);

    }


}
