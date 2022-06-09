<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\FoodMenu;
use App\Consumption;
use DB;
use Dotenv\Result\Success;

class FoodMenuController extends Controller
{
    public function foodMenu()
    
    {
        $foodMenus = FoodMenu::orderBy('id', 'DESC')->with('foodCategory','consumption')->get();
        return  response($foodMenus,200);
    }
    public function singleFoodMenu($id=null)
    {
        $foodMenusCount = FoodMenu::where('id', $id)->with('foodCategory','consumption')->count();
        if($foodMenusCount==0){
            return response()->json('record not match!' ,200);
        }

        $foodMenus = FoodMenu::where('id', $id)->with('foodCategory','consumption')->first();
        return  response($foodMenus,200);
    }

    public function addFoodMenu()
    {
         
        $data =request()->all();
        if(empty($data['name'])){
            return redirect()->back()->with('error_message', 'food menu name is required !');
        }
               
        if(empty($data['sale_price']))
        {
            $data['sale_price'] = "";
        }
           
        if(empty($data['category_id']))
        {
            $data['category_id'] = "";
        }
        if(empty($data['item_id']))
        {
            $data['item_id'] = "";
        }
           
        if(empty($data['description']))
        {
            $data['description'] = "";
        }
        if(empty($data['ingredient_id']))
        {
            $data['ingredient_id'] = "";
        }
        if(empty($data['code']))
        {
            $data['code'] = "";
        }

        $foodMenu = new FoodMenu();


        if(!empty($data['image'])){
            $image_tmp = $data['image'];
            // dd($image_tmp);
            if($image_tmp->isValid())
            {
                // get extension
                $extension = $image_tmp->getClientOriginalExtension();
                // generate new image name
                $imageName = rand(111,99999).'.'.$extension;
                $imagePath = 'image/menu'.$imageName;
                $result = Image::make($image_tmp)->save($imagePath);
                // dd($result);
                $foodMenu->image =$imagePath;
            }
            
        }
        $foodMenu->admin_id = auth()->user()->id;
        $foodMenu->name = $data['name'];
        $foodMenu->sale_price = $data['sale_price'];
        $foodMenu->category_id = $data['category_id'];
        $foodMenu->description = $data['description'];
        $foodMenu->ingredient_id = $data['item_id'];
        $foodMenu->code = $data['code'];
        $foodMenu->is_kitchen = $data['is_kitchen'];
        $foodMenu->is_bar = $data['is_bar'];
        $foodMenu->is_caffe = $data['is_caffe'];
        $foodMenu->save();
        $id = DB::getPdo()->lastInsertId();
        foreach($data['ingredient_id'] as $key=> $val)
        {
            $newConsumption = new Consumption;
            $newConsumption->ingredient_id = $val;
            $newConsumption->ingredientUnit_id = $data['ingredientUnit_id'][$key];
            $newConsumption->price = $data['price'][$key];
            $newConsumption->foodMenu_id = $id;
            $newConsumption->ingredient_name = $data['ingredient_name'][$key];
            $newConsumption->consumption_quantity = $data['consumption_quantity'][$key];
            $newConsumption->save();
        }

        return response()->json('success',200);
    }

    public function  editFoodMenu()
    {
        $data =request()->all();
        if(empty($data['name'])){
            return redirect()->back()->with('error_message', 'food menu name is required !');
        }
               
        if(empty($data['sale_price']))
        {
            $data['sale_price'] = "";
        }
           
        if(empty($data['category_id']))
        {
            $data['category_id'] = "";
        }
        if(empty($data['item_id']))
        {
            $data['item_id'] = "";
        }
           
        if(empty($data['description']))
        {
            $data['description'] = "";
        }
        if(empty($data['ingredient_id']))
        {
            $data['ingredient_id'] = "";
        }
        if(empty($data['code']))
        {
            $data['code'] = "";
        }

        $foodMenu =  FoodMenu::find($data['id']);


        if(!empty($data['image'])){
            $image_tmp = $data['image'];
            // dd($image_tmp);
            if($image_tmp->isValid())
            {
                // get extension
                $extension = $image_tmp->getClientOriginalExtension();
                // generate new image name
                $imageName = rand(111,99999).'.'.$extension;
                $imagePath = 'image/menu'.$imageName;
                $result = Image::make($image_tmp)->save($imagePath);
                // dd($result);
                $foodMenu->image =$imagePath;
            }
            
        }
        $foodMenu->admin_id = auth()->user()->id;
        $foodMenu->name = $data['name'];
        $foodMenu->sale_price = $data['sale_price'];
        $foodMenu->category_id = $data['category_id'];
        $foodMenu->description = $data['description'];
        $foodMenu->ingredient_id = $data['item_id'];
        $foodMenu->code = $data['code'];
        $foodMenu->is_kitchen = $data['is_kitchen'];
        $foodMenu->is_bar = $data['is_bar'];
        $foodMenu->is_caffe = $data['is_caffe'];
        $foodMenu->save();
        foreach($data['consumption_id'] as $key=> $val)
        {
            $newConsumption =  Consumption::find($val);
            $newConsumption->consumption_quantity = $data['consumption_quantity'][$key];
            $newConsumption->save();
        }

        return response()->json('success',200);
    }
    
    public function deleteFoodMenu()
    {
      $id =FoodMenu::find(request('id'));
      if(empty($id)){
        return response()->json('Id is not found',200);

      }
      $id->delete();
      return response()->json('success',200);

    }

}
