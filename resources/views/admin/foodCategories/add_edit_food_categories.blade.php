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
        @if(!empty($foodCategoriesData['id'])) action="{{route('admin.add.edit.food.category',$foodCategoriesData['id'])}}" @else action="{{route('admin.add.edit.food.category')}}" @endif
        method="post" enctype="multipart/form-data">
        @csrf
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="category_name">Name</label>
                  <input type="text" class="form-control" name="category_name" id="category_name" placeholder="Enter name"
                  @if(!empty($foodCategoriesData['category_name']))
                  value= "{{$foodCategoriesData['category_name']}}"
                  @else value="{{old('category_name')}}"
                  @endif>
                </div>
                <div class="form-group">
                  <label for="description">Description</label>
                  <textarea name="description" id="description" cols="20" class="form-control" rows="4"> @if(!empty($foodCategoriesData['description']))
                    {{$foodCategoriesData['description']}}
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

