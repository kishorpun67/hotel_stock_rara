<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
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
class ReportController extends Controller
{
    public function plAccountReport()
    {
        $current_day_sales = Order::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at',  Carbon::now()->month)->whereDay('created_at', Carbon::now()->subDay(1))->sum('total');
    	$last_day_sales1 = Order::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->whereDay('created_at', Carbon::now()->subDay(2))->sum('total');
        $current_day_purchase = Purchase::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->whereDay('created_at', Carbon::now()->subDay(1))->sum('total');
    	$last_day_purchase1 = Purchase::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->whereDay('created_at', Carbon::now()->subDay(2))->sum('total');
        Session::flash('page', 'pl_account');
        return view('admin.report.pl_account',compact('current_day_sales', 'last_day_sales1', 'current_day_purchase', 'last_day_purchase1'));
    }
    public function dailySummaryReport()
    { 
        $purchase = Purchase::with('supplierName')->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->whereDay('created_at', Carbon::now()->subDay(1))->get();
        $supplierDuePurchase = Purchase::with('supplierName')->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->whereDay('created_at', Carbon::now()->subDay(1))->where('due', "!=", "")->get();
        $sales = Order::with('customer')->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->whereDay('created_at', Carbon::now()->subDay(1))->get();
        $customerDueOrder = Order::with('customer')->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->whereDay('created_at', Carbon::now()->subDay(1))->where('due', "!=", "")->get();
        $expense = Expense::with('ingredientCategory', 'waste')->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->whereDay('created_at', Carbon::now()->subDay(1))->get();
        $waste = Waste::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->whereDay('created_at', Carbon::now()->subDay(1))->get();
        Session::flash('page', 'daily_sale_report');
        return view('admin.report.daily_summary_report', compact('purchase', 'supplierDuePurchase', 'sales', 'customerDueOrder', 'expense', 'waste'));
    }
    public function purchaseReport()
    {
        $purchase = Purchase::with('supplierName', 'purchase_item')->whereDay('created_at', '<=', Carbon::now()->subDay(1))->get();
        $supplierDuePurchase = Purchase::with('supplierName', 'purchase_item')->where('due', "!=", "")->whereDay('created_at', '<=', Carbon::now()->subDay(1))->get();
        Session::flash('page', 'purchase_report');
        return view('admin.report.purchase_report', compact('purchase','supplierDuePurchase'));
    }

    public function attendanceReport()
    {
        $attendance = Attendance::with('admin')->whereDay('created_at', '<=', Carbon::now()->subDay(1))->get();
        Session::flash('page', 'attendance_report');
        return view('admin.report.attendance_report',compact('attendance'));
    }
    public function saleReport()
    {
        $sales = Order::with('customer','ordrDetails')->get();
        $customerDueOrder = Order::with('customer')->where('due', "!=", "")->whereDay('created_at', '<=', Carbon::now()->subDay(1))->get();

        Session::flash('page', 'sale_report');
        return view('admin.report.sale_report',compact('sales', 'customerDueOrder'));
    }

    public function miscellaneousReport()
    {
        $miscellaneous = Miscellaneous::whereDay('created_at', '<=', Carbon::now()->subDay(1))->get();
        Session::flash('page', 'miscellaneous_report');
        return view('admin.report.miscllaneous_report',compact('miscellaneous'));
    }
    public function stockReport()
    {
       $stocks = IngredientItem::with('ingredientCategory', 'ingredientUnit')->whereDay('created_at', '<=', Carbon::now()->subDay(1))->get();
        Session::flash('page', 'stock_report');
        return view('admin.report.stock_report', compact('stocks'));
    }
    public function consumptionReport()
    {
         $consumption = Consumption::with('ingredientUnit')->whereDay('created_at', '<=', Carbon::now()->subDay(1))->get();
        Session::flash('page', 'consumption_report');
        return view('admin.report.consumption_report', compact('consumption'));
    }

    public function lowInventoryReport()
    {
       $stocks = IngredientItem::with('ingredientCategory','ingredientUnit')->where('quantity','<=',5)->whereDay('created_at', '<=', Carbon::now()->subDay(1))->get();
        Session::flash('page', 'low_inventory_report');
        return view('admin.report.low_inventory_report', compact('stocks'));
        
    }
    public function leaveReport()
    {
        $leave = Leave::with('employee')->whereDay('created_at', '<=', Carbon::now()->subDay(1))->get();
        Session::flash('page', 'leave_report');
        return view('admin.report.leave_report', compact('leave'));
    }
    public function salaryReport()
    {
        $salary = Attendance::with('admin')->whereDay('created_at', '<=', Carbon::now()->subDay(1))->get();
        Session::flash('page', 'salary_report');
        return view('admin.report.salary_report',compact('salary'));
    }
    public function taxReport()
    {
        $tax = Order::where('tax' ,'!=', "")->whereDay('created_at','<=', Carbon::now()->subDay(1))->get();
        Session::flash('page', 'tax_report');
        return view('admin.report.tax_report',compact('tax'));
    }
    
    public function taskReport()
    {
        $task = Task::whereDay('created_at','<=', Carbon::now()->subDay(1))->get();
        Session::flash('page', 'task_report');
        return view('admin.report.task_report',compact('task'));
    }

    
}
