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
        <input type="hidden" name="price[]" value="{{ $data->price }}">
      
       



        <td>{{ $data->ingredient_id }}</td>
        <td>{{ $data->name}}</td>
        <td>{{ $data->price}}</td>
        <td><input class="" onkeyup="purchaseCalculate(this, this.getAttribute('ingredientCart_id'))" type="text" name="quantity[]" value="{{ $data->quantity}}" ingredientCart_id="{{ $data->id }}" 
          >@if (!empty($data->ingredientUnit->unit_name))
          {{$data->ingredientUnit->unit_name}}
          @endif
        </td>
        <td>{{ $data->quantity * $data->price}}</td>
       
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
                  
</div>
<!-- /.col -->
<div class="col-6">
  <p class="lead"></p>

  <div class="table-responsive">
    <table class="table">
      <tr>
        <th style="width:50%">G.Total</th>
        <td> <input type="text" name="total" class="total" value="{{ $total }}" readonly></td>
      </tr>
      <tr>
        <th>Paid</th>
        <td><input class="paid" type="number" onkeyup="purchasePaid(this)" name="paid" value="" ingredientCart_id="" ></td>
      </tr>
      <tr>
        <th>Due:</th>
        <td><input id="deu_amount" type="number" name="due" value="" readonly></td>
      </tr>
    </table>
  </div>
</div>
</div>
