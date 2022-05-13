<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,600">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="css/app.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
    </head>
    <?php
    if(session_status()==1){
      session_start();
    }

    $admin=false;
    $user=false;
    $master=false;

    if(isset($_SESSION["rol"])){
      if($_SESSION["rol"] == "admin" ){
        $admin=true;
        $user=true;
      }elseif($_SESSION["rol"] == "user"){
        $user=true;
      }elseif($_SESSION["rol"] == "master"){
        $master=true;
        $admin=true;
        $user=true;
      }
    }
    ?>

    <body>
    <header class="text-dark">

<!-- Image and text -->
<nav class="navbar navbar-light bg-light">
  <a class="navbar-brand" href="#">
    <img src="../img/book.png" width="80" height="50" class="d-inline-block align-top" alt="">
    BooksAffinity
  </a>

</nav>
    </header>

    <nav class="navbar border-0 mb-0 navbar-expand-lg navbar-light bg-dark rounded-0">
	<a href="#" class="navbar-brand text-white">Books<b>Affinity</b></a>
	<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
		<span class="navbar-toggler-icon"></span>
	</button>
	<!-- Collection of nav links, forms, and other content for toggling -->
	<div id="navbarCollapse" class="collapse navbar-collapse justify-content-start">
		<div class="navbar-nav">
			<a href="/" class="nav-item nav-link text-success">Home</a>
			<a href="/userPanel" class="nav-item nav-link text-success">Mi Perfil</a>
		<!--		<div class="nav-item dropdown">
			<a href="#" data-toggle="dropdown" class="nav-item nav-link text-success dropdown-toggle">Generos</a>
				<div class="dropdown-menu">
					<a href="#" class="dropdown-item">Terror</a>
					<a href="#" class="dropdown-item">Fantastico</a>
					<a href="#" class="dropdown-item">Drama</a>
					<a href="#" class="dropdown-item">Suspense</a>
				</div>
      </div> 
			<a href="#" class="nav-item nav-link text-success" hidden>Favoritos</a>
			<a href="#" class="nav-item nav-link text-success">Top 2022</a>
      <a href="#" class="nav-item nav-link text-success">Novedades</a> -->
			<a href="#" class="nav-item nav-link text-success">Contacto</a>
      
      <div>
      <form class="navbar-form form-inline search-form" method="GET" action="/home">
        <div class="input-group">
          <input type="text" class="form-control" name="search" placeholder="Search...">
          <span class="input-group-btn">
            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
          </span>
        </div>
      </form>
      </div>

    
			<div class="nav-item dropdown login-dropdown ">
				<a href="#" data-toggle="dropdown" class="nav-item nav-link text-success dropdown-toggle" aria-expanded="false"><i class="fa fa-user-o"></i>
        <?php
            if($user){
              if(isset($_SESSION["username"])){
                echo $_SESSION["username"];
              }
            }else{
              echo "Login";
            }
        ?>
        </a>
				<div class="dropdown-menu ">
            <form class="form-inline login-form" action="/home" method="post">
            @csrf

    <?php
    if($user){
      if(isset($_SESSION["username"])){
        echo '<button type="submit" style="width: 80%;" name="sessionclose" class=" align-items-center btn btn-primary m-1">Cerrar sessión</button>';
        }

    }else{
      echo' <div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">
									<span class="fa fa-user"></span>
								</span>
							</div>
                <input type="text" class="form-control" name="userName" placeholder="Username" required>
              </div>
              <div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">
									<i class="fa fa-lock"></i>
								</span>
							</div>
                <input type="password" class="form-control" name="userPass" placeholder="Password" required>
              </div>
                <button type="submit" name="sessionopen" class="btn btn-primary">Login</button>';
    }

    ?>
            </form>
          
         </div>
      </div>
      </div>
	</div>
  </div>
</nav>

    <div class="row">
    <div class="d-flex col-md-2 flex-column flex-shrink-0 p-3 text-success bg-dark" style="width: 280px;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-success text-decoration-none">
      <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
      <span class="fs-4">Sidebar</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="/" class="nav-link text-success" aria-current="page">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#home"></use></svg>
          Home
        </a>
      </li>
      <?php
      if($user){
        echo '<li>
        <a href="/userPanel" class="nav-link text-success">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"></use></svg>
          Mi Perfil
        </a>
      </li>'
      ;
      
      }
      ?>

      <li>
        <a href="/authors" class="nav-link text-success">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
          Autores
        </a>
      </li>
      <li>
        <a href="/countries" class="nav-link text-success">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
          Paises
        </a>
      </li>
      <li>
        <a href="/editorials" class="nav-link text-success">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
          Editorial
        </a>
      </li>


<?php

if ($admin){

    echo '<li>
            <a href="/bookmanage" class="nav-link text-success">
              <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
              Editar libro
            </a>
          </li>'.
          '<li>
            <a href="/authormanage" class="nav-link text-success">
              <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
              Editar Autor
            </a>
          </li>'.
          '<li>
            <a href="/editorialmanage" class="nav-link text-success">
              <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
              Editar Editorial
            </a>
          </li>'
          ;
}

?>
      <li>
        <a href="/genres" class="nav-link text-success">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"></use></svg>
          Categorías
        </a>
      </li>
      <li>
        <a href="/filteredlist" class="nav-link text-success">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"></use></svg>
          Listas con filtro
        </a>
      </li>

      <?php

if (!$user){
      echo '<li>
        <a href="/signup" class="nav-link text-success">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"></use></svg>
          Registro
        </a>
      </li>';
    }

    ?>
    </ul>
    <hr>

  </div>

  <div class="col-md-9 bg-opacity-75">


        @yield('content')
  </div>
</div>

    <div class="col-md-1 bg-opacity-75" style="background-color: #4e2942;">
    </div>


</div>

    </body>

    <div class="container">
  <footer class="py-3 my-4">
    <ul class="nav justify-content-center border-bottom pb-3 mb-3">
      <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Home</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Features</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Pricing</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">FAQs</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>
    </ul>
    <p class="text-center text-muted">© 2021 Company, Inc</p>
  </footer>
</div>

<?php
      if(isset($_SESSION["logued"])){
        echo $_SESSION["logued"];
        $_SESSION["logued"]="";
      }
?>


</html>
