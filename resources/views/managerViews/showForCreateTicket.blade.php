@extends('layouts.manager')
@section('content')

ticket created page


<div class="countryAdd-wrap">
   <form method="post" action="{{route('create.ticket')}}">
      @csrf
      <div class="add-form-el">
         <select name="airline_ticket">
            <!-- <option disabled selected hidden>выберите авиакомпанию</option> -->
            <option>Аэрофлот</option>
         </select>
      </div>
      <div class="add-form-el">
         <input class="admin-input" name="flight_ticket" type="text" placeholder="введите № рейса">
      </div>
      <div class="add-form-el">
         <input class="admin-input" name="name_airplane_ticket" type="text" placeholder="введите название самолёта">
      </div>
      <div class="add-form-el">
         <select name="departure_place_ticket">
            <option disabled selected hidden>выберите город отправления</option>
            @foreach($data as $name_city)
            <option>
               {{$name_city->name_city}}
            </option>
            @endforeach
         </select>
      </div>
      <div class="add-form-el">
         <select name="iata_code_departure_ticket">
            <option disabled selected hidden>выберите код ИАТА места отправления</option>
            @foreach($data as $iata_code)
            <option>
               {{$iata_code->iata_code_airport}}
            </option>
            @endforeach
         </select>
      </div>
      <div class="add-form-el">
         <select name="arrival_place_ticket">
            <option disabled selected hidden>выберите город прибытия</option>
            @foreach($data as $name_city)
            <option>
               {{$name_city->name_city}}
            </option>
            @endforeach
         </select>
      </div>
      <div class="add-form-el">
         <select name="iata_code_arrival_ticket">
            <option disabled selected hidden>выберите код ИАТА места прибытия</option>
            @foreach($data as $iata_code)
            <option>
               {{$iata_code->iata_code_airport}}
            </option>
            @endforeach
         </select>
      </div>
      <div class="add-form-el">
         <label>Дата отправления:<input class="admin-input" name="date_departure_ticket" type="date"></label>
      </div>
      <div class="add-form-el">
         <label>Время отправления:<input class="admin-input" name="time_departure_ticket" type="time"></label>
      </div>
      <div class="add-form-el">
         <label>Дата прибытия:<input class="admin-input" name="date_arrival_ticket" type="date"></label>
      </div>
      <div class="add-form-el">
         <label>Время прибытия:<input class="admin-input" name="time_arrival_ticket" type="time"></label>
      </div>
      <div class="add-form-el">

         <select name="class_ticket">
            <option disabled selected hidden>выберите класс перелёта</option>
            <option>Эконом-класс</option>
            <option>Бизнес-класс</option>
            <option>Первый-класс</option>
         </select>
      </div>
      <div class="add-form-el">
         <label for="luggage">Наличие багажа</label>
         <input name="availability_luggage" type="checkbox">
         <!-- <select name="availability_luggage">
            <option>да</option>
            <option>нет</option>
         </select> -->
      </div>

      <div class="add-form-el">
         <input class="admin-input" name="price_ticket" type="text" placeholder="Введите цену">
      </div>
      <div class="add-form-el">
         <input class="admin-input" name="quantity" type="number" placeholder="Количество билетов">
      </div>

      <button class="add-form-btn" type="submit">Добавить</button>
   </form>
</div>



@endsection