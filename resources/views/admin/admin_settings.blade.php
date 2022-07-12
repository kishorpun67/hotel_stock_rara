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
        <div class="row" style="justify-content: center";>
          <!-- left column -->
          <div class="col-md-6">
                <!-- general form elements -->
                <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Update Password</h3>
                </div>
                <!-- /.card-header -->

           
                <!-- form start -->
                <form role="form" method="POST" action="{{route('admin.update.current.password')}}" name="updatePasswordForm" id="updatePasswordForm">
                  @csrf
                    <div class="card-body">
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input class="form-control" value="{{ Auth::guard('admin')->user()->email }}" readonly="">
                    </div>
                    <div class="form-group">
                        <label for="current_password">Current Password</label>
                        <input type="password" name="current_password" id="current_password" class="form-control"  placeholder="Enter Current Password" required>
                        <span id="checkCurrentPassword"></span>
                    </div>
                    <div class="form-group">
                        <label for="new_password">New Password</label>
                        <input type="password" name="new_password" id="new_password" class="form-control"  placeholder="Enter New Password" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" id="confirm_password" name="confirm_password" class="form-control"  placeholder="Confirm New Password" required>
                    </div>
                    <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
                </div>
                <!-- /.card -->

          </div>
          <!--/.col (left) -->

        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

</div>
<!-- /.content-wrapper -->

@endsection
