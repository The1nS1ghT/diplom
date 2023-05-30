@extends('layouts.manager')
@section('content')


<div>
   @foreach($services as $data)
   <p>Название услуги: {{$data->name_services}}</p>
   <p>Количество: {{$data->quantity_services}}</p>
   @endforeach
</div>
@endsection