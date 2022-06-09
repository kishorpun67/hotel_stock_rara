<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin\TestMonial;
use Session;
use Image;

class TestimonialController extends Controller
{
    public function testimonial()
    {
        $testimonial = TestMonial::get();
        Session::flash('page', 'testimonial');

        return view('admin.testimonial.testimonial', compact( 'testimonial'));
    }
    public function addEditTestimonail(Request $request, $id=null)
    {
        if($id=="") {
            $testimonial = new  TestMonial;
            $message = "Testimonial has been added sucessfully";
        }else{            
            $testimonial = TestMonial::find($id);
            $message = "Testimonial has been updated sucessfully";
        }
        if($request->isMethod('post')) {
            $data = $request->all();
            // dd($data);
            if(empty($data['porfession'])){
                 $data['porfession'] = "" ;
            }
            if(empty($data['description']))
            {
                $data['description'] =  '';
            }
            if(empty($data['image']))
            {
                $data['image'] = "";
            }
            if($data['image']){
                if ($request->hasFile('image')) {
                    $image_tmp = $data['image'];
            // dd($image_tmp);
                if($image_tmp->isValid())
                {
                    // get extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    // generate new image name
                    $imageName = rand(111,99999).'.'.$extension;
                    $imagePath = 'image/item'.$imageName;
                    $result = Image::make($image_tmp)->resize(570,380)->save($imagePath);
                    $testimonial->image = $imagePath;

                    // dd($result);
                }
                   
                }
            }           
            $testimonial->name = $data['name'];
            $testimonial->porfession = $data['porfession'];
            $testimonial->description = $data['description'];
            $testimonial->status = 1;
            $testimonial->save(); 
            Session::flash('success_message', $message);
            return redirect()->back();
            // return redirect('admin/categories');
        }
        // $categories = Category::with('subcategories')->where(['parent_id' =>0])->get();

        Session::flash('page', 'testimonial');
        // return view('admin.categories.add_edit_category', compact('title','button','categorydata','categories'));
    }

    public function deleteTestimonail($id)
    {
        $id =TestMonial::where('id', $id)->delete();

      return redirect()->back()->with('success_message', 'Testimonial has been delete successfully!');

    }
}
