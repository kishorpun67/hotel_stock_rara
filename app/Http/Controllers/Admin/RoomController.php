<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Auth;
use App\Admin\Admin;
use App\Admin\Post;
use Image;
use DB;
use Hash;
use View;
use App\User;
use App\Admin\Checkin;
use App\Admin\Checkout;
use App\Admin\RoomType;
use App\Admin\BookRoom;
use App\Admin\Room;
use App\Customer;
use App\AllActivity;

class RoomController extends Controller
{

    public function rooms()
    {
        $rooms =Room::with('roomType')->get();
        Session::flash('page', 'room');
        return view('admin.room.view_room', compact('rooms'));
    }

    public function addEditRoom(Request $request, $id=null)
    {
        if($id=="") {
            $title = "Add Room";
            $button ="Submit";
            $room = new Room;
            $roomData = array();
            $message = "Room has been added sucessfully";
        }else{
            $title = "Edit Room";
            $button ="Update";
            $roomData = Room::where('id',$id)->first();
            $roomData= json_decode(json_encode($roomData),true);
            $room = Room::find($id);
            $message = "Room has been updated sucessfully";
        }
        if($request->isMethod('post')) {
           $data = $request->all();
        // return($data);
            $rules = [
                'name' => 'required',
                'room_no' =>'required|numeric',
                'price' =>'required|numeric',
                'room_type_id' =>'required',
                'room_size' =>'required',
            ];

            $customMessages = [
                'name.required' => 'Name is required',
                'room_no.required' => 'Room No is required',
                'room_no.numeric' => 'Room No must be number format',
                'price.required' => 'Price is required',
                'price.numeric' => 'Price is invalid ',
                'room_type_id.required' => 'Room Type is required',
                'room_size.required' => 'Room Size is required',

            ];
            $this->validate($request, $rules, $customMessages);
           
            $room->admin_id = auth('admin')->user()->id;
            $room->name = $data['name'];
            $room->room_no = $data['room_no'];
            $room->price = $data['price'];
            $room->room_type_id = $data['room_type_id'];
            $room->room_size = $data['room_size'];
            $room->save();
            Session::flash('success_message', $message);
            return redirect()->route('admin.room');
        }
        $typeofRooms = RoomType::get();
        Session::flash('page', 'room');
        return view('admin.room.add_edit_room', compact('title','button','roomData', 'typeofRooms'));
    }

    public function deleteRoom($id=null)
    {
        Room::where('id', $id)->delete();
        return redirect()->back()->with('success_message', 'Room has been deleted successfully');
    }

    public function bookRooms()
    {
        $bookRooms =BookRoom::orderBy('id', 'desc')->with('room', 'customer')->get();
        Session::flash('page', 'bookRoom');
        return view('admin.room.view_book_room', compact('bookRooms'));
    }
    public function ajaxGetCustomer($id=null)
    {
        $customer = Customer::where('id', $id)->first();
        return response()->json($customer,200);
    }

