
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
          <li><a href="{{route('home')}}" class="breadCrumb_link">HOME</a></li>
          <li><span>{{$categoy->category}}</span></li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- ./Main slider ends-->

<section class="package-section section_wrapper">
  <div class="container elementor-widget-container">
    <div class="row">
      <div class="col-sm-3">
        <aside class="filter_category_sidebar">
          <div class="filter_category_wrapper">
            <h2 class="filter-title">Filter</h2>
            <label class="label_title">Price:</label>
            <div class="filter_item form-group price_filter">
              {{-- <form action="javascript:" id="price_range"> --}}
              <input type="text" class="form-control" id="min_price" placeholder="Min" size="5" value=""  maxlength="" minlength="">
              <input type="text" class="form-control" id="max_price" placeholder="Max" size="5" value=""  maxlength="" minlength="">
              <button type="button" role="button" id="price_range" class="btn btn-go"> Go </button>
            {{-- </form> --}}
            </div>
            <div class="filter_item form-group location_filter">
              <label class="label_title">Choose Location:</label>
              <input type="text" class="form-control autocomplete" placeholder="Location" id="get_location"  >
            </div>
            <div class="filter_item form-group date_filter">
              <label class="label_title">Date:</label>
              <input type="date" class="form-control" name="name" placeholder="Tile">
            </div>
            <div class="filter_item form-group negotiable_filter">
              <label class="label_title">Price Type:</label>
              <label>
                <input type="checkbox" value="Negotiable" class="price_type"  name="p-neg"  id="">
                <span>Negotiable</span> </label>
              <label>
                <input type="checkbox" value="Fixed" class="price_type"  name="p-neg" id="">
                <span>Fixed </span> </label>
            </div>
            
            <div class="filter_item form-group type_filter">
              <label for="room">Types</label>
              @foreach ($types as $item)
                  
              <label>
                <input type="checkbox" value="{{$item->id}}" class="type"  name="p-neg"  id="">
                <span>{{$item->type}}</span> 
              </label>
              @endforeach
            </div>
          </div>
        </aside>
      </div>
      <div class="col-sm-9">
        <div class="portfolio-grid">
          <div class="filter_item form-group filter_sort">
            <label class="label_title">Sort by</label>
            <div class="select_dropdown">
              <input type="hidden" name="url" id="url" value="{{$categoy->url}}">
              <select class="form-control" name="sort-type" id="sort">
                <option value="">Select</option>
                <option value="low_to_high">Price: Low to High</option>
                <option value="high_to_low">Price: High to Low</option>
                <option value="ascending"> Name: A to Z</option>
                <option value="descending"> Name: Z to A</option>
                {{-- <option value="most_visited"> Most Visited </option> --}}
              </select>
            </div>
          </div>
         <span class="appendAjaxList">
           @include('front.ajaxListing')
         </span>
         
        </div>
      </div>
    </div>
  </div>
</section>
@endsection