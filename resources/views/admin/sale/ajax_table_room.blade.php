
@if (count($table) > 0)
   <table class="burger-table mt-3 " id="ajaxtTableShow" style="">
    @foreach ($table->chunk(10) as $item)
  
    <tbody>
      <tr>
      @foreach ($item as $table)
        <td  class="room-class " id="table-{{$table->id}}">
          <a href="javascript:"  onclick="getSingleTable(this.getAttribute('table_id'))" table_id={{$table->id}}><i class="fas fa-table"> {{$table->table_no}}</i></a>
        </td>
      @endforeach
      </tr>
    <tbody>
    @endforeach
  </table>
@endif