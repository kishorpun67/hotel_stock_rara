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
use App\Admin\Role;
use App\Admin\Permission;
use App\Admin\AdminPermission;
use App\IngredientItem;
use App\Order;
use App\Waste;
use Carbon\Carbon;
use App\PaymentMethod;
class AdminController extends Controller
{
    public function dashboard()
    {

        // return auth('admin')->user()->hasPermission(26);
        // if(auth('admin')->user()->hasPermission($roles[$permission]))
        $admin = Auth('admin')->user();
        $permission = Permission::get();
        // return$admin->hasPermission($permission);
        
        Session::flash('page', 'dashboard');
        return view('admin.admin_dashboard');
    }

    public function settings()
    {
        Session::flash('page', 'setting');
        return View::make('admin.admin_settings');
    }
    public function register(Request $request)
    {
        if($request->isMethod('post')) {
            $data = $request->all();
            // return $data;
            //  $paasword= Hash::make($data['password']);
            // return ($data['email']);

            $rules = [
                'email' => 'required|eamil|max:255',
                'password' => 'required',
            ];
            $customMessages = [
                'email.required' => 'Email is required',
                'email.email' => 'Valild Email is required',
                'password.required' => 'Password is required',
            ];
            // $this->validate($request, $rules, $customMessages);
            $count = Admin::where('email', $data['email'])->count();
            if($count >=1){
                Session::flash('error_message', 'Email already exists');
                return redirect()->back();
            }
            $count = Admin::where('number', $data['phone'])->count();
            if($count >=1){
                Session::flash('error_message', 'Number already exists');
                return redirect()->back();
            }
            $newAdmin = new Admin();
            $newAdmin->role_id = 1;
            $newAdmin->name = $data['name'];
            $newAdmin->hotel = $data['hotel'];
            $newAdmin->number = $data['phone'];
            $newAdmin->email = $data['email'];
            $newAdmin->password = Hash::make( $data['password']);
            $newAdmin->save();
            Session::flash('success_message', 'Your Account has create sucessfully');
            return redirect('/admin');
            
        }
        return  View::make('admin.admin_register');
    }
    public function login(Request $request)
    {

        if($request->isMethod('post')) {
            $data = $request->all();
            // return $data;
            //  $paasword= Hash::make($data['password']);
            // return ($data['email']);

            $rules = [
                'email' => 'required|eamil|max:255',
                'password' => 'required',
            ];
            $customMessages = [
                'email.required' => 'Email is required',
                'email.email' => 'Valild Email is required',
                'password.required' => 'Password is required',
            ];
            // $this->validate($request, $rules, $customMessages);
            //  $datas= Admin::where('email', $data['email'])->first();
            //  $datas->password =$paasword;
            //  $datas->save();
            $remember_me = $request->has('remember') ? true : false;
            // return;
            if(Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']], $remember_me)) {
                return redirect('admin/dashboard');
            }else{
                Session::flash('error_message', 'Invalid Email or Password');
                return redirect()->back();
            }
        }
        if(Auth::guard('admin')->check()){
            return redirect('admin/dashboard');

        }
        return  View::make('admin.admin_login');
    }

    public function checkCurrentPassword(Request $request)
    {
        $data = $request->all();
        if(Hash::check($data['current_password'],Auth::guard('admin')->user()->password))
        {
            echo "true";
        }else{
            echo"false";
        }
    }

    public function updateCurrentPassword(Request $request)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            // return $data->id;
            // check current password
            if(Hash::check($data['current_password'],Auth::guard('admin')->user()->password)) {

                // check new password ana confirm password
                if($data['new_password']==$data['confirm_password']){
                    Admin::where('id',Auth::guard('admin')->user()->id)->update(['password' => bcrypt($data['new_password'])]);
                    Session::flash('success_message', 'Password has been changed sucessfully');
                }else{
                    Session::flash('error_message', 'New Password and Confirm Password is not Match');
                }

            }else{
                Session::flash('error_message', 'Your Current Password is Incorrect');
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
                $this->validate($request, $rules, $customMessages);
                if(empty($data['image'])){
                    $data['image']='';
                    $imagePath = Auth::guard('admin')->user()->image;
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
                Admin::where('email',Auth::guard('admin')->user()->email)->update([
                    'name'=>$data['name'],
                    'number' =>$data['number'],
                    'image' => $imagePath,
                ]);
                Session::flash('success_message', 'Admin details update sucessfully');
                return redirect()->back();
            }
            Session::flash('page', 'updateAdminDetail');
            return view('admin.admin_update');
    }

