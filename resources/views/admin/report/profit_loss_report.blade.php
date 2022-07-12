@extends('layouts.admin_layout.admin_layout')
@section('content')
<?php 
  use App\Order;
  $current_month = date('M');
  $last_month = date('M',strtotime("-1 month"));
  $last_to_last_month3 = date('M',strtotime("-2 month"));
  $last_to_last_month4 = date('M',strtotime("-3 month"));
  $last_to_last_month5 = date('M',strtotime("-4 month"));
  $last_to_last_month6 = date('M',strtotime("-5 month"));
  $last_to_last_month7 = date('M',strtotime("-6 month"));
  $last_to_last_month8 = date('M',strtotime("-7 month"));
  $last_to_last_month9 = date('M',strtotime("-8 month"));
  $last_to_last_month10 = date('M',strtotime("-9 month"));
  $last_to_last_month11 = date('M',strtotime("-10 month"));
  $last_to_last_month12 = date('M',strtotime("-11 month"));

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profit and Loss Report</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Profit and Loss Report</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
 
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
              <div class="card-header">
                <h3 class="card-title">Profit and Loss </h3>
              </div>
              <div class="card-body">
                <table id="test" class="table table-bordered table-striped  text-center">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Select Months</label>
                        <select name="" id="get_month" class="form-control getMonthlyProfitLoss" >
                          <option value="1">{{$current_month}}</option>
                          <option value="2">{{$last_month}}</option>
                          <option value="3">{{$last_to_last_month3}}</option>
                          <option value="4">{{$last_to_last_month4}}</option>
                          <option value="5">{{$last_to_last_month5}}</option>
                          <option value="6">{{$last_to_last_month6}}</option>
                          <option value="7">{{$last_to_last_month7}}</option>
                          <option value="8">{{$last_to_last_month8}}</option>
                          <option value="9">{{$last_to_last_month9}}</option>
                          <option value="10">{{$last_to_last_month10}}</option>
                          <option value="11">{{$last_to_last_month11}}</option>
                          <option value="12">{{$last_to_last_month12}}</option>
                          <option value="all">All</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <thead>
                  <tr>
                    <th>SN</th>
                    <th>Customer</th>
                    <th>Date</th>
                    <th>Item</th>
                    <th>Purchase Price(Per Item)</th>
                    <th>Sale Price (Per Item)</th>
                    <th>Quantity</th>
                    <th>Profit</th>
                    <th>Ingredient Consumption</th>
                  </tr>
                  </thead>
                  <tbody id="ajaxProfitLoss">
                    @include('admin.report.ajax_profit_loss')
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
          <div class="row">
            <?php $i = 1;
              $total_purchased = 0;
              $total_sales = 0;
              $total_quantity = 0;
              $total_profit = 0;
            ?>
            @foreach ($order as $item)
              <?php 
              $purchaseprice = Order::purchasePriceItem($item->item_id);
                $total_purchased +=$purchaseprice;
                $profit = $item->price -$purchaseprice;
                $total_sales += $item->price;
                $total_quantity += $item->quantity;
                $total_profit += $profit*$item->quantity;
              ?> 
            @endforeach
            <div class="col-md-3 col-sm-6 col-12">

              <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fa fa-truck"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Purchase</span>
                  <span class="info-box-number">{{$total_purchased}}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">
              <div class="info-box">
                <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>
  
                <div class="info-box-content">
                  <span class="info-box-text">Sale</span>
                  <span class="info-box-number">{{number_format($total_sales)}}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">
              <div class="info-box">
                <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>
  
                <div class="info-box-content">
                  <span class="info-box-text">Quantity</span>
                  <span class="info-box-number">{{number_format($total_quantity)}}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">
              <div class="info-box">
                <span class="info-box-icon bg-danger"><i class="far fa-star"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Profit</span>
                  <span class="info-box-number">{{number_format($total_profit)}}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
          </div>
      </section>
  </div>

@endsection
@section('script')
<script>
  $(function () {
    $("#test").DataTable();
  });
</script>
@endsection
