@extends('layouts.admin_layout.admin_layout')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Catelogues</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Catelogues</li>
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
              <h3 class="card-title">Sale</h3>
            </div>
            <div class="card-body">
              <table id="test" class="table table-bordered table-striped  text-center">
                <thead>
                <tr>
                  <th>SN</th>
                  <th>Date</th>
                  <th>Customer</th>
                  <th>Total</th>
                  <th>Discount</th>
                  <td>Action</td>
                </tr>
                </thead>
                <tbody>
                  <?php $i = 1;
                  $total = 0;
                  $discount = 0;
                  $paid = 0;
                  $due = 0;
                  ?>
                  @foreach ($sale as $item)
                  <tr>
                    <td>{{$i}}</td>
                    <td>{{$item->created_at}}</td>

                    <td>
                      @if (!empty($item->customer->customer_name))
                      {{$item->customer->customer_name}}
                      @else
                      Walk-In Customer
                      @endif
                    </td>
                    <td>{{$item->total}}</td>
                    <td>{{$item->discount}}</td>
                    <td>

                    <a href="{{route('admin.sale.billing', $item->id)}}"><i class="fa fa-file-invoice"></i></a>&nbsp;&nbsp;

                      <a href="javascript:" class="delete_form" record="sale"  rel="{{$item->id}}" style="display:inline;">
                      <i class="fa fa-trash fa-" aria-hidden="true" ></i>
                    </a></td>
                  </tr>
                      <?php $i++;
                      $total = $total + $item->total;
                      $discount = $discount + $item->discount;
                      ?>
                  @endforeach
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
