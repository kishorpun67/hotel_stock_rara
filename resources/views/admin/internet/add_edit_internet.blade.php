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
        @if(!empty($internetdata['id'])) action="{{route('admin.add.edit.internet',$internetdata['id'])}}" @else action="{{route('admin.add.edit.internet')}}" @endif
        method="post" enctype="multipart/form-data">
        @csrf
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="internet_uses">Internet Name</label>
                  <input type="text" class="form-control" name="internet_uses" id="internet_uses" placeholder="Internate Name "
                  @if(!empty($internetdata['internet_uses']))
                  value= "{{$internetdata['internet_uses']}}"
                  @else value="{{old('internet_uses')}}"
                  @endif>
                </div>
                <div class="form-group">
                  <label for="internet_mbps">Internet Mbps</label>
                  <input type="text" class="form-control" name="internet_mbps" id="internet_mbps" placeholder="Enter Internet Mbps"
                  @if(!empty($internetdata['internet_mbps']))
                  value= "{{$internetdata['internet_mbps']}}"
                  @else value="{{old('internet_mbps')}}"
                  @endif>
                </div>    
                <div class="from-group">
                  <label for="payment_type">Type</label>
                  <select name="payment_type" onchange="paymentType(this.value)" id="payment_type" class="form-control">
                    <option value="">Select</option>
                    <option value="single" @if (!empty($internetdata['payment_type']) && $internetdata['payment_type']=='single' )
                        selected=""
                    @endif>One Month</option>
                    <option value="multiple"@if (!empty($internetdata['payment_type']) && $internetdata['payment_type']=='multiple' )
                    selected=""
                @endif>Multiple Month</option>
                  </select>
                </div>
                  @if (!empty($internetdata['id']) && !empty($internetdata['payment_type']) 
                  && ($internetdata['payment_type']) =="single" )
                    <?php $display1 = 'block' ?>
                  @else
                    <?php $display1 = 'none' ?>
                  @endif
                  @if (!empty($internetdata['id']) && !empty($internetdata['payment_type']) 
                  && ($internetdata['payment_type']) =="multiple" )
                    <?php $display = 'block' ?>
                  @else
                    <?php $display = 'none' ?>
                  @endif
                <div class="form-group" style="display:{{$display1}}" id="single">
                  <label for="internet_month">Months</label>
                  <input type="date" class="form-control" name="internet_month" id="internet_month" placeholder=""
                  @if(!empty($internetdata['internet_month']))
                  value= "{{$internetdata['internet_month']}}"
                  @else value="{{old('internet_month')}}"
                  @endif>
                </div> 
                <div class="form-group" style="display:{{$display}};" id="start_date">
                  <label for="start_date">Start Date</label>
                  <input type="date" class="form-control" name="start_date" id="start_date" placeholder=""
                  @if(!empty($internetdata['start_date']))
                  value= "{{$internetdata['start_date']}}"
                  @else value="{{old('start_date')}}"
                  @endif>
                </div>
                <div class="form-group" style="display: {{$display}}" id="end_date">
                  <label for="end_date">End Date</label>
                  <input type="date" class="form-control" name="end_date" id="end_date" placeholder=""
                  @if(!empty($internetdata['end_date']))
                  value= "{{$internetdata['end_date']}}"
                  @else value="{{old('end_date')}}"
                  @endif>
                </div>
                <div class="form-group">
                  <label for="internet_total">Internet Total</label>
                  <input type="text" class="form-control" name="internet_total" id="internet_total" placeholder="Enter Internet Total"
                  @if(!empty($internetdata['internet_total']))
                  value= "{{$internetdata['internet_total']}}"
                  @else value="{{old('internet_total')}}"
                  @endif>
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

