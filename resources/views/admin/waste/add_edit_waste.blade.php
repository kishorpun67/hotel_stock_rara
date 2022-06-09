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
    {{-- @if(Session::has('error_message'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top: 10px;">
        {{ Session::get('error_message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif --}}
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
        @if(!empty($wastedata['id'])) action="{{route('admin.add.edit.waste',$wastedata['id'])}}" @else action="{{route('admin.add.edit.waste')}}" @endif
        method="post" enctype="multipart/form-data">
        @csrf
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="ref_no">Refrence Number</label>
                  <input type="text" class="form-control" name="ref_no" id="ref_no" placeholder="Enter refrence number"
                  @if(!empty($wastedata['ref_no']))
                  value= "{{$wastedata['ref_no']}}"
                  @else value="{{old('ref_no')}}"
                  @endif>
                </div>
                
                  <div class="form-group">
                    <label for="category_id">Ingredient Category</label>
                    <select name="category_id" id="category_id" class="form-control form-control-sm " >
                        <option value="" >Select</option>
                        @forelse($ingredientCategory as $data)
                                <option value="{{$data->id}}"
                                  @if (!empty($wastedata['category_id']) && $wastedata['category_id'] == $data->id)
                                      selected=""
                                  @endif
                                    >&nbsp;&raquo;&nbsp; {{$data->category}}
                                </option>
                                
                        @empty
                        @endforelse
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="food_id">Food</label>
                    <select name="food_id" id="food_id" class="form-control form-control-sm " >
                        <option value="" >Select</option>
                        @forelse($foodMenu as $data)
                                <option value="{{$data->id}}"
                                  @if (!empty($wastedata['food_id']) && $wastedata['food_id'] == $data->id)
                                  selected=""
                              @endif
                                    >&nbsp;&raquo;&nbsp; {{$data->name}}
                                </option>
                                
                        @empty
                        @endforelse
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" class="form-control" name="date" id="date"
                    @if(!empty($wastedata['date']))
                    value= "{{$wastedata['date']}}"
                    @else value="{{old('date')}}"
                    @endif>
                  </div>

                  
                  <div class="form-group">
                    <label for="responsible_person">Responsible Person</label>
                    <input type="responsible_person" class="form-control" name="responsible_person" id="responsible_person" placeholder="Enter responsible person"
                    @if(!empty($wastedata['responsible_person']))
                    value= "{{$wastedata['responsible_person']}}"
                    @else value="{{old('date')}}"
                    @endif>
                  </div>

                  <div class="form-group">
                    <label for="total_loss">Total Loss</label>
                    <input type="total_loss" class="form-control" name="total_loss" id="total_loss" placeholder="Enter total loss"
                    @if(!empty($wastedata['total_loss']))
                    value= "{{$wastedata['total_loss']}}"
                    @else value="{{old('date')}}"
                    @endif>
                  </div>

                  <div class="form-group">
                    <label for="description">Note</label>
                    <textarea name="description" id="description" cols="20" class="form-control" rows="4"> @if(!empty($wastedata['description']))
                      {{$wastedata['description']}}
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

