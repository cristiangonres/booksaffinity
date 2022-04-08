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
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>
body {
	font-family: 'Open Sans', sans-serif;
}
.form-control {
	box-shadow: none;
	border-radius: 4px;
	border-color: #dfe3e8;
}
.navbar {
	background: #fff;
	padding-left: 16px;
	padding-right: 16px;
	border-bottom: 1px solid #dfe3e8;
	border-radius: 0;
}
.navbar .navbar-brand {
	font-size: 20px;
	padding-left: 0;
	padding-right: 50px;
}
.navbar .navbar-brand b {
	color: #29c68c;
}
.navbar a, .navbar a:active {
	color: #999;
	background: transparent;
}
.navbar .navbar-nav a:hover, .navbar .navbar-nav a:focus {
	color: #29c68c !important;
}
.navbar .navbar-nav > a.active, .navbar .navbar-nav.show > a {
	color: #26bb84 !important;
	background: transparent !important;
}
.navbar .form-inline .input-group-text {
	box-shadow: none;
	border-radius: 2px 0 0 2px;
	background: #f5f5f5;
	border-color: #dfe3e8;
	font-size: 16px;
}
.navbar .form-inline i {
	font-size: 16px;
}
.navbar .form-inline .btn {
	border-radius: 2px;
	color: #fff;
	border-color: #29c68c;
	background: #29c68c;
	outline: none;
}
.navbar .form-inline .btn:hover, .navbar .form-inline .btn:focus {
	border-color: #26bb84;
	background: #26bb84;
}
.navbar .search-form {
	display: inline-block;
}
.navbar .search-form .btn {
	margin-left: 4px;
}
.navbar .search-form .form-control {
	border-radius: 2px;
}
.navbar .login-form .input-group {
	margin-right: 4px;
	float: left;
}
.navbar .login-form .form-control {
	max-width: 158px;
	border-radius: 0 2px 2px 0;
}
.navbar .navbar-right .dropdown-toggle::after {
	display: none;
}
.navbar .dropdown-menu {
	font-size: 14px;
	border-radius: 1px;
	border-color: #e5e5e5;
	box-shadow: 0 2px 8px rgba(0,0,0,.05);
}
.navbar .dropdown-menu a {
	padding: 6px 20px;
}
.navbar .login-dropdown .dropdown-menu {
	width: 505px;
	padding: 20px;
	left: auto;
	right: 0;
}
.navbar .login-dropdown .dropdown-toggle::after {
	display: none;
}

/*Estilos de la vista categorias */
.list-group-item{
  background-color: #343a40!important;
}
.list-group-item a{
  text-decoration:none;
  color: #28a745;
}

.list-group-item:hover{
  text-decoration:none;
  color:green;
}

.list-group-item a:hover{
  text-decoration:none;
  color: grey;
}

@media (min-width: 1200px){
	.search-form .input-group {
		width: 300px;
		margin-left: 30px;
	}
}
@media (max-width: 768px){
	.navbar .dropdown-menu {
		width: 100%;
		background: transparent;
		padding: 10px 20px;
	}
	.navbar .input-group {
		width: 100%;
		margin-bottom: 15px;
	}
	.navbar .input-group .form-control {
		max-width: none;
	}
	.navbar .login-form .btn {
		width: 100%;
	}
}
</style>
</head>
    </head>

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

    <nav class="navbar border-0 navbar-expand-lg navbar-light bg-dark">
	<a href="#" class="navbar-brand text-white">Books<b>Affinity</b></a>
	<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
		<span class="navbar-toggler-icon"></span>
	</button>
	<!-- Collection of nav links, forms, and other content for toggling -->
	<div id="navbarCollapse" class="collapse navbar-collapse justify-content-start">
		<div class="navbar-nav">
			<a href="/" class="nav-item nav-link text-success">Home</a>
			<a href="#" class="nav-item nav-link text-success">Mi Perfil</a>
			<div class="nav-item dropdown">
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
      <a href="#" class="nav-item nav-link text-success">Novedades</a>
			<a href="#" class="nav-item nav-link text-success">Contacto</a>
        </div>
		<form class="navbar-form form-inline search-form">
			<div class="input-group">
				<input type="text" class="form-control" placeholder="Search...">
				<span class="input-group-btn">
					<button type="button" class="btn btn-default"><i class="fa fa-search"></i></button>
				</span>
			</div>
		</form>
		<div class="navbar-nav ml-auto">
			<div class="nav-item dropdown login-dropdown ">
				<a href="#" data-toggle="dropdown" class="nav-item nav-link text-success dropdown-toggle" aria-expanded="false"><i class="fa fa-user-o"></i> Login</a>
				<div class="dropdown-menu ">
                    <form class="form-inline login-form" action="/afterSignin" method="post">
                    @csrf
                        <div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">
									<span class="fa fa-user"></span>
								</span>
							</div>
                            <input type="text" class="form-control" name="userName" placeholder="Username" required="">
                        </div>
                        <div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">
									<i class="fa fa-lock"></i>
								</span>
							</div>
                            <input type="text" class="form-control" name="userPass" placeholder="Password" required="">
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
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
      <li>
        <a href="/authors" class="nav-link text-success">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
          Autores
        </a>
      </li>
      <li>
        <a href="/books" class="nav-link text-success">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
          Libros
        </a>
      </li>
      <li>
        <a href="/book" class="nav-link text-success">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
          Detalle libro
        </a>
      </li>
      <li>
        <a href="/bookmanage" class="nav-link text-success">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
          Editar libro
        </a>
      </li>

      <li>
        <a href="/authormanage" class="nav-link text-success">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
          Editar Autor
        </a>
      </li>
      <li>
        <a href="/editorial" class="nav-link text-success">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#grid"></use></svg>
          Detalle Editorial
        </a>
      </li>
      <li>
        <a href="/editorialmanage" class="nav-link text-success">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
          Editar Editorial
        </a>
      </li>
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
      <li>
        <a href="/moderatexx" class="nav-link text-success">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"></use></svg>
          Moderar
        </a>
      </li>
      <li>
        <a href="/signup" class="nav-link text-success">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"></use></svg>
          Registro
        </a>
      </li>
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


</html>
