@extends('layouts.manager')
@section('content')

update page


@foreach($data as $dataup)

<div class="ticket-update-wrap">
   <form method="post" action="{{route('update.ticket', $dataup->id_ticket)}}">
      @csrf
      <p>ID: {{$dataup->id_ticket}}</p>

      <label>Авиакомпания: </label>
      <input name="airline_ticket" type="text" value="{{$dataup->airline_ticket}}">


      <label>Рейс №: </label>
      <input name="flight_ticket" type="text" value="{{$dataup->flight_ticket}}">


      <label>Название самолёта: </label>
      <input name="name_airplane_ticket" type="text" value="{{$dataup->name_airplane_ticket}}">


      <label>Город отправления: </label>
      <select name="departure_place_ticket">
         <option selected hidden>{{$dataup->departure_place_ticket}}</option>
         @foreach ($codeiata as $city)
         <option>{{$city->name_city}}</option>
         @endforeach
      </select>


      <label>Город прибытия: </label>
      <select name="arrival_place_ticket">
         <option selected hidden>{{$dataup->arrival_place_ticket}}</option>
         @foreach ($codeiata as $city)
         <option>{{$city->name_city}}</option>
         @endforeach
      </select>

      <label>Код ИАТА аэропорта отправления: </label>
      <select name="iata_code_departure_ticket">
         <option selected hidden>{{$dataup->iata_code_departure_ticket}}</option>
         @foreach ($codeiata as $iata)
         <option>{{$iata->iata_code_airport}}</option>
         @endforeach
      </select>

      <label>Код ИАТА аэропорта прибытия: </label>
      <select name="iata_code_arrival_ticket">
         <option selected hidden>{{$dataup->iata_code_arrival_ticket}}</option>
         @foreach ($codeiata as $iata)
         <option>{{$iata->iata_code_airport}}</option>
         @endforeach
      </select>
      <label>Дата отправления</label>
      <input name="date_departure_ticket" type="date" value="{{$dataup->date_departure_ticket}}">
      <label>Время отправления</label>
      <input name="time_departure_ticket" type="time" value="{{$dataup->time_departure_ticket}}">
      <label>Дата прибытия</label>
      <input name="date_arrival_ticket" type="date" value="{{$dataup->date_arrival_ticket}}">
      <label>Время прибытия</label>
      <input name="time_arrival_ticket" type="time" value="{{$dataup->time_arrival_ticket}}">
      <label>Тип перелёта</label>
      <input name="type_flight_ticket" type="text" hidden value="{{$dataup->type_flight_ticket}}">
      <label>Класс перелёта</label>
      <select name="class_ticket" id="">
         <option selected hidden>{{$dataup->class_ticket}}</option>
         <option>Эконом-класс</option>
         <option>Бизнес-класс</option>
         <option>Первый-класс</option>
      </select>
      <label>Наличие багажа</label>
      @if($dataup->availability_luggage == false)
      <input name="availability_luggage" type="checkbox">
      @else ($dataup->availability_luggage == true)
      <input name="availability_luggage" checked type="checkbox">
      @endif
      <label>Цена</label>
      <input name="price_ticket" type="text" value="{{$dataup->price_ticket}}">
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