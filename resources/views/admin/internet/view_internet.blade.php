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
              <h3 class="card-title">Internet</h3>
             <a href="{{route('admin.add.edit.internet')}}" style="width: auto; float:right; display:inline-block;" class="btn btn-block btn-success"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;&nbsp;Add Internet</a>
            </div>
            <div class="card-body">
              <table id="categories" class="table table-bordered table-striped  text-center">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Internet Consumption</th>
                  <th>Internet Mbps</th> 
                  <th>Months</th> 
                  <th>Internet Total</th> 
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
               @forelse($internet as $data)
                  <td>{{$data->id}}</td>
                  <td>{{$data->internet_uses}}</td>
                  <td>{{$data->internet_mbps}}</td>
                  <td>{{$data->internet_month}}</td>
                  <td>{{$data->internet_total}}</td>
                   <td>
                    <a href="{{route('admin.add.edit.internet', $data->id)}}"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                    <a href="javascript:" class="delete_form" record="internet"  rel="{{$data->id}}" style="display:inline;">
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
