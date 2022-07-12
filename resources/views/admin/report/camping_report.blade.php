@extends('layouts.admin_layout.admin_layout')
@section('content')
<?php 
  use App\Admin\Tent;
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
              <h3 class="card-title">Camping Report</h3>
            </div>
            <div class="card-body">
              <table id="monthly-charts" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Number of Customer</th>
                  <th>Tent Type</th>
                  <th>Price (Per\day)</th>
                  <th>Duration (Days)</th>
                  <th>Total</th>
                </tr>
                </thead>
                <tbody>
                  <?php 
                  $i=1;
                    ?>
                @forelse($rentTent as  $tent)
                <tr>
                    <td>{{ $i}}</td>
                    <?php 
                  $i++;
                    ?>
                    <td>
                        @if(!empty( $tent->customer->customer_name))
                            {{ $tent->customer->customer_name}}
                        @endif
                    </td>
                    <td>{{ $tent->number_of_customer}}</td>
                    <td>
                      @if(!empty( $tent->tent_id))
                      <?php 
                         $ids = explode(',', $tent->tent_id);
                         $tents = Tent::whereIn('id', $ids)->get();
                         
                      ?>
                      {{-- {{$ids}} --}}
                      @foreach ($tents as $item)
                      {{$item->name}} <br>
                          
                      @endforeach
                       
                      @endif
                    </td>

                    <td>
                      @foreach ($tents as $item)
                        {{$item->price}} <br>
                      @endforeach
                    </td>
                    <td>{{ $tent->duration}}</td>

                    <td>{{ $tent->total}}</td>
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