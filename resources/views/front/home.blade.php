

 @extends('layouts.front_layout.front_layout')
 @section('content')
 <?php 
 use App\Admin\Item;
 
 ?>
 
<section class="banner_slider">
  <div id="bootstrap-touch-slider" class="carousel bs-slider fade  control-round indicators-line" data-ride="carousel" data-pause="hover" data-interval="false"> 
    
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#bootstrap-touch-slider" data-slide-to="0" class=""></li>
      <li data-target="#bootstrap-touch-slider" data-slide-to="1" class=""></li>
      <li data-target="#bootstrap-touch-slider" data-slide-to="2" class=""></li>
    </ol>
    
    <!-- Wrapper For Slides -->
    <div class="carousel-inner" role="listbox"> 
      
      <!-- Third Slide -->
      <?php 
       $id =0;
      ?>
      @foreach ($banners as $item)
       @if( $id == 0)
      <?php $active = "active"; ?>
        @else
        <?php $active = ""; ?>
        @endif
      <div class="item {{$active}}"> 
        
        <!-- Slide Background --> 
        <img src="{{asset($item->image)}}" alt="" class="slide-image">
        <div class="bs-slider-overlay"></div>
        <!-- Slide Text Layer -->
        <div class="slide-text slide_style_center container">
          <h1 data-animation="animated fadeInLeft">{{$item->title_first}}</h1>
          <h2 data-animation="animated zoomInRight">{{$item->title_second}}</h2>
          <p data-animation="animated lightSpeedIn" class="">{{$item->description}}</p>
          <a href="#" class="btn slide_btn" data-animation="animated zoomInUp">View Tours</a> </div>
      </div>
      <?php 
        $id = $id+1;
      ?>
      @endforeach

      
      
    </div>
    <!-- End of Wrapper For Slides --> 
    
    <!-- Left Control --> 
    <a class="left carousel-control" href="#bootstrap-touch-slider" role="button" data-slide="prev"> <span class="fa fa-angle-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> 
    
    <!-- Right Control --> 
    <a class="right carousel-control" href="#bootstrap-touch-slider" role="button" data-slide="next"> <span class="fa fa-angle-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
</section>

<!--===========	Choose section starts ======// -->

<section class="choose_section section_wrapper">
  <div class="container">
    <h2 class="section_title border left">Why Choose US</h2>
    <div class="row mt-3">
      <div class="col-md-9">
        <div class="row choose-bar ">
          <div class="col col-md-4 col-sm-6 col-xs-6">
            <figure class="icon-user items"> <span><i class="fas fa-award"></i></span> </figure>
            <figcaption class="icon-caption">
              <h4>98% Success Rate</h4>
              <p>Precise planning with first-hand knowledge defining our high success rate</p>
            </figcaption>
          </div>
          <div class="col col-md-4 col-sm-6 col-xs-6">
            <figure class="icon-user"> <span><i class="fas fa-atlas"></i></span> </figure>
            <figcaption class="icon-caption">
              <h4>98% Success Rate</h4>
              <p>Precise planning with first-hand knowledge defining our high success rate</p>
            </figcaption>
          </div>
          <div class="col col-md-4 col-sm-6 col-xs-6">
            <figure class="icon-user"> <span><i class="fas fa-binoculars"></i></span> </figure>
            <figcaption class="icon-caption">
              <h4>98% Success Rate</h4>
              <p>Precise planning with first-hand knowledge defining our high success rate</p>
            </figcaption>
          </div>
          <div class="col col-md-4 col-sm-6 col-xs-6">
            <figure class="icon-user"> <span><i class="fas fa-award"></i></span> </figure>
            <figcaption class="icon-caption">
              <h4>98% Success Rate</h4>
              <p>Precise planning with first-hand knowledge defining our high success rate</p>
            </figcaption>
          </div>
          <div class="col col-md-4 col-sm-6 col-xs-6">
            <figure class="icon-user"> <span><i class="fas fa-atlas"></i></span> </figure>
            <figcaption class="icon-caption">
              <h4>98% Success Rate</h4>
              <p>Precise planning with first-hand knowledge defining our high success rate</p>
            </figcaption>
          </div>
          <div class="col col-md-4 col-sm-6 col-xs-6">
            <figure class="icon-user"> <span><i class="fas fa-binoculars"></i></span> </figure>
            <figcaption class="icon-caption">
              <h4>98% Success Rate</h4>
              <p>Precise planning with first-hand knowledge defining our high success rate</p>
            </figcaption>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <aside class="sidebar_search_form">
          <div class="sidebar_search_title">
            <h2> Search Tours</h2>
            <h4>Find your Dream Tour Today</h4>
          </div>
          <form role="form">
            <div class="form-group" id="search-tour">
              <input type="search" class="form-control" placeholder="Search Tours...." >
              <button type="submit" class="btn btn-search-tour"> </button>
            </div>
            <div class="form-group select_dropdown" id="destination">
              <select class="form-control" name="destination">
                <option value="" selected>Destination</option>
                <option value="Pokhara">Pokhara</option>
                <option value="Manang">Manang</option>
                <option value="Chitwan">Chitwan</option>
              </select>
            </div>
            <div class="form-group select_dropdown" id="tour-type">
              <select class="form-control" name="tour-type">
                <option value="" selected>Tour Type</option>
                <option value="walking">Walking</option>
                <option value="cycling">Cycling</option>
                <option value="Hiking">Hiking</option>
              </select>
            </div>
            <div class="form-group" id="date">
              <input type="date" class="form-control">
            </div>
            <div class="form-group">
              <div>
                <input class=" btn btn-primary view_btn tour-btn" type="submit" value="Find Tours">
              </div>
            </div>
          </form>
        </aside>
      </div>
    </div>
  </div>
