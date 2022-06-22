<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel</title>

    <!-- <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/@mdi/font@6.x/css/materialdesignicons.min.css" rel="stylesheet">
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous"> -->

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.2.0/mdb.min.css" rel="stylesheet" />

      <!-- Custom styles -->
  <link rel="stylesheet" href="css/admin.css" />
  <link rel="stylesheet" href="css/autocomplete.css">
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw=="
    crossorigin="anonymous"></script> -->
 
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script> -->
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.2.0/mdb.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
</head>

<body>
    
  

</body>
  <!--Main Navigation-->
  <header>
    <!-- Sidebar -->
    <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white" style="max-width:200px">
      <div class="position-sticky">
        @auth
        @if (Auth::user()->is_admin)
        <div class="list-group list-group-flush mx-3 mt-4">
          <a href="/category" class="list-group-item list-group-item-action py-2 ripple
          {{ Route::currentRouteNamed('web.category.index') ? 'active' : '' }}
          " aria-current="true">
            <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Category</span>
          </a>
          <a href="/equipment" class="list-group-item list-group-item-action py-2 ripple
          {{ Route::currentRouteNamed('web.equipment.index') ? 'active' : '' }}
          ">
            <i class="fas fa-chart-area fa-fw me-3"></i><span>Equipment</span>
          </a>
          <a href="/user" class="list-group-item list-group-item-action py-2 ripple
          {{ Route::currentRouteNamed('web.user.index') ? 'active' : '' }}
          "><i
              class="fas fa-users fa-fw me-3"></i><span>User</span></a>
        </div>
        @endif
        @endauth
      </div>
    </nav>
    <!-- Sidebar -->

    <!-- Navbar -->
    <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
      <!-- Container wrapper -->
      <div class="container-fluid">
        <!-- Toggle button -->
        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#sidebarMenu"
          aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fas fa-bars"></i>
        </button>

        <!-- Brand -->
        <a class="navbar-brand" href="/">
          <img src="https://picsum.photos/id/238/300/300" height="30" alt="" loading="lazy" />
          <h3 class="mt-1 ms-1">Web App</h3>
        </a>
      

      
        <ul class="navbar-nav ms-auto d-flex flex-row">
          <li class="nav-item dropdown">
          </li>
          @auth
  
          <!-- Avatar -->
          <h6 class="mt-2">{{Auth::user()->name}}</h4>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center" href="#"
              id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
              <img src="https://mdbootstrap.com/img/Photos/Avatars/img (31).jpg" class="rounded-circle" height="22"
                alt="" loading="lazy" />
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
              <li><a class="dropdown-item" href="#">My profile</a></li>
              <li><a class="dropdown-item" href="#">Settings</a></li>
              <li><a class="dropdown-item" href="/logout">Logout</a></li>
            </ul>
          </li>
          @endauth

          @guest
          <li class="d-flex">
            <button class="btn btn-outline-primary me-1">
              <a href="/index">Login</a>
            </button> 
            <button class="btn btn-outline-primary">
              <a href="/register">Register</a>
            </button> 
          </li>
          @endguest

        </ul>
      </div>
      <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
  </header>
  <!--Main Navigation-->

     <!--Main layout-->
  <main style="margin-top: 58px; padding-left: 200px" >
    <div class="container-fluid pt-1 ma-0 p-0">
      @yield('content')
    </div>
  </main>
  <script language="javascript">  
      let items = document.querySelectorAll("#sidebarMenu a");
      // items.addEventListener("click", {

      // })  
      // console.log(items)
  </script>
  <!--Main layout-->
</html>