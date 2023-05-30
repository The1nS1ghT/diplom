@extends('layouts.manager')
@section('content')


<div>
   @foreach($cities as $city)
   <p>ID: {{$city->id_city}}</p>
   <p>название: {{$city->name_city}}</p>
   <button>редактировать</button>
   <button>удалить</button>
   @endforeach
</div>
@endsection