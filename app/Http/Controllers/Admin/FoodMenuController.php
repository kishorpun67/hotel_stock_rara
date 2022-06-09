<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\FoodMenu;
use App\IngredientItem;
// use App\IngredientUnit;
use App\FoodCategory;
use App\foodTable;
use Image;
use Session;
use DB;
use App\Consumption;

class FoodMenuController extends Controller
{
    public function foodMenus()
    {
        $foodMenus = FoodMenu::orderBy('id', 'DESC')->with('foodCategory','ingredientItem')->get();
        Session::flash('page', 'foodMenu');
        return view('admin.foodMenus.view_food_menus', compact('foodMenus'));
    }

    public function addEditFoodMenu(Request $request, $id=null)
    {
        if($id=="") {
            $title = "Add Food Menu";
            $button ="Submit";
            $foodMenu = new FoodMenu;
            $foodMenusData = array();
            $message = "food menus has been added sucessfully";
        }else{
            $title = "Edit Food Menu";
            $button ="Update";
            $foodMenusData = FoodMenu::with('consumption')->where('admin_id',auth('admin')->user()->id)->where('id',$id)->first();
            $foodMenusData= json_decode(json_encode($foodMenusData),true);
            $foodMenu = FoodMenu::find($id);
            $message = "Food Menus has been updated sucessfully";
        }
        if($request->isMethod('post')) {


            $data = $request->all();
            $rules = [
                'name' => 'required',
            ];
            $customMessages = [
                'email.required' => 'Menu Name is required!',
            ];
            $this->validate($request, $rules, $customMessages);
            //dd($data);
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
           
            $foodMenu->admin_id = auth('admin')->user()->id;
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
            
            if(empty($id)){
                $id = DB::getPdo()->lastInsertId();
                foreach($data['id'] as $key=> $val)
                {
                    $newConsumption = new Consumption;
                    $newConsumption->ingredient_id = $data['ingredient_id'][$key];
                    $newConsumption->ingredientUnit_id = $data['ingredientUnit_id'][$key];
                    $newConsumption->price = $data['price'][$key];
                    $newConsumption->foodMenu_id = $id;
                    $newConsumption->ingredient_name = $data['ingredient_name'][$key];
                    $newConsumption->consumption_quantity = $data['consumption_quantity'][$key];
                    $newConsumption->save();
                    foodTable::where('id', $val)->delete();
                }
                
            }else{
                foreach($data['id'] as $key=> $val)
                {
                    $newConsumption =  Consumption::find($val);
                    $newConsumption->consumption_quantity = $data['consumption_quantity'][$key];
                    $newConsumption->save();
                }

            }



            Session::flash('success_message', $message);
            return redirect('admin/food-menus');
        }
        $foodCategory = FoodCategory::get();
        $ingredientItem = IngredientItem::get();
        // $ingredientUnit = IngredientUnit::get();
        $foodTable = foodTable::with('ingredientUnit')->where('admin_id', auth('admin')->user()->id)->get();
        Session::flash('page', 'foodMenu');
        return view('admin.foodMenus.add_edit_food_menus', compact('title','button','foodMenusData','foodCategory','ingredientItem','foodTable'));
    }


    //ajax food menu table
    public function ajaxfoodMenuTable(Request $request)
    {
        $data = $request->all();
        $ingredientItemCount = foodTable::where(['ingredient_id'=>$data['foodTable_id'],'admin_id'=>auth('admin')->user()->id])->count();
        if($ingredientItemCount==0){
            $ingredientItem = IngredientItem::where('id', $data['foodTable_id'])->first();
            $foodTable = new foodTable;
            // $foodTable->item_id = $data['item_id'];
            $foodTable->admin_id = auth('admin')->user()->id;
            $foodTable->ingredient_id =  $ingredientItem->id;
            $foodTable->ingredientUnit_id =  $ingredientItem->ingredientUnit_id;
            $foodTable->ingredient =  $ingredientItem->name;
            $foodTable->price =  $ingredientItem->purchase_price;
            $foodTable->save();
            $foodTable  = foodTable::with('ingredientUnit')->where('admin_id', auth('admin')->user()->id)->get();
            return view('admin.foodMenus.ajax_foodMenu_table',compact('foodTable'));
        }else{
            return response()->json(['message'=>'exsist'], 200);
        }

    }

    //ajax food menu delete
    public function deletefoodMenuTable(Request $request)
    {
        
      $data = $request->all();
      foodTable::where('id', $data['ingredient_id'])->delete();
      $foodTable  = foodTable::with('ingredientUnit')->get();
      return view('admin.foodMenus.ajax_foodMenu_table',compact('foodTable'));
    }
    public function deleteFoodMenu($id)
    {
      $id =FoodMenu::find($id);
      $id->delete();
      return redirect()->back()->with('success_message', 'Food menus has been deleted successfully!');

    }
}