<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Admin\RentTent;
use App\Customer;
use App\Admin\Tent;
use DB;
use App\AllActivity;

class RentTentController extends Controller
{
    public function rentTent()
    {
        $rentTent =RentTent::orderBy('id', 'desc')->with('customer', 'tent')->get();
        Session::flash('page', 'rent_tent');
        return view('admin.rentTent.view_rent_tent', compact('rentTent'));
    }

    public function ajaxGetTentPrice()
    {
        // return (request('tent_id'));
        if (!empty(request('tent_id'))) {
            $ids = request('tent_id');
        } else {
            $ids = [];
        }
        $tentprice = Tent::whereIn('id', $ids)->sum('price');
        return response()->json($tentprice,200);
    }

    public function addEditRentTent(Request $request, $id=null)
    {
        if($id=="") {
            $title = "Add Camping";
            $button ="Submit";
            $rentTent = new RentTent;
            $rentTentData = array();
            $message = "Camping has been added sucessfully";
        }else{
            $title = "Edit RentTent";
            $button ="Update";
            $rentTentData = RentTent::where('id',$id)->first();
            $rentTentData= json_decode(json_encode($rentTentData),true);
            $rentTent = RentTent::find($id);
            $message = "Camping has been updated sucessfully";
        }
        if($request->isMethod('post')) {
           $data = $request->all();
            // return($data);
            $rules = [
                'customer_id' => 'required',
                'tent_id' => 'required',
                'number_of_customer' => 'required|numeric',
                'price' =>'required|numeric',
                'duration' => 'required|numeric',
            ];

            $customMessages = [
                'customer_id.required' => 'Customer Name field is required',
                'tent_id.required' => 'Tent field is required',
                'number_of_customer.required' => 'Number of Customer field is required',
                'number_of_customer.numeric' => 'Invalid format !',
                'price.required' => 'Price is required',
                'price.numeric' => 'Price is invalid ',
                'duration.required' => 'Duration is required',
                'duration.numeric' => 'Duration is invalid',
            ];
            $this->validate($request, $rules, $customMessages);
            // if($id==null){
            //     $getStatus = AllActivity::where('customer_id', $data['customer_id'])->latest()->first();
            //     if(!empty($getStatus->status) && $getStatus->status != 'Paid' && $getStatus->status != 'Cancled'){
            //         return redirect()->back()->with('error_message','Please! Checkout this customor first');
            //     }
            // }
            if(empty($data['number_of_customer']))
            {
                $data['number_of_customer'] = "";
            }
            if(empty($data['total']))
            {
                $data['total'] = "";
            }

            if(empty($data['price']))
            {
                $data['price'] = "";
            }
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
           $tent_id = (['tent_id' => implode(',', (array) $request->input('tent_id'))]);
        //    return ;
            $orderCheck = AllActivity::where(['customer_id'=>$data['customer_id']])->latest()->first();
            $rentTent->admin_id = auth('admin')->user()->id;
            $rentTent->customer_id = $data['customer_id'];
            $rentTent->tent_id = $tent_id['tent_id'];
            $rentTent->number_of_customer = $data['number_of_customer'];
            $rentTent->duration = $data['duration'];
            $rentTent->price = $data['price'];
            $rentTent->total = $data['total'];
            $rentTent->paid = $data['paid'];
            $rentTent->due = $data['due'];
            $rentTent->save();
            if($id==null){
                $camping_id= DB::getPdo()->lastInsertId();
                if(empty($orderCheck->status) ){
                    $newActivity = new AllActivity();
                    $newActivity->camping_id = $camping_id;
                    $newActivity->customer_id = $data['customer_id'];
                    $newActivity->admin_id = auth('admin')->user()->id;
                    $newActivity->status = "New";
                    $newActivity->save();
                }elseif($orderCheck->status == 'Paid' || $orderCheck->status == 'Cancel'){
                    // return "test";
                    $newActivity = new AllActivity();
                    $newActivity->camping_id = $camping_id;
                    $newActivity->customer_id = $data['customer_id'];
                    $newActivity->admin_id = auth('admin')->user()->id;
                    $newActivity->status = "New";
                    $newActivity->save();
                }elseif($orderCheck->status == 'Paid' || $orderCheck->status != 'Cancel'){
                    // return "test2";
                    $newActivity =  AllActivity::where('customer_id', $data['customer_id'])->latest()->first();
                    $newActivity->camping_id = $camping_id;
                    $newActivity->save();
                }
            }else{
                $camping_id= DB::getPdo()->lastInsertId();
                $checkID =  AllActivity::where(['camping_id'=> $id])->first();
                if(!empty($checkID->book_room_id) || !empty($checkID->swimming_id) || !empty($checkID->rafting_id) || !empty($checkID->order_id)) {
                    AllActivity::where('camping_id', $id)->update(['camping_id' => null]);
                }else{
                    AllActivity::where('camping_id', $id)->delete();
                }
                if(empty($orderCheck->status) ){
                    $newActivity = new AllActivity();
                    $newActivity->camping_id = $id;
                    $newActivity->admin_id = auth('admin')->user()->id;
                    $newActivity->customer_id = $data['customer_id'];
                    $newActivity->status = "New";
                    $newActivity->save();
                }
                if(!empty($orderCheck->status) && $orderCheck->status != 'Paid' && $orderCheck->status != 'Cancled'){
                    $newActivity =  AllActivity::where('customer_id', $data['customer_id'])->latest()->first();
                    $newActivity->customer_id = $data['customer_id'];
                    $newActivity->camping_id = $id;
                    $newActivity->save();
                }
            }
            Session::flash('success_message', $message);
            return redirect()->route('admin.rent.tent');
        }
        $tents = Tent::get();
        $customers = Customer::get();
        Session::flash('page', 'rent_tent');
        return view('admin.rentTent.add_edit_rent_tent', compact('title','button','rentTentData', 'customers', 'tents'));
    }
    public function deleteRentTent($id=null) {
        RentTent::where('id', $id)->delete();
        $checkID =  AllActivity::where(['camping_id'=> $id])->first();
        // return 'test';
        if(!empty($checkID->swimming_id) || !empty($checkID->rafting_id) || !empty($checkID->book_room_id) || !empty($checkID->order_id)) {
            AllActivity::where('camping_id', $id)->update(['camping_id' => null]);
        }else{
            // return 'test';
            AllActivity::where('camping_id', $id)->delete();
        }
        return redirect()->back()->with('success_message', 'Camping  has been deleted successfully');
    }

}
