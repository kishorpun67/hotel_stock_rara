<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link rel="shortcut icon" href="{{asset('front/images/favicon.png')}}" type="image/x-icon">
<title>Burger house | Home</title>
<link rel="stylesheet" type="text/css" href="{{asset('front/css/bootstrap.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('front/fonts/fontawesome-free-6.0.0-web/css/fontawesome.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('front/fonts/fontawesome-free-6.0.0-web/css/solid.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('front/fonts/fontawesome-free-6.0.0-web/css/regular.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('front/fonts/fontawesome-free-6.0.0-web/css/brands.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('front/fonts/font-awesome-4.7.0/css/font-awesome-4.7.0.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('front/fonts/fonts.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('front/css/animate.css')}}" />
<!--<link rel="stylesheet" type="text/css" href="{{asset('front/css/bootstrap-touch-slider.css')}}" media="all">-->
<link rel="stylesheet" type="text/css" href="{{asset('front/lightbox/css/lightbox.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('front/css/owl.carouselv2.3.4.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('front/css/reset.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('front/css/style.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('front/css/side_nav.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('front/css/navbar.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('front/css/responsive.css')}}" />
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400&display=swap" rel="stylesheet">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<?php  
  use App\Table;
  use App\CustomerTable;
  use App\Admin\Room;
  use App\Order;
  $tables = Table::orderBy('table_no','asc')->where('room_id', 0)->get();
  $roomBig = Room::where('room_size','Big')->get();
  $roomSmall = Room::orderBy('room_no','asc')->where('room_size','Small')->get();
  

?>
<style>
  .metting-room-active{
    background-color: green;
    color: white;
  }
</style>
</head>
<body>
<div class="container">
  <figure class="logo_holder"><a href="{{route('admin.dashboard')}}"> <img src="{{asset('front/images/istockphoto-1156053620-612x612.jpg')}}" alt="This is web logo"> </a> </figure>
  <div class="title_bar my-3">
    <ul>
      <li><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
      <li><a href="{{route('admin.sale')}}">Sale</a></li>
    </ul>
  </div>
  
  <!--<div class="contact_info">
    <address>
    <figure class="icon"> <i class="fa-solid fa-globe"></i> </figure>
    <div class="details">
      <h4 class="contact_title">Address</h4>
      <span>Burger House <br>
      Bhaktapur</span> </div>
    </address>
    <address>
    <figure class="icon"> <i class="fa-solid fa-phone" aria-hidden="true"></i></figure>
    <div class="details">
      <h4 class="contact_title">Phone</h4>
      <span><a href="tel:#" class="call">9812345678</a></span> </div>
    </address>
    <address>
    <figure class="icon"> <i class="fa-solid fa-envelope" aria-hidden="true"></i> </figure>
    <div class="details">
      <h4 class="contact_title">Email</h4>
      <a href="mailto:#" class="email">info@demomail.com</a> </div>
    </address>
  </div>-->
  

  <div class="button-bar center">
    <h2 class="sub-title">Select</h2>
    <ul>
      <li><a href="#" data-toggle="modal" data-target="#room" class="btn room-btn">Room</a></li>
      <li><a href="#" data-toggle="modal" data-target="#table" class="btn table-btn">Table</a></li>
    </ul>
  </div>
