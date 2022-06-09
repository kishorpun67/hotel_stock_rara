<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin\Post;
use App\Admin\Category;
use App\Admin\Type;
use App\Comment;

class PostController extends Controller
{
    public function postList($url=null)
    {
        if(request()->ajax()){
            $data = request()->all();
            $sort = $data['sort'];
            $url = $data['url'];
            $categoy = Category::where('url' ,$url)->first();

            $posts = Post::where('category_id' , $categoy->id)->where('confirm_status', 'Confirmed');
            if(!empty($data['price_type'])){
                $posts = $posts->whereIn('posts.price_type', $data['price_type']);
            }
            if(!empty($data['type'])){
                $posts = $posts->whereIn('posts.type_id', $data['type']);
            }
            if(!empty($data['location'])){
                $posts = $posts->where('posts.title','like', '%'.$data['location'].'%');
            }
            if(!empty($data['minPrice']) && !empty($data['maxPrice'])){
                $posts = $posts->whereBetween('posts.price',[$data['minPrice'], $data['maxPrice']]);
            }
            if(!empty($data['sort'])){
                if($data['sort'] =="low_to_high"){
                    $posts->orderBy('price', 'Asc');
                    // return 'tst';
                }
                if($data['sort'] =="high_to_low"){
                    $posts->orderBy('price', 'Desc');
                }
                if($data['sort'] =="ascending"){
                    $posts->orderBy('title', 'Asc');
                }
                if($data['sort'] =="descending"){
                    $posts->orderBy('title', 'Desc');
                }
                
            }
            
            $posts = $posts->paginate(9);
            return view('front.ajaxListing' , compact('posts'));
        }else{
            $count = Category::where('url' ,$url)->count();
            if($count == 0)
            {
                return view('error.error');
            }
            $categoy = Category::where('url' ,$url)->first();
            $posts = Post::where('category_id' , $categoy->id)->get();
            $types = Type::get();
            $meta_title = $categoy->meta_title;
            $meta_keywords = $categoy->meta_keywords;
            $meta_description = $categoy->meta_description;
            return view('front.list', compact('posts', 'meta_title','meta_description','meta_keywords','categoy', 'types'));
        }
    }

    public function searhPostArea()
    {
        $data = request()->all();
        $posts = Post::where('title','like', '%'.$data['search'].'%')->where('confirm_status', 'Confirmed')->get();
        return view('front.search', compact('posts'));

    }

    public function postDetails($url)
    {  
        $posts = Post::where('url', $url)->first();
        $comments = Comment::where('post_id', $posts->id)->get();
        return view('front.detail',compact('posts','comments')); 
    }

    public function addComment(Request $request)
    {
      
        $data = $request->all();
              if(empty($data['message']))
            {
                return redirect()->back()->with('error_message', 'Message is required !');
            }
            $comments = new Comment;
            $comments->user_id = 2;
            $comments->post_id = $data['post_id'];
            $comments->name = "Lorem Wang";
            $comments->message = $data['message'];
            $comments->star = 5;
            $comments->save();
            return redirect()->back();
    }
}
