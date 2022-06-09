@extends('layouts.admin_layout.admin_layout')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Catalogues</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Catalogues</li>
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
    {{-- @if(Session::has('error_message'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top: 10px;">
        {{ Session::get('error_message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif --}}
    @error('url')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{$message}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
      @enderror 
    <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">{{ $title}}</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
          </div>
        </div>
        <form
        @if(!empty($orderData['id'])) action="{{route('admin.add.edit.order',$orderData['id'])}}" @else action="{{route('admin.add.edit.order')}}" @endif
        method="post" enctype="multipart/form-data">
        @csrf
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">           
              <div class="form-group">
                    <label for="waiter_id">Waiter Name</label>
                    <select name="waiter_id" id="waiter_id" class="form-control form-control-sm " >
                        <option value="" >Select</option>
                        @forelse($waiter as $data)
                                <option value="{{$data->id}}"
                                  @if (!empty($orderData['waiter_id']) && $orderData['waiter_id'] == $data->id)
                                      selected=""
                                  @endif
                                    >&nbsp;&raquo;&nbsp; {{$data->name}}
                                </option>     
                        @empty
                        @endforelse
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="customer_id">Customer Name</label>
                    <select name="customer_id" id="customer_id" class="form-control form-control-sm " >
                        <option value="" >Select</option>
                        @forelse($customer as $data)
                                <option value="{{$data->id}}"
                                  @if (!empty($orderData['customer_id']) && $orderData['customer_id'] == $data->id)
                                      selected=""
                                  @endif
                                    >&nbsp;&raquo;&nbsp; {{$data->customer_name}}
                                </option>     
                        @empty
                        @endforelse
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="order_detail_id">Order Detail</label>
                    <input type="text" class="form-control" name="order_detail_id" id="order_detail_id" placeholder="Enter order detail"
                    @if(!empty($orderData['order_detail_id']))
                    value= "{{$orderData['order_detail_id']}}"
                    @else value="{{old('order_detail_id')}}"
                    @endif>
                  </div>

                  <div class="form-group">
                    <label for="table_id">Table</label>
                    <select name="table_id" id="table_id" class="form-control form-control-sm " >
                        <option value="" >Select</option>
                        @forelse($table as $data)
                                <option value="{{$data->id}}"
                                  @if (!empty($orderData['table_id']) && $orderData['table_id'] == $data->id)
                                  selected=""
                              @endif
                                    >&nbsp;&raquo;&nbsp; {{$data->table_name}}
                                </option>      
                        @empty
                        @endforelse
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="number_of_customer">Number of Customer</label>
                    <input type="text" class="form-control" name="number_of_customer" id="number_of_customer" placeholder="Enter Number of Customer"
                    @if(!empty($orderData['number_of_customer']))
                    value= "{{$orderData['number_of_customer']}}"
                    @else value="{{old('number_of_customer')}}"
                    @endif>
                  </div>

            </div>
          </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">{{$button}}</button>
          </div>
        </form>
      </div>
    </div>
  </section>
</div>
@endsection

