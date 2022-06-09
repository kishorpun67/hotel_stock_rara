
<?php
use App\TaxVat;

$taxt = TaxVat::first();

?>
<div class="cart-top">
  <div class="d-flex justify-content-between flex-wrap align-items-center mb-3 waiter_customer">
    <div class="select_dropdown w-50">
        <select class="form-control" name="waiter_id">
          <option value="0" selected>Waiter</option>
          @foreach ($waiter as $waiter)
          <option value="{{$waiter->id}}">{{$waiter->name}}</option>
              
          @endforeach
        </select>
    </div>
    <div class="select_dropdown w-50">
      <select class="form-control" name="customer_id">
        <option value="">Walk-in Customer  <strong></strong> </option>
        @foreach ($customer as $item)
          <option value="{{$item->id}}">{{$item->customer_name}}</option>
            
        @endforeach
      </select>
    </div> 
    <div class="d-flex mt-3 edit_flex">
    <!--  <button type="button" class="btn operation_button edit_btn" data-toggle="modal" data-target="#exampleModal15"><i class="fa-solid fa-pencil"></i>Edit</button>-->
      
      
      
         <button type="button" class="btn operation_button add_btn" data-toggle="modal" data-target="#exampleModal10"><i class="fa-solid fa-plus"></i>Add</button>
      
    </div>
        {{-- <div class="quantity-bar"> <span class="input-group-btn">
          <button type="button" class="btn-number btn-minus"  data-type="minus" data-field="quant[2]"> <i class="fas fa-minus"></i> </button>
          </span>
          <input type="text" name="quant[2]" class="form-control input-number" value="1" min="1" max="100" placeholder="1">
          <span class="input-group-btn">
          <button type="button" class="btn-number btn-plus" data-type="plus" data-field="quant[2]"> <i class="fas fa-plus"></i> </button>
          </span> 
        </div> --}}
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
      <!--<li><span>Discount:</span> <input type="text" name="discount" class="form-control" autocomplete="off" onkeyup="discountFunction(this)"> <strong> </strong></li>-->
      <!--<li><span>Tax:</span> <strong>   <select class="" name="tax">-->
      <!--    <option value="0">0%</option>-->
          <option value="{{$tax }}">{{$tax }}%</option>
      <!--</select> -->
      <!--</li>-->
      <li> <span>Total Payable</span> <strong id="total_amount">{{$total_amount}}</strong> </li>
    </ul>
  </div>
  <div class="cart-overview flex-1 my-3">
<input type="hidden" name="subtotal" id="sub_total"  value="{{$total_amount}}">
  
<input type="hidden" name="total" id="grand_total"   value="{{$total_amount}}">
    <!--<h5>Payment Method</h5>-->
    <!--  <label>-->
    <!--<input type="radio" value="Bank transfer" name="payment" checked>-->
    <!--<p>Direct Bank Transfer</p>-->
    <!--</label>-->
    
    <!--<label>-->
    
    <!--<input type="radio" value="Cash Payment" name="payment">-->
    <!--<p>Cash Payment</p>-->
    <!--</label>-->
    
    <!--<label>-->
    <!--<input type="radio" value="paypal" name="payment">-->
    <!--<p>Paypal</p>-->
    <!--<fieldset class="paymenttypes">-->
    <!--  <a href="#"><img src="images/esewa.jpg" alt="" class=""></a>-->
    <!--</fieldset>-->
    <!--</label>-->
  </div>
</div>
<!--<input type="submit" value="Place Oder" class="btn btn-primary">-->
<input type="submit" class="btn place_btn btn-danger" value="Place Order">



 {{-- <button type="button" class="btn btn-primary order_btn operation_button operation_button_50" > <i class="fas fa-utensils"></i>Place Order</button> --}}
  
  <div class="modal fade" id="exampleModal10" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Customer</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
        </div>
        <div class="modal-body">
            <form method="post" action="{{route('admin.add.edit.customer')}}">
                @csrf
              <label for="name">Name*</label>
              <input  class="form-control" id="name "name="customer_name" placeholder="Enter name">
              <label for="address"> Address *</label>
              <input type="text" class="form-control" id="address" name="address" placeholder="Enter address">
              <label for="phone"> Phone *</label>
              <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone number">
              <label for="address"> Email</label>
              <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
              <br>
                <input type="submit" class="btn btn-secondary" value="Submit">

            </form>        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
  