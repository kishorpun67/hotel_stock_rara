<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consumption extends Model
{
    public function ingredientUnit()
    {
        return $this->belongsTo('App\IngredientUnit', 'ingredientUnit_id');
    }
}
