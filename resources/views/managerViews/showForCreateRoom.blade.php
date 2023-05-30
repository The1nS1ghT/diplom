@extends('layouts.manager')
@section('content')

<div>
   @foreach ($hotel as $ho)
   <p>{{$ho->id_hotel}}</p>
   @endforeach
   <form method="post" action="{{route('create.room', $ho->id_hotel)}}">
      @csrf
      <p>Добавьте номер</p>
      <div class="add-form-el">
         <label>введите тип номера</label>
         <input name="type_room" type="text">
      </div>

      <div class="add-form-el">
         <label for="">Выберите тип питания</label>
         <select name="type_food" id="">
            <option disabled selected hidden>выберите тип питания</option>
            <option>RO (room only)</option>
            <option>BB (bed & breakfast)</option>
            <option>HB (half board)</option>
            <option>FB (full board)</option>
            <option>AL (all inclusive)</option>
         </select>
      </div>

      <div class="add-form-el">
         <label class="add-form-el" for="">Выберите тип кровати</label>
         <select name="type_bed" id="">
            <option disabled selected hidden>выберите тип кровати</option>
            <option>2 отдельные кровати</option>
            <option>двуспальная</option>
         </select>
      </div>

      <label for="">Цена за ночь</label>
      <input type="number" name="price_per_night" min="1">
      <label class="add-form-el" for="">Площадь номера</label>

      <input class="add-form-el" name="square_room" type="number" min="1" max="99" placeholder="Введите площадь номера">
      <label for="">Введите количество номеров</label>
      <input class="add-form-el" name="quantity_room" type="number" min="1" max="99" placeholder="Введите количество номеров">
      <label for="">Добавить услуги:</label>
      @foreach ($services as $service)
      <label>{{$service->name_services}}</label>
      <input type="checkbox" name="services[]" value="{{$service->name_services}}">
      @endforeach
      <button class="add-form-btn" type="submit">добавить</button>
   </form>

</div>
@endsection