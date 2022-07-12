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
        @if(!empty($tentData['id'])) action="{{route('admin.add.edit.tent',$tentData['id'])}}" @else action="{{route('admin.add.edit.tent')}}" @endif
        method="post" enctype="multipart/form-data">
        @csrf
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="name">Name *</label>
                  <input type="text" class="form-control" name="name" id="name" placeholder="Enter name"
                  @if(!empty($tentData['name']))
                  value= "{{$tentData['name']}}"
                  @else value="{{old('name')}}"
                  @endif>
                  <p style="color:red">
                    @error('name')
                    {{$message}}
                    @enderror
                  </p>
                </div>
                <div class="form-group">
                    <label for="tent_type_id">Tent Type *</label>
                    <select name="tent_type_id" id="tent_type_id" class="form-control">
                        <option value="">Select</option>
                        @foreach($tentTypes as $tentTypes)
                            <option value="{{$tentTypes->id}}" 
                                @if(!empty($tentData['tent_type_id']) && $tentData['tent_type_id']== $tentTypes->id)
                                selected=""
                                @else {{ old('tent_type_id') ==  $tentTypes->id ? 'selected' : '' }}
                                @endif
                                >{{$tentTypes->name}}
                            </option>
                        @endforeach
                    </select>
                    <p style="color:red">
                      @error('tent_type_id')
                      {{$message}}
                      @enderror
                    </p>
                </div>
                <div class="form-group">
                    <label for="address">Price *</label>
                    <input type="number" min="1" class="form-control" name="price" id="price" placeholder="Enter Price."
                    @if(!empty($tentData['price']))
                    value= "{{$tentData['price']}}"
                    @else value="{{old('price')}}"
                    @endif>
                    <p style="color:red">
                      @error('price')
                      {{$message}}
                      @enderror
                    </p>
                </div>  
                <div class="form-group">
                    <label for="price">Description</label>
                    <textarea name="description" id="" cols="30" rows="5" class="form-control">
                        @if(!empty($tentData['description']))
                        {{$tentData['description']}}
                        @endif
                    </textarea>
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

