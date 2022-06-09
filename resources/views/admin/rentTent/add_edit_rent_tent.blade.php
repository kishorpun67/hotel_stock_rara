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
        @if(!empty($rentTentData['id'])) action="{{route('admin.add.edit.rent.tent',$rentTentData['id'])}}" @else action="{{route('admin.add.edit.rent.tent')}}" @endif
        method="post" enctype="multipart/form-data">
        @csrf
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="name">Name *</label>
                  <select name="customer_id" id="customer_name" class="form-control select2">
                      <option value="">Select</option>
                      @foreach($customers as $customer)
                          <option value="{{$customer->id}}" 
                              @if(!empty($rentTentData['customer_id']) && $rentTentData['customer_id']== $customer->id)
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
                    <label for="name">Tent Type *</label>
                    <select name="tent_id[]" id="tent_id" multiple="multiple" class="form-control select2">
                        <option value="">Select</option>
                        @foreach($tents as $tent)
                            <option value="{{$tent->id}}" 
                              @if (!empty($rentTentData['tent_id']))
                              <?php echo isset($rentTentData['tent_id']) && in_array($tent->id,explode(',',$rentTentData['tent_id'])) ? "selected" : '' ?>
                                @else 
                                {{ old('tent_id') == $tent->id ? 'selected' : '' }}

                              @endif
                               
                                >{{$tent->name}}
                            </option>
                        @endforeach
                    </select>
                    <p style="color:red">
                      @error('tent_id')
                      {{$message}}
                      @enderror
                    </p>
                </div>
                <div class="form-group">
                    <label for="price">Price (per day rate) *</label>
                    <input type="number" min="1" class="form-control totalCampingAmount" name="price" id="price" placeholder="Enter Price"
                    @if(!empty($rentTentData['price']))
                    value= "{{$rentTentData['price']}}"
                    @else value="{{old('price')}}"
                    @endif>
                    <p style="color:red">
                      @error('price')
                      {{$message}}
                      @enderror
                    </p>
                </div>
                <div class="form-group">
                  <label for="duration">Duration (Day) *</label>
                  <input type="number" min="1" class="form-control totalCampingAmount" totalSumming name="duration" id="duration" placeholder="Enter Duration" val
                  @if(!empty($rentTentData['duration']))
                  value= "{{$rentTentData['duration']}}"
                  @else value=""
                  @endif>
                  <p style="color:red">
                    @error('duration')
                    {{$message}}
                    @enderror
                  </p>
                </div>  
                
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="address">Number of Customer *</label>
                    <input type="number" min="1" class="form-control" name="number_of_customer" id="number_of_customer" placeholder="Number of Customer"
                    @if(!empty($rentTentData['number_of_customer']))
                    value= "{{$rentTentData['number_of_customer']}}"
                    @else value="{{old('number_of_customer')}}"
                    @endif>
                    <p style="color:red">
                      @error('number_of_customer')
                      {{$message}}
                      @enderror
                    </p>
                  </div>  
                  <div class="form-group">
                    <!--<label for="address">Total</label>-->
                    <input type="hidden" class="form-control" name="total" id="total" readonly placeholder="Total"
                    @if(!empty($rentTentData['total']))
                    value= "{{$rentTentData['total']}}"
                    @else value="{{old('total')}}"
                    @endif>
                  </div>  
                  <div class="form-group">
                    <label for="address">Paid</label>
                    <input type="number"min="1" class="form-control totalCampingAmount" name="paid" id="paid"  placeholder="Paid"
                    @if(!empty($rentTentData['paid']))
                    value= "{{$rentTentData['paid']}}"
                    @else value="{{old('paid')}}"
                    @endif>
                  </div>  
                  <div class="form-group">
                    <label for="address">Due</label>
                    <input type="number" class="form-control" name="due" id="due" readonly placeholder="Due"
                    @if(!empty($rentTentData['due']))
                    value= "{{$rentTentData['due']}}"
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

