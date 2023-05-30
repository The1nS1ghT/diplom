@extends('layouts.index')
@section('content')

room details

@foreach ($services as $service)
<p>{{$service->name_services}}</p>
@endforeach
<a href="">назад</a>

@endsection