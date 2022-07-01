<table class="burger-table mt-3" id="tableRoomShow">
    @foreach ($roomSmall->chunk(10) as $item)
    <tbody>
      <tr>
      @foreach ($item as $room)
        <td  class="room-class" id="room-{{$room->id}}">
          <a href="javascript:"  onclick="getRoom(this.getAttribute('room_id'))" room_id={{$room->id}}>  <i class="fas fa-bed"> {{$room->room_no}}</i></a>
        </td>
      @endforeach
      </tr>
    <tbody>
    @endforeach
  </table>