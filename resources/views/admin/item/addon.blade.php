@extends('layouts.admin_layout.admin_layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Item</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Item</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    @if(Session::has('error_message'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top: 10px;">
        {{ Session::get('error_message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif
    @if(Session::has('success_message'))
      <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 10px;">
        {{ Session::get('success_message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Add Item Add On</h3>
                    <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
                </div>
            </div>
            <form method="post" action="{{route('admin.add.addon', $addon->id)}}"  enctype="multipart/form-data">
            @csrf
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="product_name">Item Name:</label>&nbsp;{{$addon->item_name}}
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                          <img style=" width:100px; margin-top:5px;" src="{{asset($addon->image)}}" alt="">
                        <label for=""></label>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group" style="margin-top:30px; margin-left:8px;">
                      <div class="field_wrapper">
                        <div>
                          <input type="text" name="add_on[]" id="add_on" placeholder="Size Addons" value="" required/>
                          <input type="number" name="price[]" id="price" placeholder="Price" value="" required/>
                          <a href="javascript:void(0);" class="add_button">Add</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </section>
        <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">View Item Add On</h3>
            </div>
            <form method="post" action="{{route('admin.edit.addon', $addon->id)}}"  enctype="multipart/form-data">
            @csrf
            <div class="card-body">
              <table id="categories" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Add On</th>
                    <th>Price</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @forelse($addon['addon'] as $attribute)
                  <input style="display:none;" type="text" name="idAttr[]" value="{{$attribute->id}}">
                  <tr class="text-center">
                    <td>{{$attribute->id}}</td>
                    <td><input type="text" name="add_on[]" id="add_on" value="{{$attribute->add_on}}"></td>
                    <td><input type="number" name="price[]" id="price" value="{{$attribute->price}}"></td>
                    <td>
                      <a href="javascript:" class="delete_form" record="attribute" rel="{{$attribute->id}}" style="display:inline;">
                        <i class="fa fa-trash" aria-hidden="true" ></i></a>
                      </a>
                    </td>
                  </tr>
                  @empty
                  @endforelse
                  </tbody>
                </table>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
              </div>
            </div>
            </form>
        </div>
      </div>
    </section>
</div>
@endsection
@section('script')
<script>
  $(function () {
    $("#categories").DataTable();

  });
</script>
@endsection
