<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Consumption;

class IngredientItem extends Model
{
    public function ingredientCategory()
    {
        return $this->belongsTo('App\IngredientCategory', 'category_id');
    }

    public function ingredientUnit()
    {
        return $this->belongsTo('App\IngredientUnit', 'ingredientUnit_id');
    }
    public static function getConsumptinStock($id)
    {
        $consumption = Consumption::where('foodMenu_id', $id)->get();
        return $consumption;
    }
    public static function reduceIngredientStock($id, $stock)
    {
        // echo$id; die;
        IngredientItem::where('id', $id)->decrement('quantity', $stock);
        // return;
        // return $totalOrder;
    }

    public static function increaseIngredientStock($id , $stock)    {
        IngredientItem::where('id', $id)->increment('quantity', $stock);
    }
   
}
