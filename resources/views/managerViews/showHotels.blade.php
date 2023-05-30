@extends('layouts.index')
@section('content')
@foreach ($hotels as $data)

<a href="{{route('showDetails.hotel', $data->id_hotel)}}">Название отеля: {{$data->name_hotel}}</a>
<p>Город: {{$data->name_city}}</p>
<p>Страна: {{$data->name_country}}</p>
@if (Auth::user()->type_user == 'менеджер')
<a href="{{route('showForUpdate.hotel', $data->id_hotel)}}">редактировать</a>
@endif
@endforeach
@endsection