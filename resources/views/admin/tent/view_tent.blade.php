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
              <h3 class="card-title">View Tent</h3>
              <a href="{{route('admin.add.edit.tent')}}" style="max-width: 150px; float:right; display:inline-block;" class="btn btn-block btn-success"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;&nbsp;Add Tent</a>
            </div>
            <div class="card-body">
              <table id="monthly-charts" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Tent Type</th>
                  <th>Price</th>
                  <th>Description</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($tents as  $tent)
                <tr>
                    <td>{{ $tent->id}}</td>
                    <td>{{ $tent->name}}</td>
                    <td>
                        @if(!empty( $tent->tentType->name))
                        {{ $tent->tentType->name}}
                        @else
                        No Type
                        @endif
                    </td>
                    <td>{{ $tent->price}}</td>
                    <td>{{ $tent->description}}</td>
                    </td>
                    <td>
                    <a href="{{route('admin.add.edit.tent',  $tent->id)}}" > <i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                    <a href="javascript:" class="delete_form" record= "tent" rel="{{ $tent->id}}" style="display:inline;">
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