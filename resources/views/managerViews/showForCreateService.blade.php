@extends('layouts.manager')
@section('content')

<div class="countryAdd-wrap">
   <p class="countryAdd-wrap-logo">Добавить новую услугу</p>
   <form method="POST" action="{{route('create.service')}}">
      @csrf
      <div class="add-form-el">
         <input class="admin-input" name="name_service" type="text" placeholder="*введите название">
      </div>
      <div class="add-form-el">
         <label>Наличие услуги</label>
         <input name="availability_service" type="checkbox">
      </div>
      <div class="add-form-el">

         <input class="admin-input" name="quantity_service" type="text" placeholder="*количество">
      </div>
      <!-- <div class="add-form-el">

         <select name="type_room" id="">
            <option disabled selected hidden>выберите тип номера</option>
            <option>стандартный</option>
            <option">2</option>
               <option>3</option>
         </select>
      </div> -->
      <!-- <div class="add-form-el">
         <select name="type_bed" id="">
            <option disabled selected hidden>выберите тип кровати</option>
            <option>2 отдельные кровати</option>
            <option>двуспальная</option>
         </select>
      </div> -->
      <!-- <div class="add-form-el">
         <input class="admin-input" name="photo_nomer" type="text">
      </div> -->
      <!-- <div class="add-form-el">
         <select name="type_food" id="">
            <option disabled selected hidden>выберите тип питания</option>
            <option>RO (room only)</option>
            <option>BB (bed & breakfast)</option>
            <option>HB (half board)</option>
            <option>FB (full board)</option>
            <option>AL (all inclusive)</option>
         </select>
      </div> -->
      <button class="add-form-btn" type="submit">добавить</button>
   </form>
</div>

@endsection