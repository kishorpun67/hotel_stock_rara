<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Waste;
use App\FoodMenu;
use App\IngredientCategory;
use Session;

class WasteController extends Controller
{
    public function waste()
    {
        $waste = Waste::with('ingredientCategory','FoodMenu')->get();
        Session::flash('page', 'waste');
        return view('admin.waste.view_waste', compact('waste'));
    }

    public function addEditWaste(Request $request, $id=null)
    {
        if($id=="") {
            $title = "Add Waste";
            $button ="Submit";
            $waste = new Waste;
            $wastedata = array();
            $message = "wastes has been added sucessfully";
        }else{
            $title = "Edit Waste";
            $button ="Update";
            $wastedata = Waste::where('admin_id',auth('admin')->user()->id)->where('id',$id)->first();
            $wastedata= json_decode(json_encode($wastedata),true);
            $waste = Waste::find($id);
            $message = "wastes has been updated sucessfully";
        }
        if($request->isMethod('post')) {
            $data = $request->all();
            // dd($data);
            if(empty($data['ref_no'])){
                return redirect()->back()->with('error_message', 'Refrence number is required !');
            }
            
            if(empty($data['price']))
            {
                $data['price'] = "";
            }
            if(empty($data['category_id']))
            {
                $data['category_id'] = "";
            }
            if(empty($data['food_id']))
            {
                $data['food_id'] = "";
            }
            if(empty($data['date']))
            {
                $data['date'] = "";
            }
            if(empty($data['responsible_person']))
            {
                $data['responsible_person'] = "";
            }
            if(empty($data['total_loss']))
            {
                $data['total_loss'] = "";
            }
            if(empty($data['description']))
            {
                $data['description'] = "";
            }
           
            $waste->admin_id = auth('admin')->user()->id;
            $waste->ref_no = $data['ref_no'];
            $waste->category_id = $data['category_id'];
            $waste->food_id = $data['food_id'];
            $waste->date = $data['date'];
            $waste->responsible_person = $data['responsible_person'];
            $waste->total_loss = $data['total_loss'];
            $waste->description = $data['description'];
            $waste->save();
            Session::flash('success_message', $message);
            return redirect('admin/waste');
        }
        $ingredientCategory = IngredientCategory::get();
        $foodMenu = FoodMenu::get();
        Session::flash('page', 'waste');
        return view('admin.waste.add_edit_waste', compact('title','button','wastedata','ingredientCategory','foodMenu'));
    }

    public function wasteReport()
    {
        $waste = Waste::get();
        Session::flash('page', 'waste_report');
        return view('admin.waste.waste_report',compact('waste'));
    }
    


    public function deleteWaste($id)
    {
      $id =Waste::find($id);
      $id->delete();
      return redirect()->back()->with('success_message', 'Waste has been deleted successfully!');

    }
}
