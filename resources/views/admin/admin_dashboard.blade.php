 @extends('layouts.admin_layout.admin_layout')
@section('content')
<?php 
use App\OrderDetail;
use App\User;
use App\FoodMenu;
use App\Purchase;
use App\Expense;
use App\Customer;
use App\Attendance;
use App\Supplier;
use App\IngredientItem;
use App\Order;
use App\Ingredient;


$foodMenuCount = FoodMenu::count();
$IngredientItemCount = IngredientItem::count();
$customerCount = Customer::count();
$purchase = Purchase::sum('total');
$salesSum  =Order::sum('total');
$expense = Expense::sum('amount');
$customer = Customer::count();
$attendance = Attendance::count();
$supplier = Supplier::count();
$foodMenu = foodMenu::get();
$ingredientLowStock =IngredientItem::with('ingredientUnit')->whereColumn('ingredient_items.alert_qty', ">=", 'ingredient_items.quantity')->get();
$highest_customer = Order::with('customer')->orderBy('total', 'desc')->limit(10)->get();
$purchase_due = Purchase::with('supplierName')->where('due', "!=", "")->groupBy('supplier_id')->get();

if(auth('admin')->user()->parent_id > 0){
      $admin_id = auth('admin')->user()->parent_id;
  }else{
      $admin_id = auth('admin')->user()->id;
  }

// $user = User::count();
// $total_order = OrderDetail::where('admin_id', $admin_id)->sum('quantity');




