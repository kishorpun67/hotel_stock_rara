<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    public function waste()
    {
        return $this->belongsTo('App\Waste', 'waste_id');
    }

    public function ingredientCategory()
    {
        return $this->belongsTo('App\IngredientCategory', 'category_id');
    }

}
