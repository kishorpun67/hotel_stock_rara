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
        @if(!empty($swimmingPoolData['id'])) action="{{route('admin.add.edit.swimming.pool',$swimmingPoolData['id'])}}" @else action="{{route('admin.add.edit.swimming.pool')}}" @endif
        method="post" enctype="multipart/form-data">
        @csrf
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="name">Name *</label>
                  <select name="customer_id" id="customer_name" class="form-control">
                      <option value="">Select</option>
                      @foreach($customers as $customer)
                          <option value="{{$customer->id}}" 
                              @if(!empty($swimmingPoolData['customer_id']) && $swimmingPoolData['customer_id']== $customer->id)
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
                  <label for="number">Number of Customer *</label>
                  <input type="number"  min="1" class="form-control totalSummingAmount" name="number_of_customer" id="number_of_customer" placeholder="Number of Customer"
                  @if(!empty($swimmingPoolData['number_of_customer']))
                  value= "{{$swimmingPoolData['number_of_customer']}}"
                  @else value="{{old('number_of_customer')}}"
                  @endif>
                  <p style="color:red">
                    @error('number_of_customer')
                    {{$message}}
                    @enderror
                  </p>
                </div>  
                <div class="form-group">
                    <label for="price">Price (Per hrs rate\Per Person) *</label>
                    <input type="number"  min="1" class="form-control totalSummingAmount" name="price" id="price" placeholder="Enter Price"
                    @if(!empty($swimmingPoolData['price']))
                    value= "{{$swimmingPoolData['price']}}"
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
                  <input type="number"  min="1" class="form-control totalSummingAmount" totalSumming name="duration" id="duration" placeholder="Enter Duration" val
                  @if(!empty($swimmingPoolData['duration']))
                  value= "{{$swimmingPoolData['duration']}}"
                  @else value=""
                  @endif>
                  <p style="color:red">
                    @error('duration')
                    {{$message}}
                    @enderror
                  </p>
                </div>  
                <div class="form-group">
                  <label for="address">Total</label>
                  <input type="number" class="form-control" name="total" id="total" readonly placeholder="Total"
                  @if(!empty($swimmingPoolData['total']))
                  value= "{{$swimmingPoolData['total']}}"
                  @else value="{{old('total')}}"
                  @endif>
                </div>  
                <div class="form-group">
                  <!--<label for="address">Paid</label>-->
                  <input type="hidden" class="form-control totalSummingAmount"  min="1" name="paid" id="paid"  placeholder="Paid"
                  @if(!empty($swimmingPoolData['paid']))
                  value= "{{$swimmingPoolData['paid']}}"
                  @else value="{{old('paid')}}"
                  @endif>
                </div>  
                <div class="form-group">
                  <label for="address">Due</label>
                  <input type="number" class="form-control" name="due" id="due" readonly placeholder="Due"
                  @if(!empty($swimmingPoolData['due']))
                  value= "{{$swimmingPoolData['due']}}"
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

