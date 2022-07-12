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
                <h3 class="card-title">Salary</h3>
               {{-- <a href="{{route('admin.add.edit.attendance')}}" style="max-width: 150px; float:right; display:inline-block;" class="btn btn-block btn-success"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;&nbsp;Add Attendance</a> --}}
              </div>
              <div class="card-body">
                <table id="categories" class="table table-bordered table-striped  text-center">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Staff Name</th>
                    <th>Total Work Hour</th>
                    <th>Salary</th>
                  </tr>
                  </thead>
                  <tbody>
                 @forelse($attendance as $data)
                    <td>{{$data->id}}</td>
                    <td>
                      @if (!empty($data->staff->name))
                          {{$data->staff->name}}
                      @endif
                    </td>
                    <td><?php 
                      // $totalDuration = $data->updated_at->diffForHumans($data->created_at);
                      $totalDuration =  $data->created_at->diff($data->updated_at)->format('%H:%I')." Minutes";
                      echo($totalDuration);
                 ?></td>
                       <td><?php 
                       if(!empty($data->staff->price))
                       {
                        $hrs =$data->staff->price;
                        $perMinute = $data->staff->price/60;

                       }else{
                        $hrs = 500;
                        $perMinute = 500/60;

                       }

                        // $totalDuration = $data->updated_at->diffForHumans($data->created_at);
                        $totalDuration =  $data->created_at->diff($data->updated_at)->format('%H:%I');
                        $test = (explode(":",$totalDuration));
                        $hoursPrice = ($test[0] *$hrs) + ($test[1] *$perMinute);
                        // var_dump($totalDuration);
                        echo round($hoursPrice,2);
                   ?>/-Rs</td>
                  
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
