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
        @if(!empty($customerdata['id'])) action="{{route('admin.add.edit.customer',$customerdata['id'])}}" @else action="{{route('admin.add.edit.customer')}}" @endif
        method="post" enctype="multipart/form-data">
        @csrf
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="customer_name">Name</label>
                  <input type="text" class="form-control" name="customer_name" id="customer_name" placeholder="Enter name"
                  @if(!empty($customerdata['customer_name']))
                  value= "{{$customerdata['customer_name']}}"
                  @else value="{{old('customer_name')}}"
                  @endif>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                      <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter phone number"
                      @if(!empty($customerdata['phone']))
                      value= "{{$customerdata['phone']}}"
                      @else value="{{old('phone')}}"
                      @endif>
                    </div>  
                    <div class="form-group">
                        <label for="email">Email</label>
                          <input type="email" class="form-control" name="email" id="email" placeholder="Enter email"
                          @if(!empty($customerdata['email']))
                          value= "{{$customerdata['email']}}"
                          @else value="{{old('email')}}"
                          @endif>
                        </div>  

                <div class="form-group">
                <label for="dob">Date of birth</label>
                  <input type="date" class="form-control" name="dob" id="dob"
                  @if(!empty($customerdata['dob']))
                  value= "{{$customerdata['dob']}}"
                  @else value="{{old('dob')}}"
                  @endif>
                </div>

                  <div class="form-group">
                    <label for="date_of_aniversary">Date of Anniversary</label>
                      <input type="date" class="form-control" name="date_of_aniversary" id="date_of_aniversary"
                      @if(!empty($customerdata['date_of_aniversary']))
                      value= "{{$customerdata['date_of_aniversary']}}"
                      @else value="{{old('date_of_aniversary')}}"
                      @endif>
                    </div>  
            

                    <div class="form-group">
                        <label for="address">Address</label>
                          <input type="text" class="form-control" name="address" id="address" placeholder="Enter address"
                          @if(!empty($customerdata['address']))
                          value= "{{$customerdata['address']}}"
                          @else value="{{old('address')}}"
                          @endif>
                        </div>
                        <div class="form-group">
                            <label for="gst_number">Pan Number</label>
                              <input type="text" class="form-control" name="gst_number" id="gst_number" placeholder="Enter pan number"
                              @if(!empty($customerdata['gst_number']))
                              value= "{{$customerdata['gst_number']}}"
                              @else value="{{old('gst_number')}}"
                              @endif>
                            </div>
                            <div class="form-group">
                              <label for="description">description</label>
                              <textarea name="description" id="description" cols="20" class="form-control" rows="4"> @if(!empty($customerdata['description']))
                                {{$customerdata['description']}}
                                @else {{old('description')}}
                                @endif</textarea>
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

