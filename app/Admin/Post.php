<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Cart;
class Post extends Model
{
    public function category()
    {
        return $this->belongsTo('App\Admin\Category', 'category_id')->select('id', 'category');
    }
    public function admin()
    {
        return $this->belongsTo('App\Admin\Admin', 'admin_id')->select('id', 'name');
    }
    public function type()
    {
        return $this->belongsTo('App\Admin\Type', 'type_id')->select('id', 'type');
    }

    public function addon()
    {
        return $this->hasMany('App\Admin\AddOn', 'item_id');
    }
    public function size()
    {
        return $this->hasMany('App\Admin\Size', 'item_id');
    }

    // public static function checkItem($item_id)
    // {
    //     $getItemStock = Item::where('id',$item_id)->first();
    //     return $getItemStock;
    // }

    public static function deleteCartCount($id, $user_id)
    {
        Cart::where(['id' =>$id, 'user_id'=>$user_id])->delete();
    }

    public static function deleteSotck($id , $stock)
    {
        Item::where('id',$id)->decrement('stock', $stock);
    }

    public static function checkStock($id)
    {
        $stock = Item::where('id',$id)->first();
        return $stock->stock;
    }

    public static function addStock($id , $stock)
    {
        Item::where('id',$id)->increment('stock', $stock);
    }

    public static function stockIncrement($id, $stock)
    {
        Item::where('id',$id)->increment('stock', $stock);

    }
    public static function stockDecrement($id, $stock)
    {
        Item::where('id',$id)->decrement('stock', $stock);
    }
}
