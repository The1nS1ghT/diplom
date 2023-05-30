@extends('layouts.manager')
@section('content')

<div>
   @for ($i = 0; $i < count($tickets); $i++) <p>Авиакомпания: {{$tickets[$i]->airline_ticket}}</p>
      <p>Рейс №{{$tickets[$i]->flight_ticket}}</p>
      <p>Тип самолёта: {{$tickets[$i]->name_airplane_ticket}}</p>
      <p>Место отправления: {{$tickets[$i]->departure_place_ticket}}</p>
      <p>Место прибытия: {{$tickets[$i]->arrival_place_ticket}}</p>
      <p>Код ИАТА места отправления: {{$tickets[$i]->iata_code_departure_ticket}}</p>
      <p>Код ИАТА места прибытия: {{$tickets[$i]->iata_code_arrival_ticket}}</p>
      <p>Дата отправления: {{$tickets[$i]->date_departure_ticket}}</p>
      <p>Время отправления: {{$tickets[$i]->time_departure_ticket}}</p>
      <p>Дата прибытия: {{$tickets[$i]->date_arrival_ticket}}</p>
      <p>Время прибытия: {{$tickets[$i]->time_arrival_ticket}}</p>
      <p>Тип перелёта: {{$tickets[$i]->type_flight_ticket}}</p>
      <p>Класс перелёта: {{$tickets[$i]->class_ticket}}</p>
      @if($tickets[$i]->availability_luggage == false)
      <p>Наличие багажа: нет</p>
      @else ($tickets[$i]->availability_luggage == true)
      <p>Наличие багажа: да</p>
      @endif
      <p>Цена билета: {{$tickets[$i]->price_ticket}}</p>
      @if($tickets[$i]->redeemed == false)
      <p>статус: свободен</p>
      @else ($tickets[$i]->redeemed == true)
      <p>статус: куплен</p>
      @endif
      <p>{{$list[$i]}}</p>
      <a href="{{route('showDetails.ticket', $tickets[$i]->id_ticket)}}">подробнее</a>
      @endfor
</div>


@endsection