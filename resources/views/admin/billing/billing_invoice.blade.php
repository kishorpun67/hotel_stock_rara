@extends('layouts.admin_layout.admin_layout')
@section('content')
<?php 
use App\Admin\Admin;
use App\Admin\Room;
// use App\TaxVat;

// $tax = TaxVat::first();
$admin = Admin::first();
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Invoice</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Invoice</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-globe"></i> {{$admin->hotel}}.
                    <small class="float-right">Date: <?php echo  date("d-m-Y") ;?></small>
                  </h4>
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

              <!-- Table row -->
              <?php 
              $subTotal =0;
              ?>
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
                  <img src="../../dist/img/credit/paypal2.png" alt="Paypal"> --}}

                  {{-- <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
                    plugg
                    dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                  </p> --}}
                </div>
                <!-- /.col -->
                <div class="col-6">
                  {{-- <p class="lead">Amount Due 2/22/2014</p> --}}

                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%">Subtotal:</th>
                        <td>{{$activity->sub_total}}</td>
                      </tr>
                      <tr>
                        <th>Tax:</th>
                        <td>
                          {{$activity->tax}}%
                        </td>
                      </tr>
                      <tr>
                        <th>Discount:</th>
                        <td>
                          {{$activity->discount}}
                        </td>
                      </tr>
                      <tr>
                        <th>Service Charge:</th>
                        <td>
                          {{$activity->service_charge}}
                        </td>
                      </tr>
                      <tr>
                        <th>Total:</th>
                        <?php  $total = $subTotal+(($activity->tax*$subTotal)/100); 
                        $total_amount = $total + $activity->service_charge -$activity->discount;
                        ?>
                        <td>{{$activity->total}}</td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <a href="{{route('admin.customer.bill.print', $activity->id)}}" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                  {{-- <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                    Payment
                  </button> --}}
                  {{-- <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Generate PDF
                  </button> --}}
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>


@endsection
@section('script')
<script>
  $(function () {
    $("#categories").DataTable();
  });
</script>
@endsection
