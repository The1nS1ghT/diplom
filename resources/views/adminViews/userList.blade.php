@extends('layouts.admin')

@section('content')

<input type="text" placeholder="поиск">


<div class="users-wrap">
   @foreach ($users as $user)
   <p> id: {{$user->id}}</p>
   <p class="users-wrap-el">Имя: {{$user->name}}</p>
   <p class="users-wrap-el">Фамилия: {{$user->surname}}</p>
   <p class="users-wrap-el">Отчество: {{$user->patronymic}}</p>
   <p class="users-wrap-el">Email: {{$user->email}}</p>
   <p class="users-wrap-el">Номер: {{$user->phone_user}}</p>
   <p class="users-wrap-el">Тип пользователя: {{$user->type_user}}</p>
   <a class="users-wrap-btn" href="{{route('userDetails', $user->id)}}">Подробнее</a>
   @endforeach
</div>

@endsection

<style>
   .users-wrap {
      display: flex;
      width: 700px;
      flex-direction: column;
      background-color: aliceblue;
      margin-left: 300px;
   }

   .users-wrap-el {
      width: 200px;
   }

   .users-wrap-btn {
      width: 200px;
      background-color: red;
      color: white;
      font-size: 16px;
   }
</style>