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
        @if(!empty($leavedata['id'])) action="{{route('admin.add.edit.leave',$leavedata['id'])}}" @else action="{{route('admin.add.edit.leave')}}" @endif
        method="post" enctype="multipart/form-data">
        @csrf
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                  <div class="form-group">
                    <label for="date">Date</label>
                      <input type="date" class="form-control" name="date" id="date"
                      @if(!empty($leavedata['date']))
                      value= "{{$leavedata['date']}}"
                      @else value="{{old('date')}}"
                      @endif>
                    </div>
                 
                  <div class="form-group">
                    <label for="subject">Subject</label>
                    <textarea name="subject" id="subject" cols="20" class="form-control" rows="4"> @if(!empty($leavedata['subject']))
                      {{$leavedata['subject']}}
                      @else {{old('subject')}}
                      @endif</textarea>
                  </div>

                  <div class="form-group">
                    <label for="days">Days</label>
                      <input type="text" class="form-control" name="days" id="days" placeholder="Enter days"
                      @if(!empty($leavedata['days']))
                      value= "{{$leavedata['days']}}"
                      @else value="{{old('days')}}"
                      @endif>
                    </div>

                <div class="form-group">
                  <label for="letter">Letter</label>
                  <input type="file" class="form-control" name="letter" id="letter" placeholder="Enter table name"
                  @if(!empty($leavedata['letter']))
                  value= "{{$leavedata['letter']}}"
                  @else value="{{old('letter')}}"
                  @endif>
                </div>
                {{-- <div class="form-group">
                    <label for="status">Status</label>
                      <input type="text" class="form-control" name="status" id="status" placeholder="Enter seat capacity"
                      @if(!empty($leavedata['status']))
                      value= "{{$leavedata['status']}}"
                      @else value="{{old('status')}}"
                      @endif>
                    </div>   --}}
    
      

                {{-- <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" cols="20" class="form-control" rows="4"> @if(!empty($leavedata['description']))
                      {{$leavedata['description']}}
                      @else {{old('description')}}
                      @endif</textarea>
                  </div>

                  <div class="form-group">
                    <label for="outlet">outlet</label>
                      <input type="text" class="form-control" name="outlet" id="outlet"
                      @if(!empty($leavedata['outlet']))
                      value= "{{$leavedata['outlet']}}"
                      @else value="{{old('outlet')}}"
                      @endif>
                    </div> --}}
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

