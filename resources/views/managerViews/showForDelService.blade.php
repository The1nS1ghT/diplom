@extends('layouts.manager')
@section('content')
<label>выберите услуги, которые хотите убрать из номера: </label>
@foreach ($serviceInRoom as $data)
<form method="post" action="{{route('deleteService.room',[$data->id_hotel, $data->type_room])}}">
   @csrf
   <p>{{$data->name_services}}</p>
   <input type="checkbox" name="services[]" value="{{$data->name_services}}">
   @endforeach
   <button type="submit">Удалить</button>
</form>

@endsection