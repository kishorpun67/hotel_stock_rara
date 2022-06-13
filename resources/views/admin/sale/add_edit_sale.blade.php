<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
<title>Burger house | Dashboard</title>
<link rel="stylesheet" type="text/css" href="{{asset('front/css/bootstrap.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('front/fonts/fontawesome-free-6.0.0-web/css/fontawesome.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('front/fonts/fontawesome-free-6.0.0-web/css/solid.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('front/fonts/fontawesome-free-6.0.0-web/css/regular.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('front/fonts/fontawesome-free-6.0.0-web/css/brands.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('front/fonts/font-awesome-4.7.0/css/font-awesome-4.7.0.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('front/fonts/fonts.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('front/css/animate.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('front/css/bootstrap-touch-slider.css')}}" media="all">
<link rel="stylesheet" type="text/css" href="{{asset('front/lightbox/css/lightbox.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('front/css/owl.carouselv2.3.4.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('front/css/reset.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('front/css/style.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('front/css/side_nav.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('front/css/navbar.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('front/css/isotope.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('front/css/responsive.css')}}" />
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400&display=swap" rel="stylesheet">
<style>
    .invoice-title h2, .invoice-title h3 {
        display: inline-block;
    }

    .table > tbody > tr > .no-line {
        border-top: none;
    }

    .table > thead > tr > .no-line {
        border-bottom: none;
    }

    .table > tbody > tr > .thick-line {
        border-top: 2px solid;
}
</style>
<!------ Include the above in your HEAD tag ---------->


<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

