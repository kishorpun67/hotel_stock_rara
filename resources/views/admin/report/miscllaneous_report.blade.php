@extends('layouts.admin_layout.admin_layout')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Miscellaneous Report</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Miscellaneous Report</li>
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
              <h3 class="card-title">Miscellaneous</h3>
            </div>
            <div class="card-body">
              <table id="categories" class="table table-bordered table-striped  text-center">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Electricity Uses</th>
                  <th>Interuses</th> 
                  <th>Water Amount</th> 
                  <th>Water Uses</th> 
                  <th>Consumption Bill</th> 
                </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    $electricity_uses = 0;
                    $interuses = 0;
                    $water_amount = 0;
                    $water_uses = 0;
                    $consumption_bill=0;
                    ?>
               @forelse($miscellaneous as $data)
                  <td>{{$data->id}}</td>
                  <td>Rs.{{$data->electricity_uses}}</td>
                  <td>{{$data->interuses}}</td>
                  <td>{{$data->water_amount}}</td>
                  <td>{{$data->water_uses}}.ltr</td>
                  <td>Rs.{{$data->consumption_bill}}</td>
                 
                </tr>
                <?php $i++;
                        $electricity_uses = $electricity_uses + $data->electricity_uses;
                        $interuses = $interuses + $data->interuses;
                        $water_amount = $water_amount + $data->water_amount;
                        $water_uses = $water_uses + $data->water_uses;
                        $consumption_bill=$consumption_bill + $data->consumption_bill;

                        ?>
                @empty
                <p>No Data</p>
                @endforelse
                <tr>
                  <td><strong>Total</strong></td>
                    <td><strong>{{$electricity_uses}}</strong></td>
                    <td><strong>{{$interuses}}</strong></td>
                    <td><strong>{{$water_amount}}</strong></td>
                    <td><strong>{{$water_uses}}</strong></td>
                    <td><strong>{{$consumption_bill}}</strong></td>

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
