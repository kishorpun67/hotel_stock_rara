@extends('layouts.admin_layout.admin_layout')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
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
    @if(Session::has('error_message'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top: 10px;">
        {{ Session::get('error_message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif
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
        @if(!empty($raftingData['id'])) action="{{route('admin.add.edit.rafting',$raftingData['id'])}}" @else action="{{route('admin.add.edit.rafting')}}" @endif
        method="post" enctype="multipart/form-data">
        @csrf
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="name">Customer Name *</label>
                  <select name="customer_id" id="customer_name" class="form-control">
                      <option value="">Select</option>
                      @foreach($customers as $customer)
                          <option value="{{$customer->id}}" 
                              @if(!empty($raftingData['customer_id']) && $raftingData['customer_id']== $customer->id)
                              selected=""
                              @else {{ old('customer_id') ==  $customer->id ? 'selected' : '' }}
                              @endif
                              >{{$customer->customer_name}}
                          </option>
                      @endforeach
                  </select>
                  <p style="color:red">
                    @error('customer_id')
                    {{$message}}
                    @enderror
                  </p>
                </div>
                <div class="form-group">
                  <label for="address">Number of Customer *</label>
                  <input type="number" min="1" class="form-control" name="number_of_customer" id="number_of_customer" placeholder="Number of Customer"
                  @if(!empty($raftingData['number_of_customer']))
                  value= "{{$raftingData['number_of_customer']}}"
                  @else value="{{old('number_of_customer')}}"
                  @endif>
                  <p style="color:red">
                    @error('number_of_customer')
                    {{$message}}
                    @enderror
                  </p>
                </div>  
                <div class="form-group">
                    <label for="price">Price (per hr rate) *</label>
                    <input type="number" min="1" class="form-control totalSummingAmount" name="price" id="price" placeholder="Enter Price"
                    @if(!empty($raftingData['price']))
                    value= "{{$raftingData['price']}}"
                    @else value="{{old('price')}}"
                    @endif>
                    <p style="color:red">
                      @error('price')
                      {{$message}}
                      @enderror
                    </p>
                </div>
                <div class="form-group">
                  <label for="duration">Duration (Hrs) *</label>
                  <input type="number" min="1" class="form-control totalSummingAmount" totalSumming name="duration" id="duration" placeholder="Enter Duration" val
                  @if(!empty($raftingData['duration']))
                  value= "{{$raftingData['duration']}}"
                  @else value=""
                  @endif>
                  <p style="color:red">
                    @error('duration')
                    {{$message}}
                    @enderror
                  </p>
                </div>  
                <div class="form-group">
                  <!--<label for="address">Total</label>-->
                  <input type="hidden"min="1" class="form-control" name="total" id="total" readonly placeholder="Total"
                  @if(!empty($raftingData['total']))
                  value= "{{$raftingData['total']}}"
                  @else value="{{old('total')}}"
                  @endif>
                 
                </div>  
                <div class="form-group">
                  <label for="address">Paid</label>
                  <input type="number" min="1" class="form-control totalSummingAmount" name="paid" id="paid"  placeholder="Paid"
                  @if(!empty($raftingData['paid']))
                  value= "{{$raftingData['paid']}}"
                  @else value="{{old('paid')}}"
                  @endif>
                </div>  
                <div class="form-group">
                  <label for="address">Due</label>
                  <input type="number" class="form-control" name="due" id="due" readonly placeholder="Due"
                  @if(!empty($raftingData['due']))
                  value= "{{$raftingData['due']}}"
                  @else value="{{old('due')}}"
                  @endif>
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

