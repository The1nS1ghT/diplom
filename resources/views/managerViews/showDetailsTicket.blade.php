@extends('layouts.manager')
@section('content')

Ticket details

<div class="ticket-update-wrap">
   @for ($i = 0; $i < count($data); $i++) <p>ID: {{$data[$i]->id_ticket}}</p>
      <p>Авиакомпания: {{$data[$i]->airline_ticket}}</p>
      <p>Рейс №{{$data[$i]->flight_ticket}}</p>
      <p>Название самолёта: {{$data[$i]->name_airplane_ticket}}</p>
      <p>Место отправления: {{$data[$i]->departure_place_ticket}}</p>
      <p>Место прибытия: {{$data[$i]->arrival_place_ticket}}</p>
      <p>Код ИАТА места отправления: {{$data[$i]->iata_code_departure_ticket}}</p>
      <p>Код ИАТА места прибытия: {{$data[$i]->iata_code_arrival_ticket}}</p>
      <p>Дата отправления: {{$data[$i]->date_departure_ticket}}</p>
      <p>Время отправления: {{$data[$i]->time_departure_ticket}}</p>
      <p>Дата прибытия: {{$data[$i]->date_arrival_ticket}}</p>
      <p>Время прибытия: {{$data[$i]->time_arrival_ticket}}</p>
      <p>Время в пути: {{$dateDetails[$i]}}</p>
      <p>Тип перелёта: {{$data[$i]->type_flight_ticket}}</p>
      <p>Класс перелёта: {{$data[$i]->class_ticket}}</p>
      @if($data[$i]->availability_luggage == false)
      <p>Наличие багажа: нет</p>
      @else ($data[$i]->availability_luggage == true)
      <p>Наличие багажа: да</p>
      @endif
      <p>Цена: {{$data[$i]->price_ticket}}</p>
      <a href="{{route('showForUpdate.ticket', $data[$i]->id_ticket)}}">редактировать</a>
      <a href="{{route('delete.ticket', $data[$i]->id_ticket)}}">удалить</a>
      @endfor
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