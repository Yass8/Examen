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
        @yield('menu')
        <!-- /. NAV SIDE  -->
      
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