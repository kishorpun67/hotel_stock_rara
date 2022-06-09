
      <div class="modal-body">
        <form role="form">
          <div class="cart-wrapper checkout_wrapper">
            <div class="cart-top">
              <table class="cart_table">
                <thead>
                  <tr>
                    <th>SN</th>
                    <th>Item</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
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
                              <div class="quantity-bar"> {{$item->quantity}}</td>
                            <td class="total-price">Rs.{{$item->price * $item->quantity}}</td>
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
                  <p>Discount: 0</p>
                  <p>Tax: 0</p> 
                  <p>SubTotal: {{$total_amount}}</p> 
                  <p>Total Payable: {{$total_amount}}</p> 


                  
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
      