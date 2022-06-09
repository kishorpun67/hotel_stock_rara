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
        @if(!empty($taskdata['id'])) action="{{route('admin.update.task',$taskdata['id'])}}" @else action="{{route('admin.update.task')}}" @endif
        method="post" enctype="multipart/form-data">
        @csrf
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="fomr-group">
                  <label for="">Task</label><br>
                  <input type="text" name="task" id="" readonly class="form-control" 
                  @if(!empty($taskdata['task']))
                  value= "{{$taskdata['task']}}"
                  @else value="{{old('task')}}"
                  @endif>
                </div>
                <div class="form-group">
                  <label for="started">Start Date</label>
                  <input type="date" class="form-control" readonly name="start_date" id="start_date" placeholder="Enter table name"
                  @if(!empty($taskdata['start_date']))
                  value= "{{$taskdata['start_date']}}"
                  @else value="{{old('start_date')}}"
                  @endif>
                </div>
                <div class="form-group">
                  <label for="started">End Date</label>
                  <input type="date" class="form-control" readonly name="end_date" id="end_date" placeholder="Enter table name"
                  @if(!empty($taskdata['end_date']))
                  value= "{{$taskdata['end_date']}}"
                  @else value="{{old('end_date')}}"
                  @endif>
                </div>
                <div class="form-group">
                  <label for="">Description</label>
                  <p>
                    @if (!empty($taskdata['description']))
                        {{$taskdata['description']}}
                    @endif

                  </p>

              </div>
              <div class="form-group">
                <select name="status" id="" class="form-control">
                  <option value="New" @if (!empty($taskdata['status']) || $taskdata['status'] == "New")
                      {{$taskdata['status']}}
                  @endif>New</option>
                  <option value="Ongoing"@if (!empty($taskdata['status']) || $taskdata['status'] == "Ongoing")
                  {{$taskdata['status']}}
              @endif>Ongoing</option>
                  <option value="Partially"@if (!empty($taskdata['status']) || $taskdata['status'] == "Partially")
                  {{$taskdata['status']}}
              @endif>Partially</option>
                  <option value="Completed"@if (!empty($taskdata['status']) || $taskdata['status'] == "Completed")
                  {{$taskdata['status']}}
              @endif>Completed</option>

                </select>
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

