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
<link rel="stylesheet" type="text/css" href="{{asset('front/css/bootstrap-touch-slider.css')}}" media="all">
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
 $tables = Table::get();
?>
</head>
<body>
    <div class="container">
        <figure class="logo_holder"><a href="index.html"> <img src="{{asset('front/images/istockphoto-1156053620-612x612.jpg')}}" alt="This is web logo"> </a> </figure>
        <div class="title_bar my-3">
          <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">Management</a></li>
            <li><a href="#">Services</a></li>
          </ul>
        </div>
                  @foreach ($tables as $item)
              <table class="burger-table">
                  <thead>
                  <tr>
                    <th><a href="#" data-toggle="modal" data-target="#exampleModal-{{$item->id}}"><i class="fa-brands fa-figma"></i><span style="margin-left: 10px">{{$item->table_no}}</span></a></th>
  
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
       
                <div class="modal fade" id="exampleModal-{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title text-aligin-center " id="exampleModalLongTitle" style="text-align: center;
                        ">Table</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <?php
                        $customer_table = CustomerTable::where('table_id',$item->id)->get();
                        $total_customer = CustomerTable::where('table_id',$item->id)->sum('no_customer');

                      ?>
                      <div class="modal-body">
                        <div class="cart-wrapper checkout_wrapper">
                          <div class="cart-top">
                            <h5 style="text-align: center;">Table No : {{$item->table_no}} </h5>
                            <h5 style="text-align: center;">Seat Capacity : {{$item->seat_capacity}} </h5>
                            <h5 style="text-align: center;"  id="available_seat-{{$item->id}}">Avaliable : {{$item->seat_capacity-$total_customer}} </h5>
                            <table class="cart_table">
                              <thead>
                                <tr>
                                  <th>Person</th>
                                  <th>Del</th>
                                </tr>
                              </thead>
                              <tbody id="data-{{$item->id}}">
                                
                                   <div >
                                   @foreach ($customer_table as $data)
                                   <tr>
                                    <td>{{$data->no_customer}}</td>
                                    <td><a href="javascript:" onclick="deleteCustomerTable(this.getAttribute('customer_id'), this.getAttribute('table_id'))" table_id={{$item->id}}  customer_id ={{$data->id}} ><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                                  </tr>
                                   @endforeach
                                  </div>
                                
                                <div class="row">
                                  <div class="col-md-12">
                                      <input type="text" id="no_of_customer-{{$item->id}}" value="1" class="form-control">
                                      <button onclick="addCustomer(this.getAttribute('table_id'))" table_id={{$item->id}} class="btn btn-primary">Add</button>
                                  </div>
                                </div>
                              </tbody>
                              
                            </table>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <a href="{{route('admin.add.table', $item->id)}}"  style=":hover{
                              background-color: #6c757d;
                              border-color: #6c757d;"  class="btn btn-primary">Proceed With Table</a>
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach

                
                
             
       
         
         
         
         
         
         
         
         
         
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
<script type="text/javascript" src="{{asset('front/js/jquery-1.9.1.min.js')}}"></script> 
<script type="text/javascript" src="{{asset('front/js/owl.carouselv2.3.4.js')}}"></script> 
<script type="text/javascript" src="{{asset('front/js/fixed-nav.js')}}"></script> 
<script type="text/javascript" src="{{asset('front/js/jquery.js')}}"></script> 
<script type="text/javascript" src="{{asset('front/js/bootstrap.js')}}"></script> 
<script type="text/javascript" src="{{asset('front/js/Push_up_jquery.js')}}"></script> 
<script type="text/javascript" src="{{asset('front/js/annimatable_jquery.js')}}"></script>
<script src="{{asset('js/admin_js/admin_script.js')}}"></script>

</body>
</html>