    public function ajaxGetRoom($id=null)
    {
        $room = Room::with('roomType')->where('id', $id)->first();
        return response()->json($room,200);
    }
    public function addEditBookRoom(Request $request, $id=null)
    {
        if($id=="") {
            $title = "Add Book Room";
            $button ="Submit";
            $bookRoom = new BookRoom;
            $bookRoomData = array();
            $message = "Book Room has been added sucessfully";
        }else{
            $title = "Edit Book Room";
            $button ="Update";
            $bookRoomData = BookRoom::where('id',$id)->first();
            $bookRoomData= json_decode(json_encode($bookRoomData),true);
            $bookRoom = BookRoom::find($id);
            $message = "Book Room has been updated sucessfully";
        }
        if($request->isMethod('post'))
        {
            $data = request()->all();
            // return $data;
            $rules = [
                'arrival_date' => 'required|date',
                'arrival_time' =>'required',
                'depature_date' => 'required|date',
                'depature_time' =>'required',
                'customer_id' =>'required',
                'address' =>'required',
                'contact' =>'required|numeric',
                'room_id' =>'required',
                'pax' =>'required',
                'travel_agent' =>'required',
            ];

            $customMessages = [
                'arrival_date.required' => 'Date is required!',
                'arrival_date.date' => 'Date is not valid format!',
                'arrival_time.required' => 'Time is required!',
                'arrival_time.time' => 'Time is not valid format!',
                'depature_date.required' => 'Date is required!',
                'depature_date.date' => 'Date is not valid format!',
                'depature_time.required' => 'Time is required!',
                // 'depature_time.time' => 'Time is not valid format!',
                'depature_time.required' => 'Time is required!',
                'customer_id.required' => 'Customer name is required!',
                'address.required' => 'Address is required!',
                'contact.required' => 'Contact  is required!',
                'contact.number' => ' Contact is invalid format!',
                // 'contact.between' => 'Contact must be between 10 to 15!',
                'room_id.required' => 'Room is required!',
                'pax.required' => 'Pax is required!',
                'travel_agent.required' => 'Travel Agent is required!',
            ];
            $this->validate($request, $rules, $customMessages);
            $getStatus = AllActivity::where('customer_id', $data['customer_id'])->latest()->first();
            // if($id==null){
            //    $count = AllActivity::where('customer_id', $data['customer_id'])->where('book_room_id', '!=', null)->whereIn('status', ['Paid','Cancel'])->latest()->count();
            //     if($count > 1)  {
            //         return redirect()->back()->with('error_message','Please! Checkout this customor first');
            //     }
            // }
            if(empty($data['advance']))
            {
                $data['advance'] = "";
            }
            if(empty($data['total']))
            {
                $data['total'] = "";
            }
            if(empty($data['room_type']))
            {
                $data['room_type'] = "";
            }
            if(empty($data['additional_charge']))
            {
                $data['additional_charge'] = "";
            }
            if(empty($data['room_charge']))
            {
                $data['room_charge'] = "";
            }
            if(empty($data['discount']))
            {
                $data['discount'] = "";
            }
            if(empty($data['paid']))
            {
                $data['paid'] = "";
            }
            if(empty($data['due']))
            {
                $data['due'] = "";
            }
            if(empty($data['agent_name']))
            {
                $data['agent_name'] = "";
            }
            $room_id = (['room_id' => implode(',', (array) $request->input('room_id'))]);
            $orderCheck = AllActivity::where(['customer_id'=>$data['customer_id']])->latest()->first();

            // return $data;
            $bookRoom->admin_id =  auth('admin')->user()->id;
            $bookRoom->arrival_date = $data['arrival_date'];
            $bookRoom->arrival_time = $data['arrival_time'];
            $bookRoom->depature_time = $data['depature_time'];
            $bookRoom->depature_date = $data['depature_date'];
            $bookRoom->customer_id = $data['customer_id'];
            $bookRoom->address = $data['address'];
            $bookRoom->contact = $data['contact'];
            $bookRoom->pax = $data['pax'];
            // $bookRoom->room_type = $data['room_type'];
            $bookRoom->room_id = $room_id['room_id'];
            $bookRoom->travel_agent = $data['travel_agent'];
            $bookRoom->agent_name = $data['agent_name'];
            $bookRoom->aditional_charge = $data['additional_charge'];
            $bookRoom->discount = $data['discount'];
            $bookRoom->room_charge = $data['room_charge'];
            $bookRoom->advance = $data['advance'];
            $bookRoom->discount = $data['discount'];
            $bookRoom->total = $data['total'];
            $bookRoom->paid = $data['paid'];
            $bookRoom->due = $data['due'];
            $bookRoom->status = "New";
            $bookRoom->save();
            if($id==null){
                $book_room_id= DB::getPdo()->lastInsertId();
                if(empty($orderCheck->status) ){
                    $newActivity = new AllActivity();
                    $newActivity->book_room_id = $book_room_id;
                    $newActivity->customer_id = $data['customer_id'];
                    $newActivity->admin_id = auth('admin')->user()->id;
                    $newActivity->status = "New";
                    $newActivity->save();
                }elseif($orderCheck->status == 'Paid' || $orderCheck->status == 'Cancel'){
                    // return "test";
                    $newActivity = new AllActivity();
                    $newActivity->book_room_id = $book_room_id;
                    $newActivity->customer_id = $data['customer_id'];
                    $newActivity->admin_id = auth('admin')->user()->id;
                    $newActivity->status = "New";
                    $newActivity->save();
                }elseif($orderCheck->status == 'Paid' || $orderCheck->status != 'Cancel'){
                    // return "test2";
                    $newActivity =  AllActivity::where('customer_id', $data['customer_id'])->latest()->first();
                    $newActivity->book_room_id = $book_room_id;
                    $newActivity->save();
                }
            }else{
                $book_room_id= DB::getPdo()->lastInsertId();
                $checkID =  AllActivity::where(['book_room_id'=> $id])->first();
                if(!empty($checkID->swimming_id) || !empty($checkID->rafting_id) || !empty($checkID->camping_id) || !empty($checkID->order_id)) {
                    AllActivity::where('book_room_id', $id)->update(['book_room_id' => null]);
                }else{
                    AllActivity::where('book_room_id', $id)->delete();
                }
                if(empty($orderCheck->status) ){
                    $newActivity = new AllActivity();
                    $newActivity->book_room_id = $id;
                    $newActivity->admin_id = auth('admin')->user()->id;
                    $newActivity->customer_id = $data['customer_id'];
                    $newActivity->status = "New";
                    $newActivity->save();
                }
                if(!empty($orderCheck->status) && $orderCheck->status != 'Paid' && $orderCheck->status != 'Cancled'){
                    $newActivity =  AllActivity::where('customer_id', $data['customer_id'])->latest()->first();
                    $newActivity->customer_id = $data['customer_id'];
                    $newActivity->book_room_id = $id;
                    $newActivity->save();
                }
            }
            Session::flash('success_message', $message);
            return redirect()->route('admin.book.room');
        }
        $rooms = Room::get();
        $customers =Customer::get();
        Session::flash('page', 'bookRoom');
        return view('admin.room.add_edit_book_room', compact('title','button','bookRoomData', 'rooms', 'customers'));
    
    }

