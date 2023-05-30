@extends('layouts.manager')
@section('content')

update hotel


@foreach($hotel as $data)
<div class="ticket-update-wrap">
   <form method="post" action="{{route('update.hotel', $data->id_hotel)}}">
      @csrf
      <p>ID: {{$data->id_hotel}}</p>
      <label>название</label>
      <input name="name_hotel" type="text" value="{{$data->name_hotel}}">
      <label>Адрес отеля</label>
      <input name="address_hotel" type="text" value="{{$data->address_hotel}}">
      <label>контакты</label>
      <input name="contacts_hotel" type="text" value="{{$data->contacts_hotel}}">

      <a href="{{route('showForCreate.room', $data->id_hotel)}}">добавить номер</a>
      <button type="submit">изменить</button>
   </form>
</div>

@endforeach
@endsection

<style>
   .ticket-update-wrap {
      display: flex;
      flex-direction: column;
      width: 250px;
      margin-left: 300px;
   }

   input {
      width: 200px;
   }
</style>