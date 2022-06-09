<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Admin\Banner;
use Image;
use PhpParser\Node\Expr\FuncCall;

class BannerController extends Controller
{
    
    public function banner()
    {
        $banner = Banner::where('admin_id',auth('admin')->user()->id)->get();
        Session::flash("page", 'banner');
        return view('admin.banner.banner', compact('banner'));
    }

    public function updateBannerStatus()
    {
        if(request()->ajax()) {
            $data = request()->all();
            if($data['status']=="Active") {
                $status = 0;
            }else {
                $status = 1;
            }
            Banner::where('admin_id',auth('admin')->user()->id)->where('id', $data['banner_id'])->update(['status' => $status]);
            return response()->json(['status' =>$status,'banner_id' =>$data['banner_id']]);
        }
    }

    public function add(Request $request)
    {
        $data = $request->all();
        // dd($data);
        $rules = [
            'name' => 'required|regex:/^[\pL\s\-]+$/u',
            'address' =>'required',
            'email' =>'required',
            'phone' =>'required|between:10,20',
            'vehicle_no' =>'required|',
            'password' =>'required|between:8,20',

        ];

        $customMessages = [
            'name.required' => 'Name is required',
            'name.alpha' => 'alpha charcter is required',
            'address.required' => 'address is required',
            'phone.required' => 'phone is required',
            'phone.between' => 'enter between 10 to 20 ',
            'password.between' => 'your password at lest 8 charater is required',
        ];
        // $this->validate($request, $rules, $customMessages);
        $item = new Banner;
        if(empty($data['image'])){
            $data['image']='';
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
                $imagePath = 'image/banner/'.$imageName;
                $result = Image::make($image_tmp)->save($imagePath);
                // dd($result);

            }
        }
        $item->admin_id = auth('admin')->user()->id;
        $item->title_first = $data['title_first'];
        $item->title_second = $data['title_second'];
        $item->description = $data['description'];
        $item->status = 1;
        $item->image = $imagePath;
        $item->save();
        return redirect()->back()->with('success_message', 'Item has been added successfully!');
    }

    public function edit(Request $request, $id)
    {
        $data = $request->all();
        $item =  Banner::find($id);
        if(empty($data['image'])){
            $imagePath = $data['old_image'];
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
                $imagePath = 'image/banner/'.$imageName;
                $result = Image::make($image_tmp)->save($imagePath);
                // dd($result);
            }
        }
        $item->title_first = $data['title_first'];
        $item->title_second = $data['title_second'];
        $item->description = $data['description'];

        $item->image = $imagePath;
        $item->save();

        return redirect()->back()->with('success_message', 'Item has been updated successfully!');
    }
    public function delete($id)
    {
        Banner::where('admin_id',auth('admin')->user()->id)->where('id', $id)->delete();
        return redirect()->back()->with('success_message', 'Item has been deleted successfully!');
    }
}
