<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   @vite(['resources/sass/app.scss', 'resources/js/app.js','resources/css/admin.css'])
   <title>QuickTours (admin panel)</title>
</head>

<body>
   <header>
      <!DOCTYPE html>
      <html lang="en">

      <head>
         <meta charset="UTF-8">
         <meta http-equiv="X-UA-Compatible" content="IE=edge">
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
         @vite(['resources/css/app.css','resources/sass/app.scss','resources/js/app.js'])
         <title>QuickTours</title>
      </head>

      <body>
         <div id="app">
            <header class="header">
               <div class="header-wrapOne">
                  <a href="/" class="header-wrapOne-logo">QuickTours</a>
                  <div class="header-wrapOne-info">
                     <p class="header-wrapOne-info-el">example@gmail.com</p>
                     <p class="header-wrapOne-info-el">8-800-888-88-88</p>
                  </div>
                  <div class="header-wrapOne-search">
                     <input class="header-wrapOne-search-input" type="text">
                     <img src="resources/images/header-search.png">
                  </div>
                  @if (Route::has('login'))
                  <div class="header-wrapOne-authWrap">
                     @guest
                     <a class="header-btn" href="/login">войти</a>
                     <!-- <a class="header-btn" href="/register">Регистрация</a> -->
                     @else
                     <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->

                        <li class="nav-item dropdown">
                           <a id="navbarDropdown" class="header-btn" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                              {{ Auth::user()->name }}
                           </a>

                           <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                              @if (Auth::user()->type_user == 'администратор')
                              <a class="dropdown-item" href="{{ route('admin') }}">
                                 администратор
                              </a>
                              <a class="dropdown-item" href="{{ url('/home') }}">
                                 профиль
                              </a>
                              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                 выход
                              </a>
                              @elseif (Auth::user()->type_user == 'менеджер')
                              <a class="dropdown-item" href="{{ route('manager') }}">
                                 менеджер
                              </a>
                              <a class="dropdown-item" href="{{ url('/home') }}">
                                 профиль
                              </a>
                              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                 выход
                              </a>
                              @else
                              <a class="dropdown-item" href="{{ url('/home') }}">
                                 профиль
                              </a>
                              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                 выход
                              </a>
                              @endif


                              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                 @csrf
                              </form>
                           </div>
                        </li>

                     </ul>
                     @endguest
                  </div>
                  @endif
               </div>
               <div class="header-wrapTwo">
                  <div class="header-WrapTwo-btn">
                     <a class="header-btn" href="/countries">Страны</a>
                     <a class="header-btn" href="{{route('show.hotel')}}">Отели</a>
                     <a class="header-btn" href="/countries">Туры</a>
                  </div>
               </div>

            </header>
            <div class="admin-wrapper">
               <a class="admin-wrapper-btn" href="{{route('showForCreate.country')}}">Добавить страну</a>
               <a class="admin-wrapper-btn" href="{{route('showForCreate.city')}}">Добавить город</a>
               <a class="admin-wrapper-btn" href="{{route('showForCreate.airport')}}">Добавить аэропорт</a>
               <a class="admin-wrapper-btn" href="{{route('admin/users')}}">Список пользователей</a>
               <a class="admin-wrapper-btn" href="">Список заказов </a>
            </div>

         </div>
      </body>

      </html>
   </header>
   <main>
      @yield('content')
   </main>
</body>

</html>

<style scoped>
   .admin-wrapper {
      display: flex;
      justify-content: space-between;
      width: 1310px;
      height: 60px;
      margin: 0 auto;
   }

   .admin-wrapper-btn {
      font-size: 22px;
      color: black;
      text-decoration: none;
   }
</style>