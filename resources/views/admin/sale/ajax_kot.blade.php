
      <div class="modal-body">
        <form role="form">
          <div class="cart-wrapper checkout_wrapper">
            <div class="cart-top">
              <table class="cart_table">
                <thead>
                  <tr>
                    <th>Item</th>
                    <th>Quantity</th>
                  </tr>
                </thead>
                <tbody>
                    <?php $total_amount = 0;
                    $total_item = 0;
                    ?>
              
                    @if (!empty($orderDetails->kitchen))
                        @forelse ($orderDetails->kitchen as $item)
                        <tr>
                            <td class="product_title">{{$item->item}}</td>
                              <td class="quantity-bar"> {{$item->quantity}}</td>
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
                <ul class="cart_listing">
                  <p>Customer: @if (!empty($orderDetails->Customer->customer_name)) 
                      {{$orderDetails->Customer->customer_nam}}
                  @else
                      Walk-in Customer
                  @endif</p> 
                  <p>Waiter: @if (!empty($orderDetails->waiter->name)) 
                    {{$orderDetails->waiter->name}}
                @else
                    Waiter
                @endif</p>
                </ul>
              </div>
            </div>
          </div>
        </form>
      </div>
      