</section>

<!--===========	Popular Tour starts ====== // -->

<section class="popular-tour">
  <div class="container">
    <div class="heading">
      <h3 class="center"><i>Take a look at our</i></h3>
      <h2 class="section_title border">MOST POPULAR TOURS</h2>
    </div>
    <div class="row">
      <div class="col-sm-offset-1 col-sm-10">
        <div class="carousel-wrap">
          <div class="owl-carousel owl-theme">
            <div class="item"> <a href="#">
              <figure class="expedition_img"> <img src="{{asset('frontend/images/expedition1.png')}}">
                <div class="box_caption">
                  <h3>Everest B.C &amp; Gokyo Lakes</h3>
                </div>
                <div class="tour-review"> <span class="reviews-stars"> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> </span> <span class="reviews-count">(5)</span> </div>
                <div class="price_box"> <span>From $49</span> </div>
              </figure>
              </a>
              <figcaption class="expedition_caption">
                <div class="expedition_wrapper">
                  <h4>Special Package</h4>
                  <p>Precise planning with first-hand knowledge defining our high success rate</p>
                </div>
              </figcaption>
            </div>
            <div class="item"> <a href="#">
              <figure class="expedition_img"> <img src="{{asset('frontend/images/expedition2.png')}}">
                <div class="box_caption">
                  <h3>Everest B.C &amp; Gokyo Lakes</h3>
                </div>
                <div class="tour-review"> <span class="reviews-stars"> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> </span> <span class="reviews-count">(3)</span> </div>
                <div class="price_box"> <span>From $49</span> </div>
              </figure>
              </a>
              <figcaption class="expedition_caption">
                <div class="box_caption">
                  <h3><a href="#">Everest B.C &amp; Gokyo Lakes</a></h3>
                </div>
                <div class="expedition_wrapper">
                  <h4>Special Package</h4>
                  <p>Precise planning with first-hand knowledge defining our high success rate</p>
                </div>
              </figcaption>
            </div>
            <div class="item"> <a href="#">
              <figure class="expedition_img"> <img src="{{asset('frontend/images/expedition3.png')}}">
                <div class="box_caption">
                  <h3>Everest B.C &amp; Gokyo Lakes</h3>
                </div>
                <div class="tour-review"> <span class="reviews-stars"> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> </span> <span class="reviews-count">(4)</span> </div>
                <div class="price_box"> <span>From $49</span> </div>
              </figure>
              </a>
              <figcaption class="expedition_caption">
                <div class="expedition_wrapper">
                  <h4>Special Package</h4>
                  <p>Precise planning with first-hand knowledge defining our high success rate</p>
                </div>
              </figcaption>
            </div>
            <div class="item"> <a href="#">
              <figure class="expedition_img"> <img src="{{asset('frontend/images/expedition4.png')}}">
                <div class="box_caption">
                  <h3>Everest B.C &amp; Gokyo Lakes</h3>
                </div>
                <div class="tour-review"> <span class="reviews-stars"> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> </span> <span class="reviews-count">(2)</span> </div>
                <div class="price_box"> <span>From $49</span> </div>
              </figure>
              </a>
              <figcaption class="expedition_caption">
                <div class="expedition_wrapper">
                  <h4>Special Package</h4>
                  <p>Precise planning with first-hand knowledge defining our high success rate</p>
                </div>
              </figcaption>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!--===========	Deals and Discount section starts ====== // -->

