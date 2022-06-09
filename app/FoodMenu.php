<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FoodMenu extends Model
{
    public function foodCategory()
    {
        return $this->belongsTo('App\FoodCategory', 'category_id');
    }

    public function ingredientItem()
    {
        return $this->belongsTo('App\IngredientItem', 'item_id');
    }

    public function ingredientUnit()
    {
        return $this->belongsTo('App\IngredientUnit', 'ingredient_id');
    }
    public function consumption()
    {
        return $this->hasMany('App\Consumption', 'foodMenu_id');
    }
    
   
}

