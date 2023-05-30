@extends('layouts.index')
@section('content')
<div>
   <a href="">Континент</a>
</div>

<div class="country_con">
   @foreach ($co as $con)
   <input type="hidden" value="{{$con->id_country}}">
   <a href="{{route('getCountryDetails', $con->id_country)}}" class="country">{{$con->name_country}}</a>

   @endforeach
</div>
@endsection

<style scoped>
   .country_con {
      width: 360px;
      height: 200px;
      background-color: antiquewhite;
      display: flex;
      flex-wrap: wrap;
      margin-top: 30px;
      margin-left: 30px;
   }

   .country {
      text-align: center;
      display: flex;
      align-items: center;
      width: 120px;
      height: 60px;
      font-size: 14px;
      background-color: aliceblue;
      border: 1px solid black;
      justify-content: center;
   }

   .country:hover {
      background-color: black;
      color: #da2243;
   }
</style>