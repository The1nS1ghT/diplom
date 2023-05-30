@extends('layouts.admin')
@section('content')


@foreach ($country as $con)
<input type="hidden" value="{{$con->id}}">
<a href="{{route('getCountryDetails', $con->id)}}" class="country">{{$con->name_country}}</a>

@endforeach

@endsection