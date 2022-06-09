<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Admin\Item;
use App\Admin\Category;
use App\User;
use App\Admin\Banner;
use Carbon\Carbon;
use Auth;
class ItemController extends Controller
{
    public function detail($url)
    {
       $count = Item::where('url', $url)->count();
       if($count <=0)
       {
           return redirect()->route('home');
       }
       $singleItem = Item::with('category')->where('url', $url)->first();
       $meta_title =  $singleItem->meta_title;
       $meta_description =  $singleItem->meta_description;
       $meta_keywords =  $singleItem->meta_keywords;
       return view('front.detail', compact('singleItem', 'meta_title', 'meta_description','meta_keywords'));
    }

    public function searchItem()
    {
        // return session()->get('admin_id');
        $data = request()->all();
        $searchProduct = $data['item'];
        $banners = Banner::where('status',1)->get();
        if(empty($searchProduct)){
            return redirect()->back()->with('error_message', 'You must enter some product name');
        }
        // return Item::whereLike('admin_id', session()->get('admin_id'))->where('item_name', $searchProduct)->get();
        return$products = Item::where('admin_id', session()->get('admin_id'))->where('item_name', 'like', '%'.$searchProduct.'%')->get();
        return$products = Item::where(function($query) use($searchProduct){
             $query->where('admin_id', session()->get('admin_id'))->orWhere('item_name', 'like', '%'.$searchProduct.'%');
        })->where('status',1)->get();
        return view('front.search', compact('banners', 'products'));

    }
}
