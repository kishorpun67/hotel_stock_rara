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
                <h3 class="card-title">Suppler Deu Payments</h3>
               {{-- <a href="{{route('admin.add.edit.attendance')}}" style="max-width: 150px; float:right; display:inline-block;" class="btn btn-block btn-success"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;&nbsp;Add Attendance</a> --}}
              </div>
              <div class="card-body">
                <table id="categorie" class="table table-bordered table-striped  text-center">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Total</th>
                    <th>Paid</th>
                    <th>Due</th>
                    <th>Action</th>
                
                    {{-- <th>Deu</th>
                    <th>Total</th> --}}
                  </tr>
                  </thead>
                  <tbody>
                 @forelse($supplier as $data)
                    <td>{{$data->id}}</td>
                    <td>@if (!empty($data->supplierName->name))
                      {{$data->supplierName->name}}
                    @endif</td>
                    <td>{{$data->created_at}}</td>
                    <td>{{$data->total}}</td>
                    <td>{{$data->paid}}</td>
                    <td>{{$data->due}}</td>
                    <td> <a href="{{route('admin.add.edit.purchase', $data->id)}}">Payment </a></td>
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
    $("#categorie").DataTable();
  });
</script>
@endsection
