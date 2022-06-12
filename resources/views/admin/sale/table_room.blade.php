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
  $tables = Table::get();
  $roomBig = Room::where('room_size','Big')->get();
  $roomSmall = Room::where('room_size','Small')->get();

?>
</head>
<body>
<div class="container">
  <figure class="logo_holder"><a href="index.html"> <img src="{{asset('front/images/istockphoto-1156053620-612x612.jpg')}}" alt="This is web logo"> </a> </figure>
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
          <div class="table-outer">
            <h3 class="room-title mb-0">Room</h3>
            <div class="carousel-wrap room-slider backInDown animatable mt-3">
              <div class="owl-carousel owl-theme">
                 @foreach ($roomBig as $item)
                  <div class="item">
                    <figure class="room_image zoomIn animated">
                      <img src="{{asset('front/images/71556-200.png')}}" alt="This is Room img"> 
                      <figcaption class="room_caption"> 
                          <h5 style="text-align: center;">	{{$item->name}}</h5>
                          <h5 style="text-align: center;">	Room No : {{$item->room_no}} </h5>
                      </figcaption>
                    </figure>
                  </div>
                @endforeach

              </div>
            </div>
            <h3 class="room-title mb-0">Room</h3>
            <table class="burger-table mt-3">
              @foreach ($roomSmall->chunk(10) as $item)
              <tbody>
              <tr>
              @foreach ($item as $room)
		<td><a href=""><i class="fa-brands fa-figma"></i></a></td>
                <td class="marked"><a href=""><i class="fa-brands fa-figma"></i></a></td>
                   <td class="active"><a href=""><i class="fa-brands fa-figma"></i></a></td>
              @endforeach

              </tr>
              <tbody>
            @endforeach
            </table>
            @foreach ($tables as $item)
            <?php
                $customer_table = CustomerTable::where('table_id',$item->id)->get();
                $total_customer = CustomerTable::where('table_id',$item->id)->sum('no_customer');
              ?>
            <div class="table-inner mt-3">
              <figure class="table_image zoomIn animated"> <img src="{{asset('front/images/table-dinner.png')}}" alt="This is Table image">
                <figcaption class="table_caption"> 
                  <h5 style="text-align: center;">Table No : {{$item->table_no}} </h5>
                  <h5 style="text-align: center;">Seat Capacity : {{$item->seat_capacity}} </h5>
                  <h5 style="text-align: center;" >Total Customer : <span id="total-customer-{{$item->id}}">{{$total_customer}}</span> </h5>
                  <h5 style="text-align: center;"  id="available_seat-{{$item->id}}">Avaliable : {{$item->seat_capacity-$total_customer}} </h5>
                </figcaption>
              </figure>
              <table class="cart_table">
                <thead>
                  <tr>
                    <th>Person</th>
                    <th>Type</th>
                    <th>Del</th>
                  </tr>
                </thead>
                <tbody id="data-{{$item->id}}">
                <div > @foreach ($customer_table as $data)
                  <tr>
                    <td>{{$data->no_customer}}</td>
                    <td>{{$data->type}}</td>
                    <td><a href="javascript:" onclick="deleteCustomerTable(this.getAttribute('customer_id'), this.getAttribute('table_id'))" table_id={{$item->id}}  customer_id ={{$data->id}} ><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                  </tr>
                  @endforeach </div>
                <div class="row">
                  <div class="col-md-12 d-flex">
                    <?php $avaliable_seat = $item->seat_capacity-$total_customer;?>
                    @if ($avaliable_seat >= 1)
                    <?php $dispaly ="flex"; $dispaly1 ="none"  ?>
                    @else
                    <?php $dispaly ="none"; $dispaly1 ="block"  ?>
                    @endif
                    <input style="display:{{$dispaly}}" type="number" min="1" id="no_of_customer-{{$item->id}}" value="1" class="form-control">
                    <select style="display:{{$dispaly}}" name="type" id="type-{{$item->id}}" class="form-control">
                      <option value="Sigle">Single</option>
                      <option value="Group">Group</option>
                    </select>
                    <button id="display-btn-{{$item->id}}" style="display:{{$dispaly}}" onclick="addCustomer(this.getAttribute('table_id'))" table_id={{$item->id}} class="btn btn-primary add_btn"><i class="fa-solid fa-plus"></i>Add</button>
                    <button id="display-{{$item->id}}" style="color: red; display:{{$dispaly1}}"  class="btn btn-danger">Booked</button>
                  </div>
                </div>
                  </tbody>
                
              </table>
            </div>
            @endforeach </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <form action="{{route('admin.add.table')}}" method="get">
          @csrf
          <input type="hidden" name="table_id" id="table_id">
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
          <div class="table-outer"> @foreach ($tables as $item)
            <?php
                $customer_table = CustomerTable::where('table_id',$item->id)->get();
                $total_customer = CustomerTable::where('table_id',$item->id)->sum('no_customer');
        
              ?>
            <div class="table-inner mb-3">
