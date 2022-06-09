<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Admin\Category;
use App\OrderDetail;
use Carbon\Carbon;
use App\Order;
use App\Purchase;
use App\Expense;
use App\Waste;
use Illuminate\Support\Arr;

class ChartsController extends Controller
{
   
   

    public function monthlyReport()
    {
        
       
        $this_month_sale = Order::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->sum('total');
        $this_month_purchase = Purchase::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->sum('total');
        $this_month_expense = Expense::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->sum('amount');
        $this_month_waste= Waste::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->sum('total_loss');
        return  response()->json(['sale'=>$this_month_sale, 'purchase'=>$this_month_purchase, 'expense'=>$this_month_expense,'waste'=>$this_month_waste], 200);
    }
    public function monthlySaleReport()
    {
        $first_month = date('M');
        $second_month = date('M',strtotime("-1 month"));
        $third_month = date('M',strtotime("-2 month"));
        $fourth_month = date('M',strtotime("-3 month"));
        $fith_month = date('M',strtotime("-4 month"));
        $six_month = date('M',strtotime("-5 month"));
        $seven_month = date('M',strtotime("-6 month"));
        $eight_month = date('M',strtotime("-7 month"));
        $nine_month = date('M',strtotime("-8 month"));
        $ten_month = date('M',strtotime("-9 month"));
        $elevan_month = date('M',strtotime("-10 month"));
        $tewval_month = date('M',strtotime("-11 month"));
        $month =  array('one'=>$first_month, 'two'=>$second_month, 'three'=>$third_month, 'four'=> $fourth_month, 'five'=>$fith_month,'six'=>$six_month
        , 'seven'=>$seven_month, 'eight'=> $eight_month, 'nine'=>$nine_month, 'ten'=>$ten_month, 'elevan'=> $elevan_month, 'tawval'=>$tewval_month
        );

        $first_month = Order::whereMonth('created_at', Carbon::now()->month)->sum('total');
        $second_month = Order::whereMonth('created_at', Carbon::now()->subMonth(1))->sum('total');
        $third_month = Order::whereMonth('created_at', Carbon::now()->subMonth(2))->sum('total');
        $foruth_month = Order::whereMonth('created_at', Carbon::now()->subMonth(3))->sum('total');
        $fith_month = Order::whereMonth('created_at', Carbon::now()->subMonth(4))->sum('total');
        $six_month = Order::whereMonth('created_at', Carbon::now()->subMonth(5))->sum('total');
        $seven_month = Order::whereMonth('created_at', Carbon::now()->subMonth(6))->sum('total');
        $eight_month = Order::whereMonth('created_at', Carbon::now()->subMonth(7))->sum('total');
        $nine_month = Order::whereMonth('created_at', Carbon::now()->subMonth(8))->sum('total');
        $ten_month = Order::whereMonth('created_at', Carbon::now()->subMonth(9))->sum('total');
        $elevan_month = Order::whereMonth('created_at', Carbon::now()->subMonth(10))->sum('total');
        $tewval_month = Order::whereMonth('created_at', Carbon::now()->subMonth(11))->sum('total');

        $month_data = array('one'=>$first_month, 'two'=>$second_month, 'three'=>$third_month, 'four'=> $foruth_month, 'five'=>$fith_month,'six'=>$six_month
        , 'seven'=>$seven_month, 'eight'=> $eight_month, 'nine'=>$nine_month, 'ten'=>$ten_month, 'elevan'=> $elevan_month, 'tawval'=>$tewval_month
        );
        return response()->json(['month'=> $month, 'data'=>$month_data]);

        
    }


    

}
