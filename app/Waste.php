<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Waste extends Model
{
    public function ingredientCategory()
    {
        return $this->belongsTo('App\IngredientCategory', 'category_id');
    }

    public function foodMenu()
    {
        return $this->belongsTo('App\FoodMenu', 'food_id');
    }
}
