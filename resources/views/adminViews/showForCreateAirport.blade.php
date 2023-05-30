@extends('layouts.admin')
@section('content')

<div class="countryAdd-wrap">
   <p class="countryAdd-wrap-logo">Добавить новый аэропорт</p>
   <form method="POST" action="{{route('create.airport')}}">
      @csrf
      <div class="add-form-el">
         <input class="admin-input" name="name_airport" type="text" placeholder="*введите название">
      </div>
      <div class="add-form-el">
         <select name="name" id="name">
            <option value="" disabled selected hidden>выберите город</option>
            @foreach($city as $c)
            <option>
               {{$c->name_city}}
            </option>
            @endforeach
         </select>
      </div>
      <div class="add-form-el">

         <input class="admin-input" name="code_ikao" type="text" placeholder="*введите код ИКАО">
      </div>
      <div class="add-form-el">

         <input class="admin-input" name="code_iata" type="text" placeholder="*введите код ИАТА">
      </div>
      <button class="add-form-btn  " type="submit">добавить</button>
   </form>
</div>

@endsection