    public function checkoutRoom($id=null)
    {
        $data = request()->all();
        // return $id;
        $checkoutRoom = BookRoom::where('id',$id)->first();
        $checkoutRoom->aditional_charge = $data['additional_charge'];
        $checkoutRoom->discount = $data['discount'];
        $checkoutRoom->room_charge = $data['room_charge'];
        $checkoutRoom->advance = $data['advance'];
        $checkoutRoom->discount = $data['discount'];
        $checkoutRoom->total = $data['total'];
        $checkoutRoom->paid = $data['paid'];
        $checkoutRoom->due = $data['due'];
        $checkoutRoom->status = "Paid";
        $checkoutRoom->save();
        return redirect()->route('admin.room.bill.print', $id);
        // return redirect()->action("RoomController@roomBillPrint");

    }

    public function roomBillPrint($id=null)
    {
        $billingRoom = BookRoom::where('id',$id)->first();
        // return $billingRoom;
        $customer = Customer::where('id', $billingRoom->customer_id)->first();
        return view('admin.room.room_bill_print', compact('billingRoom', 'customer'));
    }
    public function deleteBookRoom($id=null)
    {
        // return $id;
        BookRoom::where('id', $id)->delete();
        $checkID =  AllActivity::where(['book_room_id'=> $id])->first();
        // return 'test';
        if(!empty($checkID->swimming_id) || !empty($checkID->rafting_id) || !empty($checkID->camping_id) || !empty($checkID->order_id)) {
            AllActivity::where('book_room_id', $id)->update(['book_room_id' => null]);
        }else{
            // return 'test';
            AllActivity::where('book_room_id', $id)->delete();
        }
        return redirect()->back()->with('success_message', 'Book Room has been deleted successfully');
    }

}
