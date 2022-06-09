<?php

namespace App;
use App\IngredientUnit;

use Illuminate\Database\Eloquent\Model;

class foodTable extends Model
{
    public function ingredientUnit()
    {
        return $this->belongsTo('App\IngredientUnit', 'ingredientUnit_id');
    }
}
