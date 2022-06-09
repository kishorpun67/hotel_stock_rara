<?php
namespace App;

class Example
{
    public function __construct()
    {

    }
    public  function handle($name=null)
    {
        // return $name;
        die('its word');
    }
    public function name($name)
    {
        return $name;
    }
}
