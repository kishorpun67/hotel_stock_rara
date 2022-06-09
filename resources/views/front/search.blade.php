
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
          <li><a href="{{route('home')}}" class="breadCrumb_link">Home</a></li>
          <li><span>List</span></li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- ./Main slider ends-->

<section class="package-section section_wrapper">
  <div class="container elementor-widget-container">
    <div class="row">
      {{-- <div class="col-sm-3">
        <aside class="filter_category_sidebar">
          <div class="filter_category_wrapper">
            <h2 class="filter-title">Filter</h2>
            <label class="label_title">Price:</label>
            <div class="filter_item form-group price_filter">
              <input type="text" class="form-control" placeholder="Min" size="5" value=""  maxlength="" minlength="">
              <input type="text" class="form-control" placeholder="Max" size="5" value=""  maxlength="" minlength="">
              <button type="button" role="button" class="btn btn-go"> Go </button>
            </div>
            <div class="filter_item form-group negotiable_filter">
              <label class="label_title">Price Negotiable:</label>
              <label>
                <input type="radio" value="Yes" id="" name="p-neg">
                <span>Yes</span> </label>
              <label>
                <input type="radio" value="No" name="p-neg"  id="">
                <span>No</span> </label>
              <label>
                <input type="radio" value="Fixed Price" name="p-neg" id="">
                <span>Fixed Price</span> </label>
            </div>
            <div class="filter_item form-group date_filter">
              <label class="label_title">Date:</label>
              <input type="date" class="form-control" name="date">
            </div>
            <div class="filter_item form-group type_filter">
              <label for="room">Types</label>
              <div class="select_dropdown">
                <select class="form-control" name="tour-types">
                  <option value="Business">Business</option>
                  <option value="Economy"  selected="selected">Economy</option>
                  <option value="VIP" >VIP</option>
                  <option value="Family">Family</option>
                </select>
              </div>
            </div>
          </div>
        </aside>
      </div> --}}
      <div class="col-sm-12">
        <div class="portfolio-grid">
          {{-- <div class="filter_item form-group filter_sort">
            <label class="label_title">Sort by</label>
            <div class="select_dropdown">
              <select class="form-control" name="sort-type">
                <option value="lth">Price: Low to High</option>
                <option value="htl">Price: High to Low</option>
                <option value="ascending"> Name: Ascending</option>
                <option value="descending"> Name: Descending</option>
                <option value="most-visited"> Most Visited </option>
              </select>
            </div>
          </div> --}}
          <div class="row special_package">
            @foreach ($posts as $item)
                
            <div class="col-sm-4 portfolio-item">
              <div class="single_package"> <a href="{{ route('post.detail', $item->url) }}">
                <figure class="pkg-img"> <img src="{{asset($item->image)}}"> 
                  <!--<div class="box_caption">
                  <h3>Everest B.C &amp; Gokyo Lakes</h3>
                </div>--> 
                  
                </figure>
                </a>
                <figcaption class="expedition_caption">
                  <div class="expedition_wrapper">
                    {{-- <h4 class="collection">Collection</h4> --}}
                    <h4 class="pkg-title">{{$item->title}}</h4>
                    <p>{{$item->details}}</p>
                    <div class="tour-review"> <span class="reviews-stars"> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> </span> <span class="reviews-count">(3)</span> </div>
                    <span class="pkg-price">Rs. {{$item->price}}</span> </div>
                </figcaption>
              </div>
            </div>
            @endforeach

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection