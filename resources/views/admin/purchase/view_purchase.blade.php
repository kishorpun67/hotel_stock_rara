@extends('layouts.admin_layout.admin_layout')
@section('content')
<?php  use App\Purchase;?>
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
              <h3 class="card-title">Purchase</h3>
             <a href="{{route('admin.add.edit.purchase')}}" style="max-width: 150px; float:right; display:inline-block;" class="btn btn-block btn-success"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;&nbsp;Add Purchse</a>
            </div>
            <div class="card-body">
              <table id="categories" class="table table-bordered table-striped  text-center">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Supplier Name</th>
                  <th>Date</th>
                  <th>Total Payable</th> 
                  <th>Paid</th> 
                  <th>Due</th> 
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
               @forelse($purchase as $data)
                  <td>{{$data->id}}</td>
                  <td>
                    @if (!empty($data->supplierName->name))
                    {{$data->supplierName->name}}                        
                    @endif
                  </td>
                  <td>{{$data->date}}</td>
                  <td>{{$data->total}}</td>
                  <td>
                    <?php $due_paid = Purchase::purchaseDue($data->id);
                    $total_paid = $due_paid +$data->paid;
                     ?>
                    {{$total_paid}}</td>
                  <td>{{$data->due}}</td>

                   <td>
                    <a href="{{route('admin.add.edit.purchase', $data->id)}}"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                    <a href="javascript:" class="delete_form" record="purchase"  rel="{{$data->id}}" style="display:inline;">
                      <i class="fa fa-trash fa-" aria-hidden="true" ></i>
                    </a>
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
