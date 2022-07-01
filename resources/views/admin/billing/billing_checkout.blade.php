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
          <h3 class="card-title">Checkout</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
          </div>
        </div>
        <form action="{{route('admin.customer.all.invoice', $activity->id)}}" method="post" enctype="multipart/form-data">
        @csrf
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-grop">
                  <label for="">Customer Name</label>
                  <input type="text" class="form-control" readonly name="pos" id="category" placeholder=""" value="{{$customer->customer_name}}">
                </div>
                <?php $pos = 0?>
                @if (!empty($activity->order_id))
                    @foreach ($sales->ordrDetails as $item)
                        <?php $pos += $item->price *$item->quantity ?>
                    @endforeach
                    <div class="form-group">
                        <label for="category">POS</label>
                        <input type="text" class="form-control" readonly name="pos" id="category" placeholder=""" value="{{$pos}}">
                    </div>
                @endif
                @if (!empty($activity->book_room_id))
                    <div class="form-group">
                        <label for="category">Room Charge</label>
                        <input type="text" class="form-control" readonly name="pos" id="category" placeholder=""" value="{{$bookRoom->total}}">
                    </div>
                @endif
                @if (!empty($activity->camping_id))
                    <div class="form-group">
                        <label for="category">Camping Charge</label>
                        <input type="text" class="form-control" readonly name="pos" id="category" placeholder=""" value="{{$camping->total}}">
                    </div>
                @endif
                @if (!empty($camping->total))
                   <?php $camping_total = $camping->total ?>
                @else
                    <?php $camping_total = 0 ?>
                @endif
                @if (!empty($bookRoom->total))
                    <?php $bookRoom_total = $bookRoom->total ?>
                    @else
                    <?php $bookRoom_total = 0 ?>
                @endif
                @if (!empty($swimmingPool->total))
                <?php $swimmingPool_total = $swimmingPool->total ?>
                @else
                <?php $swimmingPool_total = 0 ?>
                @endif
                @if (!empty($rafting->total))
                    <?php $rafting_total = $rafting->total ?>
                    @else
                    <?php $rafting_total = 0 ?>
                @endif
                <?php $subTotal = $pos + $camping_total + $bookRoom_total  +$swimmingPool_total + $rafting_total;
                 $totals = intVal($subTotal  + $activity->service_charge  - $activity->discount);
                 $tax =0;
                 $total_amount = ($totals +$tax*$totals/100);
                //  $deu = $total_amount - $activity->deu;
                 ?>
                <div class="form-group">
                    <label for="subTotal">Sub Total</label>
                    <input type="text" name="subtotal" id="subtotal" class="form-control" readonly placeholder=""" value="{{$subTotal}}">
                </div>
                <div class="form-group">
                  <label for="total">Service Charge</label>
                  <input type="number" class="form-control totalCheckoutBillAmount" value="{{$activity->service_charge}}" name="service_charge" id="service_charge"  placeholder="Total">
                </div>
                <div class="form-group">
                  <label for="address">Paid</label>
                  <input type="number" class="form-control totalCheckoutBillAmount" name="paid" id="paid" min="1"  placeholder="Paid" value="{{$activity->paid}}">
              </div>
              <div class="form-group">
                    <label for="total">Due</label>
                    <input type="number" class="form-control" name="due" id="due" readonly placeholder="Due" value="{{$activity->due}}">
                </div>
              </div>
              <div class="col-md-6">
                @if (!empty($activity->swimming_id))
                    <div class="form-group">
                        <label for="category">Swimming Charge</label>
                        <input type="text" class="form-control" readonly name="pos" id="category" placeholder=""" value="{{$swimmingPool->total}}">
                    </div>
                @endif
                @if (!empty($activity->rafting_id))
                    <div class="form-group">
                        <label for="category">Rafting Charge</label>
                        <input type="text" class="form-control" readonly name="pos" id="category" placeholder=""" value="{{$rafting->total}}">
                    </div>
                @endif
                <div class="form-group">
                  <label for="">Status</label>
                  <select name="status" id=""  class="form-control">
                    <option value="New" @if ( $activity->status == "New" )
                    selected=""
                    @endif>New</option>
                    <option value="Cancel"@if ( $activity == "Cancel" )
                    selected=""
                    @endif>Cancel</option>
                    <option value="Paid"
                    @if ( $activity == "Paid" )
                    selected=""
                    @endif>Paid</option>
                  </select>
                </div>
                <div class="form-group">
                    <label for="category">Payment Metho</label>
                    <select name="payment_id" id="" class="form-control">
                        @foreach($paymentMethod as $payment)
                            <option value="{{$payment->id}}" 
                                @if(!empty($activity->payment_id) && $activity->payment_id== $payment->id)
                                selected=""
                                @else {{ old('payment_id') ==  $payment->id ? 'selected' : '' }}
                                @endif
                                >{{$payment->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="address">Discount</label>
                    <input type="number" class="form-control totalCheckoutBillAmount" name="discount" id="discount"  placeholder="Discount" value="{{$activity->discount}}">
                </div>
                <div class="form-group">
                  <label for="address">Tax(%)</label>
                  <select name="tax" id="tax" class="form-control totalCheckoutBillAmount">
                    <option value="0">None</option>
                    <option value="10">10%</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="total">Total</label>
                  <input type="number" class="form-control" name="total" id="total" readonly placeholder="Total" value="{{round($total_amount)}}">
               </div>
              
            </div>
          </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Checkout</button>
          </div>
        </form>
      </div>
    </div>
  </section>
</div>
@endsection

