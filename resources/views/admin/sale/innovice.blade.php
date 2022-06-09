@if (!empty($orderDetails->ordrDetails))
<div class="container">
    <div class="row">
        <div class="col-md-12">
    		<div class="invoice-title">
    			<h2>Invoice</h2><h3 class="pull-right">Order # {{$orderDetails->id}} </h3>
    		</div>
    		<hr>
    		<div class="row">
    			<div class="col-md-6">
    				<address>
    				<strong>Billed To:</strong><br>
					@if (!empty($orderDetails->customer->customer_name))
					{{$orderDetails->customer->customer_name}} <br>
					@else
						Walk-in Customer
					@endif
                        
    				</address>
    			</div>
    			
    		</div>
    		<div class="row">
    			<div class="col-md-6">
    				<address>
    					<strong>Payment Method:</strong><br>
                        {{$orderDetails->payment}}
    				</address>
    			</div>
    			<div class="col-md-6 text-right">
    				<address>
    					<strong>Order Date:</strong><br>
    					{{$orderDetails->created_at}} 
    				</address>
    			</div>
    		</div>
    	</div>
    </div>
    
    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>Order summary</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-condensed">
    						<thead>
                                <tr>
        							<td style="width:18%" class="text-center"><strong> Name</strong></td>
        							<td style="width:18%" class="text-center"><strong> Price</strong></td>
        							<td style="width:18%" class="text-center"><strong> Qty</strong></td>
        							<td style="width:18%" class="text-right"><strong>Total</strong></td>
                                </tr>
    						</thead>
    						<tbody>
    							<!-- foreach ($order->lineItems as $line) or some such thing here -->
                                <?php $subtotal = 0; ?>
                                @foreach($orderDetails->ordrDetails as $order)
    							<tr class="text-center">
                                    <td>{{$order->item}}</td>
                                    <td>Rs.{{$order->price}}.00</td>
                                    <td class="text-center">{{$order->quantity}}</td>
                                    <td class="text-right">Rs.{{$order->price*$order->quantity}}.00</td>
    							</tr>
                                <?php $subtotal = $subtotal + ($order->price*$order->quantity); ?>
                                @endforeach
    							<tr>
    								<td class="thick-line text-right"  colspan="3"><strong>Subtotal</strong></td>
    								<td class="thick-line text-right">Rs.{{$subtotal}}.00</td>
    							</tr>
								<tr>
    								<td class="thick-line text-right"  colspan="3"><strong>Discount</strong></td>
    								<td class="thick-line text-right">Rs.{{$orderDetails->discount}}.00</td>
    							</tr>
								<tr>
    								<td class="thick-line text-right"  colspan="3"><strong>Tax</strong></td>
    								<td class="thick-line text-right">{{$orderDetails->tax}}%</td>
    							</tr>
    							<tr>  
									<?php $tax = $subtotal*10/100; 
									$grand_total = $subtotal + $tax- $orderDetails->discount;
									?>
    								<td class=" text-right" colspan="3"><strong>Total</strong></td>
    								<td class=" text-right">Rs.{{$grand_total}}.00</td>
    							</tr>
    						</tbody>
    					</table>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
  </div>
    @endif