<section class="deal-section pt-5">
  <div class="container">
    <div class="heading">
      <h2 class="section_title border left"> Deals & Dicount </h2>
      <p>Lorem ipsum dolor sit amet consectetur tsed eliectetur adipiscing elitsed </p>
    </div>
    <div class="row mt-5">
      <div class="col col-md-3 col-sm-4 col-xs-6 mb-5"> <a href="#">
        <figure class="expedition_img"> <img src="{{asset('frontend/images/thumb2.jpg')}}">
          <div class="tour-review"> <span class="reviews-stars"> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> </span> <span class="reviews-count">(5)</span> </div>
          <div class="price_box circle_box"> <span>From $49</span> </div>
        </figure>
        </a>
        <figcaption class="expedition_caption">
          <div class="expedition_wrapper">
            <h4>Special Package</h4>
            <p>Precise planning with first-hand knowledge defining our high success rate</p>
          </div>
        </figcaption>
      </div>
      <div class="col col-md-3 col-sm-4 col-xs-6 mb-5"> <a href="#">
        <figure class="expedition_img"> <img src="{{asset('frontend/images/thumb3.jpg')}}">
          <div class="tour-review"> <span class="reviews-stars"> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> </span> <span class="reviews-count">(5)</span> </div>
          <div class="price_box circle_box"> <span>From $49</span> </div>
        </figure>
        </a>
        <figcaption class="expedition_caption">
          <div class="expedition_wrapper">
            <h4>Special Package</h4>
            <p>Precise planning with first-hand knowledge defining our high success rate</p>
          </div>
        </figcaption>
      </div>
      <div class="col col-md-3 col-sm-4 col-xs-6 mb-5"> <a href="#">
        <figure class="expedition_img"> <img src="{{asset('frontend/images/thumb1.jpg')}}">
          <div class="tour-review"> <span class="reviews-stars"> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> </span> <span class="reviews-count">(5)</span> </div>
          <div class="price_box circle_box"> <span>From $49</span> </div>
        </figure>
        </a>
        <figcaption class="expedition_caption">
          <div class="expedition_wrapper">
            <h4>Special Package</h4>
            <p>Precise planning with first-hand knowledge defining our high success rate</p>
          </div>
        </figcaption>
      </div>
      <div class="col col-md-3 col-sm-4 col-xs-6 mb-5"> <a href="#">
        <figure class="expedition_img"> <img src="{{asset('frontend/images/trip2.jpg')}}">
          <div class="tour-review"> <span class="reviews-stars"> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> </span> <span class="reviews-count">(5)</span> </div>
          <div class="price_box circle_box"> <span>From $49</span> </div>
        </figure>
        </a>
        <figcaption class="expedition_caption">
          <div class="expedition_wrapper">
            <h4>Special Package</h4>
            <p>Precise planning with first-hand knowledge defining our high success rate</p>
          </div>
        </figcaption>
      </div>
    </div>
  </div>
</section>

<!--===========	Destination section starts ====== // -->

<section class="destination-section pt-5">
  <div class="container">
    <div class="heading">
      <h3 class="center"><i>Take a look at our</i></h3>
      <h2 class="section_title border">Destinations</h2>
    </div>
    <div class="row mt-5">
      <div class="col col-md-3 col-sm-4 col-xs-6 mb-5"> <a href="#">
        <figure class="expedition_img"> <img src="{{asset('frontend/images/expedition1.png')}}">
          <figcaption class="expedition_caption">
            <div class="box_caption">
              <h3>Brazil</h3>
            </div>
          </figcaption>
        </figure>
        </a> </div>
      <div class="col col-md-3 col-sm-4 col-xs-6 mb-5"> <a href="#">
        <figure class="expedition_img"> <img src="{{asset('frontend/images/expedition2.png')}}">
          <figcaption class="expedition_caption">
            <div class="box_caption">
              <h3>Canada</h3>
            </div>
          </figcaption>
        </figure>
        </a> </div>
      <div class="col col-md-3 col-sm-4 col-xs-6 mb-5"> <a href="#">
        <figure class="expedition_img"> <img src="{{asset('frontend/images/expedition3.png')}}">
          <figcaption class="expedition_caption">
            <div class="box_caption">
              <h3>USA</h3>
            </div>
          </figcaption>
        </figure>
        </a> </div>
      <div class="col col-md-3 col-sm-4 col-xs-6 mb-5"> <a href="#">
        <figure class="expedition_img"> <img src="{{asset('frontend/images/expedition4.png')}}">
          <figcaption class="expedition_caption">
            <div class="box_caption">
              <h3>Spain</h3>
            </div>
          </figcaption>
        </figure>
        </a> </div>
    </div>
  </div>
</section>

<!--===========	Destination section ends ====== // --> 

<!--===========//Tour section starts ===========// -->

