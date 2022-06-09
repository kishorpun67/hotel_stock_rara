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
        @if(!empty($waterdata['id'])) action="{{route('admin.add.edit.water',$waterdata['id'])}}" @else action="{{route('admin.add.edit.water')}}" @endif
        method="post" enctype="multipart/form-data">
        @csrf
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="water_uses">Water Consumption</label>
                  <input type="text" class="form-control" name="water_uses" id="water_uses" placeholder="Enter Water Uses"
                  @if(!empty($waterdata['water_uses']))
                  value= "{{$waterdata['water_uses']}}"
                  @else value="{{old('water_uses')}}"
                  @endif>
                </div>
                <div class="form-group">
                  <label for="water_unit">Water Unit</label>
                  <input type="text" class="form-control" name="water_unit" id="water_unit" placeholder="Enter Water Unit"
                  @if(!empty($waterdata['water_unit']))
                  value= "{{$waterdata['water_unit']}}"
                  @else value="{{old('water_unit')}}"
                  @endif>
                </div>    

                <div class="form-group">
                  <label for="water_month">Months</label>
                  <input type="date" class="form-control" name="water_month" id="water_month" placeholder=""
                  @if(!empty($waterdata['water_month']))
                  value= "{{$waterdata['water_month']}}"
                  @else value="{{old('water_month')}}"
                  @endif>
                </div> 

                <div class="form-group">
                  <label for="water_total">Water Total</label>
                  <input type="text" class="form-control" name="water_total" id="water_total" placeholder="Enter Water Total"
                  @if(!empty($waterdata['water_total']))
                  value= "{{$waterdata['water_total']}}"
                  @else value="{{old('water_total')}}"
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

