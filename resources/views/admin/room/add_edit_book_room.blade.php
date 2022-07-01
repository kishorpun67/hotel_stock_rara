@extends('layouts.admin_layout.admin_layout')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
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
        @if(!empty($bookRoomData['id'])) action="{{route('admin.add.edit.book.room',$bookRoomData['id'])}}" @else action="{{route('admin.add.edit.book.room')}}" @endif
        method="post" enctype="multipart/form-data">
        @csrf
          <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                      <label for="arrival_date">Arrival Date *</label>
                      <input type="date" class="form-control" name="arrival_date" id="arrival_date"
                      @if(!empty($bookRoomData['arrival_date']))
                      value= "{{$bookRoomData['arrival_date']}}"
                      @else :value="{{old('arrival_date')}}"
                      @endif>
                    <p style="color:red">
                      @error('arrival_date')
                      {{$message}}
                      @enderror
                    </p>
                  </div>
                  <div class="form-group">
                      <label for="arrival_time">Arival Time *</label>
                      <input type="time" class="form-control" name="arrival_time" id="arrival_time" 
                      @if(!empty($bookRoomData['arrival_time']))
                      value= "{{$bookRoomData['arrival_time']}}"
                      @else value="{{old('arrival_time')}}"
                      @endif>
                      <p style="color:red">
                        @error('arrival_date')
                        {{$message}}
                        @enderror
                      </p>
                  </div>  
                  <div class="form-group">
                      <label for="price">Departure Date *</label>
                      <input type="date" class="form-control" name="depature_date" id="depature_date" 
                      @if(!empty($bookRoomData['depature_date']))
                      value= "{{$bookRoomData['depature_date']}}"
                      @else value="{{old('depature_date')}}"
                      @endif>
                      <p style="color:red">
                        @error('depature_date')
                        {{$message}}
                        @enderror
                      </p>
                  </div>
                  <div class="form-group">
                      <label for="depature_time">Departure Time *</label>
                      <input type="time" class="form-control" name="depature_time" id="depature_time" 
                      @if(!empty($bookRoomData['depature_time']))
                      value= "{{$bookRoomData['depature_time']}}"
                      @else value="{{old('depature_time')}}"
                      @endif>
                      <p style="color:red">
                        @error('depature_time')
                        {{$message}}
                        @enderror
                      </p>
                  </div>  
                  <div class="form-group">
                      <label for="name">Name *</label>
                      <select name="customer_id" id="customer_name" class="form-control">
                          <option value="">Select</option>
                          @foreach($customers as $customer)
                              <option value="{{$customer->id}}" 
                                  @if(!empty($bookRoomData['customer_id']) && $bookRoomData['customer_id']== $customer->id)
                                  selected=""
                                  @else {{ old('customer_id') == $customer->id ? 'selected' : '' }} 
                                  @endif
                                  >{{$customer->customer_name}}
                              </option>
                          @endforeach
                      </select>
                      <p style="color:red">
                        @error('customer_id')

                        {{$message}}
                        @enderror
                      </p>
                  </div>
                  <div class="form-group">
                      <label for="address">Address *</label>
                      <input type="text" class="form-control" name="address" id="address" placeholder="Enter Address"
                      @if(!empty($bookRoomData['address']))
                      value= "{{$bookRoomData['address']}}"
                      @else value="{{old('address')}}"
                      @endif>
                      <p style="color:red">
                        @error('address')
                      
                        {{$message}}
                        @enderror
                      </p>
                  </div>
                  <div class="form-group">
                      <label for="contact">Contact *</label>
                      <input type="number" class="form-control" name="contact" id="contact" placeholder="Enter Contact"
                      @if(!empty($bookRoomData['contact']))
                      value= "{{$bookRoomData['contact']}}"
                      @else value="{{old('contact')}}"
                      @endif>
                      <p style="color:red">
                        @error('contact')
                      
                        {{$message}}
                        @enderror
                      </p>
                  </div>
                  <div class="form-group">
                      <label for="advance"> Advance </label>
                      <input type="number" min="1" name="advance" id="advance" class="form-control totalAmountRoom" placeholder="Advance" 
                      @if(!empty($bookRoomData['advance']))
                      value= "{{$bookRoomData['advance']}}"
                      @else value="{{old('advance')}}"
                      @endif>
                  </div>
                  <div class="form-group">
                      <label for="total"> Total</label>
                      <input type="text" name="total" id="total" readonly class="form-control " placeholder="Total Amount" 
                      @if(!empty($bookRoomData['total']))
                      value= "{{$bookRoomData['total']}}"
                      @else value="{{old('total')}}"
                      @endif>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                      <label for="room_id">Room No *</label>
                      <select name="room_id[]" id="room_type_id" multiple="multiple" class="form-control select2">
                          <option value="">Select</option>
                          @foreach($rooms as $room)
                              <option value="{{$room->id}}" 
                                @if (!empty($bookRoomData['room_id']))
                                <?php echo isset($bookRoomData['room_id']) && in_array($room->id,explode(',',$bookRoomData['room_id'])) ? "selected" : '' ?>
                                  @else 
                                  {{ old('room_id') == $room->id ? 'selected' : '' }}
                                @endif
                                  >{{$room->room_no}}
                              </option>
                          @endforeach
                      </select>
                      <p style="color:red">
                        @error('room_id')
                        {{$message}}
                        @enderror
                      </p>
                  </div>
                  {{-- <div class="form-group">
                      <label for="price">Price</label>
                      <input type="text" class="form-control"  min="1" name="price" id="price" placeholder="Enter price"
                      @if(!empty($bookRoomData['price']))
                      value= "{{$bookRoomData['price']}}"
                      @else value="{{old('price')}}"
                      @endif>
                  </div> --}}
                  {{-- <div class="form-group">
                      <label for="room_type">Room type</label>
                      <input type="text" class="form-control" name="room_type" id="room_type" placeholder="Enter RoomType"
                      @if(!empty($bookRoomData['room_type']))
                      value= "{{$bookRoomData['room_type']}}"
                      @else value="{{old('room_type')}}"
                      @endif>
                  </div> --}}
                  <div class="form-group">
                      <label for="name">Pax *</label>
                      <select name="pax" id="" class="form-control" >
                          <option  value="">Select</option>
                          <option value="All"
                          @if(!empty($bookRoomData['pax']) && $bookRoomData['pax']=="All")
                          selected
                          @else {{ old('pax') == 'All' ? 'selected' : '' }} 
                          @endif
                              >All</option>
                          <option value="Adult"
                          @if(!empty($bookRoomData['pax']) && $bookRoomData['pax']=="Adult")
                          selected
                          @else {{ old('pax') == 'Adult' ? 'selected' : '' }} 
                          @endif
                              >Adult</option>
                              <option value="Child"

                              @if(!empty($bookRoomData['pax']) && $bookRoomData['pax']=="Child")
                          selected
                          @else {{ old('pax') == 'Child' ? 'selected' : '' }} 
                          @endif
                              >Child</option>
                      </select>
                      <p style="color:red">
                        @error('pax')
                        {{$message}}
                        @enderror
                      </p>
                  </div>
                  <div class="form-group">
                      <label for="name">Travel Agent *</label>
                      <select name="travel_agent" id="travel_agent" class="form-control" >
                          <option  value="">Select</option>
                          <option value="Self"
                          @if(!empty($bookRoomData['travel_agent']) && $bookRoomData['travel_agent']=="Self")
                          selected
                          @else {{ old('travel_agent') == 'Self' ? 'selected' : '' }} 
                          @endif
                              >Self</option>
                              <option value="Agent"
                              @if(!empty($bookRoomData['travel_agent']) && $bookRoomData['travel_agent']=="Agent")
                          selected
                          @else {{ old('travel_agent') == 'Agent' ? 'selected' : '' }} 

                          @endif>Agent</option>
                      </select>
                      <p style="color:red">
                        @error('travel_agent')
                        {{$message}}
                        @enderror
                      </p>
                  </div>
                  @if (!empty($bookRoomData['travel_agent']) && $bookRoomData['travel_agent']=="Agent")
                      <?php $display = "block"?>
                  @else
                      <?php $display = "none"?>
                  @endif
                  <div class="form-group " style="display: {{$display}}" id="display_agent_name">
                      <label for="name"> Agent Name</label>
                      <input type="text" name="agent_name" id="" class="form-control" placeholder="Agent Name" 
                      @if(!empty($bookRoomData['agent_name']))
                      value= "{{$bookRoomData['agent_name']}}"
                      @else value="{{old('agent_name')}}"
                      @endif>
                  </div>
                  <div class="form-group">
                      <label for="name"> Room Charge</label>
                      <input type="number" name="room_charge"  min="1" id="room_charge" class="form-control totalAmountRoom" placeholder="Room Charge" 
                      @if(!empty($bookRoomData['room_charge']))
                      value= "{{$bookRoomData['room_charge']}}"
                      @else value="{{old('room_charge')}}"
                      @endif>
                  </div>
                  <div class="form-group">
                      <label for="additional_charge"> Additional Charge</label>
                      <input type="number" name="additional_charge"  min="1" id="additional_charge" class="form-control totalAmountRoom" placeholder="Additional Charge" 
                      @if(!empty($bookRoomData['aditional_charge']))
                      value= "{{$bookRoomData['aditional_charge']}}"
                      @else value="{{old('aditional_charge')}}"
                      @endif>
                  </div>
                  <div class="form-group">
                      <label for="discount totalAmountRoom"> Discount</label>
                      <input type="number" name="discount"  min="1" id="discount" class="form-control totalAmountRoom" placeholder="Discount" 
                      @if(!empty($bookRoomData['discount']))
                      value= "{{$bookRoomData['discount']}}"
                      @else value="{{old('discount')}}"
                      @endif>
                  </div>
                  {{-- <div class="form-group">
                      <label for="name"> Paid</label>
                      <input type="number" name="paid"  min="1" id="paid" class="form-control totalAmountRoom" placeholder="Paid" 
                      @if(!empty($bookRoomData['paid']))
                      value= "{{$bookRoomData['paid']}}"
                      @else value="{{old('paid')}}"
                      @endif>
                  </div> --}}
                  
                  <div class="form-group">
                      <label for="name"> Due</label>
                      <input type="text" name="due" id="due" readonly class="form-control" placeholder="Due" 
                      @if(!empty($bookRoomData['due']))
                      value= "{{$bookRoomData['due']}}"
                      @else value="{{old('due')}}"
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

