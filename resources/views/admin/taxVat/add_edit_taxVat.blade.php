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
        @if(!empty($taxVatdata['id'])) action="{{route('admin.add.edit.taxVat',$taxVatdata['id'])}}" @else action="{{route('admin.add.edit.taxVat')}}" @endif
        method="post" enctype="multipart/form-data">
        @csrf
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                    <label for="vat_type">Vat Type</label>
                    <select name="vat_type" id="" class="form-control form-control-sm">
                        <option  value="percent" >percent</option>
                        <option  value="fixed" >fixed</option>
                
                    </select>
                  </div>

        
                <div class="form-group">
                    <label for="vat">Vat</label>
                    <input type="text" class="form-control" name="vat" id="vat" placeholder="Enter Vat"
                    @if(!empty($taxVatdata['vat']))
                    value= "{{$taxVatdata['vat']}}"
                    @else value="{{old('vat')}}"
                    @endif>
                  </div>

                  <div class="form-group">
                    <label for="tax">Tax</label>
                    <input type="text" class="form-control" name="tax" id="tax" placeholder="Enter Tax"
                    @if(!empty($taxVatdata['tax']))
                    value= "{{$taxVatdata['tax']}}"
                    @else value="{{old('tax')}}"
                    @endif>
                  </div>

                  <div class="form-group">
                    <label for="service">Service Charge</label>
                    <input type="text" class="form-control" name="service" id="service" placeholder="Enter Service"
                    @if(!empty($taxVatdata['service']))
                    value= "{{$taxVatdata['service']}}"
                    @else value="{{old('service')}}"
                    @endif>
                  </div>
      
                {{-- <div class="form-group">
                  <label for="">Task</label><br>

                  <input type="radio" id="ongong" name="project" value="Ongong">
                 <label for="ongong">Ongoing</label><br>

                  <input type="radio" id="partiallycompleted" name="project" value="Partially Completed">
                 <label for="partiallycompleted">Partially Completed</label><br>

                 <input type="radio" id="completed" name="project" value="Completed">
                 <label for="completed">completed</label>
                  </div> --}}


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

