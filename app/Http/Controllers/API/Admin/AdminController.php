<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin\Admin;
use Hash;
use App\Admin\AdminPermission;
use App\Admin\Role;
use Image;
use DB;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        $user=  Admin::where('email', $request->email)->first();
        // print_r($data);
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response([
                    'message' => ['These credentials do not match our records.']
                ], 404);
            }

                $token = $user->createToken('my-app-token')->plainTextToken;
                // $response = \Session::put('token', $token);
            $response = [
                'user' => $user,
                'token' => $token
            ];
            return response()->json($response, 200);
    }

    public function staff()
    {
        $saff = Admin::where('role_id','>',2)->get();
        return response()->json($saff, 200);
    
    }

    public function updateCurrentPassword(Request $request)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            // return $data->id;
            // check current password
            if(Hash::check($data['current_password'],auth()->user()->password)) {

                // check new password ana confirm password
                if($data['new_password']==$data['confirm_password']){
                    Admin::where('id',auth()->user()->id)->update(['password' => Hash::make($data['new_password'])]);
                    return response()->json('Password has been changed sucessfully!',);
                }else{
                    return response()->json('New Password and Confirm Password is not Match!',);
                }

            }else{
                return response()->json('Your Current Password is Incorrect!',200);
            }
            return redirect()->back();
        }
    }
    public function updateAdminDetails(Request $request)
    {
        if($request->isMethod('post'))
            {
                $data = $request->all();
                // dd($data);
                $rules = [
                    'name' => 'required|regex:/^[\pL\s\-]+$/u',
                    'number' =>'required|between:10,20',
                    'image' =>'image:jpeg, png, bmp, gif',
                ];

                $customMessages = [
                    'name.required' => 'Name is required',
                    'name.alpha' => 'alpha charcter is required',
                    'number.required' => 'number is required',
                    'number.between' => 'enter between 10 to 20 ',
                    'image.image' =>'file must be image',
                ];
                // $this->validate($request, $rules, $customMessages);
                if(empty($data['image'])){
                    $data['image']='';
                    $imagePath = auth()->user()->image;
                }
                if($data['image']){
                    $image_tmp = $data['image'];
                    // dd($image_tmp);
                    if($image_tmp->isValid())
                    {
                        // get extension
                        $extension = $image_tmp->getClientOriginalExtension();
                        // generate new image name
                        $imageName = rand(111,99999).'.'.$extension;
                        $imagePath = 'image/admin_image/admin_photos/'.$imageName;
                        $result = Image::make($image_tmp)->resize(163,61)->save($imagePath);
                        // dd($result);

                    }else if(!empty($data['current_admin_image'])) {
                        $imagePath = $data['current_admin_image'];
                    }else{
                        $imagePath = "";
                    }
                }
                Admin::where('email',auth()->user()->email)->update([
                    'name'=>$data['name'],
                    'number' =>$data['number'],
                    'image' => $imagePath,
                ]);
                return response()->json('Admin details update sucessfully', 200);
                return redirect()->back();
            }
    }
    public function viewUser()
    {
        if(auth()->user()->type != "Admin"){
            return redirect()->route('admin.dashboard');
        }
        $admins = Admin::with('subAdminRole')->where('parent_id', auth()->user()->id)->get();
       return response($admins,200);
    
    }

    public function addUser()
    {
        if(auth()->user()->type != "Admin"){
            return response()->json('Your are not allowed!',200);
            // return redirect()->route('admin.dashboard');
        }  
        $data = request()->all();

        $userCount = Admin::where('email', $data['email'])->count();
        if($userCount >= 1){
            return response()->json('Email is already exists!');
        }

        if(empty($data['old_image']))
        {
            $imagePath = "";
        }
        if(empty($data['role_id']))
        {
            $data = 0;
        }

        $newAdmin = new Admin;
        if(!empty($data['image'])){
            $image_tmp = $data['image'];
            // dd($image_tmp);
            if($image_tmp->isValid())
            {
                // get extension
                $extension = $image_tmp->getClientOriginalExtension();
                // generate new image name
                $imageName = rand(111,99999).'.'.$extension;
                $imagePath = 'image/admin_image/admin_photos/'.$imageName;
                $result = Image::make($image_tmp)->resize(183,196)->save($imagePath);
                $newAdmin->image = $imagePath;
            }
        }
        $newAdmin->name = $data['name'];
        $newAdmin->parent_id = auth()->user()->id;
        $newAdmin->email = $data['email'];
        $newAdmin->number = $data['number'];
        $newAdmin->role_id = $data['role_id'];
        $newAdmin->will_login = $data['will_login'];
        $newAdmin->password = Hash::make($data['password']);
        $newAdmin->save();
        $id = DB::getPdo()->lastInsertId();

        if(!empty($data['permissoin_id'])){
            foreach($data['permissoin_id'] as $datas){
                $newPermission = new AdminPermission();
                $newPermission->admin_id = $id;
                $newPermission->permission_id =  $datas;
                $newPermission->save();
            }
        }
        return response()->json('Success', 200);
    }
    public function editUser()
    {
        if(auth()->user()->type != "Admin"){
            return response()->json('Your are not allowed!',200);
            // return redirect()->route('admin.dashboard');
        }  
        $data = request()->all();

        

        if(empty($data['old_image']))
        {
            $imagePath = "";
        }
        if(empty($data['role_id']))
        {
            $data = 0;
        }

        $newAdmin =  Admin::find($data['id']);
        if(!empty($data['image'])){
            $image_tmp = $data['image'];
            // dd($image_tmp);
            if($image_tmp->isValid())
            {
                // get extension
                $extension = $image_tmp->getClientOriginalExtension();
                // generate new image name
                $imageName = rand(111,99999).'.'.$extension;
                $imagePath = 'image/admin_image/admin_photos/'.$imageName;
                $result = Image::make($image_tmp)->resize(183,196)->save($imagePath);
                $newAdmin->image = $imagePath;
            }
        }
        $newAdmin->name = $data['name'];
        $newAdmin->parent_id = auth()->user()->id;
        $newAdmin->email = $data['email'];
        $newAdmin->number = $data['number'];
        $newAdmin->role_id = $data['role_id'];
        $newAdmin->will_login = $data['will_login'];
        // $newAdmin->password = Hash::make($data['password']);
        $newAdmin->save();
       
        AdminPermission::where('admin_id', request('id'))->delete();

        if(!empty($data['permissoin_id'])){
            foreach($data['permissoin_id'] as $datas){
                $newPermission = new AdminPermission();
                $newPermission->admin_id = request('id');
                $newPermission->permission_id =  $datas;
                $newPermission->save();
            }
        }
        return response()->json('Success', 200);
        
    }
    public function deleteUser()
    {
        if(auth()->user()->type != "Admin"){
            return redirect()->route('admin.dashboard');
        }
        $id = Admin::find(request('id'));
        if(empty($id)){
          return response()->json('Id is not found',200);
        }
        $id->delete();
        return response()->json('success',200);
    }

}
