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
        @if(!empty($roomData['id'])) action="{{route('admin.add.edit.room',$roomData['id'])}}" @else action="{{route('admin.add.edit.room')}}" @endif
        method="post" enctype="multipart/form-data">
        @csrf
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                    <label for="address">Room No *</label>
                    <input type="text" class="form-control" name="room_no" id="room_no" placeholder="Enter Room No."
                    @if(!empty($roomData['room_no']))
                    value= "{{$roomData['room_no']}}"
                    @else value="{{old('room_no')}}"
                    @endif>
                    <p style="color:red">
                      @error('room_no')
                      {{$message}}
                      @enderror
                    </p>
                </div>  
                <div class="form-group">
                    <label for="price">Price *</label>
                    <input type="text" class="form-control"  min="1" name="price" id="price" placeholder="Enter Price"
                    @if(!empty($roomData['price']))
                    value= "{{$roomData['price']}}"
                    @else value="{{old('price')}}"
                    @endif>
                    <p style="color:red">
                      @error('price')
                      {{$message}}
                      @enderror
                    </p>
                </div>
                <div class="form-group">
                    <label for="room_type_id">Room Type *</label>
                    <select name="room_type_id" id="room_type_id" class="form-control">
                        <option value="">Select</option>
                        @foreach($typeofRooms as $typeofRoom)
                            <option value="{{$typeofRoom->id}}" 
                                @if(!empty($roomData['room_type_id']) && $roomData['room_type_id']== $typeofRoom->id)
                                selected=""
                                @else {{ old('room_type_id') ==  $typeofRoom->id ? 'selected' : '' }} 
                                @endif
                                >{{$typeofRoom->room_type}}
                            </option>
                        @endforeach
                    </select>
                    <p style="color:red">
                      @error('room_type_id')
                      {{$message}}
                      @enderror
                    </p>
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

