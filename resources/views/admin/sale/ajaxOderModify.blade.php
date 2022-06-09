
      <div class="modal-body">
        <form role="form">
          <div class="cart-wrapper checkout_wrapper">
            <div class="cart-top">
              <table>
                <thead>
              <tr>
                <th>ID</th>
                <th>Item</th>
                    <th>Quantity</th>
                    <th>Discount</th>
                    <th>Total</th>
                    <th>delete</th>
                  </tr>
                </thead>
                <tbody>
                    <?php $total_amount = 0;
                    $total_item = 0;
                    ?>
              @if (!empty($orderDetails->ordrDetails))
              @forelse ($orderDetails->ordrDetails as $item)
                        <tr>
                            <td class="serial">{{$item->id}}</td>
                            <td class="product_title">{{$item->item}}</td>
                            <td class="product_price">Rs.{{$item->price}}</td>
                            <td class="quantity">
                  
                              <div class="quantity-bar"> <span class="input-group-btn">
                                <button type="button" class="btn-number btn-minus " onclick="quantityMinus(this.getAttribute('cart_id'))"  data-type="minus"  cart_id="{{$item->id}}"  cart-value="{{$item->quantity}}"> <i class="fas fa-minus"></i> </button>
                                </span>
                                <input type="text" name="quantity"id="quant-{{$item->id}}" class="form-control input-number" value="{{$item->quantity}}" min="1" max="100" placeholder="1">
                                <span class="input-group-btn">
                                <button type="button" class="btn-number btn-plus " onclick="quantityPlus(this.getAttribute('cart_id'))"  data-type="plus" cart_id="{{$item->id}}"  cart-value="{{$item->quantity}}" data-field="quant-{{$item->id}}"> <i class="fas fa-plus"></i> </button>
                                </span> </div></td>
                            <td class="total-price">Rs.{{$item->price * $item->quantity}}</td>
                            <td class="discount"><a href="javascript:" onclick="deleteOrderDetail(this.getAttribute('cart_id'))" cart_id="{{$item->id}}" ><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                  
                          </tr>
                          <?php $total_amount= $total_amount + ($item->price* $item->quantity);
                          $total_item = $total_item + $item->quantity;
                          ?>
                        @empty
                        @endforelse
                    @endif
                </tbody>
              </table>
            </div>
            <div class="cart-bottom d-flex">
              <div class="cart-overview flex-1">
                <h3>Cart Total</h3>
                <ul class="cart_listing">
                  <p>Total item: {{$total_item}}</p>
                  <p>SubTotal: {{$total_amount}}</p> 
                  <p>Discount:  
                    {{$orderDetails->discount}}
                  </p>
                  <p>Tax:
                    {{$orderDetails->tax}}%
                 </p> 
                  
                  <?php 
                  $tax = $total_amount*10/100; 
                  $grand_total = $total_amount +$tax -$orderDetails->discount; ?>
                
                  <p>Total Payable: {{$grand_total}}</p> 
                </ul>
              </div>
              
                 <div class="cart-overview flex-1">
              
              <label>
              <h3 class="topborder"><span>Payment Method</span></h3>
              <p> @if (!empty($orderDetails->payment))
                {{$orderDetails->payment}}
              @endif Direct Bank Transfer</p>
             
            </div>
            </div>
          </div>
        </form>
        </div>
    