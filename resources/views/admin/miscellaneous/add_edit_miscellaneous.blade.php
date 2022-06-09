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
        @if(!empty($miscellaneousdata['id'])) action="{{route('admin.add.edit.miscellaneous',$miscellaneousdata['id'])}}" @else action="{{route('admin.add.edit.miscellaneous')}}" @endif
        method="post" enctype="multipart/form-data">
        @csrf
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <h3 class="">Electricity</h3>
                <div class="form-group">
                  <label for="electricity_uses">Electricity Consumption</label>
                  <input type="text" class="form-control" name="electricity_uses" id="electricity_uses" placeholder="Enter Electricity Uses"
                  @if(!empty($miscellaneousdata['electricity_uses']))
                  value= "{{$miscellaneousdata['electricity_uses']}}"
                  @else value="{{old('electricity_uses')}}"
                  @endif>
                </div>
                <div class="form-group">
                  <label for="electricity_unit">Electricity Unit</label>
                  <input type="text" class="form-control" name="electricity_unit" id="electricity_unit" placeholder="Enter Electricity Unit"
                  @if(!empty($miscellaneousdata['electricity_unit']))
                  value= "{{$miscellaneousdata['electricity_unit']}}"
                  @else value="{{old('electricity_unit')}}"
                  @endif>
                </div>    

                <div class="form-group">
                  <label for="electricity_month">Months</label>
                  <input type="date" class="form-control" name="electricity_month" id="electricity_month" placeholder=""
                  @if(!empty($miscellaneousdata['electricity_month']))
                  value= "{{$miscellaneousdata['electricity_month']}}"
                  @else value="{{old('electricity_month')}}"
                  @endif>
                </div> 

                <div class="form-group">
                  <label for="electricity_total">Electricity Total</label>
                  <input type="text" class="form-control" name="electricity_total" id="electricity_total" placeholder="Enter Electricity Total"
                  @if(!empty($miscellaneousdata['electricity_total']))
                  value= "{{$miscellaneousdata['electricity_total']}}"
                  @else value="{{old('electricity_total')}}"
                  @endif>
                </div> 

                <h3 class="">Internet</h3>
                <div class="form-group">
                  <label for="internet_uses">Internet Consumption</label>
                  <input type="text" class="form-control" name="internet_uses" id="internet_uses" placeholder="Enter Internet Uses"
                  @if(!empty($miscellaneousdata['internet_uses']))
                  value= "{{$miscellaneousdata['internet_uses']}}"
                  @else value="{{old('internet_uses')}}"
                  @endif>
                </div>
                <div class="form-group">
                  <label for="internet_mbps">Internet Mbps</label>
                  <input type="text" class="form-control" name="internet_mbps" id="internet_mbps" placeholder="Enter Internet Unit"
                  @if(!empty($miscellaneousdata['internet_mbps']))
                  value= "{{$miscellaneousdata['internet_mbps']}}"
                  @else value="{{old('internet_mbps')}}"
                  @endif>
                </div>    

                <div class="form-group">
                  <label for="internet_month">Months</label>
                  <input type="date" class="form-control" name="internet_month" id="internet_month" placeholder=""
                  @if(!empty($miscellaneousdata['internet_month']))
                  value= "{{$miscellaneousdata['internet_month']}}"
                  @else value="{{old('internet_month')}}"
                  @endif>
                </div> 

                <div class="form-group">
                  <label for="internet_total">Internet Total</label>
                  <input type="text" class="form-control" name="internet_total" id="internet_total" placeholder="Enter Internet Unit"
                  @if(!empty($miscellaneousdata['internet_total']))
                  value= "{{$miscellaneousdata['internet_total']}}"
                  @else value="{{old('internet_total')}}"
                  @endif>
                </div> 

                <h3 class="">Water</h3>
                <div class="form-group">
                  <label for="water_uses">Water Consumption</label>
                  <input type="text" class="form-control" name="water_uses" id="water_uses" placeholder="Enter Water Uses"
                  @if(!empty($miscellaneousdata['water_uses']))
                  value= "{{$miscellaneousdata['water_uses']}}"
                  @else value="{{old('water_uses')}}"
                  @endif>
                </div>
                <div class="form-group">
                  <label for="water_unit">Water Unit</label>
                  <input type="text" class="form-control" name="water_unit" id="water_unit" placeholder="Enter Water Unit"
                  @if(!empty($miscellaneousdata['water_unit']))
                  value= "{{$miscellaneousdata['water_unit']}}"
                  @else value="{{old('water_unit')}}"
                  @endif>
                </div>    

                <div class="form-group">
                  <label for="water_month">Months</label>
                  <input type="date" class="form-control" name="water_month" id="water_month" placeholder=""
                  @if(!empty($miscellaneousdata['water_month']))
                  value= "{{$miscellaneousdata['water_month']}}"
                  @else value="{{old('water_month')}}"
                  @endif>
                </div> 

                <div class="form-group">
                  <label for="water_total">Water Total</label>
                  <input type="text" class="form-control" name="water_total" id="water_total" placeholder="Enter Water Total"
                  @if(!empty($miscellaneousdata['water_total']))
                  value= "{{$miscellaneousdata['water_total']}}"
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

