  <!-- Navbar -->

  <?php 
    use App\OrderDetail;
    use App\foodMenu;
    use App\Purchase;
    use App\Expense;
    use App\Customer;
    use App\Attendance;
    use App\Supplier;
    use App\paymentMethod;
    use App\IngredientItem;
    use App\Order;
    use App\Ingredient;
    use Carbon\Carbon;

    $purchasePaid = Purchase::whereDay('created_at', Carbon::now()->day)->sum('paid');
    $salePaid = Order::whereDay('created_at', Carbon::now()->day)->sum('paid');
    $tax = Order::whereDay('created_at', Carbon::now()->day)->where('tax', "!=", "")->sum('total');
    $expanse = Expense::whereDay('created_at', Carbon::now()->day)->sum('amount');
    $supplierDueReceive = Purchase::whereDay('created_at', Carbon::now()->day)->where('due', "!=", "")->sum('due');
    $customerDueReceive = Order::whereDay('created_at', Carbon::now()->day)->where('due', "!=", "")->sum('due');


    $totalSale = Order::whereDay('created_at', Carbon::now()->day)->sum('total');
    $totalPurchase = Purchase::whereDay('created_at', Carbon::now()->day)->sum('total');

   $total = $totalSale + $totalPurchase + $expanse;




    


  ?>
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('admin.add.edit.sale')}}" class="nav-link">POS</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('admin.add.edit.purchase')}}" class="nav-link">Add Purchase</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link" data-toggle="modal" data-target="#today_summary">Today Summary</a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
     
     
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto" >
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">{{Auth::guard('admin')->user()->unReadnotifications->count()}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="width: 1000px">
          <span class="dropdown-item dropdown-header">{{Auth::guard('admin')->user()->unReadnotifications->count()}} Notifications</span>
          @foreach(Auth::guard('admin')->user()->unReadnotifications as $notification)
            @if (!empty($notification->data['order']))
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              {{$notification->data['order']['title']}} {{$notification->data['order']['order_id']}} {{$notification->data['order']['body']}}
              <span class="float-right text-muted text-sm">{{$notification->created_at->diffForHumans()}}</span>
            </a>
            @endif
            @if (!empty($notification->data['alert']))
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              {{$notification->data['alert']['title']}} {{$notification->data['alert']['table']}} {{$notification->data['alert']['floor']}} {{$notification->data['alert']['floor_no']}}
              <span class="float-right text-muted text-sm">{{$notification->created_at->diffForHumans()}}</span>
            </a>
            @endif
            
          @endforeach
          <div class="dropdown-divider"></div>
          <a href="{{route('admin.read.all.notification')}}" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link"  href="{{route('admin.logout')}}">
          <i class="fa fa-sign-out" ></i>logout
        </a>
      </li>
    </ul>
  </nav>
  <div class="modal fade" id="today_summary" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Today Summary</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
        </div>
        <div class="modal-body">
          <div>
          </div>
          <table class="table">
            <thead>
              <tr>
                <th>Title</th>
                <th>Amount</th>
              </tr>
            </thead>
            <tbody>

              <tr>
                <td>Purchase(only padi Amount)</td>
                <th>{{$purchasePaid}}.00</th>
              </tr>
              <tr>
                <td>Sale(only padi Amount)</td>
                <th>{{$salePaid}}.00</th>
              </tr>
              <tr>
                <td>Total Tax</td>
                <th>{{$tax*10/100}}.00</th>
              </tr>
              <tr>
                <td>Expanse</td>
                <th>{{$expanse}}.00</th>
              </tr>
              <tr>
                <td>Supplier Due Payment</td>
                <th>{{$supplierDueReceive}}.00</th>
              </tr>
              <tr>
                <td>Customer Due Receive</td>
                <th>{{$customerDueReceive}}.00</th>
              </tr>
              <tr>
                <td>Blance = ((Sale + Customer Due Recive) - (Purchase + Supplier Due Payment ) + Expense)</td>
                <th>{{ $total }}.00</th>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Yes</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal">No</button> --}}
        </div>
      </div>
    </div>
  </div>
  <!-- /.navbar -->
