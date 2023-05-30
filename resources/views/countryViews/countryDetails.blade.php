@extends('layouts.index')
@section('content')


<div class="country-wrap">
   @foreach($data as $data)
   <p class="coutnry-wrap-name">{{$data->name_country}}</p>
   <p class="coutnry-wrap-el">Телефонный код: {{$data->phone_country}}</p>
   <p class="coutnry-wrap-el">Валюта: {{$data->currently_country}}</p>
   <p class="coutnry-wrap-el">Континент: {{$data->continent_country}}</p>
   <p class="coutnry-wrap-el">Описание: {{$data->description_country}}</p>
   <a class="country-wrap-btn" href="/countries">назад</a>
   @if(Auth::user()->type_user == 'администратор')
   <a class="country-wrap-btn" href="{{route('showForUpdate.country', $data->id_country)}}">редактировать</a>
   @endif
   @endforeach
</div>



@endsection

<style scoped>
   .country-wrap {
      display: flex;
      flex-direction: column;
      width: 700px;
      margin-left: 300px;
      margin-top: 100px;
      height: 300px;
      background-color: aliceblue;
   }

   .coutnry-wrap-el {
      font-size: 20px;
      padding-left: 20px;
   }

   .coutnry-wrap-name {
      font-size: 26px;
      padding-left: 20px;
   }

   .country-wrap-btn {
      width: 200px;
      height: 40px;
      font-size: 20px;
      flex-direction: none;
      color: black;
      padding-left: 20px;
   }
</style>