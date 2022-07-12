@extends('layouts.admin_layout.admin_layout')
@section('content')
<?php 
use App\PurchaseItem;
use App\Consumption;
?>

  <!-- Content Wrapper. Contai<>ns page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Stock</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Stock</li>
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
              <h3 class="card-title">Stock</h3>
            </div>
            <div class="card-body">
              <table id="categories" class="table table-bordered table-striped  text-center">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Ingredient </th>
                  <th>Category</th>
                  <th>Quantiy</th>
                  <th>Consumption</th>
                  <th>Alert Quantity</th>
                  <th> Unit</th>
                  {{-- <th>Code</th> --}}
                </tr>
                </thead>
                <tbody>
               @forelse($stock as $data)
                  <td>{{$data->id}}</td>
                  <td>{{$data->name}}</td>
                  {{-- <td>{{$data->purchase_price}}</td> --}}
                  <td>
                    @if (!empty($data->ingredientCategory->category))
                    {{$data->ingredientCategory->category}}
                    @endif</td>
                    <td>
                      <?php 
                      $item_stock = PurchaseItem::where('ingredient_id', $data->id)->sum('quantity');
                      // echo $item_stock;
                      ?>
                      {{$data->quantity}}
                    </td>
                    <td><?php $consumption = Consumption::where('ingredient_id', $data->id)->sum('consumption_quantity');
                    echo $consumption;
                     ?></td>
                  <td>{{$data->alert_qty}}</td>
                  <td>
                    @if (!empty($data->ingredientUnit->unit_name))
                    {{$data->ingredientUnit->unit_name}}
                    @endif
                  </td>
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
