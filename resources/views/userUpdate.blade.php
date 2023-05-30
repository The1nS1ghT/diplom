@extends('layouts.index')

@section('content')
<div>
   <form class="profile-wrap" action="{{route('update', Auth::user()->id)}}" method="post">
      @csrf
      <label class="profile-wrap-el">{{Auth::user()->id}}</label>
      <label>Имя</label>
      <input class="profile-wrap-el" name="id" type="hidden" value="{{Auth::user()->id}}">
      <input class="profile-wrap-el" name="name" value="{{Auth::user()->name}}">
      <label>Фамилия</label>
      <input class="profile-wrap-el" name="surname" value="{{Auth::user()->surname}}">
      <label>Отчество</label>
      <input class="profile-wrap-el" name="patronymic" value="{{Auth::user()->patronymic}}">
      <label>Email</label>
      <input class="profile-wrap-el" name="email" value="{{Auth::user()->email}}">
      <label class="profile-wrap-el">телефон</label>
      <input class="profile-wrap-el" name="phone_user" value="{{Auth::user()->phone_user}}">
      <label for="">Изменить аватар</label>
      <input type="file" name="image">
      <button type="submit">Обновить</button>
   </form>
</div>
@endsection