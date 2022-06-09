@extends('layouts.admin_layout.admin_layout')
@section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
        
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


        <!-- Main content -->
    <section class="content">

        <div class="container-fluid">
        <div class="row" style="justify-content: center;">
          <!-- left column -->
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Update Admin Details</h3>
                    </div>
                    <!-- /.card-header -->

                    @if(Session::has('success_message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 10px;">
                        {{ Session::get('success_message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <!-- form start -->
                    <form role="form" method="POST" action="{{route('admin.update.admin.details')}}" name="updatePasswordForm" id="updatePasswordForm" enctype="multipart/form-data">
                    @csrf
                        <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email Address</label>
                            <input class="form-control" name="email" value="{{ Auth::guard('admin')->user()->email }}" readonly="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Type</label>
                            <input class="form-control" name="type" value=" {{ Auth::guard('admin')->user()->subAdminRole->roles }} " readonly="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Name</label>
                            <input type="text" name="name" id="current_password" value="{{Auth::guard('admin')->user()->name}}" class="form-control" id="exampleInputPassword1">
                           <p>
                                @error('name')
                                <div style="color:red">{{ $message }}</div>
                                @enderror
                            </p>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Number</label>
                            <input type="number" name="number" id="current_password" value="{{ Auth::guard('admin')->user()->number }}" class="form-control" id="exampleInputPassword1">
                            @error('number')
                                <div style="color:red">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Image</label>
                            <input type="file" id="image" name="image" class="form-control" id="image">
                            @error('image')
                                <div style="color:red">{{ $message }}</div>
                            @enderror
                            @if(!empty(Auth::guard('admin')->user()->image))
                            <a href="{{asset(Auth::guard('admin')->user()->image)}}"> View Image</a>
                            <input type="hidden" name="current_admin_image" value="{{Auth::guard('admin')->user()->image}}">
                            @endif
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->

</div>
<!-- /.content-wrapper -->

@endsection
