@extends('layouts.admin_layout.admin_layout')
@section('content')
<?php 
use App\Order;
use App\Table;
use App\Admin\Room;

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
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
              <h3 class="card-title">Ready food</h3>
            </div>
            <div class="card-body">
              <table id="categories" class="table table-bordered table-striped  text-center">
                <thead>
                <tr>
                  <th>Notification List</th>
                </tr>
                </thead>
                <tbody>
               @forelse($collectfood as $data)
                  <td>@if (!empty($data->order->table_id) || !empty($data->order->room_id))
                    <?php $orders = Order::with('table','room')->where('id',$data->order->id)->first();  ?>
                    @if (!empty($orders->table->table_no) )
                     Table no: {{$orders->table->table_no}},
                    @endif
                    @if (!empty($orders->room->room_no) )
                      Room no: {{$orders->room->room_no}},
                    @endif
                  @endif Item: {{$data->item}} is ready to serve &nbsp;&nbsp; 
                  <form action="{{route('admin.collect.food')}}" method="post">
                    @csrf <input type="hidden" name="food_id" value="{{$data->id}}">
                  <button  class="btn btn-success">Collect</button>
                </form></td>
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