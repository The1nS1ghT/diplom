@extends('layouts.index')

@section('content')
<div class="profile-wrap">
   <p class="profile-wrap-el">имя: {{Auth::user()->name}}</p>
   <p class="profile-wrap-el">фамилия: {{Auth::user()->surname}}</p>
   <p class="profile-wrap-el">отчество: {{Auth::user()->patronymic}}</p>
   <p class="profile-wrap-el">email: {{Auth::user()->email}}</p>
   <p class="profile-wrap-el">номер: {{Auth::user()->phone_user}}</p>
   <a class="profile-wrap-el" href="{{route('userUpdate', Auth::user()->id)}}">Редактировать</a>
   @isset ($image)
   <img src="{{asset('/storage/' . $image)}}" alt="">
   @endisset
</div>
@endsection