@extends('layouts.admin')
@section('content')


<div class="countryAdd-wrap">
   <p class="countryAdd-wrap-logo">Добавить новый город</p>
   <form method="POST" action="{{route('create.city')}}">
      @csrf
      <div class="add-form-el">
         <input class="admin-input" name="name_city" id="name_city" type="text" placeholder="*введите название">
      </div>
      <label for=""></label>
      <div class="add-form-el">
         <select name="name_country" id="name_country">
            <option value="" disabled selected hidden>выберите страну</option>
            @foreach($country as $co)
            <option>
               {{$co->name_country}}
            </option>
            @endforeach
         </select>
      </div>
      <button class="add-form-btn" type="submit">добавить</button>
   </form>
</div>

@endsection