<!--              <h5 style="text-align: center;">Table No : {{$item->table_no}} </h5>
              <h5 style="text-align: center;">Seat Capacity : {{$item->seat_capacity}} </h5>
              <h5 style="text-align: center;" >Total Customer : <span id="total-customer-{{$item->id}}">{{$total_customer}}</span> </h5>
              <h5 style="text-align: center;"  id="available_seat-{{$item->id}}">Avaliable : {{$item->seat_capacity-$total_customer}} </h5>-->
              <figure class="table_image flipInY animatable"> <img src="{{asset('front/images/table-dinner.png')}}" alt=""> 
              
              <figcaption class="table_caption"> 
              
 <h5 style="text-align: center;">Table No : {{$item->table_no}} </h5>
              <h5 style="text-align: center;">Seat Capacity : {{$item->seat_capacity}} </h5>
              <h5 style="text-align: center;" >Total Customer : <span id="total-customer-{{$item->id}}">{{$total_customer}}</span> </h5>
              <h5 style="text-align: center;"  id="available_seat-{{$item->id}}">Avaliable : {{$item->seat_capacity-$total_customer}} </h5>
              </figcaption>
              
              
              </figure>
              <table class="cart_table">
                <thead>
                  <tr>
                    <th>Person</th>
                    <th>Type</th>
                    <th>Del</th>
                  </tr>
                </thead>
                <tbody id="data-{{$item->id}}">
                <div > @foreach ($customer_table as $data)
                  <tr>
                    <td>{{$data->no_customer}}</td>
                    <td>{{$data->type}}</td>
                    <td><a href="javascript:" onclick="deleteCustomerTable(this.getAttribute('customer_id'), this.getAttribute('table_id'))" table_id={{$item->id}}  customer_id ={{$data->id}} ><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                  </tr>
                  @endforeach </div>
                <div class="row">
                  <div class="col-md-12 d-flex">
                    <?php $avaliable_seat = $item->seat_capacity-$total_customer;?>
                    @if ($avaliable_seat >= 1)
                    <?php $dispaly ="flex"; $dispaly1 ="none"  ?>
                    @else
                    <?php $dispaly ="none"; $dispaly1 ="block"  ?>
                    @endif
                    <input style="display:{{$dispaly}}" type="number" min="1" id="no_of_customer-{{$item->id}}" value="1" class="form-control">
                    <select style="display:{{$dispaly}}" name="type" id="type-{{$item->id}}" class="form-control">
                      <option value="Sigle">Single</option>
                      <option value="Group">Group</option>
                    </select>
                    <button id="display-btn-{{$item->id}}" style="display:{{$dispaly}}" onclick="addCustomer(this.getAttribute('table_id'))" table_id={{$item->id}} class="btn btn-primary add_btn"><i class="fa-solid fa-plus"></i>Add</button>
                    <button id="display-{{$item->id}}" style="color: red; display:{{$dispaly1}}"  class="btn btn-danger">Booked</button>
                  </div>
                </div>
                  </tbody>
                
              </table>
            </div>
            @endforeach </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <form action="{{route('admin.add.table')}}" method="get">
          @csrf
          <input type="hidden" name="table_id" id="table_id">
          <button class="btn btn-danger"> Proceed With Table</button>
        </form>
      </div>
    </div>
  </div>
</div>
<footer class="footer mt-5">
  <div class="copyright">
    <div class="container">
      <p class="lft">© <script type="text/javascript" language="javascript">var date = new Date(); document.write(date.getFullYear());</script> All Rights Reserved.</p>
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
  loop: true,
  margin: 10,
  dots:true,
  nav: true,
//  navText: [
//    "<i class='fa fa-caret-left'></i>",
//    "<i class='fa fa-caret-right'></i>"
//  ],
  autoplay: true,
  autoplayHoverPause: true,
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
<script src="{{asset('js/admin_js/admin_script.js')}}"></script>
</body>
</html>
