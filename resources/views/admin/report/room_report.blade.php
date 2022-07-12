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
              <h3 class="card-title">Room Report</h3>
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
                </tr>
             
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