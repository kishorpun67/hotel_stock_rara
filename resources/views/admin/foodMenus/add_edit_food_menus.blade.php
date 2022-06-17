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
        @if(!empty($foodMenusData['id'])) action="{{route('admin.add.edit.food.menu',$foodMenusData['id'])}}" @else action="{{route('admin.add.edit.food.menu')}}" @endif
        method="post" enctype="multipart/form-data">
        @csrf
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" name="name" id="name" placeholder="Enter name"
                  @if(!empty($foodMenusData['name']))
                  value= "{{$foodMenusData['name']}}"
                  @else :value="{{old('name')}}"
                  @endif>
                </div>

                <div class="form-group">
                <label for="sale_price">Sale Price</label>
                  <input type="text" class="form-control" name="sale_price" id="sale_price" placeholder="Enter sale price"
                  @if(!empty($foodMenusData['sale_price']))
                  value= "{{$foodMenusData['sale_price']}}"
                  @else :value="{{old('sale_price')}}"
                  @endif>
                </div>

              
                <div class="form-group">
                    <label for="category_id">Ingredient Food Category</label>
                    <select name="category_id" id="category_id" class="form-control form-control-sm " >
                        <option value="" >Select</option>
                        @forelse($foodCategory as $data)
                                <option value="{{$data->id}}"
                                  @if (!empty($foodMenusData['category_id']) && $foodMenusData['category_id'] == $data->id)
                                      selected=""
                                  @endif
                                    >&nbsp;&raquo;&nbsp; {{$data->category_name}}
                                </option>
                                
                        @empty
                        @endforelse
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="item_id">Ingredient Item</label>
                    <select name="item_id" id="foodTable_id" class="form-control form-control-sm " >
                        <option value="" >Select</option>
                        @forelse($ingredientItem as $data)
                                <option value="{{$data->id}}"
                                  @if (!empty($foodMenusData['item_id']) && $foodMenusData['item_id'] == $data->id)
                                      selected=""
                                  @endif
                                    >&nbsp;&raquo;&nbsp; {{$data->name}}
                                </option>
                                
                        @empty
                        @endforelse
                    </select>
                  </div>
                  @if (empty($foodMenusData['id']))
                  <div id="ajaxFoodTable">
                    @include('admin.foodMenus.ajax_foodMenu_table')
                  </div>
                  @else
                  <div class="col-md-12">
                    <table class="table table-bordered table-striped  text-center">
                      <thead>
                      <tr>
                        <th>SN</th>
                        <th>Ingredient</th>
                        <th>Consumption</th>
                      </tr>
                      </thead>
                      <tbody>
                        <tr>
                          @forelse($foodMenusData['consumption'] as $data)
                          <input type="hidden" name="id[]" value="{{ $data['id']}}">
                          <input type="hidden" name="ingredient_id[]" value="{{ $data['ingredient_id'] }}">
                          <input type="hidden" name="ingredient_name[]" value="{{ $data['ingredient_name'] }}">
                          <td>{{ $data['ingredient_name']}}</td>
                          <td><input type="number"  name="consumption_quantity[]" value="{{ $data['consumption_quantity']}}">
                          </td>
                          <td>
                            {{-- <a href="{{route('admin.add.edit', $data->id)}}"><i class="fa fa-edit">Edit</i></a>&nbsp;&nbsp; --}}
                            <a href="javascript:" class="delete_foodMenu_table" ingredient_id="{{$data['id']}}" style="display:inline;">
                              <i class="fa fa-trash fa-" aria-hidden="true" ></i>
                            </a></td>
                          </tr>
                          @empty
                          <p>No Data</p>
                          @endforelse
                      </tbody>
                    </table>
                  </div>
                  @endif
                  

                
      
        
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" cols="20" class="form-control" rows="4"> @if(!empty($foodMenusData['description']))
                  {{$foodMenusData['description']}}
                  @else {{old('description')}}
                  @endif</textarea>
              </div>

              <div class="form-group">
                  <label for="image">Image</label>
                  <input type="file" class="form-control" id="image" name="image" @if(!empty($foodMenusData['image']))
                value= "{{$foodMenusData['image']}}"
                @else value="{{old('image')}}"
                @endif><br>
                @if(!empty($foodMenusData['image']))
                  <img src="{{asset($foodMenusData['image'])}}" width="100" height="100" alt="" srcset="">
                @endif
              </div>
              


                  <div class="form-group">
                      <label for="code">Code</label>
                        <input type="text" class="form-control" name="code" value="{{rand(111,9999)}}" id="code" placeholder="Enter sale price"
                        @if(!empty($foodMenusData['code']))
                        value= "{{$foodMenusData['code']}}"
                        @else value="{{old('code')}}"
                        @endif>
                      </div>
                      <div class="form-group" >
                        <label for="">Is it Kitchen Item?</label>
                        <select name="is_kitchen" class="form-control">
                          <option value="No"@if (!empty($foodMenusData['is_kitchen']) && $foodMenusData['is_kitchen'] == "No")
                            selected=""
                        @endif>No</option>
                          <option value="Yes"@if (!empty($foodMenusData['is_kitchen']) && $foodMenusData['is_kitchen'] == "Yes")
                          selected=""
                      @endif>Yes</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="">Is it Bar Item?</label>
                        <select class="form-control" name="is_bar">
                          <option value="No"@if (!empty($foodMenusData['is_bar']) && $foodMenusData['is_bar'] == "No")
                            selected=""
                        @endif>No</option>
                          <option value="Yes"@if (!empty($foodMenusData['is_bar']) && $foodMenusData['is_bar'] == "Yes")
                          selected=""
                      @endif>Yes</option>
                        </select>
                      </div>
          <div class="form-group">
            <label for="">Is it Caffe Item?</label>
            <select class="form-control" name="is_caffe">
              <option value="No" @if (!empty($foodMenusData['is_caffe']) && $foodMenusData['is_caffe'] == "No")
                selected=""
            @endif>No</option>
              <option value="Yes"@if (!empty($foodMenusData['is_caffe']) && $foodMenusData['is_caffe'] == "Yes")
              selected=""
          @endif>Yes</option>
            </select>
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

