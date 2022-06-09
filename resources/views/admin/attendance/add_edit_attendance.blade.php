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
        @if(!empty($attendanceData['id'])) action="{{route('admin.add.edit.attendance',$attendanceData['id'])}}" @else action="{{route('admin.add.edit.attendance')}}" @endif
        method="post" enctype="multipart/form-data">
        @csrf
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="in_date">In Date</label>
                    <input type="" class="form-control" name="in_date" id="in_date" placeholder=""
                    @if(!empty($attendanceData['in_date']))
                    value= "{{$attendanceData['in_date']}}"
                    @else value="<?php 
                    if(date_default_timezone_set('Asia/Kathmandu'))
                    {
                    date("format");
                    echo date( 'Y:m:d');
                    }  
                    ?>"
                    @endif>
                  </div> 
                <div class="form-group">
                    <label for="in_time">In Time</label>
                      <input type="" class="form-control" name="in_time" id="in_time" placeholder=""
                      @if(!empty($attendanceData['in_time']))
                      value= "{{$attendanceData['in_time']}}"
                      @else value="<?php 
                      if(date_default_timezone_set('Asia/Kathmandu'))
                      {
                      date("format");
                      echo date( 'h:ia');
                      }  
                      ?>"
                      @endif>
                    </div>  

                    <div class="form-group">
                      <label for="out_date">Out Date</label>
                        <input type="" class="form-control" name="out_date" id="out_date" placeholder=""
                        @if(!empty($attendanceData['in_date']) && !empty($attendanceData['in_time']))
                        value= "<?php 
                        if(date_default_timezone_set('Asia/Kathmandu'))
                        {
                        date("format");
                        echo date( 'Y:m:d');
                        }  
                        ?>"
                        @else value=""
                        @endif>
                      </div>  
                         <div class="form-group">
                    <label for="out_time">Out Time</label>
                      <input type="" class="form-control" name="out_time" id="out_time" placeholder=""
                      @if(!empty($attendanceData['in_date']) && !empty($attendanceData['in_time']))
                      value= "<?php 
                      if(date_default_timezone_set('Asia/Kathmandu'))
                      {
                      date("format");
                      echo date( 'h:ia');
                      }  
                      ?>"
                      @else value=""
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

