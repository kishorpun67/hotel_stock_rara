@extends('layouts.admin_layout.admin_layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          
        </div>
      </div><!-- /.container-fluid -->
    </section>
      <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">View Rafting</h3>
              <a href="{{route('admin.add.edit.rafting')}}" style="max-width: 150px; float:right; display:inline-block;" class="btn btn-block btn-success"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;&nbsp;Add Rafting</a>
            </div>
            <div class="card-body">
              <table id="monthly-charts" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Number of Cust</th>
                  <th>Price</th>
                  <th>Duration (Hrs)</th>
                  <th>Total</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($rafting as $rafting)
                <tr>
                    <td>{{$rafting->id}}</td>
                    <td>@if (!empty($rafting->customer->customer_name))
                      {{$rafting->customer->customer_name}}
                  @else
                  @endif</td>
                    <td>{{$rafting->number_of_customer}}</td>
                    <td>{{$rafting->price}}</td>
                    <td>{{$rafting->duration}}</td>
                    <td>{{$rafting->total}}</td>
                    <td>
                    <a href="{{route('admin.add.edit.rafting', $rafting->id)}}" > <i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                    <a href="javascript:" class="delete_form" record="rafting" rel="{{$rafting->id}}" style="display:inline;">
                        <i class="fa fa-trash fa-" aria-hidden="true" ></i>
                    </a>
                   </td>
                </tr>
                @empty
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