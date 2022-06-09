<?php
namespace App;
use App\Example;
use Illuminate\Support\Facades\Facade;

class ExampleFacde extends Facade
{
    protected static function getFacadeAccessor()
    {

        return 'example';
        // return Example::class;

    }
}
