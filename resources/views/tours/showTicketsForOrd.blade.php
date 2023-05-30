@extends('layouts.index')
@section('content')

@foreach ($arr as $data)
@for($i = 0; $i < count($data); $i++) <form method="post" action="{{route('confirmTicket', [$data[$i]->flight_ticket, $data[$i]->class_ticket])}}">
   @csrf
   <div class="asd">
      <div class="main">
         <input type="text" name="val[]" value="{{$data[$i]->flight_ticket}}">
         <p>{{$data[$i]->airline_ticket}}</p>
         <p>Код: {{$data[$i]->flight_ticket}}</p>
         <p>Дата: {{$data[$i]->date_departure_ticket}}</p>
         <p>Время: {{$data[$i]->time_departure_ticket}}</p>
      </div>
      <p>{{$data[$i]->class_ticket}}</p>
      @endfor
      <button type="submit">выбрать</button>

   </div>

   @endforeach


   </form>

   @endsection

   <style>
      .asd {
         width: 600px;
         height: 300px;
         display: flex;
         background-color: aliceblue;
         flex-direction: column;
         margin: 0 auto;
         margin-top: 60px;
      }
   </style>