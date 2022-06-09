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
        @if(!empty($expensedata['id'])) action="{{route('admin.add.edit.expense',$expensedata['id'])}}" @else action="{{route('admin.add.edit.expense')}}" @endif
        method="post" enctype="multipart/form-data">
        @csrf
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="date">Date</label>
                  <input type="date" class="form-control" name="date" id="date" placeholder=""
                  @if(!empty($expensedata['date']))
                  value= "{{$expensedata['date']}}"
                  @else value="{{old('date')}}"
                  @endif>
                </div>
                
                <div class="form-group">
                    <label for="waste_id">Responsible Person</label>
                    <select name="waste_id" id="waste_id" class="form-control form-control-sm " >
                        <option value="" >Select</option>
                        @forelse($waste as $data)
                                <option value="{{$data->id}}"
                                  @if (!empty($expensedata['supplier_id']) && $expensedata['supplier_id'] == $data->id)
                                      selected=""
                                  @endif
                                    >&nbsp;&raquo;&nbsp; {{$data->responsible_person}}
                                </option>
                                
                        @empty
                        @endforelse
                    </select>
                  </div>

                   
                  <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="amount" class="form-control" name="amount" id="amount" placeholder="Enter Amount"
                    @if(!empty($expensedata['amount']))
                    value= "{{$expensedata['amount']}}"
                    @else value="{{old('amount')}}"
                    @endif>
                  </div>

                  <div class="form-group">
                    <label for="category_id">Category </label>
                    <select name="category_id" id="category_id" class="form-control form-control-sm " >
                        <option value="" >Select</option>
                        @forelse($ingredientCategory as $data)
                                <option value="{{$data->id}}"
                                  @if (!empty($expensedata['category_id']) && $expensedata['category_id'] == $data->id)
                                      selected=""
                                  @endif
                                    >&nbsp;&raquo;&nbsp; {{$data->category}}
                                </option>
                                
                        @empty
                        @endforelse
                    </select>
                  </div>

        
            
                  <div class="form-group">
                    <label for="note">Note</label>
                    <textarea name="note" id="note" cols="20" class="form-control" rows="4"> @if(!empty($expensedata['note']))
                      {{$expensedata['note']}}
                      @else {{old('note')}}
                      @endif</textarea>
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

