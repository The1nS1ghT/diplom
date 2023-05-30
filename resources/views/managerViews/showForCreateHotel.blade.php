@extends('layouts.manager')
@section('content')


create hotel

<div class="ticket-update-wrap">
   <form method="post" action="{{route('create.hotel')}}">
      @csrf
      <label>Название отеля</label>
      <input name="name_hotel" type="text">
      <select name="name_city" id="">
         <option disabled selected hidden>выберите город</option>
         @foreach ($cities as $name_city)
         <option>{{$name_city->name_city}}</option>
         @endforeach
      </select>
      <label>адрес отеля</label>
      <input name="address_hotel" type="text">
      <label>контакты</label>
      <input name="contacts_hotel" type="text">
      <label>сайт отеля</label>
      <input name="site_hotel" type="text">

      <!-- <label for="">Добавить номера</label>
      <select name="type_room">
         <option disabled selected hidden>выберите тип номера</option>
         <option>Стандартный</option>
         <option>Люкс</option>
         <option>Президентский</option>
         <option>Королевский</option>
      </select>
      <select name="type_food">
         <option disabled selected hidden>выберите тип питания</option>
         <option>RO (room only)</option>
         <option>BB (bed & breakfast)</option>
         <option>HB (half board)</option>
         <option>FB (full board)</option>
         <option>AL (all inclusive)</option>
      </select>
      <select name="type_bed" id="">
         <option disabled selected hidden>выберите тип кровати</option>
         <option>2 отдельные кровати</option>
         <option>двуспальная</option>
      </select>
      <input type="number" name="quantity_room" min="1" max="99" placeholder="Введите кол-во номеров">
 -->

      <button type="submit">Добавить</button>
   </form>
</div>

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