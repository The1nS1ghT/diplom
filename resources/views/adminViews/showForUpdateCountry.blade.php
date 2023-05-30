@extends('layouts.admin')
@section('content')

Country update page

<div>
   @foreach ($data as $country)
   <form method="post" action="{{route('update.country', $country->id_country)}}">
      @csrf
      <p>{{$country->id_country}}</p>
      <label for=""></label>
      <input name="name_country" type="text" value="{{$country->name_country}}">
      <label for=""></label>
      <input name="phone_country" type="text" value="{{$country->phone_country}}">
      <label for=""></label>
      <input name="currently_country" type="text" value="{{$country->currently_country}}">
      <label for=""></label>
      <input name="continent_country" type="text" value="{{$country->continent_country}}">
      <label for=""></label>
      <input name="description_country" type="text" value="{{$country->description_country}}">
      <button type="submit">изменить</button>
   </form>
   @endforeach
</div>

@endsection