</head>
<body>

  <div class="top_bar">
  <div id="pav-mainnav">
  <div class="logo-bar navigation-bar">
       <div class="container-fluid">
       <div class="row align-items-center">
       <div class="col-5">
       <div class="top_icon__menu topbar-icons">
        <ul>
          <li><a href="{{route('admin.dashboard')}}" ><i class="fas fa-tachometer-alt"></i></i></i></a></li>
          <li><a href="{{route('admin.add.edit.sale')}}" ><i class="fa fa-home" aria-hidden="true"></i></i></a></li>
          <li><a href="{{route('admin.sale')}}" title=""><i class="fa fa-shopping-cart" aria-hidden="true"></i>
          </a></li>
        </ul>
      </div>
      </div>
  <div class="col-2"> <figure class="logo_holder"><a href="index.html"> 
    <img src="{{asset('front/images/istockphoto-1156053620-612x612.jpg')}}" alt="This is web logo">  </a> </figure>
    </div>
       <div class="col-5">
       <div class="topbar_menu_item">
          <ul class="menu__list">
            <li> <a href="#" class="btn btn btn-primary" onclick="getFoodType('All')">All</a> </li>
            <li><a href="#" class="btn btn btn-success" onclick="getFoodType('Kitchen')">Kitchen Items</a></li>
            <li><a href="#" class="btn btn btn-warning" onclick="getFoodType('Caffe')">Caffe Items</a></li>
            <li><a href="#" class="btn btn-info" onclick="getFoodType('Bar')">Bar Items</a></li>
          </ul>
        </div>
       </div>
    </div>
    </div>
    </div>
    </div>
    </div>
      <div class="container-fluid">
    <div id="isotope-container">
      <div class="order-wrapper">
        <h4> Running Orders</h4>
        <ul>
          @foreach ($order as $item)
            <li class=" oder-active" id="orders-{{$item->id}}" ><a href="javascript:"  order_id="{{$item->id}}" class="order_item"> 
              <span>Cust:@if (!empty($item->customer->customer_name))
                  {{$item->customer->customer_name}}
              @else
                Walk-in Customer
              @endif
          <br>
          @if (!empty($item->table->table_no))
            Table:{{$item->table->table_no}}
          @endif
          <br>
          @if(!empty($item->room->room_no))
            Room:{{$item->room->room_no}}
          @endif
          </span> <i class="fa-solid fa-chevron-right"></i></a></li>
          @endforeach
        </ul>
        <button type="button" class="btn  modify_btn operation_button modify_order" data-toggle="modal" data-target="#modify_order"> <i class="fas fa-edit"></i>Modify Order</button>
        <button type="button" class="btn order_btn operation_button test_order_details" data-toggle="modal" data-target="#exampleModal2"> <i class="fas fa-info-circle"></i>Order Details</button>
        <!-- Modal -->
        
        <div class="d-flex justify-content-between align-items-center">
          <button type="button" class="btn operation_button operation_button_50 kot_order_details" data-toggle="modal" data-target="#order-kot"> <i class="fas fa-print"></i>KOT </button>
          <button type="button" class="btn operation_button operation_button_50 bot_order_details" data-toggle="modal" data-target="#exampleModal4"> <i class="fas fa-print"></i>BOT </button>
        </div>
        <div class="d-flex justify-content-between align-items-center">
          <button type="button" class="btn operation_button operation_button_50 order_innovice" data-toggle="modal" data-target="#exampleModal5"> <i class="fas fa-file-invoice"></i>Invoice </button>
          <button type="button" class="btn operation_button operation_button_50 order_bill" data-toggle="modal" data-target="#exampleModal6"> <i class="fas fa-money-bill"></i>Bill </button>
        </div>
        <form action="{{route('admin.cancel.order')}}" method="POST">
          <input type="hidden" name="order_id" id="order_id" value=""  >
          @csrf
          <button class="btn order_btn operation_button"><i class="fa fa-ban" aria-hidden="true"></i>Cancel Order</button>
        </form>
        <button type="button" class="btn order_btn operation_button kitchen_status" data-toggle="modal" data-target="#exampleModal8"> <i class="fas fa-spinner"></i> Kitchen Status</button>
        <div class="modal fade" id="modify_order" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4>Order Details </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
              </div>
                
              <div class="modal-body">
                <span id="ajaxModifyOrder">
                  @include('admin.sale.ajax_order_details')
                </span>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4>Order Details </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
              </div>
                
              <div class="modal-body">
                <span id="ajaxOrderDetail">
                  @include('admin.sale.ajax_order_details')
                </span>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="order-kot" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">KOT Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
              </div>
              <div class="modal-body"> 

              <span id="ajaxKotOrderDetail">
                @include('admin.sale.ajax_kot')
              </span>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="exampleModal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">BOT Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
              </div>
              <div class="modal-body"> 
                <span id="ajaxBotOrderDetail">
                  @include('admin.sale.ajax_bot')
                </span></div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="exampleModal5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Innovie</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
              </div>
              <div class="modal-body"> 
                <spane id="checkout">
                  @include('admin.sale.innovice')
                </spane>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="exampleModal6" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Bill</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
              </div>
              <div class="modal-body"> 
                <spane id="oder-bill">
                  @include('admin.sale.innovice')
                </spane>
              </div>
              <div class="modal-footer">
                 <form action="{{route('admin.bill.print')}}" method="post">
                  @csrf
                  <input type="hidden" name="order_id" id="orders_id" value=""  >
                  <input type="submit" value="Print" class="btn btn-primary"> 
                </form> 
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="exampleModal8" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Alert!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
              </div>
              <div class="modal-body">
                <spane id="ajaxKitchenStatus">
                  @include('admin.sale.ajax_kitchen_status')
                </spane>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Yes</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
              </div>
            </div>
          </div>
        </div>
   
        <form action="{{route('admin.place.order')}}" method="post">
          @csrf
          @if (!empty($table->room->room_no))
            <input type="hidden" name="room_id" value="{{$table->room->id}}">
          @elseif(!empty($table->room_no))
            <input type="hidden" name="room_id" value="{{$table->id}}">
          @else
            <input type="hidden" name="room_id" value="0">
          @endif 
          @if (!empty($table->table_no))
            <input type="hidden" name="table_id" value="{{$table->id}}">
          @else
            <input type="hidden" name="table_id" value="0">
          @endif
      <div class="cart-wrapper checkout_wrapper" id="add_item_table">
        @include('admin.sale.ajax_food_table')
      </form>
