<!DOCTYPE html>
<html>
 <?php 
use App\Admin\Admin;
use App\Admin\Room;
use App\TaxVat;

$tax = TaxVat::first();
$admin = Admin::first();
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Customer Bill Print</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 4 -->

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <!-- Main content -->
        <section class="invoice">
            <!-- title row -->
            <div class="row">
                <div class="col-12">
                    <h2 class="page-header">
                        <i class="fas fa-globe"></i> {{$admin->hotel}}.
                        <small class="float-right">Date: <?php echo  date("d-m-Y") ;?></small>
                    </h2>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    From
                    <address>
                        <strong>{{auth('admin')->user()->name}}.</strong><br>
                        {{$admin->hotel_address}}<br>
                        Phone: (+977) {{$admin->hotel_address}}<br>
                        Lane Line: (+977) {{$admin->lane_line}}<br>
                        Email: {{$admin->hotel_email}}
                      </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    To
                    <address>
                        <strong>{{$customer->customer_name}}</strong><br>
                        {{$customer->address}}<br>
                        Phone: (+977) {{$customer->phone}}<br>
                        Email: {{$customer->email}}
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <b>Invoice #007612</b><br>
                    <br>
                    {{-- <b>Order ID:</b> 4F3S8J<br>
                    <b>Payment Due:</b> 2/22/2014<br>
                    <b>Account:</b> 968-34567 --}}
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <?php 
            $subTotal =0;
            ?>
            <!-- Table row -->
            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-striped">
                      @if(!empty($sales->ordrDetails))
                    <thead>
                    <tr>
                      <th>SN</th>
                      <th>Resturant</th>
                      <th>quantity</th>
                      <th>Rate</th>
                      <th>Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                        
                          @foreach ($sales->ordrDetails as $item)
                            <tr>
                              <td>{{$item->id}}</td>
                              <td>{{$item->item}}</td>
                              <td>{{$item->quantity}}</td>
                              <td>{{$item->price}}</td>
                              <td>{{$item->price *$item->quantity}}</td>
                            </tr>
                          @endforeach
                    </tbody>
                    @endif

                    @if(!empty($swimmingPool->id))
                   
                    <thead>
                    <tr>
                      <th>SN</th>
                      <th>Swimming Pool</th>
                      <th>Number of Customer</th>
                      <th>Duration(Hrs)</th>
                      <th>Rate(Per\hrs)</th>
                      <th>Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>{{$swimmingPool->id}}</td>
                        <td>swimming pool</td>
                        <td>{{$swimmingPool->number_of_customer}}</td>
                        <td>{{$swimmingPool->duration}}</td>
                        <td>{{$swimmingPool->price}}</td>
                        <td>{{$swimmingPool->price *$swimmingPool->duration}}</td>
                        <?php $subTotal +=  $swimmingPool->price *$swimmingPool->duration;?>
                      </tr>

                    </tbody>
                     @endif
                    @if(!empty($rafting->id))
                    <thead>

                      <tr>
                        <th>SN</th>
                        <th>Rafting</th>
                        <th>Number of Customer</th>
                        <th>Duration(Hrs)</th>
                        <th>Rate(Per\hrs)</th>
                        <th>Subtotal</th>
                      </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>{{$rafting->id}}</td>
                          <td>Rafting</td>
                          <td>{{$rafting->number_of_customer}}</td>
                          <td>{{$rafting->duration}}</td>
                          <td>{{$rafting->price}}</td>
                          <td>{{$rafting->price *$rafting->duration}}</td>
                          <?php $subTotal +=  $rafting->price *$rafting->duration;?>

                        </tr>
  
                      </tbody>
                    @endif

                      @if(!empty($camping->id))
                    
                      <thead>

                        <tr>
                          <th>SN</th>
                          <th>Camping</th>
                          <th>Number of Customer</th>
                          <th>Duration(day)</th>
                          <th>Rate(Per\day)</th>
                          <th>Subtotal</th>
                        </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>{{$camping->id}}</td>
                            <td>Camping</td>
                            <td>{{$camping->number_of_customer}}</td>
                            <td>{{$camping->duration}}</td>
                            <td>{{$camping->price}}</td>
                            <td>{{$camping->price *$camping->duration}}</td>
                          <?php $subTotal +=  $camping->price *$camping->duration;?>

                          </tr>
    
                        </tbody>
                        @endif
                        @if(!empty($bookRoom->room_id))
                        <thead>

                          <tr>
                            <th>SN</th>
                            <th>Room</th>
                            <th>Room Type</th>
                            <th>Room Charge</th>
                            <th>Additional Charge</th>
                            <th>Subtotal</th>
                          </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>{{$bookRoom->id}}</td>
                              <td>
                                   @if (!empty($bookRoom->room_id))
                                    <?php 
                                    $ids = explode(',', $bookRoom->room_id);
                                    $rooms = Room::whereIn('id', $ids)->with('roomType')->get();
                                    ?>
                                    {{-- {{$ids}} --}}
                                    @foreach ($rooms as $item)
                                    {{$item->name}} <br>
                                    @endforeach
                                  @else
                                  @endif
                                </td>
                              <td>
                                @if (!empty($bookRoom->room_id))
                                   @foreach ($rooms as $item)
                                    @if (!empty($item->roomType->room_type))
                                        {{$item->roomType->room_type}} <br>
                                    @endif
                                    @endforeach
                              @else
                              @endif</td>
                              <td>{{$bookRoom->room_charge}}</td>
                              <td>{{$bookRoom->aditional_charge}}</td>
                              <td>{{$bookRoom->room_charge + $bookRoom->aditional_charge}}</td>
                          <?php $subTotal +=  $bookRoom->room_charge + $bookRoom->aditional_charge; ?>

                            </tr>
      
                          </tbody>
                        @endif

                  </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                    {{-- <p class="lead">Payment Methods:</p>
                    <img src="../../dist/img/credit/visa.png" alt="Visa">
                    <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
                    <img src="../../dist/img/credit/american-express.png" alt="American Express">
                    <img src="../../dist/img/credit/paypal2.png" alt="Paypal">

                    <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                    </p> --}}
                </div>
                <!-- /.col -->
                <div class="col-6">
                    {{-- <p class="lead">Amount Due 2/22/2014</p> --}}

                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th style="width:50%">Subtotal:</th>
                                <td>{{$subTotal}}</td>
                            </tr>
                            <tr>
                            <th>Tax:</th>
                            <td>
                              {{$tax->tax}}%
                            </td>
                          </tr>
                          <tr>
                            <th>Total:</th>
                            <?php  $total = $subTotal+(($tax->tax*$subTotal)/100); ?>
                            <td>{{$total}}</td>
                          </tr>
                        </table>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- ./wrapper -->

    <script type="text/javascript">
        window.addEventListener("load", window.print());
    </script>
</body>

</html>