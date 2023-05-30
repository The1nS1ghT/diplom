@extends('layouts.admin')

@section('content')
<div class="users-wrap">
   <p class="users-wrap-el">ID: {{$data->id}}</p>
   <p class="users-wrap-el">Имя: {{$data->name}}</p>
   <p class="users-wrap-el">Фамилия: {{$data->surname}}</p>
   <p class="users-wrap-el">Отчество: {{$data->patronymic}}</p>
   <p class="users-wrap-el">Почта: {{$data->email}}</p>
   <p class="users-wrap-el">Телефон: {{$data->phone_user}}</p>
   <p class="users-wrap-el">Тип пользователя: {{$data->type_user}}</p>
   <p class="users-wrap-el">Дата регистрации: {{$data->created_at}}</p>
   <p class="users-wrap-el">Пол: {{$data->gender_user}}</p>
   <p class="users-wrap-el">Дата Рождения: {{$data->birthday_user}}</p>
   <p class="users-wrap-el">{{$data->photo_user}}</p>
   <p class="users-wrap-el">{{$data->passport_name}}</p>
   <p class="users-wrap-el">{{$data->passport_surname}}</p>
   <p class="users-wrap-el">{{$data->passport_number_user}}</p>
   <p class="users-wrap-el">{{$data->passport_date_issue_user}}</p>
   <p class="users-wrap-el">{{$data->passport_date_departure_user}}</p>
   <div>
      <a class="users-wrap-btn" href="/admin/users">назад</a>
      @if ($data->type_user == 'клиент')
      <a class="users-wrap-btn" href="{{route('create.manager', $data->id)}}">добавить менеджера</a>
      @else ($data->type_user == 'менеджер')
      <a class="users-wrap-btn" href="{{route('delete.manager', $data->id)}}">удалить менеджера</a>
      @endif
   </div>
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
      font-size: 16px;
   }

   .users-wrap-btn {
      width: 200px;
      background-color: red;
      color: white;
      font-size: 16px;
   }
</style>