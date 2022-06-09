@extends('layouts.admin_layout.admin_layout')
@section('content')
<?php 
  use App\PurchaseItem;
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Stock Report</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Stock Report</li>
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
              <h3 class="card-title">Stock Report</h3>
            </div>
            <div class="card-body">
              <table id="categories" class="table table-bordered table-striped  text-center">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Ingredient</th>
                  <th>Category</th> 
                  <th>Sock Qty/Amount</th> 
                  <th>Total Cost</th> 
                  <th>Alert Qty/Amount</th> 
                </tr>
                </thead>
                <tbody>
                   
               @forelse($stocks as $data)
                  <td>{{$data->id}}</td>
                  <td>{{$data->name}}</td>
                  <td>
                    @if (!empty($data->ingredientCategory->category))
                    {{$data->ingredientCategory->category}}
                    @endif
                      </td>
                  <td> @if ($data->quantity<= $data->alert_qty)
                    <span style="color: red">{{$data->quantity}} @if (!empty($data->ingredientUnit->unit_name))
                      {{$data->ingredientUnit->unit_name}}
                      @endif </span>
                      
                  @else
                  {{$data->quantity}} @if (!empty($data->ingredientUnit->unit_name))
                  {{$data->ingredientUnit->unit_name}}
                  @endif
                  @endif</td>
                  <?php 
                  // $total  = PurchaseItem::where('ingredient_id', $item->id)->sum('')
                  ?>
                  <td>Rs.{{$data->purchase_price* $data->quantity}}</td>
                  <td>{{$data->alert_qty}}    @if (!empty($data->ingredientUnit->unit_name))
                    {{$data->ingredientUnit->unit_name}}
                    @endif</td>
                </tr>
            
                @empty
                <p>No Data</p>
                @endforelse
               
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
    $("#categories").DataTable();
  });
</script>
@endsection
