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
               <a class="header-btn" href="{{route('show.tour')}}">Туры</a>
            </div>
         </div>
      </header>

      <main>
         <form method="post" action="{{route('search.tour')}}">
            @csrf
            <div class="search-wrap">
               <div>
                  <label>Откуда</label>
                  <input name="place_departure" type="text" placeholder="Москва" value="Москва">
               </div>
               <div>
                  <label>Куда</label>
                  <input id="place_arrival" name="place_arrival" value="{{ old('place_arrival') }}" required>
               </div>
               <div>
                  <label>Туда</label>
                  <input name="date_departure_ticket" type="date" value="{{ old('date_departure_ticket') }}" required>
               </div>
               <div>
                  <label>Обратно</label>
                  <input name="date_arrival_ticket" type="date" value="{{ old('date_arrival_ticket' )}}" required>
               </div>
               <div>
                  <label>Туристы</label>
                  <input name="quantity_tourists" type="number">
               </div>
               <button type="submit">Поиск</button>
            </div>
         </form>
         @yield('content')
      </main>
   </div>
</body>

<style scoped>
   .search-wrap {
      display: flex;
      width: 1100px;
      background-color: aliceblue;
      margin: 0 auto;
      height: 40px;
   }

   input {
      height: 40px;
      font-size: 20px;
      border-bottom: 1px solid black;
      text-decoration: none;
      outline: none;
      margin-right: 2px;
   }
</style>

<script>
   function showHide(element_id) {
      //Если элемент с id-шником element_id существует
      if (document.getElementById(element_id)) {
         //Записываем ссылку на элемент в переменную obj
         var obj = document.getElementById(element_id);
         //Если css-свойство display не block, то: 
         if (obj.style.display != "block") {
            obj.style.display = "block"; //Показываем элемент
         } else obj.style.display = "none"; //Скрываем элемент
      }
      //Если элемент с id-шником element_id не найден, то выводим сообщение
      else alert("Элемент с id: " + element_id + " не найден!");
   }

   const order = document.getElementsByClassName('');
   /*хватаем элемент order_item*/
   const order_item = document.getElementsByClassName('order_item');

   /* и тут прокручиваем в цикле order*/
   for (let i = 0; i < order.length; i++) {
      // и тут событие срабатывает  которое добавляет и удаляет класс
      order[i].addEventListener('click', function() {
         order_item[i].classList.toggle('active');
      })
   }
</script>

</html>