 <!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

     <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('css/blog-home.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('css/mystyle.css')}}" rel="stylesheet" type="text/css"/>
   <script src="{{asset('js/jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/myscript.js')}}" type="text/javascript"></script>
     <link href="{{asset('css/mystyle.css')}}" rel="stylesheet" type="text/css"/>
    <script src="{{asset('js/myscript.js')}}" type="text/javascript"></script>
 <title>Blog Home </title>
</head>

<body onpageshow='test()'>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation"  id="header">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                  
                <a class="navbar-brand" href="{{ url('/') }}">Blog</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li>
                        <a href="{{ url('/posts') }}">Posts</a>
                    </li>
                     @if (Auth::check()) 
                    <li><a href="{{ url('/profile') }}">Profile</a></li>
                      @if (3>Auth::user()->role) 
                      <li><a href="{{ url('/control') }}">Control</a></li>
                      @endif
                    @endif
                </ul>
                 <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li>
                            <div class="dropdown">
                             <button onclick="myFunction()" class="dropbtn">
                                 {{ Auth::user()->name }} &nbsp; <span class="caret"></span> 
                             </button>
                            <ul class="dropdown-content" id="myDropdown" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out">  </i>Logout</a></li>
                            </ul>
                            </div>

                        </li>

                    @endif
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">
        <!-- Blog Entries Column -->
            <div class="col-md-8">
                @yield('content')
            </div>
     <!-- Blog Sidebar Widgets Column -->
    </div>
     
      <hr>
  <!-- Footer -->
  @yield('footer_id1')
       <footer >
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2020</p>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </footer>
        @yield('footer_id2')
</body>

</html>
