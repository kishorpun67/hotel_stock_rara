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
        @if(!empty($waiterdata['id'])) action="{{route('admin.add.edit.waiter',$waiterdata['id'])}}" @else action="{{route('admin.add.edit.waiter')}}" @endif
        method="post" enctype="multipart/form-data">
        @csrf
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" name="name" id="name" placeholder="Enter name"
                  @if(!empty($waiterdata['name']))
                  value= "{{$waiterdata['name']}}"
                  @else value="{{old('name')}}"
                  @endif>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                      <input type="text" class="form-control" name="address" id="address" placeholder="Enter address"
                      @if(!empty($waiterdata['address']))
                      value= "{{$waiterdata['address']}}"
                      @else value="{{old('address')}}"
                      @endif>
                    </div>  
                        <div class="form-group">
                            <label for="number">Number</label>
                              <input type="text" class="form-control" name="number" id="number" placeholder="Enter number number"
                              @if(!empty($waiterdata['number']))
                              value= "{{$waiterdata['number']}}"
                              @else value="{{old('number')}}"
                              @endif>
                            </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                          <input type="email" class="form-control" name="email" id="email" placeholder="Enter email"
                          @if(!empty($waiterdata['email']))
                          value= "{{$waiterdata['email']}}"
                          @else value="{{old('email')}}"
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