</div>
      <div id="filter-big" class="filter"> 
        <!--<strong>Filter by category :</strong> -->
        <a href="javascript:" category_id="all"  class="categories">Show All</a> 
        @foreach ($foodCategories as $item)
          <a href="javascript" class="categories" category_id="{{$item->id}}">{{$item->category_name}}</a> 
        @endforeach
      </div>
      <div class="image-content">
        <div class="form_search mb-3">
          <form role="form">
            <input class="form-control" id="search-field" placeholder="Keywords..." type="search">
            <button type="button" class="btn btn-search"> <i class="fa fa-search"></i></button>
          </form>
          <div class="clear"></div>
        </div>
        <div class="row" id="ajaxItem">
            @include('admin.sale.ajaxItem')
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
<script type="text/javascript" src="{{asset('front/js/fixed-nav.js')}}"></script> 
<script type="text/javascript" src="{{asset('front/js/jquery.js')}}"></script> 
<script type="text/javascript" src="{{asset('front/js/bootstrap.js')}}"></script> 
<script type="text/javascript" src="{{asset('front/js/Push_up_jquery.js')}}"></script> 
<script type="text/javascript" src="{{asset('front/js/annimatable_jquery.js')}}"></script> 
<script type='text/javascript' src="{{asset('front/js/isotope.min.js')}}"></script> 
<script type="text/javascript">
	var $container = $('#isotope-container .image-content ul');
	// Isotope initialize-
	$container.isotope();

	/* ---- Filtering ----- */
	$('#isotope-container').find('.filter a').first().addClass('active');
	$("#isotope-container").find('.filter a').click(function(){		
		if ( $(this).hasClass('active') ) {			  
			return false;		  
		} 
		else {				
			$('#isotope-container').find('.filter a').removeClass('active');				
			var selector = $(this).attr('data-filter');
			$container.isotope({ filter: selector });
			$(this).addClass('active');
			return false;			
		}
	});	
	
 
 
</script>

<script>
 
  
  $('.btn-number').click(function(e){
        // alert('tes')
          e.preventDefault();
          
          fieldName = $(this).attr('data-field');
          attr = $(this).attr('attr');
          type      = $(this).attr('data-type');
          var input = $("#quant-"+attr);
          var currentVal = parseInt(input.val());
          if (!isNaN(currentVal)) {
              if(type == 'minus') {
                  if(currentVal > input.attr('min')) {
                      input.val(currentVal - 1).change();
                  } 
                  if(parseInt(input.val()) == input.attr('min')) {
                      $(this).attr('disabled', true);
                  }
      
              } else if(type == 'plus') {
      
                  if(currentVal < input.attr('max')) {
                      input.val(currentVal + 1).change();
                  }
                  if(parseInt(input.val()) == input.attr('max')) {
                      $(this).attr('disabled', true);
                  }
      
              }
          } else {
              input.val(0);
          }
      });
  $('.input-numbers').focusin(function(){
     $(this).data('oldValue', $(this).val());
  });
  
  $(".input-number").keydown(function (e) {
          // Allow: backspace, delete, tab, escape, enter and .
          if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
               // Allow: Ctrl+A
              (e.keyCode == 65 && e.ctrlKey === true) || 
               // Allow: home, end, left, right
              (e.keyCode >= 35 && e.keyCode <= 39)) {
                   // let it happen, don't do anything
                   return;
          }
          // Ensure that it is a number and stop the keypress
          if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
              e.preventDefault();
          }
      });
  
  
  
  
  </script>
  <script src="{{asset('js/admin_js/admin_script.js')}}"></script>
</body>
</html>
