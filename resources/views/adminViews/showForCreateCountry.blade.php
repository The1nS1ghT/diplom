@extends('layouts.admin')
@section('content')


<div class="countryAdd-wrap">
   <p class="countryAdd-wrap-logo">Добавить новую страну</p>
   <form class="countryAdd-form" method="POST" action="{{route('create.country')}}">
      @csrf
      <div class="add-form-el">
         <input class="admin-input" name="name_country" id="name_country" type="text" placeholder="*введите название">
      </div>
      <div class="add-form-el">
         <input class="admin-input" type="text" name="phone_country" id="phone_country" placeholder="*введите код телефона">
      </div>
      <div class="add-form-el">
         <input class="admin-input" type="text" name="currently_country" id="currently_country" placeholder="*введите валюту страны">
      </div>
      <div class="add-form-el">
         <input class="admin-input" type="text" name="continent_country" id="continent_country" placeholder="*введите континент">
      </div>
      <div class="add-form-el">
         <textarea class="textarea" name="description_country" id="description_country" placeholder="описание страны"></textarea>
      </div>
      <button class="add-form-btn" type="submit">добавить</button>
   </form>
</div>

@endsection