</div>
<div class="modal fade" id="room" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-aligin-center " id="exampleModalLongTitle" style="text-align: center;
        ">Room and Table</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body">
        <div class="cart-wrapper checkout_wrapper">
          <div class="carousel-wrap room-slider backInDown animatable mt-3">
            <div class="owl-carousel owl-theme">
               @foreach ($roomBig as $item)
                  <a href="javascript:" onclick="getRoom(this.getAttribute('room_id'))" room_id={{$item->id}}>
                    <div class="item test" id="metting-room-active-{{$item->id}}">
                      <figure class="room_image zoomIn animated">
                        <img src="{{asset('front/images/71556-200.png')}}" alt="This is Room img"> 
                        <figcaption class="room_caption"> 
                            <h5 style="text-align: center;">	{{$item->name}}</h5>
                            <h5 style="text-align: center;">	Room No : {{$item->room_no}} </h5>
                        </figcaption>
                      </figure>
                    </div>
                  </a>
              @endforeach
            </div>
          </div>
          {{-- <div  id=""> --}}
            @include('admin.sale.ajax_small_room')
          {{-- </div> --}}
          <div class="table-outer" id="ajaxTableRoom">
            @include('admin.sale.ajax_table_room')
          </div>
          <div class="table-outer" id="ajaxTableBigRoom">
            {{-- @include('admin.sale.ajax_big_room_table') --}}
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <form action="{{route('admin.add.table')}}" method="get">
          @csrf
          <input type="hidden" name="table_id" id="table_id">
          <input type="hidden" name="room_id" id="room_id">
          <button class="btn btn-danger"> Proceed With Table</button>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="table" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-aligin-center " id="exampleModalLongTitle" style="text-align: center;
        ">Table</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body">
        <div class="cart-wrapper checkout_wrapper">
          <div class="table-outer"> 
            <table class="burger-table">
              @foreach ($tables->chunk(10) as $item)
              <tbody>
                <tr>
                @foreach ($item as $tables)
                 <?php
                    $count = Order::where('table_id', $tables->id)->count();
                    if($count >0){
                      $order = Order::where('table_id', $tables->id)->first();
                      if(!empty($order->status) && $order->status == 'Paid' || $order->status == 'Cancel'){
                        $roomstatus = "";
                      } else{
                        $roomstatus = "marked";
                      }
                    }else{
                      $roomstatus = "";
                    }
                  ?>
                  <td  class="room-class {{$roomstatus}}" id="table-{{$tables->id}}">
                    <a href="javascript:"  onclick="ajaxTable(this.getAttribute('table_id'))" table_id={{$tables->id}}><i class="fas fa-table"> {{$tables->table_no}}</i></a>
                  </td>
                @endforeach
                </tr>
              <tbody>
              @endforeach
            </table>
          </div>
          <div class="table-outer" id="ajaxTable"> 
            @include('admin.sale.ajax_table')
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <form action="{{route('admin.add.table')}}" method="get">
          @csrf
          <input type="hidden" name="table_id" id="table_ids">
          <button class="btn btn-danger"> Proceed With Table</button>
        </form>
      </div>
    </div>
  </div>
</div>
<footer class="footer mt-5">
  <div class="copyright">
    <div class="container">
      <p class="lft">?? <script type="text/javascript" language="javascript">var date = new Date(); document.write(date.getFullYear());</script> All Rights Reserved.</p>
      <div class="footer-social-icons">
        <ul>
          <li><a href="#"><i class="fab fa-facebook" aria-hidden="true"></i> </a></li>
          <li><a href="#"><i class="fab fa-twitter" aria-hidden="true"></i> </a></li>
          <li><a href="#"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
        </ul>
      </div>
      <p class="rht"> Powered by: <a href="https://rarasoft.business.site/" target="_blank" class="company_link" collator_asort="">&nbsp;Rara Soft Pvt. Ltd</a> </p>
    </div>
  </div>
</footer>
<section class="back_top"><!--//back to top scroll-->
  <div class="container">
    <div id="back-top" style="display: block;"> <a href="#top" title="Go to top"><i class="fa fa-angle-up" aria-hidden="true"></i> </a> </div>
  </div>
</section>
<!--//back to top scroll--> 

<script type="text/javascript" src="{{asset('front/js/jquery-1.9.1.min.js')}}"></script> 
<script type="text/javascript" src="{{asset('front/js/owl.carouselv2.3.4.js')}}"></script> 
<script type="text/javascript">



$('.room-slider .owl-carousel').owlCarousel({
  loop: false,
  margin: 10,
  dots:true,
  nav: false,
//  navText: [
//    "<i class='fa fa-caret-left'></i>",
//    "<i class='fa fa-caret-right'></i>"
//  ],
  autoplay: false,
  autoplayHoverPause: false,
  responsive: {
    0: {
      items: 1
    },
	
   400: {
	items: 2
  },
	
    600: {
      items: 3
    },
 
	
    1000: {
      items: 4
    },
	
 
	
  }
  
})
 
</script> 
<script type="text/javascript" src="{{asset('front/js/fixed-nav.js')}}"></script> 
<script type="text/javascript" src="{{asset('front/js/jquery.js')}}"></script> 
<script type="text/javascript" src="{{asset('front/js/bootstrap.js')}}"></script> 
<script type="text/javascript" src="{{asset('front/js/Push_up_jquery.js')}}"></script> 
<script type="text/javascript" src="{{asset('front/js/annimatable_jquery.js')}}"></script> 
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>

  @if(Session::has('success_message'))
      toastr.options =
      {
          "closeButton" : true,
          "progressBar" : true
      }
          toastr.success("{{ session('success_message') }}");
  @endif
  @if(Session::has('error_message'))
      toastr.options =
      {
          "closeButton" : true,
          "progressBar" : true
      }
              toastr.error("{{ session('error_message') }}");
  @endif
</script>
<script src="{{asset('js/admin_js/admin_script.js')}}"></script>
</body>
</html>