    public function logout()
    {
        // Auth::logout();
        // Auth::logout();
        Auth::guard('admin')->logout();
        return redirect('/admin')->with('success_message', 'Logout Successfully!');
    }

      


    public function viewUser()
    {
        if(auth('admin')->user()->type != "Admin"){
            return redirect()->route('admin.dashboard');
        }
        $admins = Admin::with('subAdminRole')->where('parent_id', auth('admin')->user()->id)->get();
        $admin_roles = Role::where('id', ">",2)->get();
        Session::flash('page', 'admin_roles');
        return view('admin.user.view_user', compact('admins', 'admin_roles'));
    
    }

    public function addEditUser($id=null)
    {
        if(auth('admin')->user()->type != "Admin"){
            return redirect()->route('admin.dashboard');
        }
        if($id=="") {
            $title = "Add User";
            $button ="Submit";
            $newAdmin = new Admin;
            $adminData = array();
            $message = "Ingredient units has been added sucessfully";
        }else{
            $title = "Edit Ingredient Items";
            $button ="Update";
            $adminData = Admin::where('parent_id',auth('admin')->user()->id)->where('id',$id)->first();
            $adminData= json_decode(json_encode($adminData),true);
            $newAdmin = Admin::find($id);
            $message = "Ingredient Items has been updated sucessfully";
        }
        if(request()->isMethod('POST')){
            $data = request()->all();

            $rules = [
                'name'=>'required',
                'email' => 'required|email',
                'number'=>'required',
            ];
            $customMessages = [
                'name.required'=>'Name is required',
                'email.required' => 'Email is required',
                'number.required'=>'Number is required',
                'email.email' => 'Valild Email is required',
            ];
            $this->validate(request(), $rules, $customMessages);
            if(empty($data['image']) && !empty($data['old_image'])){
                $imagePath = $data['old_image'];
            }
            if(empty($data['old_image']))
            {
                $imagePath = "";
            }
            if(empty($data['role_id']))
            {
                $data = 0;
            }
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
            $newAdmin->parent_id = auth('admin')->user()->id;
            $newAdmin->email = $data['email'];
            $newAdmin->price = $data['price'];
            $newAdmin->number = $data['number'];
            $newAdmin->role_id = $data['role_id'];
            $newAdmin->will_login = $data['will_login'];
            if(!empty($data['password'])){
                $newAdmin->password = Hash::make($data['password']);
            }
            $newAdmin->save();
            if(!empty($id)){
                AdminPermission::where('admin_id',$id)->delete();
            }else{
                $id = DB::getPdo()->lastInsertId();

            }
            if(!empty($data['checkbox'])){
                foreach($data['checkbox'] as $datas){
                    $newPermission = new AdminPermission();
                    $newPermission->admin_id = $id;
                    $newPermission->permission_id =  $datas;
                    $newPermission->save();
                }
            }
            
            
            return redirect()->route('admin.user')->with('success_message', $message);

        }
        Session::flash('page', 'admin_roles');
        $roles = Role::where('id','>',2)->get();
        $permissions = Permission::get();

        return view('admin.user.add_edit_user', compact('adminData', 'roles','button', 'title', 'permissions'));
        
    }
    public function deleteUser($id)
    {
        if(auth('admin')->user()->type != "Admin"){
            return redirect()->route('admin.dashboard');
        }
        Admin::where('id', $id)->delete();
        return redirect()->back()->with('success_message','Admin has been deleted sucessfully successfully!');            

    }
}
