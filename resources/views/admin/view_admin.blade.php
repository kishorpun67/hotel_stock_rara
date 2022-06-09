@extends('layouts.admin_layout.admin_layout')
@section('content')
<?php 
use App\Admin\Permission;
use App\Admin\AdminPermission;
  $permissions = Permission::get();
  $permissinsCount = Permission::count();

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
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
      @error('access')
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

      @error('email')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{$message}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
      @enderror 
      @error('number')
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{$message}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>
    @enderror 
    @error('type')
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{$message}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
  @enderror 
      @error('password')
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
              <h3 class="card-title">View User</h3>
              <a href="" data-toggle="modal" data-target="#myModals" style="max-width: 150px; float:right; display:inline-block;" class="btn btn-block btn-success"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;&nbsp;Add User</a>
            </div>
            <div class="card-body">
              <table id="categories" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th> Name</th>
                  <th>Email</th>
                  <th>Number</th>
                  <th>Type</th>
                  <th>Image</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($admins as $admin)
                <tr class="text-center">
                    <td>{{$admin->id}}</td>
                    <td>{{$admin->name}}</td>
                    <td>{{$admin->email}}</td>
                    <td>{{$admin->number}}</td>
                    <td>
                      @if (!empty($admin->subAdminRole->roles))
                      {{$admin->subAdminRole->roles}}
                      @endif
                    </td>
                    <td><img src="{{asset($admin->image)}}" alt="" with="100" height="100" srcset=""></td>
                    <td>
                      @if ($admin->type !=="SuperAdmin")
                      <a href="" data-toggle="modal" data-target="#test{{$admin->id}}"><i class="fas fa-lock"></i>&nbsp;&nbsp;</a>
                      <a href="" data-toggle="modal" data-target="#myModal{{$admin->id}}" > <i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                        <a href="javascript:" class="delete_form" record="admin" rel="{{$admin->id}}" style="display:inline;">
                        <i class="fa fa-trash fa-" aria-hidden="true" ></i>
                        </a>
                      @endif
                   </td>
                </tr>
                <div class="modal fade" id="myModal{{$admin->id}}">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                          <form  method="POST"  id="admin_edit_validation"  action="{{route('admin.add.edit.admin',$admin->id)}}"  enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                  <label for="class"> Name</label>
                                  <input class="form-control" name="name" placeholder="Name" value="{{$admin->name}}" >
                                </div>
                                <div class="form-group">
                                  <label for="class"> Email</label>
                                  <input type="email" class="form-control" name="email" placeholder="Email" value="{{$admin->email}}">
                                </div>
                                <div class="form-group">
                                  <label for="class"> Number</label>
                                  <input  type="number" class="form-control" name="number" placeholder="Number" value="{{$admin->number}}">
                                </div>
                                <div class="form-group">
                                  <label for="class"> Roles</label>
                                  <select name="role_id" id="" class="form-control">
                                      <option value="" >Select</option>
                                      @foreach ($admin_roles as $role)
                                      <option value="{{$role->id}}" @if ($admin->role_id ===$role->id) selected
                                        @endif >{{$role->roles}}</option>
                                      @endforeach
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label for="class"> Image</label>
                                  <input type="file" name="image" class="form-control" id="">
                                  <br>
                                  @if($admin->image)
                                    <input type="hidden"  name="old_image" value="{{$admin->image}}">
                                    <img src="{{asset($admin->image)}}" height="200" width="400" alt="" srcset="">
                                  @endif
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <input type="submit" class="btn btn-success" value="Update">
                            </div>
                          </form>
                      </div>
                    </div>
                </div>
                <div class="modal fade" id="test{{$admin->id}}">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <form  method="POST"   action="{{route('admin.add.edit.access',$admin->id)}}"  enctype="multipart/form-data">
                          @csrf
                          <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6 text-left">
                                  <input type="hidden" name="admin_id" value="{{$admin->id}}">
                                  <input type="checkbox"  id="checkAll" /> <label>Select All</label><br/>
                                  <?php 
                                    $checkPermession = AdminPermission::where('admin_id', $admin->id)->get();
                                    foreach ($checkPermession as $permission) {
                                      $permission_ids[] = $permission->permission_id;
                                      # code...
                                    }
                                  ?>
                                  @foreach ($permissions as $item)
                                    <input type="checkbox" name="checkbox[]"  id="" value="{{$item->id}}" @if (in_array(3, $permission_ids))
                                    checked
                                    @endif>&nbsp;<label for="" > {{$item->permission}} </label><br>
                                  @endforeach
                                  
                                </div>
                                <div class="col-md-6">
                                </div>
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
  <div class="modal fade" id="myModals">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form  id="admin_add_validation"  method="POST"   action="{{route('admin.add.edit.admin')}}"  enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              
                <div class="form-group">
                  <label for="class"> Name *</label>
                  <input class="form-control" name="name"  placeholder="Name" required >
                  {{-- <input type="text" required > --}}
                </div>
                <div class="form-group">
                  <label for="class"> Email *</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                </div>
                <div class="form-group">
                  <label for="class"> Number *</label>
                  <input  type="number" class="form-control" name="number" placeholder="Number">
                </div>
                <div class="form-group">
                  <label for="class" > Select Role *</label>
                  <select name="role_id" id="" class="form-control">
                    <option value="" >Select</option>
                    @foreach ($admin_roles as $role)
                      <option value="{{$role->id}}" >{{$role->roles}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="class">Password *</label>
                    <input type="password" name="password" id="" class="form-control">
                </div>
                <div class="form-group">
                  <label for="description">Image</label>
                    <input type="file" name="image" class="form-control" id="">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-success" value="Add">
            </div>
        </form>
      </div>
    </div>
</div>

@endsection
@section('script')
<script >
  $("#checkAll").change(function(){

if (! $('input:checkbox').is('checked')) {
    $('input:checkbox').attr('checked','checked');
} else {
    $('input:checkbox').removeAttr('checked');
}       
});


  </script>
  
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

