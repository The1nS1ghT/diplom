@extends('layouts.index')
@section('content')

@foreach ($tours as $tour)

@guest
<a href="{{route('showDetails.tour', [$tour->id_hotel, $tour->id_tour])}}">{{$tour->name_hotel}}</a>
<p>{{$tour->date_arrival_tour}}</p>
<p>{{$tour->date_departure_tour}}</p>
<p>Ночей: {{$tour->nights}}</p>
<p>{{$tour->price_tour}}</p>
@endguest
@auth
<a href="{{route('showDetails.tour', [$tour->id_hotel, $tour->id_tour])}}">{{$tour->name_hotel}}</a>
<p>{{$tour->date_arrival_tour}}</p>
<p>{{$tour->date_departure_tour}}</p>
<p>Ночей: {{$tour->nights}}</p>
<p>{{$tour->price_tour}}</p>
@if (Auth::user()->type_user == 'менеджер')
<a href="">Редактировать</a>
@endif
@endauth
@endforeach

@endsection