<?php 
  use App\TaxVat;
  $taxVat = TaxVat::first();
?>
<div class="col-md-12">
  <table class="table table-bordered table-striped  text-center">
    <thead>
    <tr>
      <th>SN</th>
      <th>Ingredient(code)</th>
      <th>Unit Price</th>
      <th>Quantity/Amount</th>
      <th>Total</th>
    </tr>
    </thead>
    <tbody>
      <?php 
      $total = 0
        ?>
      
        @forelse($ingredientcart  as $data)
        @if (!empty($data->ingredientUnit->id))
        <input type="hidden" name="ingredientUnit_id[]" value="{{$data->ingredientUnit->id}}">
        @endif
        <input type="hidden" name="id[]" value="{{ $data->id }}">
        <input type="hidden" name="ingredient_id[]" value="{{ $data->ingredient_id }}">
        <input type="hidden" name="ingredient[]" value="{{ $data->name }}">
        <td>{{ $data->ingredient_id }}</td>
        <td>{{ $data->name}}</td>
        <td>
          <input class="" 
          onkeyup="purchaseCalculate(this.getAttribute('ingredientCart_id')); totalCalculationPurchase();"  
          onchange="purchaseCalculate(this.getAttribute('ingredientCart_id')); totalCalculationPurchase();" name="price[]" type="text" id="ingredient_unit_price-{{$data->id}}" value="{{$data->price}}" min='1'  name="unit_price[]" 
         ingredientCart_id="{{ $data->id }}" 
         >
        <td>
        <input class="" 
       
           onkeyup="purchaseCalculate(this.getAttribute('ingredientCart_id')) ;totalCalculationPurchase(); "  
           onchange=" purchaseCalculate(this.getAttribute('ingredientCart_id')) ;totalCalculationPurchase();" type="text" id="ingredient_quantity-{{$data->id}}" 
           value="{{$data->quantity}}"   name="quantity[]" 
          ingredientCart_id="{{ $data->id }}" 
          >
          @if (!empty($data->ingredientUnit->unit_name))
          {{$data->ingredientUnit->unit_name}}
          @endif
        </td>
        <td id="subTotal-{{$data->id}}">{{ $data->quantity * $data->price}}</td>
        <td>
          {{-- <a href="{{route('admin.add.edit', $data->id)}}"><i class="fa fa-edit">Edit</i></a>&nbsp;&nbsp; --}}
          <a href="javascript:" onclick="deletePurchaseCart(this.getAttribute('ingredient_id'))" class="" ingredient_id="{{$data->id}}" style="display:inline;">
            <i class="fa fa-trash fa-" aria-hidden="true" ></i>
          </a></td>
        </tr>
        <?php $total = $total +($data->quantity*$data->price)?>
        @empty
        <p>No Data</p>
        @endforelse
    </tbody>
  </table>
</div>
<div class="col-6">
  <table class="table">
    <tr>
      <th style="width:50%">Sub.Total</th>
      <td> <input type="text" name="total" id="subtotal" class="total" value="{{ $total }}" readonly></td>
    </tr>
  </table>        
</div>
<!-- /.col -->
<div class="col-6">
  <div class="form-group">
    <label for="">Tax(%)</label>
    <select name="tax" id="tax" class="form-control " onchange="totalCalculationPurchase();">
      <option value="0">Non</option>
      <option value="{{$taxVat->tax}}">{{$taxVat->tax}}%</option>
    </select>
  </div>
  <div class="form-group">
    <label for="">Vat(%)</label>
    <select name="vat" id="vat" class="form-control " onchange="totalCalculationPurchase();">
      <option value="0">Non</option>
      <option value="{{$taxVat->vat}}">{{$taxVat->vat}}%</option>
    </select>
  </div>
  <p class="lead"></p>

  <div class="table-responsive">
    <table class="table">
      
      <tr>
        <th style="width:50%">G.Total</th>
        <td> <input type="text" name="total" id="total" class="total" value="{{ $total }}" readonly></td>
      </tr>
      <tr>
        <th>Paid</th>
        <td><input class="paid" type=" " onkeyup="purchasePaid(this)" name="paid" value="" ingredientCart_id="" ></td>
      </tr>
      <tr>
        <th>Due:</th>
        <td><input id="deu_amount"  type="number" name="due" value="{{ $total }}" readonly></td>
      </tr>
    </table>
  </div>
</div>
</div>
