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
                <h3 class="card-title">Attendance Report</h3>
               {{-- <a href="{{route('admin.add.edit.attendance')}}" style="max-width: 150px; float:right; display:inline-block;" class="btn btn-block btn-success"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;&nbsp;Add Attendance</a> --}}
              </div>
              <div class="card-body">
                <table id="categories" class="table table-bordered table-striped  text-center">
                    <thead>
                    <tr>
                      <th>ID</th>
                      <th>In Time</th>
                      <th>Out Time</th>
                      <th>In Date</th>
                      <th>Out Date</th>
                      <th>Total Work Hour</th>
                     
                    </tr>
                    </thead>
                    <tbody>
                   @forelse($attendance as $data)
                   <td>{{$data->id}}</td>
                   <td>{{$data->in_date}}</td>
                    <td>{{$data->in_time}}</td>
                     <td>{{$data->out_date}}</td>
                      <td>{{$data->out_time}}</td>
                      <td><?php 
                           $intime = (int)$data->out_time -(int)$data->in_time;
                           $string = abs($intime);
                           echo strval($string);
                      ?>: hour</td>
                    
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
