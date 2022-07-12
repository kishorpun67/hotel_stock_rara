@extends('layouts.admin_layout.admin_layout')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
         
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Customers </h3>
            </div>
            <div class="card-body">
              <table id="categories" class="table table-bordered table-striped  text-center">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Customer Name</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Status</th>
                  <th>Action</th> 
                </tr>
                </thead>
                <tbody>
               @forelse($customer as $data)
                  <td>{{$data->id}}</td>
                  <td>
                    @if (!empty($data->customer->customer_name))
                     {{$data->customer->customer_name}}
                    @endif
                   </td>
                  <td>   @if (!empty($data->customer->phone))
                    {{$data->customer->phone}}
                   @endif</td>
                  <td>   @if (!empty($data->customer->email))
                    {{$data->customer->email}}
                   @endif</td>
                   <td>{{$data->status}}</td>
                   <td>
                    <a href="{{route('admin.billing.checkout', $data->id)}}"><i class="fa fa-file-invoice"></i></a>&nbsp;&nbsp;
                    <a href="javascript:" class="delete_form" record="billing"  rel="{{$data->id}}" style="display:inline;">
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
