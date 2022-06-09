<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin\Category;
use Session;
use App\Admin\Post;
use Image;
use App\Admin\Type;

class PostController extends Controller
{
    public function item()
    {
        if(auth('admin')->user()->parent_id > 0){
            $admin_id = auth('admin')->user()->parent_id;
        }else{
            $admin_id = auth('admin')->user()->id;
        }
        $categories = Category::with('subcategories')->where(['parent_id' =>0])->get();
        $item = Post::with(['category'])->where('admin_id', auth('admin')->user()->id)->get();
        $types = Type::get();
        Session::flash("page", 'post');
        return view('admin.item.item', compact('categories', 'item', 'types'));
    }
    
    public function updatePostStatus()
    {
        if(request()->ajax()) {
            $data = request()->all();
            if($data['status']=="Active") {
                $status = 0;
            }else {
                $status = 1;
            }
            Post::where('id', $data['item_id'])->update(['status' => $status]);
            return response()->json(['status' =>$status,'item_id' =>$data['item_id']]);
        }
    }

    public function add(Request $request)
    {
        $data = $request->all();
        if(auth('admin')->user()->parent_id > 0){
            $admin_id = auth('admin')->user()->parent_id;
        }else{
            $admin_id = auth('admin')->user()->id;
        }
        // dd($data);
        $rules = [
            'category_id' => 'required',
            'name' =>'required',
            'price' =>'required',
            'url' =>'required',

        ];

        $customMessages = [
            'category_id.required' => 'Please select category',
            'name.required' => 'Item name field is required',
            'price.required' => 'price field is required',
            'url.required' => 'Url field is required',

        ];
        $this->validate($request, $rules, $customMessages);

        if(empty($data['description'])){
            $data['description']='';
        }
        if(empty($data['meta_title']))
        {
            $data['meta_title'] = "";
        }
        if(empty($data['meta_description']))
        {
            $data['meta_description'] = "";
        }
        if(empty($data['meta_keywords']))
        {
            $data['meta_keywords'] = "";
        }
        $post = new Post;
        $post->admin_id = $admin_id;
        $post->category_id =  $data['category_id'];
        $post->type_id =  $data['type_id'];
        $post->expire_days =  $data['expire_days'];
        $post->price_type =  $data['price_type'];
        $post->title = $data['name'];
        $post->details = $data['description'];
        $post->price = $data['price'];
        $post->url = $data['url'];
        $post->confirm_status = "New";
        $post->meta_title = $data['meta_title'];
        $post->meta_description = $data['meta_description'];
        $post->meta_keywords = $data['meta_keywords'];

        $post->status = 1;
        if(empty($data['image'])){
            $data['image']='';
            $imagePath = "";
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
                $imagePath = 'image/item'.$imageName;
                $result = Image::make($image_tmp)->addsave($imagePath);
                // dd($result);

            }
        }
        $post->image = $imagePath;
        $post->save();
        return redirect()->back()->with('success_message', 'Item has been added successfully!');
    }

    public function edit(Request $request, $id)
    {
        $data = $request->all();
        $rules = [
            'category_id' => 'required',
            'name' =>'required',
            'price' =>'required',
            'url' =>'required',

        ];

        $customMessages = [
            'category_id.required' => 'Please select category',
            'name.required' => 'Item name field is required',
            'price.required' => 'Price field is required',
            'url.required' => 'Url field is required',

        ];
        $this->validate($request, $rules, $customMessages);
        if(auth('admin')->user()->parent_id > 0){
            $admin_id = auth('admin')->user()->parent_id;
        }else{
            $admin_id = auth('admin')->user()->id;
        }
        if(empty($data['description'])){
            $data['description']='';
        }
        
        if(empty($data['meta_title']))
        {
            $data['meta_title'] = "";
        }
        if(empty($data['meta_description']))
        {
            $data['meta_description'] = "";
        }
        if(empty($data['meta_keywords']))
        {
            $data['meta_keywords'] = "";
        }
        $post =  Post::find($id);
        if(empty($data['image']) && !empty($data['old_image'])){
            $imagePath = $data['old_image'];
        }
        if(empty($data['old_image']))
        {
            $imagePath = "";
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
                $imagePath = 'image/item'.$imageName;
                $result = Image::make($image_tmp)->save($imagePath);
                // dd($result);
            }
        }
        $post->admin_id = $admin_id;
        $post->type_id =  $data['type_id'];
        $post->category_id =  $data['category_id'];
        $post->expire_days =  $data['expire_days'];
        $post->price_type =  $data['price_type'];
        $post->title = $data['name'];
        $post->details = $data['description'];
        $post->price = $data['price'];
        $post->url = $data['url'];
        $post->meta_title = $data['meta_title'];
        $post->meta_description = $data['meta_description'];
        $post->meta_keywords = $data['meta_keywords'];

        $post->image = $imagePath;
        $post->save();

        return redirect()->back()->with('success_message', 'Item has been updated successfully!');
    }
    public function delete($id)
    {
        Post::where('id', $id)->delete();
        return redirect()->back()->with('success_message', 'Item has been deleted successfully!');
    }
}
