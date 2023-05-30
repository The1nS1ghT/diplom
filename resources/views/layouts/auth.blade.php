<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <title>QuickTours</title>
   @vite(['resources/sass/app.scss', 'resources/js/app.js','resources/css/app.css'])
</head>

<body>
   <header>
      <div class="asd">
         <a href="{{url('/')}}">QuickTours</a>






      </div>
   </header>
   <main>
      @yield('content')
   </main>
</body>

</html>