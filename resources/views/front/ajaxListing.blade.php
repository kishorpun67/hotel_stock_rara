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