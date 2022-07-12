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
        @if(!empty($electricitydata['id'])) action="{{route('admin.add.edit.electricity',$electricitydata['id'])}}" @else action="{{route('admin.add.edit.electricity')}}" @endif
        method="post" enctype="multipart/form-data">
        @csrf
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                @if ( !empty($electricitydata['id']) &&  !empty($previousData->electricity_uses))
                  <div class="form-group">
                    <label for="electricity_uses">Electricity Consumption</label>
                    <input type="number" readonly class="form-control" onkeyup="electricityConsumption()" name="electricity_uses" id="electricity_uses" placeholder="Enter Electricity Uses"
                    value= "{{$previousData->electricity_uses}}"
                    >
                  </div>
                @endif
                @if ( empty($electricitydata['id']) &&  empty($previousData->electricity_uses) && empty($lastestElectricityUses->electricity_uses))
                <div class="form-group">
                  <label for="electricity_uses">Electricity Consumption</label>
                  <input type="number" class="form-control" onkeyup="electricityConsumption()" name="electricity_uses" id="electricity_uses" placeholder="Enter Electricity Uses">
                </div>
                @endif
                @if ( !empty($electricitydata['id']) &&  empty($previousData->electricity_uses))
                <div class="form-group">
                  <label for="electricity_uses">Electricity Consumption</label>
                  <input type="number" class="form-control" onkeyup="electricityConsumption()" name="electricity_uses" id="electricity_uses" placeholder="Enter Electricity Uses"
                  @if(!empty($electricitydata['electricity_uses']))
                  value= "{{$electricitydata['electricity_uses']}}"
                  @else value="{{old('electricity_uses')}}"
                  @endif>
                </div>
                @endif
                  
                @if (!empty($lastestElectricityUses->electricity_uses))
                <div class="form-group">
                  <label for="electricity_uses">Electricity Consumption </label>
                    <input type="number" class="form-control" onkeyup="electricityConsumption()" name="electricity_uses" id="electricity_uses" placeholder="Enter Electricity Uses"
                    value= "{{$lastestElectricityUses->electricity_uses}}" 
                    >
                </div>
                <div class="form-group">
                  <label for="early_electricity_consumption">Early Electricity Consumption</label>
                  <input type="number" class="form-control" onkeyup="electricityConsumption()" name="early_electricity_consumption" id="early_electricity_consumption" placeholder="Enter Electricity Uses">
                </div>
                @endif
                @if ( !empty($electricitydata['id']) && $count->id !=$electricitydata['id']  )
                  <div class="form-group">
                    <label for="early_electricity_consumption">Early Electricity Consumption </label>
                    <input type="number" class="form-control" onkeyup="electricityConsumption()" name="early_electricity_consumption" id="early_electricity_consumption" placeholder="Enter Electricity Uses"
                    @if(!empty($electricitydata['electricity_uses']))
                    value= "{{$electricitydata['electricity_uses']}}"
                    @else value="{{old('electricity_uses')}}"
                    @endif>
                  </div>
                @endif
                <div class="form-group">
                  <label for="electricity_unit">Electricity Unit</label>
                  <input type="number" class="form-control" onkeyup="electricityConsumption()" name="electricity_unit" id="electricity_unit" placeholder="Enter Electricity Unit"
                  @if(!empty($electricitydata['electricity_unit']))
                  value= "{{$electricitydata['electricity_unit']}}"
                  @else value="{{old('electricity_unit')}}"
                  @endif>
                </div>    
                <div class="form-group">
                  <label for="electricity_month">Months</label>
                  <input type="date" class="form-control" name="electricity_month" id="electricity_month" placeholder=""
                  @if(!empty($electricitydata['electricity_month']))
                  value= "{{$electricitydata['electricity_month']}}"
                  @else value="{{old('electricity_month')}}"
                  @endif>
                </div> 

                <div class="form-group">
                  <label for="electricity_total">Electricity Total</label> 
                  <input type="number" class="form-control" name="electricity_total" id="electricity_total" placeholder="" readonly
                  @if(!empty($electricitydata['electricity_total']))
                  value= "{{$electricitydata['electricity_total']}}"
                  @else value="{{old('electricity_total')}}"
                  @endif>
                </div> 
                <div class="form-group">
                  <label for="electricity_paid">Paid</label>
                  <input type="number" class="form-control" onkeyup="electricityConsumption()" name="electricity_paid" id="electricity_paid" placeholder="Enter Electricity Total"
                  @if(!empty($electricitydata['electricity_paid']))
                  value= "{{$electricitydata['electricity_paid']}}"
                  @else value="{{old('electricity_paid')}}"
                  @endif>
                </div> 
                @if (!empty($lastestElectricityUses->electricity_due))

                <div class="form-group">
                  <label for="electricity_last_month_due">Last Month Due</label>
                  <input type="number" class="form-control" name="electricity_last_month_due" id="electricity_last_month_due" placeholder=""
                  value= "{{$lastestElectricityUses->electricity_due}}"
                  readonly>
                </div>
                @else
                <input type="hidden"  id="electricity_last_month_due"  value="0">

                @endif
              
                <div class="form-group">
                  <label for="electricity_due">Total Due</label>
                  <input type="number" class="form-control" name="electricity_due" id="electricity_due" placeholder="Total Due" readonly
                  @if(!empty($electricitydata['electricity_due']))
                  value= "{{$electricitydata['electricity_due']}}"
                  @else
                  @if (!empty($lastestElectricityUses->electricity_due))
                  value="{{$lastestElectricityUses->electricity_due}}"
                  @endif
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

