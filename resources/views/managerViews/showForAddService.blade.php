@extends('layouts.manager')
@section('content')

<label>Активные услуги номера:</label>

@foreach ($data as $hotel)
<p>{{$hotel->name_services}}</p>
@endforeach
<label>выберите услуги, которые хотите добавить в номера: </label>
<form method="post" action="{{route('addedService.room',[$hotel->id_hotel, $hotel->type_room])}}">
   @csrf
   @foreach ($services as $service)
   <p>{{$service->name_services}}</p>
   <input type="checkbox" name="services[]" value="{{$service->name_services}}">
   @endforeach
   <button type="submit">Добавить</button>
</form>


@endsection