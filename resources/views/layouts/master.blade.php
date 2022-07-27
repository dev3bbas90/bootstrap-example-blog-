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
   <script src="{{asset('js/jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/bootstrap.min.js')}}" type="text/javascript"></script>
   <link href="{{asset('css/mystyle.css')}}" rel="stylesheet" type="text/css"/>
    <script src="{{asset('js/myscript.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/fa_script.js')}}" type="text/javascript"></script>

    <title>
    @yield('title')</title>
</head>

<body onpageshow="pgshow()">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" id="header" >
        <div class="container" 
         @if (!Auth::check()) 
        style="height: 55px;"
        @endif
        >
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="navbar-brand" href="{{ url('/') }}">
                    @yield('logoimg')
                    <img src="../upload/car1.jpg" id="logo_img" style="@yield('hide_logoimg')" alt="Blog Home">
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li>
                    <a href="{{ url('/about') }}" @yield('about_link') >About</a>
                    </li> 
                     <li><a href="/statistics" @yield('stat_link')>Statistics</a></li>

                    
                     @if (Auth::check()) 
                       <li>
                        <a href="{{ url('/posts') }}" @yield('posts_link')>Posts</a>
                        </li>
                      @if (3>Auth::user()->role) 
                      <li><a href="{{ url('/control') }}" @yield('control_link')>Control</a></li>
                      @endif
                    @endif
                   
                </ul>
                 <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::guest())
                        <li><a href="/login" @yield('login_link')>Login</a></li>
                        <li><a href="/register" @yield('register_link')>Register</a></li>
                    @else
                        <li>
                        	 <div class="dropdown">
                             <button onclick="myFunction()" class="dropbtn">
                                 {{ Auth::user()->name }} &nbsp; <span class="caret"></span> 
                             </button>
                            <ul class="dropdown-content" id="myDropdown" role="menu">
                             <li><a href="/profile/{{Auth::user()->id}}">
                                <i class="fas fa-user-alt">  </i>&nbsp;&nbsp; My Profile</a></li> 
                                <li><a href="{{ url('/logout') }}">
                                    <i class="fas fa-sign-out-alt"></i>&nbsp;&nbsp; Logout</a></li>
                                
                                <li><a href="{{ url('/switch_user') }}">
                                    &nbsp;&nbsp; Switch User</a></li>
                            </ul>
                            </div>

                          
                        </li>
                        @if(strlen( Auth::user()->name )<8)
                        <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
                        @endif
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
            <div class="col-md-4" @yield('hide_sidebar') >

                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <div class="input-group col-lg-11">
                     <form method="post" action="/category/search_category" >
                            {{ csrf_field() }}
                        <input type="text" id="search_cat" name="name" class="form-control" style=" width:80%; float: left;" placeholder="search By Category name" >
                        <span class="input-group-btn">
                             <button class="btn btn-default" type="submit" >
                                <span class="glyphicon glyphicon-search"></span>
                             </button>
                        </span>
                    </form>

                    </div>
                    <!-- /.input-group -->
                </div>

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-6">

                            <ul class="list-unstyled cat_list">
                            @if(isset($categories))
                             @foreach($categories as $cat)
                              <li><a href="../category/{{$cat->name}}">{{$cat->name}} Category</a></li>
                              @endforeach
                            @else
                            <li><a href="../category/network">Network Category</a></li>
                            <li><a href="../category/web">Web Category</a></li>
                            <li><a href="../category/Mobile">Mobile Category</a></li>
                            <li><a href="#">New Category </a></li>
                            @endif
                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->
                            
                        <!-- /.col-lg-6 -->
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <div class="well">
                    <h4 class="title">About our Project <a href="/" style="font-weight: bold; color: darkblue;"> Blog </a> :</h4>
                         <b> 
                          <strong>Blog</strong> web Application Provides You 
                          Share Your researches , articles or any thing related
                          with your Field . 
                          It also save your data privacy as no one 
                          can see or edit your information but you.

                            </b>
                </div>

            
            </div>
        </div>
        
    </div>
  
        <hr>
@yield('footer_id1')
        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2019</p>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </footer>
@yield('footer_id2')



        <script src="{{url('js/jquery2.js')}}" type="text/javascript"></script>
         <script type="text/javascript" src="{{url('/js/likes.js')}}"></script>
         <script type="text/javascript">
             var url="{{route('like')}}";
             var url2="{{route('dislike')}}";
             var token="{{Session::token()}}";


         </script>



</body>

</html>
