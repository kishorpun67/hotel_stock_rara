 @extends('layouts.front_layout.front_layout')
 @section('content')
 <!-- ./Main slider starts-->

<section class="banner_slider subpage-slider">
    <figure> <img src="{{asset('frontend/images/pexels-photo-9953821.jpeg')}}" alt=""> </figure>
    <div class="breadCrumbNav">
      <div class="container breadcrumb-container">
        <h1 class="breadCrumb_title"> Water Adventure</h1>
        <div class="breadcumb-inner">
          <ul>
            <li><a href="index.html" class="breadCrumb_link">Home</a></li>
            <li><span>Menu Detail</span></li>
          </ul>
        </div>
      </div>
    </div>
  </section>
  
  <!-- ./Main slider ends-->
  
  <div class="product-slider">
    <div class="container inner_content">
      <div class="row">
        <div class="col col-sm-8">
          <div id="carousel" class="carousel bs-slider fade  control-round indicators-line" data-ride="carousel" data-pause="hover" 
           data-interval="false">
            <div class="carousel-inner" role="listbox">
              <div class="item active"> <img src="{{ asset($posts->image) }}"> </div>
              <div class="item"> <img src="{{ asset($posts->image) }}"> </div>
              <div class="item"> <img src="{{ asset($posts->image) }}"> </div>
              <div class="item"> <img src="{{ asset($posts->image) }}"> </div>
              <div class="item"> <img src="{{ asset($posts->image) }}"> </div>
            </div>
                        <!-- Left Control --> 
      <a class="left carousel-control" href="#carousel" role="button" data-slide="prev"> <span class="fa fa-angle-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> 
      
      <!-- Right Control --> 
      <a class="right carousel-control" href="#carousel" role="button" data-slide="next"> <span class="fa fa-angle-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> 
          </div>      
          <div class="clearfix clear">
          
            <div id="thumbcarousel" class="carousel slide" data-interval="false">   <!-- /thumbcarousel start--> 
            
            
              <div class="carousel-inner"> <!-- /carousel-inner start--> 
                <div class="item active">
                  <div data-target="#carousel" data-slide-to="0" class="thumb"> <img src="{{ asset('frontend/images/img5.jpg') }}"></div>
                  <div data-target="#carousel" data-slide-to="1" class="thumb"> <img src="{{ asset('frontend/images/expedition4.png') }}"></div>
                  <div data-target="#carousel" data-slide-to="2" class="thumb"> <img src="{{ asset('frontend/images/urgent-action-requested-rug-ocean-acidification_3011.jpg') }}"></div>
                </div>
                <div class="item">
                  <div data-target="#carousel" data-slide-to="3" class="thumb"> <img src="{{ asset('frontend/images/pexels-photo-9953821.jpeg') }}"></div>
                  <div data-target="#carousel" data-slide-to="4" class="thumb"> <img src="{{ asset('frontend/images/up_trip5.jpg') }}"></div>
                  <div data-target="#carousel" data-slide-to="0" class="thumb"> <img src="{{ asset('frontend/images/img5.jpg') }}"></div>
                </div>
              </div>
              <!-- /carousel-innerend --> 
              
               <!-- Left Control --> 
              <a class="left carousel-control" href="#thumbcarousel" role="button" data-slide="prev"> <i class="fa fa-angle-left" aria-hidden="true"> </i> </a> 
              
                 <!-- Right Control --> 
              <a class="right carousel-control" href="#thumbcarousel" role="button" data-slide="next"><i class="fa fa-angle-right" aria-hidden="true"></i> </a>
               </div>
            <!-- /thumbcarousel end--> 
            
          </div>
          
          
          <summary class="tour-summary">
   
          <p>{{ $posts->details }}</p> 
    </summary>         
    
      <h2 class="">Reviews</h2>    
          <div class="tour-review rating-static"> <span class="reviews-stars"> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> </span> <span class="reviews-count">(3)</span> </div>
          
          <div class="review-form">

            <form action="{{ route('comment')}}" method="post">
              <input type="hidden" name="post_id" value="{{$posts->id}}">
              @csrf
          <div class="form-group">
     <textarea id="review" class="form-control" name="message" placeholder="Write a review..."></textarea> 
     </div>
     
      <div class="form-group">
       <button class="btn submit-btn" type="submit">Submit</button>
       </div>
            </form>
       <div class="body_comment">
              <ul id="list_comment" class="col-xs-12">
                @foreach($comments as $data)
                <!-- Start List Comment 1 -->
                <li class="box_result">
                  <div class="avatar_comment"> <img src="{{ asset('frontend/images/avatar.jpg') }}" alt="avatar"/> </div>
                  <div class="result_comment">
                    <h4>Nath Ryuzaki</h4>
                    <p>{{ $data->message }}</p>
                    <div class="tools_comment"> <a class="like" href="#">Like</a> <!--<a class="replay" href="#">Reply</a>--> <i class="fa fa-thumbs-o-up"></i> <span class="count">1</span> <span class="comment-time">5m ago</span> </div>
                  </div>
                </li> 
              @endforeach
              </ul>
              <div class="col-xs-12">
              <button class="show_more_btn btn" type="button">VIEW MORE COMMENTS</button>
              </div>
            </div>
      
        </form>
     </div>   
        </div>

      
        <div class="col col-sm-4">
        <h2 class="">{{ $posts->title }}</h2>
  <div class="tour-review rating-static"> <span class="reviews-stars"> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> </span> <span class="reviews-count">(3)</span> </div>
  
  
  <div class="tour-price mt-3"><span>{{ $posts->price }}</span>   </div>
  
  <div class="price-neg mt-3"> <b>Price Negotiable:</b>&nbsp;<span>{{ $posts->price_type }}</span>
    <div class="mt-3">
  <button class="btn view_btn book-btn"type="submit">Book now</button>
  </div>
  
   <div class="mt-4">
          <ul class="social_icons">
            <li><a href="#" title=""><i class="fab fa-facebook-f"></i></a></li>
            <li><a href="#" title=""><i class="fab fa-twitter"></i> </a></li>
            <li><a href="#" title=""><i class="fab fa-instagram"></i> </a></li>
          </ul>
   </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  <!--// footer section starts-->
  
 @endsection