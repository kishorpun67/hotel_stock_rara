<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin\Category;
use App\Admin\Developer;
use Session;

class CategoryController extends Controller
{
    public function categories()
    {
        $categories = Category::with(['parentcategory'])->where('admin_id',auth('admin')->user()->id)->get();
        Session::flash('page', 'category');
        return view('admin.categories.categories', compact('categories'));
    }
    public function updateCategoryStatus(Request $request)
    {
        if($request->ajax()) {
            $data = $request->all();
            if($data['status']=="Active") {
                $status = 0;
            }else {
                $status = 1;
            }
            Category::where('admin_id',auth('admin')->user()->id)->where('id', $data['category_id'])->update(['status' => $status]);
            return response()->json(['status' =>$status,'category_id' =>$data['category_id']]);
        }
    }
    public function addEditCategory(Request $request, $id=null)
    {
        if($id=="") {
            $title = "Add Category";
            $button ="Submit";
            $category = new Category;
            $categorydata = array();
            $categories = Category::with('subcategories')->where(['parent_id' =>0, 'admin_id'=> auth('admin')->user()->id])->get();
            $categories= json_decode(json_encode($categories),true);
            $message = "Category has been added sucessfully";
        }else{
            $title = "Edit Category";
            $button ="Update";
            $count = Category::where('admin_id',auth('admin')->user()->id)->where('id',$id)->count();
            if($count <=0){
                abort(404);
            }
            $categorydata = Category::where('admin_id',auth('admin')->user()->id)->where('id',$id)->first();
            $categorydata= json_decode(json_encode($categorydata),true);
            $categories = Category::with('subcategories')->where(['parent_id' =>0])->get();
            $categories= json_decode(json_encode($categories),true);
            $category = Category::find($id);
            $message = "Category has been updated sucessfully";
        }
        if($request->isMethod('post')) {
            $data = $request->all();
            // dd($data);
            if(empty($data['category'])){
                return redirect()->back()->with('error_message', 'Category name is required !');
            }
            if(empty($data['url']))
            {
                return redirect()->back()->with('error_message', 'Url name is required !');
            }
            if(empty($data['description']))
            {
                $data['description'] = "";
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
            // if(empty($data['parent_id']))
            // {
            //     $data['parent_id'] = "";
            // }
            $category->parent_id = $data['parent_id'];
            $category->category = $data['category'];
            $category->url = $data['url'];
            $category->show_header = $data['show_header'];
            $category->status = 1;
            $category->admin_id = auth('admin')->user()->id;
            $category->meta_title = $data['meta_title'];
            $category->meta_description = $data['meta_description'];
            $category->meta_keywords = $data['meta_keywords'];
            $category->save();
            Session::flash('success_message', $message);
            return redirect('admin/categories');
        }
        Session::flash('page', 'category');
        return view('admin.categories.add_edit_category', compact('title','button','categorydata','categories'));
    }

    public function deleteCategory($id)
    {
      $id =Category::find($id);
      $id->delete();
      return redirect()->back()->with('success_message', 'Category has been delete successfully!');

    }
}
