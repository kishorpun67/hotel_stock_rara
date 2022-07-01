
<?php
  use App\TaxVat;
  $taxt = TaxVat::first();
?>
<div class="cart-top">
  <div class="d-flex justify-content-between flex-wrap align-items-center mb-3 waiter_customer">
    <div class="select_dropdown w-50">
        <select class="form-control select2" name="waiter_id">
          <option value="0" selected>Waiter</option>
          @foreach ($waiter as $waiter)
          <option value="{{$waiter->id}}">{{$waiter->name}}</option>
          @endforeach
        </select>
    </div>
    <div class="select_dropdown w-50">
      <select class="form-control select2" name="customer_id">
        <option value="">Select Customer   </option>
        @foreach ($customer as $item)
          <option value="{{$item->id}}">{{$item->customer_name}}</option>
            
        @endforeach
      </select>
    </div> 
    <div class="d-flex mt-3 edit_flex">
      <button type="button" class="btn operation_button add_btn" data-toggle="modal" data-target="#exampleModal10"><i class="fa-solid fa-plus"></i>Add</button>
      <ul class="number__list">
        <li><a href="#">Room no: @if (!empty($table->room->room_no))
            {{$table->room->room_no}}
        @elseif(!empty($table->room_no))
        {{$table->room_no}}
        @else
        None
        @endif </a></li>
        <li><a href="#">Table no:</a> @if (!empty($table->table_no))
        {{$table->table_no}}
        @else
          None
        @endif
        </li>
      </ul>
    </div>
  </div> 
  <table class="cart_table">
    <thead>
      <tr>
        <th>SN</th>
        <th>Item</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Total</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody >
      <?php $total_amount = 0;
      $total_item = 0;
      ?>
      @foreach ($carts as $item)
        <tr>
          <td class="serial">{{$item->id}}</td>
          <td class="product_title">{{$item->item}}</td>
          <td class="product_price">Rs.{{$item->price}}</td>
          <td class="quantity">
            <div class="quantity-bar"> <span class="input-group-btn">
              <button type="button" class="btn-number btn-minus qtyMinus" onclick="qtyMinus(this.getAttribute('attr'))"  data-type="minus"  attr="{{$item->id}}"  cart-value="{{$item->quantity}}"> <i class="fas fa-minus"></i> </button>
              </span>
              <input type="text" name="quantity"id="quant-{{$item->id}}" class="form-control input-number" value="{{$item->quantity}}" min="1" max="100" placeholder="1">
              <span class="input-group-btn">
              <button type="button" class="btn-number btn-plus qtyPlus" onclick="qtyPlus(this.getAttribute('attr'))" data-type="plus" attr="{{$item->id}}"  cart-value="{{$item->quantity}}" data-field="quant-{{$item->id}}"> <i class="fas fa-plus"></i> </button>
              </span> </div></td>
          <td class="total-price">Rs.{{$item->price * $item->quantity}}</td>
          <td class="discount"><a href="#" onclick="deleteCartItem(this.getAttribute('cart_id'))" class="" cart_id="{{$item->id}}" ><i class="fa fa-trash" aria-hidden="true"></i></a></td>
        </tr>
        <?php $total_amount= $total_amount + ($item->price* $item->quantity);
        $total_item = $total_item + $item->quantity;
        ?>
      @endforeach
    </tbody>
  </table>
</div>
<div class="cart-bottom d-flex">
  <div class="cart-overview flex-1 my-3">
    <h5>Cart Total</h5>
    <ul class="cart_listing">
      <li><span>Total item:</span> <strong> {{$total_item}} </strong></li>
      <li> <span>Subtotal</span> <strong>{{$total_amount}}</strong> </li>
      <?php
        $tax = $taxt->tax;
        $total_amount = $total_amount+($total_amount*$tax/100);
      ?>
      <option value="{{$tax }}">{{$tax }}%</option>
      <li> <span>Total Payable</span> <strong id="total_amount">{{$total_amount}}</strong> </li>
    </ul>
  </div>
</div>
<input type="hidden" name="total" value="{{$total_amount}}">
<input type="submit" class="btn place_btn btn-danger" value="Place Order">