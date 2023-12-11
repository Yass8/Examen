<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('titre')</title> 
	<!-- Bootstrap Styles-->
    <link href="{{asset('bootstrap-5.0.2-dist/css/bootstrap.css')}}" rel="stylesheet" />
    
</head>

<body>
    <div id="wrapper">
        {{-- @include('examen.includes.menu') --}}
        {{-- @yield('menu') --}}
        <!-- /. NAV SIDE  -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-info">
            <div class="container-fluid">
                <a class="navbar-brand text-danger" href="#" style="font-family: montserrat">Examen</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{route('dashboard')}}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link active" href="{{route('examens.index')}}">Examens</a>
                    </li>
                    {{-- <li class="nav-item">
                    <a class="nav-link" href="{{route('classes.index')}}">Classes</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="{{route('matieres.index')}}">Matières</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="{{route('candidats.index')}}">Candidats</a>
                    </li> --}}
                    <li class="nav-item">
                    <a class="nav-link" href="{{route('parametre')}}">Paramètres</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <input class="form-control me-2" type="texy" value="" disabled>
                    <a class="btn btn-outline-success" href="">Deconnexion</a>
                </div>
                </div>
            </div>
        </nav>
      
		<div id="page-wrapper">
		  {{-- @yield('menu-header') --}}
            <div id="page-inner">

			@yield('content')
		
				<footer style="margin-top: 10px" class="card-footer text-center navbar-dark bg-info">
                    <p>All right reserved. Template by: <a href="https://webthemez.com/admin-template/">WebThemez.com</a></p>
				       
				</footer>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="{{asset('jQuery/jquery.min.js')}}"></script>
	
	<!-- Bootstrap Js -->
    <script src="{{asset('bootstrap-5.0.2-dist/js/bootstrap.min.js')}}"></script>
	
	@yield('scriptJs')
 

</body>

</html>