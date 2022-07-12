@extends('layouts.admin_layout.admin_layout')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Catelogues</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Catelogues</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
 
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Food Menu</h3>
             <a href="{{route('admin.add.edit.food.menu')}}" style="width: auto; float:right; display:inline-block;" class="btn btn-block btn-success"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;&nbsp;Add Food Menu</a>
            </div>
            <div class="card-body">
              <table id="categories" class="table table-bordered table-striped  text-center">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Sale Price</th>
                  <th>Ingredient Food Category</th>
                  <th>Description</th>
                  <th>Image</th>
                  {{-- <th>Ingredient Food</th> --}}
                  <th>Code</th>  
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
               @forelse($foodMenus as $data)
                  <td>{{$data->id}}</td>
                  <td>{{$data->name}}</td>
                  <td>{{$data->sale_price}}</td>
                  <td>@if(!empty($data->foodCategory->category_name)){{$data->foodCategory->category_name}} @endif</td>
                  <td>{{$data->description}}</td>
                  <td><img src="{{asset($data->image)}}" alt="" width="100" height="100" srcset=""></td>
                  {{-- <td>@if(!empty($data->ingr edientUnit->unit_name)){{$data->ingredientUnit->unit_name}}@endif</td> --}}
                  <td>{{$data->code}}</td>
                   <td>
                    <a href="{{route('admin.add.edit.food.menu', $data->id)}}"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                    <a href="javascript:" class="delete_form" record="foodMenu"  rel="{{$data->id}}" style="display:inline;">
                      <i class="fa fa-trash fa-" aria-hidden="true" ></i>
                    </a>
                   </td>
                </tr>
                @empty
                <p>No Data</p>
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
<script>
  $(function () {
    $("#categories").DataTable();
  });
</script>
@endsection
