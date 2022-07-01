<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Admin\SwimmingPool;
use App\Customer;
use DB;
use App\AllActivity;

use function GuzzleHttp\Promise\all;

class SwimmingController extends Controller
{
    public function swimmingPool()
    {
        $swimmingPool =SwimmingPool::with('customer')->get();
        Session::flash('page', 'swimming_pool');
        return view('admin.swimming_pool.view_swimming_pool', compact('swimmingPool'));
    }

    public function addEditSwimmingPool(Request $request, $id=null)
    {
        if($id=="") {
            $title = "Add Swimming Pool";
            $button ="Submit";
            $swimmingPool = new SwimmingPool;
            $swimmingPoolData = array();
            $message = "Swimming Pool has been added sucessfully";
        }else{
            $title = "Edit Swimming Pool";
            $button ="Update";
            $swimmingPoolData = SwimmingPool::where('id',$id)->first();
            $swimmingPoolData= json_decode(json_encode($swimmingPoolData),true);
            $swimmingPool = SwimmingPool::find($id);
            $message = "Swimming Pool has been updated sucessfully";
        }
        if($request->isMethod('post')) {
           $data = $request->all();
        // return($data);
            $rules = [
                'customer_id' => 'required',
                'number_of_customer' =>'required|numeric',
                'price' =>'required|numeric',
                'duration' =>'required',
            ];

            $customMessages = [
                'customer_id.required' => 'Customer Name is required',
                'number_of_customer.required' => 'Number of customer is required',
                'price.required' => 'Price is required',
                'price.numeric' => 'Price is invalid ',
                'duration.required' => 'Duration is required',
            ];
            $this->validate($request, $rules, $customMessages);
            // if($id==null){
            //     $getStatus = AllActivity::where('customer_id', $data['customer_id'])->latest()->first();
            //     if(!empty($getStatus->status) && $getStatus->status != 'Paid' && $getStatus->status != 'Cancled'){
            //         return redirect()->back()->with('error_message','Please! Checkout this customor first');
            //     }
            // }
                
            if(empty($data['paid']))
            {
                $data['paid'] = "";
            }
            if(empty($data['due']))
            {
                $data['due'] = "";
            }
            if(empty($data['total']))
            {
                $data['total'] = "";
            }
            $orderCheck = AllActivity::where(['customer_id'=>$data['customer_id']])->latest()->first();
            $swimmingPool->admin_id = auth('admin')->user()->id;
            $swimmingPool->customer_id = $data['customer_id'];
            $swimmingPool->number_of_customer = $data['number_of_customer'];
            $swimmingPool->duration = $data['duration'];
            $swimmingPool->price = $data['price'];
            $swimmingPool->total = $data['total'];
            $swimmingPool->paid = $data['paid'];
            $swimmingPool->due = $data['due'];
            $swimmingPool->save();
            if($id==null){
                $swimming_id= DB::getPdo()->lastInsertId();
                if(empty($orderCheck->status) ){
                    $newActivity = new AllActivity();
                    $newActivity->swimming_id = $swimming_id;
                    $newActivity->customer_id = $data['customer_id'];
                    $newActivity->admin_id = auth('admin')->user()->id;
                    $newActivity->status = "New";
                    $newActivity->save();
                }elseif($orderCheck->status == 'Paid' || $orderCheck->status == 'Cancel'){
                    // return "test";
                    $newActivity = new AllActivity();
                    $newActivity->swimming_id = $swimming_id;
                    $newActivity->customer_id = $data['customer_id'];
                    $newActivity->admin_id = auth('admin')->user()->id;
                    $newActivity->status = "New";
                    $newActivity->save();
                }elseif($orderCheck->status == 'Paid' || $orderCheck->status != 'Cancel'){
                    // return "test2";
                    $newActivity =  AllActivity::where('customer_id', $data['customer_id'])->latest()->first();
                    $newActivity->swimming_id = $swimming_id;
                    $newActivity->save();
                }
            }else{
                $swimming_id= DB::getPdo()->lastInsertId();
                $checkID =  AllActivity::where(['swimming_id'=> $id])->first();
                if(!empty($checkID->book_room_id) || !empty($checkID->rafting_id) || !empty($checkID->camping_id) || !empty($checkID->order_id)) {
                    AllActivity::where('swimming_id', $id)->update(['swimming_id' => null]);
                }else{
                    AllActivity::where('swimming_id', $id)->delete();
                }
                $orderCheck = AllActivity::where(['customer_id'=>$data['customer_id']])->latest()->first();
                if(empty($orderCheck->status) ){
                    $newActivity = new AllActivity();
                    $newActivity->swimming_id = $id;
                    $newActivity->admin_id = auth('admin')->user()->id;
                    $newActivity->customer_id = $data['customer_id'];
                    $newActivity->status = "New";
                    $newActivity->save();
                }
                if(!empty($orderCheck->status) && $orderCheck->status != 'Paid' && $orderCheck->status != 'Cancled'){
                    $newActivity =  AllActivity::where('customer_id', $data['customer_id'])->latest()->first();
                    $newActivity->customer_id = $data['customer_id'];
                    $newActivity->swimming_id = $id;
                    $newActivity->save();
                }
            }
            Session::flash('success_message', $message);
            return redirect()->route('admin.swimming.pool');
        }
        $customers = Customer::get();
        Session::flash('page', 'swimming_pool');
        return view('admin.swimming_pool.add_edit_swimming_pool', compact('title','button','swimmingPoolData', 'customers'));
    }

    public function deleteSwimmingPool($id=null)
    {
        
        $checkID =  AllActivity::where(['swimming_id'=> $id])->first();
        if(!empty($checkID->book_room_id) || !empty($checkID->rafting_id) || !empty($checkID->camping_id) || !empty($checkID->order_id)) {
            AllActivity::where('swimming_id', $id)->update(['swimming_id' => null]);
        }else{
            // return 'test';
            AllActivity::where('swimming_id', $id)->delete();
        }
        // return $id;
        SwimmingPool::where('id', $id)->delete();

        return redirect()->back()->with('success_message', 'Swimming Pool has been deleted successfully');
    }
}
