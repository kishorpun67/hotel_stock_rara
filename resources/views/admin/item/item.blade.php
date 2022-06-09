@extends('layouts.admin_layout.admin_layout')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          
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
    <!-- Main content -->
      @error('category_id')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{$message}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
      @enderror  
      @error('name')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{$message}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
      @enderror 

      @error('price')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{$message}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
      @enderror 
      @error('url')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{$message}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
      @enderror   
      <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">View Place</h3>
              <a href="" data-toggle="modal" data-target="#myModals" style="max-width: 150px; float:right; display:inline-block;" class="btn btn-block btn-success"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;&nbsp;Add New  Post</a>
            </div>
            <div class="card-body">
              <table id="categories" class="table table-bordered table-striped">
                <thead>
                <tr>
                  
                  <th>ID</th>
                  <th>Place Name</th>
                  <th>Category</th>
                  <th>Price</th>
                  <th>Description</th>
                  <th>Image</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($item as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->title}}</td>
                    <td>
                        @if(!empty($item->category->category))
                        {{$item->category->category}}
                        @else
                        No Category
                        @endif
                    </td>
                    <td>{{$item->price}}</td>
                    <td>{{$item->details}}</td>
                    <td><img src="{{asset($item->image)}}" alt="" with="100" height="100" srcset=""></td>
                      <td>
                        @if($item->status==1)
                          <a  class="updateItemStatus" id="item-{{$item->id}}" item_id="{{$item->id}}"  href="javascript:(0);">Active</a>
                        @else
                        <a class="updateItemStatus" id="item-{{$item->id}}" item_id="{{$item->id}}" href="javascript:(0);">Inactive</a>
                        @endif
                      </td>
                    </td>
                    <td>
                    <a href=""data-toggle="modal" data-target="#myModal{{$item->id}}" > <i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                    <a href="javascript:" class="delete_form" record="post" rel="{{$item->id}}" style="display:inline;">
                        <i class="fa fa-trash fa-" aria-hidden="true" ></i>
                    </a>
                   </td>
                </tr>
                <div class="modal fade" id="myModal{{$item->id}}">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <form  method="POST"   action="{{route('admin.edit.post',$item->id)}}"  enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="class">Title *</label>
                                    <input type="text" name="name" class="form-control form-control-sm" value="{{$item->title}}">
                                    
                                    <label for="class"> Select Category  *</label>
                                    <select name="category_id" id="" class="form-control form-control-sm">
                                    <option value="" >Select</option>
                                    @forelse($categories as $category)
                                        <option value="{{$category->id}}"
                                            @if(!empty(@old('category_id')) && $category->id==@old('category_id'))
                                            selected=""
                                            @elseif(!empty($item->category_id) && $item->category_id==$category['id'])
                                            selected=""
                                            @endif
                                            >&nbsp;&raquo;&nbsp; {{$category->category}}
                                        </option>
                                        @foreach($category['subcategories'] as $subCategory)
                                            <option value="{{$subCategory->id}}"
                                            @if(!empty(@old('category_id')) && $subCategory->id==@old('category_id'))
                                            selected=""
                                            @elseif(!empty($item->category_id) && $item->category_id==$subCategory['id'])
                                            selected=""
                                            @endif
                                            >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&raquo;&nbsp; {{$subCategory->category}}</option>
                                        @endforeach
                                    @empty
                                    @endforelse
                                    </select>
                                    <label for="type">Select Type *</label>
                                    <select name="type_id" id="" class="form-control form-control-sm">
                                      <option value="">Select</option>
                                      @foreach ($types as $type)
                                        <option value="{{$type->id}}"
                                          @if (!empty($item->type_id) && $item->type_id == $type->id)
                                          selected=""
                                          @endif
                                          >{{$type->type}}</option>
                                      @endforeach
                                    </select>
                                    <label for="class"> Price *</label>
                                    <input type="number" class="form-control form-control-sm" name="price" value="{{$item->price}}">
                                    <label for="">Price Type</label>
                                    <select name="price_type" id="" class="form-control">
                                      <option value="">Select</option>
                                      <option value="Fixed" @if (!empty($item->price_type) && $item->price_type == 'Fixed') 
                                        selected=""
                                        @endif>Fixed</option>
                                      <option value="Negotiable"@if (!empty($item->price_type) && $item->price_type == "Negotiable") 
                                        selected=""
                                        @endif>Negotiable</option>
                                    </select>
                                    <label for="">How many days do you want your ad to run? *</label>
                                    <select name="expire_days" id="" class="form-control form-control-sm">
                                      <option value="">Select</option>
                                      <option value="30" @if (!empty($item->expire_days) && $item->expire_days == 30) 
                                        selected=""
                                      @endif>One Month</option>
                                      <option value="60"  @if (!empty($item->expire_days) && $item->expire_days == 60) 
                                        selected=""
                                        @endif>Two Months</option>
                                      <option value="90" @if (!empty($item->expire_days) && $item->expire_days == 90) 
                                        selected=""
                                        @endif>Three Months</option>
                                      <option value="120" @if (!empty($item->expire_days) && $item->expire_days == 120) 
                                        selected=""
                                        @endif>Four Months</option>
                                      <option value="150" @if (!empty($item->expire_days) && $item->expire_days == 150) 
                                        selected=""
                                        @endif>Five Months</option>
                                      <option value="180" @if (!empty($item->expire_days) && $item->expire_days == 180) 
                                        selected=""
                                        @endif>Six Months</option>
                                    </select>
                                    <div class="form-group">
                                      <label for="url">Url*</label>
                                      <input type="text" class="form-control" id="url" name="url" placeholder="Enter Url"
                                      @if(!empty($item['url']))
                                    value= "{{$item['url']}}"
                                    @else value="{{old('url')}}"
                                    @endif>
                                    </div>
                                    <label for="class"> Image</label>
                                    <input type="file" name="image" class="form-control" id="">
                                    <br>
                                    @if($item->image)
                                      <input type="hidden"  name="old_image" value="{{$item->image}}">
                                      <img src="{{asset($item->image)}}" height="200" width="400" alt="" srcset="">
                                    @endif
                                    <label for="class">Description</label>
                                    <textarea name="description" id="" class="form-control" cols="6" rows="3">{{$item->details}}</textarea>
                                    <label for="class">Meta Title</label>
                                    <textarea name="meta_title" id="" class="form-control" cols="6" rows="3">{{$item->meta_title}}</textarea>
                                    <label for="class">Meta Description</label>
                                    <textarea name="meta_description" id="" class="form-control" cols="6" rows="3">{{$item->meta_description}}</textarea>
                                    <label for="class">Meta Keywords</label>
                                    <textarea name="meta_keywords" id="" class="form-control" cols="6" rows="3">{{$item->meta_keywords}}</textarea>
                                    
                                </div>
                            </div>
                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <input type="submit" class="btn btn-success" value="Update">
                            </div>
                        </form>
                      </div>
                    </div>
                </div>
                @empty

                @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

@endsection
@section('script')
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script>

  $(function () {
    $("#categories").DataTable();

  });
  $(document).ready(function() {
       $('.ckeditor').ckeditor();
    });
</script>
@endsection

