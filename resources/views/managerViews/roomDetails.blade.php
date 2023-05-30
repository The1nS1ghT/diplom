@extends('layouts.manager')
@section('content')
Услуги в номере

@foreach ($rooms as $room)
<p>{{$room->name_services}}</p>
@endforeach
@if(Auth::user()->type_user == 'менеджер')
<a href="{{route('showForDelService.room', [$room->id_hotel,$room->type_room])}}">Удалить услуги</a>
<a href="{{route('showForAddService.room', [$room->id_hotel,$room->type_room])}}">Добавить услуги</a>
@endif
@endsection