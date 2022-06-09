<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Admin\Post;
use App\Admin\Category;
use App\User;
use App\Admin\Banner;
use Carbon\Carbon;
use Auth;
use App\Admin\Qr_Code;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AlertNotification;
use App\Admin\Admin;
use App\Admin\TestMonial;

class HomeController extends Controller
{
    public function home($url=null)
    {

       
        $banners = Banner::where('status',1)->get();
       $testimonial = TestMonial::get();
        return view('front.home', compact('banners','testimonial'));

        
    }

    public function  searchPost()
    {
        $data = request()->all();
        // echo 'name';
        $name = Post::where('title','like', '%'.$data['title'].'%')->where('confirm_status', 'Confirmed')->get();
        $output = "<ul>";
            foreach($name as $names)
            {
                $output .= "<li>{$names['title']}</li>";

            }
            // $output .= "</ul>Name not found</ul>";

        $output .= "</ul>";

        echo $output;

    }

   

}
