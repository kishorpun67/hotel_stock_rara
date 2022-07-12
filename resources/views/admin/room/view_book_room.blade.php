@extends('layouts.admin_layout.admin_layout')
@section('content')
<?php 
  use App\Admin\Room;
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          
        </div>
      </div><!-- /.container-fluid -->
    </section>
      <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">View Book Room</h3>
              <a href="{{route('admin.add.edit.book.room')}}"  style="max-width: 150px; float:right; display:inline-block;" class="btn btn-block btn-success"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;&nbsp;Add Entry</a>
            </div>
            <div class="card-body">
              <table id="monthly-charts" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Customer</th>
                  <th>Contact</th>
                  <th>Room No</th>
                  <th>Room </th>
                  <th>Total</th>
                  {{-- <th>Paid</th>
                  <th>Due</th>
                  <th>Status</th> --}}
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    <?php $i=1;?>
                @forelse($bookRooms as $bookRoom)
                <tr>
                    <td>{{$i}}</td>
                    <?php $i++;?>
                    <td>
                      @if (!empty($bookRoom->customer->customer_name))
                          {{$bookRoom->customer->customer_name}}
                      @else
                      @endif
                    </td>
                    <td>{{$bookRoom->contact}}</td>
                    <td>
                      @if (!empty($bookRoom->room_id))
                        <?php 
                        $ids = explode(',', $bookRoom->room_id);
                        $rooms = Room::whereIn('id', $ids)->get();
                        ?>
                        {{-- {{$ids}} --}}
                        @foreach ($rooms as $item)
                        {{$item->room_no}} <br>
                        @endforeach
                      @else
                      @endif
                    </td>
                    <td
                    >@if (!empty($bookRoom->room_id))
                      
                      @foreach ($rooms as $item)
                      {{$item->name}} <br>
                      @endforeach
                    @else
                    @endif</td>
                    <td>{{$bookRoom->total}}</td>
                    {{-- <td>{{$bookRoom->paid}}</td>
                    <td>{{$bookRoom->due}}</td>
                    <td>{{$bookRoom->status}}</td> --}}

                    </td>
                    <td>
                    <a href="javascript:" data-toggle="modal" data-target="#myModal{{$bookRoom->id}}"> <i class="fa fa-file-invoice"></i></a>&nbsp;&nbsp;
                    <a href="{{route('admin.add.edit.book.room', $bookRoom->id)}}"> <i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                    <a href="javascript:" class="delete_form" record="book-room" rel="{{$bookRoom->id}}" style="display:inline;">
                        <i class="fa fa-trash fa-" aria-hidden="true" ></i>
                    </a>
                   </td>
                </tr>
                <div class="modal fade" id="myModal{{$bookRoom->id}}">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <form  method="POST"   action="{{route('admin.checkout.room', $bookRoom->id)}}"  enctype="multipart/form-data">
                        <input type="hidden" name="id" value="{{$bookRoom->id}}">
                          @csrf
                          <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <div class="modal-body">
                            <div class="row">
                              <div class="col md-6">
                                <strong>Arrival Date : {{$bookRoom->arrival_date}}</strong> <br>
                                <strong>Arrival Time : {{$bookRoom->arrival_time}}</strong> <br>
                                <strong>Departure Date : {{$bookRoom->depature_date}}</strong> <br>
                              </div>
                              <div class="col-md6">
                                <strong>Departure Time : {{$bookRoom->depature_time}}</strong> <br>
                                <strong>Name : @if (!empty($bookRoom->customer->customer_name))
                                  {{$bookRoom->customer->customer_name}}
                                  @else
                                  @endif
                                </strong> <br>
                                <strong>Contact : {{$bookRoom->contact}}</strong> <br><br>
                              </div>
                            </div>
                              <div class="form-group">
                              </div>
                              <div class="form-group">
                                <label for="name"> Room Charge</label>
                                <input type="number" name="room_charge" id="room_charge" class="form-control totalAmountRoom" placeholder="Room Charge" 
                                @if(!empty($bookRoom->room_charge))
                                value= "{{$bookRoom->room_charge}}"
                                @else value="{{old('room_charge')}}"
                                @endif>
                            </div>
                            <div class="form-group">
                              <label for="advance"> Advance</label>
                              <input type="number" name="advance"  readonly id="advance" class="form-control totalAmountRoom" placeholder="Advance" 
                              @if(!empty($bookRoom->advance))
                              value= "{{$bookRoom->advance}}"
                              @else value="{{old('advance')}}"
                              @endif>
                          </div>
      
                            <div class="form-group">
                                <label for="additional_charge"> Additional Charge</label>
                                <input type="number" name="additional_charge" id="additional_charge" class="form-control totalAmountRoom" placeholder="Additional Charge" 
                                @if(!empty($bookRoom->aditional_charge))
                                value= "{{$bookRoom->aditional_charge}}"
                                @else value="{{old('aditional_charge')}}"
                                @endif>
                            </div>
                            <div class="form-group">
                                <label for="discount totalAmountRoom"> Discount</label>
                                <input type="number" name="discount" id="discount" class="form-control totalAmountRoom" placeholder="Discount" 
                                @if(!empty($bookRoom->discount))
                                value= "{{$bookRoom->discount}}"
                                @else value="{{old('discount')}}"
                                @endif>
                            </div>
                            <div class="form-group">
                              <label for="total"> Total</label>
                              <input type="text" name="total" id="total" readonly class="form-control " placeholder="Total Amount" 
                              @if(!empty($bookRoom->total))
                              value= "{{$bookRoom->total}}"
                              @else value="{{old('total')}}"
                              @endif>
                            </div>
                            <div class="form-group">
                                <label for="name"> Paid</label>
                                <input type="number" name="paid" id="paid" class="form-control totalAmountRoom" placeholder="Paid" 
                                @if(!empty($bookRoom->paid))
                                value= "{{$bookRoom->paid}}"
                                @else value="{{old('paid')}}"
                                @endif>
                            </div>
                            <div class="form-group">
                                <label for="name"> Due</label>
                                <input type="text" name="due" id="due" readonly class="form-control" placeholder="Due" 
                                @if(!empty($bookRoom->due))
                                value= "{{$bookRoom->due}}"
                                @else value="{{old('due')}}"
                                @endif>
                            </div>
                          </div>
                          <!-- Modal footer -->
                          <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                              <input type="submit" class="btn btn-success" value="Checkout">
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

@endsection