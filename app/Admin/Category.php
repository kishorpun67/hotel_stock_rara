<?php
namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
class Category extends Model
{
    public function items()
    {
        return $this->hasMany('App\Admin\Item', 'category_id')->where('status',1);
    }
    public function subcategories()
    {
        return $this->hasMany('App\Admin\Category', 'parent_id')->where('status',1);
    }

    public function parentcategory()
    {
        return $this->belongsTo('App\Admin\Category', 'parent_id')->select('id','category');
    }
}
