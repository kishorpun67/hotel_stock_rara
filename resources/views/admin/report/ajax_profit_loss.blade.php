
<?php 
 use App\Order;
?>
<?php $i = 1;
  $total_purchased = 0;
  $total_sales = 0;
  $total_quantity = 0;
  $total_profit = 0;
?>
@foreach ($order as $item)
<tr>
  <td>{{$i}}</td>
  <?php $i++; ?>
  <td>@if (!empty($item->order->customer_id))
    <?php  $customer = Order::getCustomerName($item->order->customer_id);
    echo $customer ?>
 @else
 Walk-In Customer
 @endif
</td>
  <td>{{$item->created_at}}</td>
  <td>{{$item->item}}</td>
  <td><?php 
   $purchaseprice = Order::purchasePriceItem($item->item_id);
   echo $purchaseprice;
   $total_purchased +=$purchaseprice;

  ?></td>
  <td>{{$item->price}}</td>
  <td>{{$item->quantity}}</td>
  <td><?php $profit = $item->price -$purchaseprice;
    $total_sales += $item->price;
    $total_quantity += $item->quantity;
    $total_profit += $profit*$item->quantity;
  ?> 
    {{$profit * $item->quantity}}
  </td>

  <td><small><strong>Ingredient - Cons(Qty)</strong></small><br>
    <small>
            <?php $ingredient = Order::getConsumptionIngredient($item->item_id); ?>
            @foreach ($ingredient as $data)
             @if (!empty($data->ingredient->name))
              {{$data->ingredient->name}}
             @endif -{{$data->consumption_quantity}} <br>
            @endforeach
    </small>
</td>

@endforeach