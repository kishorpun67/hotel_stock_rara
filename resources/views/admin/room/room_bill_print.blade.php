<?php 
use App\Admin\Admin;
$admin = Admin::first();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Room | Invoice</title>
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
                        <small class="float-right">Date: <?php echo date("d/m/Y") . "<br>";?>                        </small>
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
                        Address : {{$customer->address}}<br>
                        Phone: (+977) {{$customer->phone}}<br>
                        Email: {{$customer->email}}
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <b>Invoice #00{{$billingRoom->id}}</b><br>
                    <br>
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
                                <th>SN</th>
                                <th>Title</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Room Charge</td>
                                <td>{{$billingRoom->room_charge}}</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Additional Charge</td>
                                <td>{{$billingRoom->aditional_charge}}</td>
                            </tr> <tr>
                                <td>3</td>
                                <td>Advance</td>
                                <td>{{$billingRoom->advance}}</td>
                            </tr> 
                        </tbody>
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
                                <th style="width:39%">Subtotal:</th>
                                <td><?php  $subtotal = $billingRoom->room_charge + $billingRoom->aditional_charge - $billingRoom->advance;
                                    echo $subtotal;?></td>
                            </tr>
                            <tr>
                                <th>Discount: </th>
                                <td>{{$billingRoom->discount}}</td>
                            </tr>
                            <tr>
                                <th>Total:</th>
                                <td><?php  $total = $subtotal -$billingRoom->discount;
                                echo $total; ?></td>
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