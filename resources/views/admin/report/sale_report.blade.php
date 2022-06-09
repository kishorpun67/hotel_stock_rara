@extends('layouts.admin_layout.admin_layout')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Sale Report</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Sale Report</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    @if(Session::has('success_message'))
      <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 10px;">
        {{ Session::get('success_message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
              <div class="card-header">
                <h3 class="card-title">Sale</h3>
              </div>
              <div class="card-body">
                <table id="test" class="table table-bordered table-striped  text-center">
                  <thead>
                  <tr>
                    <th>SN</th>
                    <th>Reference NO</th>
                    <th>Customer</th>
                    <th>Total</th>
                    <th>Discount</th>
                    <th>Paid</th>
                    <th>Due</th>
                    <th>Food Item</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1;
                    $total = 0;
                    $discount = 0;
                    $paid = 0;
                    $due = 0;
                    ?>
                    @foreach ($sales as $item)
                    <tr>
                      <td>{{$i}}</td>
                      <td>{{$item->code}}</td>
                      <td>
                        @if (!empty($item->customer->customer_name))
                        {{$item->customer->customer_name}}
                        @else
                        Walk-In Customer
                        @endif
                      </td>
                      <td>{{$item->total}}</td>
                      <td>{{$item->discount}}</td>
                      <td>{{$item->paid}}</td>
                      <td>{{$item->due}}</td>
                      <td><small><strong>SN-Item-qty/unitprice-total</strong></small><br>
                        <small>
                            @if (!empty($item->ordrDetails))
                                @foreach ($item->ordrDetails as $data)
                                    {{$data->id}}-{{$data->item}}-{{$data->quantity}}-{{$data->price}}-{{$data->price*$data->quantity}} <br>
                                @endforeach
                                
                            @endif

                        </small>
                    </td>
                    </tr>
                        <?php $i++;
                        $total = $total + $item->total;
                        $discount = $discount + $item->discount;
                        $paid = $paid + $item->paid;
                        $due = $due + $item->due;
                        ?>
                    @endforeach
                    <tr>
                      <td colspan="3">Total</td>
                      <td>{{$total}}</td>
                      <td>{{$discount}}</td>
                      <td>{{$paid}}</td>
                      <td>{{$due}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="col-12">
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Customer Due Report</h3>
                </div>
                <div class="card-body">
                  <table id="test" class="table table-bordered table-striped  text-center">
                    <thead>
                    <tr>
                      <th>SN</th>
                      <th>Reference NO</th>
                      <th>Customer</th>
                      <th>Total</th>
                      <th>Discount</th>
                      <th>Paid</th>
                      <th>Due</th>
                      <th>Food Item</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php $i = 1;
                      $total = 0;
                      $discount = 0;
                      $paid = 0;
                      $due = 0;
                      ?>
                      @foreach ($customerDueOrder as $item)
                      <tr>
                        <td>{{$i}}</td>
                        <td>{{$item->code}}</td>
                        <td>
                          @if (!empty($item->customer->customer_name))
                          {{$item->customer->customer_name}}
                          @else
                          Walk-In Customer
                          @endif
                        </td>
                        <td>{{$item->total}}</td>
                        <td>{{$item->discount}}</td>
                        <td>{{$item->paid}}</td>
                        <td>{{$item->due}}</td>
                        <td><small><strong>SN-Item-qty/unitprice-total</strong></small><br>
                          <small>
                              @if (!empty($item->ordrDetails))
                                  @foreach ($item->ordrDetails as $data)
                                      {{$data->id}}-{{$data->item}}-{{$data->quantity}}-{{$data->price}}-{{$data->price*$data->quantity}} <br>
                                  @endforeach
                                  
                              @endif
  
                          </small>
                      </td>
                      </tr>
                          <?php $i++;
                          $total = $total + $item->total;
                          $discount = $discount + $item->discount;
                          $paid = $paid + $item->paid;
                          $due = $due + $item->due;
                          ?>
                      @endforeach
                      <tr>
                        <td colspan="3">Total</td>
                        <td>{{$total}}</td>
                        <td>{{$discount}}</td>
                        <td>{{$paid}}</td>
                        <td>{{$due}}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
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
