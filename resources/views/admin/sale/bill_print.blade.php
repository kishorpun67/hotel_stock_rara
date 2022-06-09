<?php 
  use App\Admin\Admin;
  $admin = Admin::first();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin | Invoice</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 4 -->

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css')}}">
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
                        <i class="fas fa-globe"></i> {{$admin->name}}
                        <small class="float-right">Date: <?php echo  date("Y-m-d") ;?></small>
                    </h2>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    From
                    <address>
          <strong>{{auth('admin')->user()->name}}</strong><br>
          Addres:{{$admin->hotel_address}}<br>
          Phone: {{$admin->number}}<br>
          Email: {{$admin->hotel_email}}
        </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    To
                    <address>
          <strong>Customer: @if (!empty($orderbill->customer->customer_name)) 
            {{$orderbill->customer->customer_name}}
        @else
            Walk-in Customer
        @endif</strong><br>
        </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <b>Invoice #007612</b><br>
                    <br>
                    <b>Order ID:</b> {{$orderbill->id}}<br>
                    {{-- <b>Payment Due:</b> 2/22/2014<br> --}}
                    {{-- <b>Account:</b> 968-34567 --}}
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Serial #</th>
                                <th>Item</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($orderbill->ordrDetails))
                                <?php  $i = 1; $total= 0;?>
                                @foreach ($orderbill->ordrDetails as $item)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$item->item}}</td>
                                        <td>{{$item->price}}</td>
                                        <td>{{$item->quantity}}</td>
                                        <td>{{$item->price * $item->quantity}}</td>
                                    </tr>
                                    <?php 
                                    $i++;
                                    $total = $total+($item->price * $item->quantity);
                                    ?>
                                @endforeach
                            
                            @endif

                            
                            
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                    <p class="lead">Payment Methods: <strong>{{$orderbill->payment}}</strong></p>
                    
                    
                </div>
                <!-- /.col -->
                <div class="col-6">

                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th style="width:50%">Subtotal:</th>
                                <td>{{$total}}</td>
                            </tr>
                            <tr>
                                <th>Tax (0%)</th>
                                <td> {{$orderbill->tax}}%</td>
                            </tr>
                            <tr>
                                <th>Discount:</th>
                                <td>Rs.{{$orderbill->discount}}.00</td>
                            </tr>
                            <tr>
                                <?php $tax = $total*10/100; 
									$grand_total = $total + $tax- $orderbill->discount;
									?>
                                <th>Total:</th>
                                <td>{{$grand_total}}</td>
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