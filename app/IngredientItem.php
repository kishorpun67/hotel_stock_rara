<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
   
}