<section class="adventure-tour-content">
  <div class="container">
    <div class="adventure-tour-wrapper">
      <div class="heading">
        <h3 class="center white_txt"><i>Find a tour by</i></h3>
        <h2 class="section_title border white_txt">Tour Type</h2>
      </div>
      <ul class="d-flex adventure-flex-wrap">
        <li class="items"> <a href="#">
          <div class="thumb-circle-item">
            <div class="thumb-circle-inner"> <i class="fas fa-parachute-box"></i> <span>Air Rides</span> </div>
          </div>
          <!--<div class="summit-titles"> <span>Asia</span>
              <h4>Denali</h4>
            </div>--> 
          </a> </li>
        <li class="items"> <a href="#">
          <div class="thumb-circle-item">
            <div class="thumb-circle-inner"> <i class="fas fa-parachute-box"></i> <span>8848.86 m</span></div>
          </div>
          <!--<div class="summit-titles"> <span>Asia</span>
              <h4>Elbrus</h4>
            </div>--> 
          </a> </li>
        <li class="items"> <a href="#">
          <div class="thumb-circle-item">
            <div class="thumb-circle-inner"> <i class="fas fa-hiking"></i> <span>Hiking</span> </div>
          </div>
          <!--<div class="summit-titles"> <span>Asia</span>
              <h4>Aconcagua</h4>
            </div>--> 
          </a> </li>
        <li class="items"> <a href="#">
          <div class="thumb-circle-item">
            <div class="thumb-circle-inner"> <i class="fas fa-baseball-ball"></i> <span>Sports</span></div>
          </div>
          <!--<div class="summit-titles"> <span>Asia</span>
              <h4>kilimanjaro</h4>
            </div>--> 
          </a> </li>
        <li class="items"> <a href="#">
          <div class="thumb-circle-item">
            <div class="thumb-circle-inner"> <i class="fas fa-walking"></i> <span>Walking</span></div>
          </div>
          <!--<div class="summit-titles"> <span>Asia</span>
              <h4>carstensz</h4>
            </div>--> 
          </a> </li>
      </ul>
    </div>
  </div>
</section>

<!--===========//Blog Section starts ===========// -->

<section class="blog_content section_wrapper">
  <div class="container">
    <div class="row">
      <div class="col col-sm-6 col-xs-6">
        <div class="heading">
          <h2 class="section_title border">LATEST POST</h2>
        </div>
        <div class="post_wrapper pt-3">
          <figure class="post_thumb"> <img src="{{asset('frontend/images/blog1.png')}}"> </figure>
          <figcaption class="post_caption">
            <h4 class="blog_title">Thursday, 06 July 2017</h4>
            <span class="date"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> Thursday, 06 July 2017</span>
            <p class="blog_detail">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent neque sem, elementum vel elit ut, scelerisque scipit ac nisl in </p>
            <a href="#" class="btn blog_btn">Read More</a> </figcaption>
        </div>
      </div>
      <div class="col col-sm-6 col-xs-6">
        <div class="heading">
          <h2 class="section_title border">TOUR REVIEWS</h2>
        </div>
        <aside class="review_side blog_side pt-3">
          <article>
            <figure class="blog_side_img img-circle"> <img src="{{asset('frontend/images/testimonial_1.jpg')}}" alt="" title=""> </figure>
            <figcaption class="blog_side_caption">
              <author class="review-title">Rockies </author>
              <p class="review-detail">Nemo enim ipsam voluptatem quia </p>
              <span class="review-date">24 Feb 2019</span> <a href="#">Continue Reading</a> </figcaption>
          </article>
          <article>
            <figure class="blog_side_img img-circle"> <img src="{{asset('frontend/images/testimonial_2.jpg')}}" alt="" title=""> </figure>
            <figcaption class="blog_side_caption">
              <author class="review-title">Rockies </author>
              <p class="review-detail">Nemo enim ipsam voluptatem quia </p>
              <span class="review-date">24 Feb 2019</span> <a href="#">Continue Reading</a> </figcaption>
          </article>
          <article>
            <figure class="blog_side_img img-circle"> <img src="{{asset('frontend/images/testimonial_3.jpg')}}" alt="" title=""> </figure>
            <figcaption class="blog_side_caption">
              <author class="review-title">Rockies </author>
              <p class="review-detail">Nemo enim ipsam voluptatem quia </p>
              <span class="review-date">24 Feb 2019</span> <a href="#">Continue Reading</a> </figcaption>
          </article>
        </aside>
      </div>
    </div>
  </div>
</section>


<!--===========//Testimonial section starts ===========// -->

<section class="review_section py-5">
  <div class="container">
    <h2 class="section_title border center white_txt"> OUR HAPPY CUSTOMERS</h2>
    <div class="carousel-wrap testimonial_content">
      <div class="owl-carousel owl-theme space_tp">
        @foreach ($testimonial as $item)
            
        <div class="item "> <a href="#">
          <figure class="img-circle"> <img src="{{asset($item->image)}}" alt=""> </figure>
          </a>
          <figcaption> <span class="author">{{$item->name}}</span> <span class="post">{{$item->porfession}}</span>
            <p>{{$item->description}}</p>
          </figcaption>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</section>


@endsection