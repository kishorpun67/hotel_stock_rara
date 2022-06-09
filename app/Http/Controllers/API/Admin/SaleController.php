<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\Customer;
use App\Table;
use App\CustomerTable;
use Dotenv\Result\Success;

class SaleController extends Controller
{
    public function sales()
    {
        $order = Order::with('Waiter','Customer','Table')->get();
        return response()->json($order, 200);

    }
    public function customerTable()
    {
        $custtomerTable = CustomerTable::get();
        return response()->json($custtomerTable, 200);
    }
    public function addCustomerTable()
    {
        $data = request()->all();
        if(empty($data['table_id'])){
            return response()->json('Table is required !',200);
        }
        if(empty($data['no_customer'])){
            return response()->json('Number of Customer is required !',200);
        }
        
        $addCustomerNumber = new CustomerTable();
        $addCustomerNumber->admin_id = auth()->user()->id;
        $addCustomerNumber->table_id = request('table_id');
        $addCustomerNumber->no_customer = request('no_customer');
        $addCustomerNumber->save();
        return response()->json('sucess',200);
    }
}
