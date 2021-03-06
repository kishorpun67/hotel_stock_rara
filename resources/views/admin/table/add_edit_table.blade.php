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
        @if(!empty($tabledata['id'])) action="{{route('admin.add.edit.table',$tabledata['id'])}}" @else action="{{route('admin.add.edit.table')}}" @endif
        method="post" enctype="multipart/form-data">
        @csrf
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="table_name">Table Name</label>
                  <input type="text" class="form-control" name="table_name" id="table_name" placeholder="Enter table name"
                  @if(!empty($tabledata['table_name']))
                  value= "{{$tabledata['table_name']}}"
                  @else value="{{old('table_name')}}"
                  @endif>
                </div>
                <div class="form-group">
                  <label for="table_name">Table No</label>
                  <input type="text" class="form-control" name="table_no" id="table_no" placeholder="Enter table name"
                  @if(!empty($tabledata['table_no']))
                  value= "{{$tabledata['table_no']}}"
                  @else value="{{old('table_no')}}"
                  @endif>
                </div>
                <div class="form-group">
                    <label for="seat_capacity">Seat Capacity</label>
                      <input type="text" class="form-control" name="seat_capacity" id="seat_capacity" placeholder="Enter seat capacity"
                      @if(!empty($tabledata['seat_capacity']))
                      value= "{{$tabledata['seat_capacity']}}"
                      @else value="{{old('seat_capacity')}}"
                      @endif>
                </div>  
    
      
                <div class="form-group">
                  <label for="room_id">Room No *</label>
                  <select name="room_id" id=""  class="form-control select2">
                      <option value="">Select</option>
                      @foreach($rooms as $room)
                          <option value="{{$room->id}}" 
                            @if (!empty($bookRoomData['room_id']) &&  $bookRoomData['room_id'] == $room->id)
                            selected=""
                              @else 
                              {{ old('room_id') == $room->id ? 'selected' : '' }}
                            @endif
                              >{{$room->name}}
                          </option>
                      @endforeach
                  </select>
                  <p style="color:red">
                    @error('room_id')
                    {{$message}}
                    @enderror
                  </p>
              </div>
                {{-- <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" cols="20" class="form-control" rows="4"> @if(!empty($tabledata['description']))
                      {{$tabledata['description']}}
                      @else {{old('description')}}
                      @endif</textarea>
                  </div>

                  <div class="form-group">
                    <label for="outlet">outlet</label>
                      <input type="text" class="form-control" name="outlet" id="outlet"
                      @if(!empty($tabledata['outlet']))
                      value= "{{$tabledata['outlet']}}"
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

