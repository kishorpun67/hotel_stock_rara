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
                <h3 class="card-title">Stock Report</h3>
               <a href="" style="max-width: 150px; float:right; display:inline-block;" class="btn btn-block btn-success"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;&nbsp;Export</a>
              </div>
              <div class="card-body">
                <table id="categories" class="table table-bordered table-striped  text-center">
                  <thead>
                  <tr>
                    <th>SN</th>
                    <th>Ingredient(code)</th>
                    <th>Category</th>
                    {{-- <th>Stock Qty/Amount</th> --}}
                    <th>Alert Qty/Amount</th>
                    
                  
                  </tr>
                  </thead>
                  <tbody>
                 @forelse($ingredientItem as $data)
                     <td>{{ $data->id }}</td>
                    <td>{{$data->name}}({{$data->code}})</td>
                    <td>@if(!empty($data->ingredientCategory->category))
                        {{$data->ingredientCategory->category}}
                        @endif
                      </td>
                      {{-- <td>@if(!empty($data->purchase->amount))
                        {{$data->purchase->amount}}
                        @endif
                      </td> --}}
                    <td>{{ $data->alert_qty }}</td>
                           
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
