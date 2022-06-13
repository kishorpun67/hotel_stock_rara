<?php  
  use App\Table;
  use App\CustomerTable;

?>
{{-- @if (!$table->isEmpty()) --}}
    @foreach ($table as $item)
    <?php
        $customer_table = CustomerTable::where('table_id',$item->id)->get();
        $total_customer = CustomerTable::where('table_id',$item->id)->sum('no_customer');
        ?>
    <div class="table-inner mt-3">
        <figure class="table_image zoomIn animated"> <img src="{{asset('front/images/table-dinner.png')}}" alt="This is Table image">
        <figcaption class="table_caption"> 
            <h5 style="text-align: center;">Table No : {{$item->table_no}} </h5>
            <h5 style="text-align: center;">Seat Capacity : {{$item->seat_capacity}} </h5>
            <h5 style="text-align: center;" >Total Customer : <span id="total-customer-{{$item->id}}">{{$total_customer}}</span> </h5>
            <h5 style="text-align: center;"  id="available_seat-{{$item->id}}">Avaliable : {{$item->seat_capacity-$total_customer}} </h5>
        </figcaption>
        </figure>
        <table class="cart_table">
        <thead>
            <tr>
            <th>Person</th>
            <th>Type</th>
            <th>Del</th>
            </tr>
        </thead>
        <tbody id="data-{{$item->id}}">
        <div > @foreach ($customer_table as $data)
            <tr>
            <td>{{$data->no_customer}}</td>
            <td>{{$data->type}}</td>
            <td><a href="javascript:" onclick="deleteCustomerTable(this.getAttribute('customer_id'), this.getAttribute('table_id'))" table_id={{$item->id}}  customer_id ={{$data->id}} ><i class="fa fa-trash" aria-hidden="true"></i></a></td>
            </tr>
            @endforeach </div>
        <div class="row">
            <div class="col-md-12 d-flex">
            <?php $avaliable_seat = $item->seat_capacity-$total_customer;?>
            @if ($avaliable_seat >= 1)
            <?php $dispaly ="flex"; $dispaly1 ="none"  ?>
            @else
            <?php $dispaly ="none"; $dispaly1 ="block"  ?>
            @endif
            <input style="display:{{$dispaly}}" type="number" min="1" id="no_of_customer-{{$item->id}}" value="1" class="form-control">
            <select style="display:{{$dispaly}}" name="type" id="type-{{$item->id}}" class="form-control">
                <option value="Sigle">Single</option>
                <option value="Group">Group</option>
            </select>
            <button id="display-btn-{{$item->id}}" style="display:{{$dispaly}}" onclick="addCustomer(this.getAttribute('table_id'))" table_id={{$item->id}} class="btn btn-primary add_btn"><i class="fa-solid fa-plus"></i>Add</button>
            <button id="display-{{$item->id}}" style="color: red; display:{{$dispaly1}}"  class="btn btn-danger">Booked</button>
            </div>
        </div>
            </tbody>
        
        </table>
    </div>
    @endforeach 
{{-- @endif --}}
