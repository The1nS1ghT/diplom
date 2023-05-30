@extends('layouts.auth')

@section('content')

<div class="card-body">
   <form method="POST" action="{{ route('register') }}">
      @csrf

      <div class="row mb-3">
         <label for="name" class="col-md-4 col-form-label text-md-end">Имя</label>

         <div class="col-md-6">
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

            @error('name')
            <span class="invalid-feedback" role="alert">
               <strong>{{ $message }}</strong>
            </span>
            @enderror
         </div>
      </div>

      <div class="row mb-3">
         <label for="surname" class="col-md-4 col-form-label text-md-end">Фамилия</label>

         <div class="col-md-6">
            <input id="surname" type="text" class="form-control @error('name') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required autocomplete="surname" autofocus>

            @error('surname')
            <span class="invalid-feedback" role="alert">
               <strong>{{ $message }}</strong>
            </span>
            @enderror
         </div>
      </div>

      <div class="row mb-3">
         <label for="patronymic" class="col-md-4 col-form-label text-md-end">Отчество</label>

         <div class="col-md-6">
            <input id="patronymic" class="form-control" type="text" name="patronymic" autofocus>
         </div>
      </div>

      <div class="row mb-3">
         <label for="phone_user" class="col-md-4 col-form-label text-md-end">Номер телефона</label>

         <div class="col-md-6">
            <input id="phone_user" class="form-control" type="text" name="phone_user" autofocus>
         </div>
      </div>

      <div class="row mb-3">
         <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>

         <div class="col-md-6">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

            @error('email')
            <span class="invalid-feedback" role="alert">
               <strong>{{ $message }}</strong>
            </span>
            @enderror
         </div>
      </div>

      <div class="row mb-3">
         <label for="password" class="col-md-4 col-form-label text-md-end">Пароль</label>

         <div class="col-md-6">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

            @error('password')
            <span class="invalid-feedback" role="alert">
               <strong>{{ $message }}</strong>
            </span>
            @enderror
         </div>
      </div>

      <div class="row mb-3">
         <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Повторите пароль</label>

         <div class="col-md-6">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
         </div>
      </div>

      <div class="row mb-3">
         <div class="col-md-6">
            <input id="type_user" class="col-md-4 col-form-label text-md-end" value="клиент" type="hidden" class="form-control" name="type_user" required autocomplete="type_user">
         </div>
      </div>
      <div class="row mb-3">
         <div class="col-md-6">
            <input id="blocked" class="col-md-4 col-form-label text-md-end" value="false" type="hidden" class="form-control" name="blocked" required autocomplete="blocked">
         </div>
      </div>

      <div class="row mb-0">
         <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
               Зарегистрироваться
            </button>
            @if (Route::has('register'))
            <a href="{{ route('login') }}">{{ __('Уже есть аккаунт? Войти') }}</a>
            @endif
         </div>
      </div>



   </form>
</div>

@endsection