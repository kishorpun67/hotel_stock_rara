@extends('layouts.admin_layout.admin_layout')
@section('content')
<?php
use App\Admin\Permission;
use App\Admin\AdminPermission;
  $permissinsCount = Permission::count();

?>

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
    {{-- @if(Session::has('error_message'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top: 10px;">
        {{ Session::get('error_message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif --}}
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
        @if(!empty($adminData['id'])) action="{{route('admin.add.edit.user',$adminData['id'])}}" @else action="{{route('admin.add.edit.user')}}" @endif
        method="post" enctype="multipart/form-data">
        @csrf
          <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="class"> Name</label>
                        <input class="form-control" name="name" placeholder="Name" @if(!empty($adminData['name']))
                        value= "{{$adminData['name']}}"
                        @else value="{{old('name')}}"
                        @endif>
                    </div>
                    <div class="form-group">
                        <label for="class"> Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Email" @if(!empty($adminData['email']))
                        value= "{{$adminData['email']}}"
                        @else value="{{old('email')}}"
                        @endif>
                    </div>
                    
                    
                    <div class="form-group">
                        <label for="">Will Login?</label><br>
                        <input type="radio" name="will_login" id="" class="will_login" value="Yes" @if (!empty($adminData['will_login']) && $adminData['will_login'] == 'Yes')  checked @endif> Yes &nbsp;
                        <input type="radio" name="will_login" id="" class="will_login" value="No"
                        @if (!empty($adminData['will_login']) && $adminData['will_login'] != 'Yes')  checked @endif > No
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="class"> Number</label>
                        <input  type="number" class="form-control" name="number" placeholder="Number" @if(!empty($adminData['number']))
                        value= "{{$adminData['number']}}"
                        @else value="{{old('number')}}"
                        @endif>
                    </div>
                    <div class="form-group">
                        <label for="class"> Roles</label>
                        <select name="role_id" id="" class="form-control">
                            <option value="" >Select</option>
                            @foreach ($roles as $role)
                            <option value="{{$role->id}}" @if ( !empty($adminData['role_id']) && $adminData['role_id'] ===$role->id) selected
                                @endif >{{$role->roles}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="class"> Image</label>
                        <input type="file" name="image" class="form-control" id="">
                        <br>
                        @if(!empty($adminData['image']) && $adminData['image'])
                        <a href="{{asset($adminData['image'])}}">View</a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row add_user"  @if (!empty($adminData['will_login']) && $adminData['will_login'] == 'Yes')
            style="display: block"
            @else
            style="display: none"

            @endif >
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password">New Password</label>
                        <input type="password" name="password" id="" class="form-control" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" name="confirm_password " placeholder="Confirm Password" id="" class="form-control">
                    </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                    <input type="checkbox"  class="checkAll" /> <label>Select All</label><br/>
                    <?php 
                    if(!empty($adminData['id'])){
                        $checkPermession = AdminPermission::where('admin_id', $adminData['id'])->get();
                        foreach ($checkPermession as $permission) {
                        $permission_ids[] = $permission->permission_id;
                    }
                    }else{
                        $permission_ids = array();
                    }
                    ?>
                    @foreach ($permissions as $item)
                    <input type="checkbox" name="checkbox[]"  id="" value="{{$item->id}}" @if (in_array($item->id, $permission_ids ?? []))
                    checked
                    @endif
                    >&nbsp;<label for="" > {{$item->permission}} </label><br>
                    @endforeach
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
<script >
 

  </script>
@endsection

