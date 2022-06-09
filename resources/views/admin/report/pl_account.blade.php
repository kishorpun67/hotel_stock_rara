@extends('layouts.admin_layout.admin_layout')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>PL Account Report</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">PL Account Report</li>
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
                    <h3 class="card-title">Today & Lastday Sale</h3>
                </div>
                <div class="card-body">
                    <table id="test" class="table table-bordered table-striped  text-center">
                    <thead>
                    <tr>
                        <th>SN</th>
                        <th>LastDay</th>
                        <th>ToDay</th>
                        <th>Different</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>  @if (!empty($last_day_sales1))
                                {{$last_day_sales1}}
                            @else
                                0
                            @endif </td>
                            <td>@if (!empty($current_day_sales))
                                {{$current_day_sales}}
                            @else
                                0
                            @endif </td>
                            <td>{{$current_day_sales-$last_day_sales1}}</td>

                        </tr>
                     
                        
                    </tbody>
                    </table>
                </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Today & Lastday Purchase</h3>
                </div>
                <div class="card-body">
                    <table id="test" class="table table-bordered table-striped  text-center">
                    <thead>
                    <tr>
                        <th>SN</th>
                        <th>LastDay</th>
                        <th>ToDay</th>
                        <th>Different</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>  @if (!empty($last_day_purchase1))
                                {{$last_day_purchase1}}
                            @else
                                0
                            @endif </td>
                            <td>@if (!empty($current_day_purchase))
                                {{$current_day_purchase}}
                            @else
                                0
                            @endif </td>
                            <td>{{$current_day_purchase-$last_day_purchase1}}</td>

                        </tr>
                     
                        
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
