@extends('layouts.manager')
@section('content')

<div>
   <form method="post" action="{{route('create.tour')}}">
      @csrf
      <label>Создать тур</label>
      <input name="name_tour" type="text" placeholder="Введите название тура">
      <label>Тип тура</label>
      <select name="type_tour">
         <option selected disabled hidden>Выберите тип тура</option>
         <option>Пляжный</option>
         <option disabled>Горнолыжный курорт</option>
         <option>Экскурсия</option>
         <option>Оздоровительный</option>
      </select>
      <label>Описание тура</label>
      <textarea name="desc_tour" placeholder="Введите описание тура"></textarea>
      <label>Выберите отель</label>
      <select name="name_hotel">
         <option selected disabled hidden>Выберите отель</option>
         @foreach ($hotel as $data)
         <option>{{$data->name_hotel}}</option>
         @endforeach
      </select>

      <label>дата начала</label>
      <input type="date" name="date_arrival_tour">
      <label>дата окончания</label>
      <input type="date" name="date_departure_tour">
      <button type="submit">Создать</button>
   </form>
</div>


@endsection