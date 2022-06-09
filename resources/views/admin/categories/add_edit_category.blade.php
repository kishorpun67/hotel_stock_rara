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
        @if(!empty($categorydata['id'])) action="{{route('admin.add.edit.category',$categorydata['id'])}}" @else action="{{route('admin.add.edit.category')}}" @endif
        method="post" enctype="multipart/form-data">
        @csrf
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="category">Category Name*</label>
                  <input type="text" class="form-control" name="category" id="category" placeholder="Enter Category Name"
                  @if(!empty($categorydata['category']))
                  value= "{{$categorydata['category']}}"
                  @else value="{{old('category')}}"
                  @endif>
                </div>
                <div id="appendCategoriesLevel">
                    @include('admin.categories.append_categoreis_level')
                </div>
                
                <div class="form-group">
                    <label for="url">Url*</label>
                    <input type="text" class="form-control" id="url" name="url" placeholder="Enter Url"
                    @if(!empty($categorydata['url']))
                  value= "{{$categorydata['url']}}"
                  @else value="{{old('url')}}"
                  @endif>
                </div>
                <div class="from-group">
                  <label for="">Show Header</label> <br>
                  <label>Yes</label> <input type="radio" name="show_header" class="" id="" value="1" 
                  @if (!empty($categorydata['show_header']) && $categorydata['show_header']==1 )
                      checked
                  @endif> &nbsp; &nbsp;  <label for="">No</label> <input type="radio" name="show_header" id="" value="2"
                  @if (!empty($categorydata['show_header']) && $categorydata['show_header']==2)
                      checked
                  @endif>
                </div>
                <div class="form-group">
                  <label for="meta_title">Meta Title</label>
                  <textarea name="meta_title" id="" cols="20" class="form-control" rows="3"> @if(!empty($categorydata['meta_title']))
                    {{$categorydata['meta_title']}}
                    @else {{old('meta_title')}}
                    @endif</textarea>
                </div>
              </div>
              <div class="col-md-6">
                
                <div class="form-group">
                  <label for="meta_description">Meta Description</label>
                  <textarea name="meta_description" id="meta_description" cols="20" class="form-control" rows="4"> @if(!empty($categorydata['meta_description']))
                    {{$categorydata['meta_description']}}
                    @else {{old('meta_description')}}
                    @endif</textarea>
                </div>
                <div class="form-group">
                  <label for="meta_keywords">Meta Keywords</label>
                  <textarea name="meta_keywords" id="meta_keywords" cols="20" class="form-control" rows="4"> @if(!empty($categorydata['meta_keywords']))
                    {{$categorydata['meta_keywords']}}
                    @else {{old('meta_keywords')}}
                    @endif</textarea>
                  
                </div>
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

