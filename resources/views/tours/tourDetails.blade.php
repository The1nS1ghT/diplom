@extends('layouts.index')
@section('content')


<!-- <v-room></v-room> -->

@foreach ($tour as $data)

<a href="{{route('showRoomDetails.tour', [$data->id_hotel,$data->id_tour, $data->type_room])}}">{{$data->type_room}}</a>
<p>{{$data->type_food}}</p>
<a href="{{route('choiseTicket.tour',[$data->id_hotel,$data->id_tour, $data->type_room])}}">выбрать</a>
<button onclick="showHide('block_id')">Показать услуги</button>
<div id="block_id" style="display: none;">
   <p>{{$data->type_room}}</p>
   Список услуг
   @foreach ($room as $rooms)
   <p>{{$rooms->name_services}}</p>
   @endforeach
</div>
@endforeach


@endsection

<style>
   #bar_block {
      display: none;
   }

   #show_bar {
      margin: auto;
      display: flex;
   }
</style>