<?php
namespace App\Helper;
use App\Admin\Item;


function items(){
  $products = Item::count();
  return $products;
} 