?>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            @if(Session::has('error_message'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top: 10px;">
              {{ Session::get('error_message') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif          
        </div><!-- /.col -->
         
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    @if (auth('admin')->user()->type == 'Admin' || auth('admin')->user()->hasPermission(61))
      <section class="content">
        <div class="container-fluid">
          <div class="row">
          
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="ion ion-pizza"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Food Menu</span>
                  <span class="info-box-number">
                    {{ $foodMenuCount }}
                  </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fa fa-leaf"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Ingredient</span>
                  <span class="info-box-number">
                    {{ $IngredientItemCount }}
                  </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div> 
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fa fa-users"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Customer</span>
                  <span class="info-box-number">
                    {{ $customerCount }}
                  </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div> 
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="ion ion-bag"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Purchase</span>
                  <span class="info-box-number">
                    {{ $purchase }}
                  </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="ion ion-bag"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Sale</span>
                  <span class="info-box-number">
                    {{ number_format($salesSum) }}
                  </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-dollar-sign"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Purchase</span>
                  <span class="info-box-number">
                    {{ number_format($expense) }}
                  </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
          </div>
        </div>
      </section>
      <div class="content">
        <div class="container-fluid">
          <!-- Info boxes -->
          <div class="row">
            <div class="col-md-12">
              <h1 style="font-size:24px; opacity:0.8;">Quick Links </h1>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box" style="min-height:58px">
                  <a href="{{route('admin.add.edit.food.menu')}}">

                  <span class="fa fa-book p-2"></span>

                  <div class="info-box-content">

                    <span class="info-box-number">
                    + Food Menu
                    </span>
              </a>

                  </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box" style="min-height:58px">
                <a href="{{route('admin.daily.summary.report')}}">
                <span class="fa fa-list p-2"></span>
                <div class="info-box-content">
                  <span class="info-box-text"></span>

                  <span class="info-box-number">
                  Daily Summary Report
                  </span>
              </a>

                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box" style="min-height:58px">
              
                  <a href="{{route('admin.settings')}}">
                    <span class="fa fa-cog p-2"></span>

                    <div class="info-box-content">
                  <span class="info-box-text"></span>

                  <span class="info-box-number">
                  Settings
                  </span>
                  </a>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box" style="min-height:58px;">
                <a href="{{route('admin.sale.report')}}">

                <span class="fa fa-list p-2"></span>
                <div class="info-box-content">
                  <span class="info-box-text"></span>

                  <span class="info-box-number">
                  Sale Report
                  </span>
                </a>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box" style="min-height:58px;">
                <a href="{{route('admin.stock.report')}}">
                <span class="fa fa-list p-2"></span>
                <div class="info-box-content">
                  <span class="info-box-text"></span>

                  <span class="info-box-number">
                  Stock Report
                  </span>
                </a>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box" style="min-height:58px;">
                <a href="{{route('admin.add.edit.expense')}}">

                <span class="fas fa-money p-2"></span>
                <div class="info-box-content">
                  <span class="info-box-text"></span>

                  <span class="info-box-number">
                  + Expanse
                  </span>
                </a>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box" style="min-height:58px;">
                <a href="{{route('admin.add.edit.purchase')}}">

                <span class="ion ion-bag p-2"></span>
                <div class="info-box-content">
                  <span class="info-box-text"></span>

                  <span class="info-box-number">
                  + Purchase
                  </span>
                </a>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box" style="min-height:58px;">
                <a href="{{route('admin.add.edit.sale')}}">

                <span class="fa fa-television p-2"></span>
                <div class="info-box-content">
                  <span class="info-box-text"></span>
                  <span class="info-box-number">
                    <i class="fa fa-coffee" aria-hidden="true"></i>
                  POS
                  </span>
                </a>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>

        </div>
      </div>
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-6">
              <div class="card">
                <div class="card-header border-0">
                  <div class="d-flex justify-content-between">
                    <h3 class="card-title">Operation Comparision(This Month)</h3>
                  </div>
                </div>
                <div class="card-body">
                  <!-- /.d<-flex -->
                  <div class="position-relative mb-4">
                    <canvas id="sales-chart" height="200"></canvas>
                  </div>
                  <div class="d-flex flex-row justify-content-end">
                    <span class="mr-2">
                      <i class="fas fa-square text-primary"></i> This Month
                    </span>
                  </div>
                </div>
              </div>

              <div class="card">
                <div class="card-header border-0">
                  <h3 class="card-title">Top 10 Food Items This Month</h3>
                </div>
                <div class="card-body table-responsive p-0">
                  <table class="table table-striped table-valign-middle">
                    <thead>
                    <tr>
                      <th>SN </th>
                      <th>Food Name </th>
                      <th >Count</th>                    
                    </tr>
                    </thead>
                    <tbody>
                      @foreach ($foodMenu as $item)
                        <tr>
                          <td>{{$item->id}}</td>
                          <td>
                            {{$item->name}}
                          </td>
                          <td style="">10</td>
                      </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="card">
                <div class="card-header border-0">
                  <h3 class="card-title">Supplier Payables</h3>
                </div>
                <div class="card-body table-responsive p-0">
                  <table class="table table-striped table-valign-middle">
                    <thead>
                    <tr>
                      <th>SN </th>
                      <th>Supplier Name </th>
                      <th >Total Due</th>                    
                    </tr>
                    </thead>
                    <tbody>
                      @foreach ($purchase_due as $item)
                        <tr>
                          <td>{{$item->id}}</td>
                          <td>
                            @if (!empty($item->supplierName->name))
                            {{$item->supplierName->name}}
                            @else
                            @endif
                          </td>
                          <?php $due = Purchase::where('supplier_id',$item->supplier_id)->sum('due');?>
                          <td style="">{{$due}}</td>
                      </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- /.card -->
            
            
              <!-- /.card -->
            </div>
            <!-- /.col-md-6 -->
            <div class="col-lg-6">
              <div class="card">
                <div class="card-header border-0">
                  <h3 class="card-title">Ingredient in Alert/Low Stock</h3>
                </div>
                <div class="card-body table-responsive p-0">
                  <table class="table table-striped table-valign-middle">
                    <thead>
                    <tr>
                      <th>Ingredient Name</th>
                      <th >Current Stock</th>                    
                    </tr>
                    </thead>
                    <tbody>
                      @foreach ($ingredientLowStock as $item)
                        <tr>
                          <td>
                            {{$item->name}}({{$item->code}})
                          </td>
                          <td style="color: red">{{$item->quantity}}  @if (!empty($item->ingredientUnit->unit_name))
                            {{$item->ingredientUnit->unit_name}}
                            @endif</td>
                      </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
              </div>

              <div class="card">
                <div class="card-header border-0">
                  <h3 class="card-title">Top 10 Customer This Month</h3>
                </div>
                <div class="card-body table-responsive p-0">
                  <table class="table table-striped table-valign-middle">
                    <thead>
                    <tr>
                      <th>SN</th>
                      <th>Customer Name</th>
                      <th >Sale Amount</th>                    
                    </tr>
                    </thead>
                    <tbody>
                      <?php $i=0 ?>
                      @foreach ($highest_customer as $item)
                      <?php $i++ ?>
                        <tr>
                          <td>
                            {{$i}}
                          </td>
                          <td>
                            @if (!empty($item->customer->customer_name))
                            {{$item->customer->customer_name}}
                            @else
                            Walk-in Customer
                            @endif
                            
                          </td>
                          <td>{{$item->total}} </td>
                      </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            
              <!-- /.card -->

            
            </div>
            <!-- /.col-md-6 -->
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header border-0">
                  <div class="d-flex justify-content-between">
                    <h3 class="card-title">Monthly Sale Comparision</h3>
                  </div>
                </div>
                <div class="card-body">
                  <!-- /.d<-flex -->
                  <div class="position-relative mb-4">
                    <canvas id="sales_graph" height="200"></canvas>
                  </div>
                  <div class="d-flex flex-row justify-content-end">
                    <span class="mr-2">
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </div>
    @else
    @endif
    <!-- Main content -->
    

</div>
<!-- /.content-wrapper -->

@endsection
