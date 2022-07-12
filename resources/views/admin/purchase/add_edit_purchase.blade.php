@extends('layouts.admin_layout.admin_layout')
@section('content')
<?php 
  use App\PurchaseDue;

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
        @if(!empty($purchasedata['id'])) action="{{route('admin.add.edit.purchase',$purchasedata['id'])}}" @else action="{{route('admin.add.edit.purchase')}}" @endif
        method="post" enctype="multipart/form-data">
        @csrf
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="code">Code</label>
                    <input type="text" class="form-control" name="code" value="{{rand(111,9999)}}" id="code" placeholder="Enter purchase code"
                    @if(!empty($purchasedata['code']))
                    value= "{{$purchasedata['code']}}"
                    @else value="{{old('code')}}"
                    @endif>
                  </div>  
                <div class="form-group">
 
                  <label for="supplier_id">Supplier Name *</label>
                  <select name="supplier_id" id="supplier_id" class="form-control select2" >
                      <option value="" >Select</option>
                      @forelse($supplier as $data)
                              <option value="{{$data->id}}"
                                @if (!empty($purchasedata['supplier_id']) && $purchasedata['supplier_id'] == $data->id)
                                    selected=""
                                @endif
                                  > {{$data->name}}
                              </option>
                              
                      @empty
                      @endforelse

                  </select>

                  
                </div>
                <div class="form-group">
                  <label for="date">Date *</label>
                  <input type="date" class="form-control" name="date" id="date" 
                  @if(!empty($purchasedata['date']))
                  value= "{{$purchasedata['date']}}"
                  @else value="{{old('date')}}"
                  @endif>
                </div>
                <div class="form-group">
                  <label for="item_id">Ingredient Item *</label>
                  <select name="item_id" id="purchase_id" class="form-control form-control-sm ">
                      <option value="" >Select</option>
                      @forelse($ingredientItem as $data)
                              <option value="{{$data->id}}"
                                @if (!empty($purchasedata['item_id']) && $purchasedata['item_id'] == $data->id)
                                selected=""
                            @endif
                                  >&nbsp;&raquo;&nbsp; {{$data->name}}
                              </option>
                      @empty
                      @endforelse
                  </select>
                </div>
                @if(!empty($purchasedata['id']))

                <div class="form-group">
                  <label for="date">Deu Pay Date *</label>
                  <input type="date" class="form-control" name="date_pay_date" id="date" 
                  @if(!empty($purchasedata['date_pay_date']))
                  value= "{{$purchasedata['date_pay_date']}}"
                  @else value="{{old('date_pay_date')}}"
                  @endif>
                </div>
                @endif
              </div>
                <div class="col-md-6 ">
                  <a href="" data-toggle="modal" data-target="#myModal"style="max-width: 150px; margin-top:30px; float:left; display:inline-block;"  class="btn btn-primary ">Add</a>
                </div>
                @if(!empty($purchasedata['id']))
                <div class="col-md-12">
                  <table class="table table-bordered table-striped  text-center">
                    <thead>
                    <tr>
                      <th>SN</th>
                      <th>Ingredient(code)</th>
                      <th>Unit Price</th>
                      <th>Quantity/Amount</th>
                      <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $total = 0
                        ?>
                      @if (!empty($purchasedata['purchase_item'] ))

                        @forelse($purchasedata['purchase_item']  as $data)

                        <input type="hidden" name="id[]" value="{{ $data['id'] }}">
                        <input type="hidden" name="ingredient_id[]" value="{{ $data['ingredient_id'] }}">
                        <input type="hidden" name="ingredient[]" value="{{ $data['ingredient'] }}">
                        <input type="hidden" name="price[]" value="{{ $data['price'] }}">
                        <tr>
                        <td>{{ $data['ingredient_id'] }}</td>
                        <td>{{ $data['ingredient']}}oiwetopewteiop</td>
                        <td>{{ $data['price']}}</td>
                        <td><input class="ingredientCart_id " type="number" readonly name="quantity[]" value="{{ $data['quantity']}}">
                        </td>
                        <td>{{ $data['quantity'] * $data['price']}}</td>
                       
                        <td>
                          {{-- <a href="{{route('admin.add.edit', $data->id)}}"><i class="fa fa-edit">Edit</i></a>&nbsp;&nbsp; --}}
                          {{-- <a href="javascript:" class="delete_cart_table" ingredient_id="{{$data['id']}}" style="display:inline;">
                            <i class="fa fa-trash fa-" aria-hidden="true" ></i>
                          </a> --}}
                        </td>
                        </tr>
                        <?php $total = $total +($data['quantity']*$data['price'])?>
                        @empty
                        <p>No Data</p>
                        @endforelse
                      @endif
                      
                    </tbody>
                  </table>
                </div>
                <div class="col-6">
                                  
                </div>
                <!-- /.col -->
                <div class="col-6">
                  <p class="lead"></p>
                
                  <div class="table-responsive">

                          @if(!empty($purchasedata['id']))
                          <?php  $purchaseDue = PurchaseDue::where('purcahse_id', $purchasedata['id'])->get();  
                            $totalDue = 0;
                          ?>
                          <p class="lead">Initial Paid <strong style="float: right;">{{$purchasedata['paid']}}</strong></p>

                          @foreach ($purchaseDue as $item)
                          <p class="lead">Amount Due {{$item->due_paid_date}} 		<strong style=" float:right"> {{$item->due_paid}}</strong></p>  
                            <?php $totalDue += $item->due_paid; ?>
                          @endforeach
                            <table class="table">
                              <tr>
                                <th style="width:50%">Sub.Total</th>
                                <td> <input type="text" name="subtotal" class="subtotal" value="{{ $total }}" readonly></td>
                              </tr>
                              <tr>
                                <th style="width:50%">Tax(%)</th>
                                <td> <input type="text" name="tax" class="tax" value="{{$purchasedata['tax'] }}%" readonly></td>
                                <?php $tax = $total*$purchasedata['tax']/100; ?>
                                <?php $vat = $total*$purchasedata['vat']/100; ?>


                              </tr>
                              </tr>
                              <tr>
                                <th style="width:50%">Vat(%)</th>
                                <td> <input type="text" name="vat" class="vat" value="{{$purchasedata['vat']}}%" readonly></td>
                              </tr>
                              <tr>
                                <th style="width:50%">G.Total</th>
                                <td> <input type="text" name="total" class="total" value="{{ round($total + $vat + $tax) }}" readonly></td>
                              </tr>
                              <tr>
                                <th>Paid Amount</th>
                                <td><input class="paid" type="number" onkeyup="purchasePaid(this)" name="paid" readonly value="{{$purchasedata['paid']+$totalDue}}" ingredientCart_id="" 
                                  ></td>
                              </tr>
                              <tr>
                                <th>Due Payment:</th>
                                <input type="hidden" name="" id="due_total" value="{{$purchasedata['due']}}">
                                <td><input id="deu_pay_amount" type="number" name="deu_pay_amount" value="{{$purchasedata['due']}}" ></td>
                              </tr>
                              <tr>
                                <th>Due:</th>
                                <td><input id="deu_amount" type="number" name="due" value="" readonly></td>
                              </tr>
                            </table>
                        @else 
                          <table class="table">
                            <tr>
                              <th style="width:50%">Sub.Total</th>
                              <td> <input type="text" name="subtotal" class="subtotal" value="{{ $total }}" readonly></td>
                            </tr>
                            <tr>
                              <th style="width:50%">G.Total</th>
                              <td> <input type="text" name="total" class="total" value="{{ $total }}" readonly></td>
                            </tr>
                            <tr>
                              <th>Paid</th>
                              <td><input class="paid" type="number" onkeyup="purchasePaid(this)" name="paid" value="" ingredientCart_id="" 
                                ></td>
                            </tr>
                            <tr>
                              <th>Due:</th>
                              <td><input id="deu_amount" type="number" name="due" value="{{ $total }}" readonly></td>
                            </tr>
                          </table>
                        @endif
                    </div>
                  </div>
                </div>
                @else
                <div id="ajaxPurchase">
                  @include('admin.purchase.ajax_purchase_table')
                </div> 
                @endif
                
               
                
            </div>
                  
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-primary ">{{$button}}</button>
          </div>
        </form>
      </div>
    </div>
  </section>
</div>

<div class="modal fade" id="myModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form
      action="{{route('admin.add.edit.supplier')}}"
      method="post" enctype="multipart/form-data">
          @csrf
          <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
              <div class="form-group">
                  <label for="name">Name*</label>
                  <input  class="form-control" id="name "name="name" placeholder="Enter name">
                  <label for="address"> Address *</label>
                  <input type="text" class="form-control" id="address" name="address" placeholder="Enter address">
                  <label for="contact_person">Contact Person*</label>
                  <input type="text" class="form-control" id="contact_person" name="contact_person" placeholder="Enter contact">
                  <label for="phone"> Phone *</label>
                  <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone number">
                  <label for="address"> Email *</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                  <label for="class">Description</label>
                  <textarea name="description" id="description" class="form-control" cols="6" rows="3"></textarea>
                  <input type="hidden" name="purchase" value="yes" />
              </div>
          </div>
          <!-- Modal footer -->
          <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              <input type="submit" class="btn btn-success" value="Submit">
          </div>
      </form>
    </div>
  </div>
</div>

@endsection

