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
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Leave</h3>
             <a href="{{route('admin.add.edit.leave')}}" style="max-width: 150px; float:right; display:inline-block;" class="btn btn-block btn-success"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;&nbsp;Add Leave</a>
            </div>
            <div class="card-body">
              <table id="categories" class="table table-bordered table-striped  text-center">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Date</th>
                  <th>Subject</th>
                  <th>Days</th>
                  <th>Letter</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
               @forelse($leave as $data)
               <tr>
                  <td>{{$data->id}}</td>
                  <td>{{$data->date}}</td>
                  <td>{{$data->subject}}</td>
                  <td>{{$data->days}}</td>
                  <td><a href="{{asset('images/letter/'.$data->letter)}}"  ="">View</a></td>

                  <td>{{$data->status}}</td>
                   <td>
                    <a href="javascript:" data-toggle="modal" data-target="#myModal{{$data->id}}"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                    <a href="javascript:" class="delete_form" record="leave"  rel="{{$data->id}}" style="display:inline;">
                      <i class="fa fa-trash fa-" aria-hidden="true" ></i>
                    </a>
                   </td>
                </tr>
                
                
                <div class="modal fade" id="myModal{{$data->id}}">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <form  method="POST"   action="{{route('admin.update.leave',$data->id)}}"  enctype="multipart/form-data">
                          @csrf
                          <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <div class="modal-body">
                              <div class="form-group">
                                <label for="class">Status</label>
                                <select name="status" id="" class="form-control">
                                  <option value="New" @if (!empty($data->status) || $data->status == "New")
                                          {{$data->status}}
                                      @endif>New</option>
                                  <option value="Rejected" @if (!empty($data->status) || $data->status == "Rejected")
                                      {{$data->status}}
                                  @endif>Rejected</option>
                                  <option value="Approved" @if (!empty($data->status) || $data->status == "Approved")
                                  {{$data->status}}
                                    @endif>Approved</option>
                                </select>
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
