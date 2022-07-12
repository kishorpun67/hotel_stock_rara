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
        @if(!empty($ingredientItemsData['id'])) action="{{route('admin.add.edit.ingredient.item',$ingredientItemsData['id'])}}" @else action="{{route('admin.add.edit.ingredient.item')}}" @endif
        method="post" enctype="multipart/form-data">
        @csrf
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="name">Name *</label>
                  <input type="text" class="form-control" name="name" id="name" placeholder="Enter name"
                  @if(!empty($ingredientItemsData['name']))
                  value= "{{$ingredientItemsData['name']}}"
                  @else value="{{old('name')}}"
                  @endif>
                </div>
                <div class="form-group">
                  <label for="category_id">Ingredient Category *</label>
                  <select name="category_id" id="category_id" class="form-control form-control-sm " >
                      <option value="" >Select</option>
                      @forelse($ingredientCategory as $data)
                              <option value="{{$data->id}}"
                                @if (!empty($ingredientItemsData['category_id']) && $ingredientItemsData['category_id'] == $data->id)
                                    selected=""
                                @endif
                                  >&nbsp;&raquo;&nbsp; {{$data->category}}
                              </option>
                      @empty
                      @endforelse
                  </select>
                </div>
                <div class="form-group">
                  <label for="category_id">Ingredient Unit *</label>
                  <select name="unit_id" id="unit_id" class="form-control form-control-sm " >
                      <option value="" >Select</option>
                      @forelse($ingredientUnit as $data)
                              <option value="{{$data->id}}"
                                @if (!empty($ingredientItemsData['ingredientUnit_id']) && $ingredientItemsData['ingredientUnit_id'] == $data->id)
                                    selected=""
                                @endif
                                  >&nbsp;&raquo;&nbsp; {{$data->unit_name}}
                              </option>
                      @empty
                      @endforelse
                  </select>
                </div>
            </div>
            <div class="col-md-6">
            
              <div class="form-group">
                <label for="purchase_price">Alert Qty *</label>
                <input type="text" class="form-control" name="alert_qty" id="alert_qty" placeholder="Enter purchase price"
                @if(!empty($ingredientItemsData['alert_qty']))
                value= "{{$ingredientItemsData['alert_qty']}}"
                @else value="{{old('alert_qty')}}"
                @endif>
              </div>
              <div class="form-group">
                <label for="purchase_price">Code</label>
                <input type="text" class="form-control" name="code" id="code" placeholder="Enter purchase price"
                @if(!empty($ingredientItemsData['code']))
                value= "{{$ingredientItemsData['code']}}"
                value="{{rand(111,9999)}}"                 
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