<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IngredientCart extends Model
{
    public function ingredientUnit()
    {
        return $this->belongsTo('App\IngredientUnit', 'ingredientUnit_id');
    }
}
