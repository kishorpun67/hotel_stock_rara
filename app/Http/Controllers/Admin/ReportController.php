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
use View;
use App\Admin\BookRoom;
use App\Admin\Rafting;
use App\Admin\RentTent;
use App\Admin\SwimmingPool;
// use App\


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

    public function profitLoss()
    {
        $order = OrderDetail::orderBy('id', 'desc')->with('order')->get();
        Session::flash('page', 'profit_loss_report');
        return view('admin.report.profit_loss_report', compact('order'));
    }

    public function ajaxGetMonthlyReport()
    {
        switch(request('month')) {
            case  1: 
                $order = OrderDetail::orderBy('id', 'desc')->with('order')->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->get();
                break;
            case 2: 
                $order = OrderDetail::orderBy('id', 'desc')->with('order')->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(1))->get();
                break;
            case 3: 
                $order = OrderDetail::orderBy('id', 'desc')->with('order')->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(2))->get();
                break;
            case 4: 
                $order = OrderDetail::orderBy('id', 'desc')->with('order')->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(3))->get();
                break;
            case 5: 
                $order = OrderDetail::orderBy('id', 'desc')->with('order')->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(4))->get();
                break;
            case 6: 
                $order = OrderDetail::orderBy('id', 'desc')->with('order')->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(5))->get();
                break;
            case 7: 
                $order = OrderDetail::orderBy('id', 'desc')->with('order')->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(6))->get();
                break;
            case 8: 
                $order = OrderDetail::orderBy('id', 'desc')->with('order')->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(7))->get();
                break;
            case 9: 
                $order = OrderDetail::orderBy('id', 'desc')->with('order')->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(8))->get();
                break;
            case 10: 
                $order = OrderDetail::orderBy('id', 'desc')->with('order')->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(9))->get();
                break;
            case 11: 
                $order = OrderDetail::orderBy('id', 'desc')->with('order')->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(10))->get();
                break;
            case 12: 
                $order = OrderDetail::orderBy('id', 'desc')->with('order')->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(11))->get();
                break;
            case "all": 
                $order = OrderDetail::orderBy('id', 'desc')->with('order')->whereYear('created_at', Carbon::now()->year)->get();
                break;               
        }
        return response()->json(['view'=>(String)View::make('admin.report.ajax_profit_loss')->with(compact('order'))]);

        // return view('admin.report.ajax_profit_loss', compact('order'));

    }
    public function roomReport()
    {
        $bookRooms =BookRoom::orderBy('id', 'desc')->with('room', 'customer')->get();
        Session::flash('page', 'room_report');
        return view('admin.report.room_report', compact('bookRooms'));
    }

    public function campingReport()
    {
        $rentTent =RentTent::orderBy('id', 'desc')->with('customer', 'tent')->get();
        Session::flash('page', 'camping_report');
        return view('admin.report.camping_report', compact('rentTent'));
    }

    public function swimmingReport()
    {
        $swimmingPool =SwimmingPool::with('customer')->get();
        Session::flash('page', 'swimming_report');
        return view('admin.report.swimming_report', compact('swimmingPool'));
    }

    public function raftingReport()
    {
        $rafting =Rafting::with('customer')->get();
        Session::flash('page', 'rafting_report');
        return view('admin.report.rafting_report', compact('rafting'));
    }

    
}
