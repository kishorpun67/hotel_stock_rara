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
        @if(!empty($bankDepositdata['id'])) action="{{route('admin.add.edit.bankDeposit',$bankDepositdata['id'])}}" @else action="{{route('admin.add.edit.bankDeposit')}}" @endif
        method="post" enctype="multipart/form-data">
        @csrf
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
    
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" class="form-control" name="date" id="date" 
                   @if(!empty($bankDepositdata['date']))
                    value= "{{$bankDepositdata['date']}}"
                    @else value="{{old('date')}}"
                    @endif>
                  </div>

                  <div class="form-group">
                    <label for="bank_name">Bank Name</label>
                    <input type="text" class="form-control" name="bank_name" id="bank_name" placeholder="Enter bank_name"
                    @if(!empty($bankDepositdata['bank_name']))
                    value= "{{$bankDepositdata['bank_name']}}"
                    @else value="{{old('bank_name')}}"
                    @endif>
                  </div>

                  <div class="form-group">
                    <label for="cash_or_cheque">Cash Or Cheque</label>
                    <select name="cash_or_cheque" id="" class="form-control form-control-sm">
                        <option  value="cash" @if (!empty($bankDepositdata['cash_or_cheque'])  && $bankDepositdata['cash_or_cheque']=="cash")
                        selected="" @endif>cash</option>
                        <option  value="cheque" @if (!empty($bankDepositdata['cash_or_cheque'])  && $bankDepositdata['cash_or_cheque']=="cheque") 
                        selected="" @endif>cheque</option>
                
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="deposite">Deposite</label>
                    <input type="text" class="form-control" name="deposite" id="deposite" placeholder="Enter Deposite"
                    @if(!empty($bankDepositdata['deposite']))
                    value= "{{$bankDepositdata['deposite']}}"
                    @else value="{{old('deposite')}}"
                    @endif>
                  </div>

                  <div class="form-group">
                    <label for="cheque_number">Cheque Number</label>
                    <input type="text" class="form-control" name="cheque_number" id="cheque_number" placeholder="Enter Cheque Number"
                    @if(!empty($bankDepositdata['cheque_number']))
                    value= "{{$bankDepositdata['cheque_number']}}"
                    @else value="{{old('cheque_number')}}"
                    @endif>
                  </div>

                  <div class="form-group">
                    <label for="client">Client</label><br>
                    <input type="radio" name="client" value="yes" @if (!empty($bankDepositdata['client'])  && $bankDepositdata['client']=="yes") 
                    checked="" @endif> Yes<br>
                     <input type="radio" name="client" value="no" @if (!empty($bankDepositdata['client'])  && $bankDepositdata['client']=="no") 
                     checked="" @endif> No<br> 
                    </div>

                   
                  <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="text" class="form-control" name="amount" id="amount" placeholder="Enter Amount"
                    @if(!empty($bankDepositdata['amount']))
                    value= "{{$bankDepositdata['amount']}}"
                    @else value="{{old('amount')}}"
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

