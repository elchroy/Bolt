<div class="navbar navbar-fixed-top" id="navigation">
  <div class="container">
    <div class="navbar-header">

      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

      <a class="navbar-brand" href="{{ url('/') }}">
      Bolt
      </a>
    </div>

    <div class="navbar-collapse collapse" id="searchbar">
     
      <ul class="nav navbar-nav navbar-right">
        <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>
                @else
                    <li><button href="" class="bolt-button add-video-button">Upload</button></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li class="menu-item"><a href="{{ url('/dashboard') }}"><i class="fa fa-home"></i> Home</a></li>
                            <li class="menu-item"><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                        </ul>
                    </li>
                @endif
      </ul>
             
             <form class="navbar-form search-form">
                <div class="form-group" style="display:inline;">
                  <div class="input-group" style="display:table;">
                    <span class="input-group-addon" style="width:1%;background: transparent; border: none;">
                        <input class="form-control input-group-addon" id="search-videos" name="search" placeholder="Search Here" autocomplete="off" autofocus="autofocus" type="text">
                    </span>
                  </div>
                </div>
              </form>


    </div><!--/.nav-collapse -->
  </div>
</div>
</nav>

<style type="text/css">

    #navigation {
      background: transparent;
      background: rgb(23, 46, 53);
      border: 0 none;
      margin: 0;
      
        -webkit-transition: background-color 800ms linear;
           -moz-transition: background-color 800ms linear;
            -ms-transition: background-color 800ms linear;
             -o-transition: background-color 800ms linear;
                transition: background-color 800ms linear;
    }

    .navbar-toggle i {
        color: #fff;
    }

    .navbar-brand {
      /*padding: 0;*/
    }

    .navbar li {
        margin: 0 2px;
    }

    .navbar-nav li a {
        border-top: 1px solid transparent;
    }

    .bolt-button {
        border-top: 1px solid rgba(144, 22, 22, 0);
        background: rgb(143, 10, 10);
        line-height: 40px;
        margin-top: 8px;
        padding: 0 10px;
        color: #fff;
        font-size: 110%;
        border: none;
    }
    
    .navbar-nav li.open a:focus,
    .navbar-nav li a.current,
    .navbar-nav li a:focus,
    .navbar-nav li a:hover {
        /*background-color: rgb(17, 78, 21);*/
        background: rgb(143, 10, 10);
        border-top: 1px solid #32B0EE;
        color: #fff;
    }

    .dropdown-menu {
        padding: 0;
    }

    .dropdown-menu li a{
        line-height: 40px;
    }

    .dropdown-menu li a:hover,
    .dropdown-menu li a:focus {
        /*background-color: rgba(24, 68, 53, 0.62)*/
        background: rgb(143, 10, 10);
    }

    #search-videos {
        width: 100%;
        padding: 0 10%;
        line-height: 30px;
        background: transparent;
        border: none;
        border-bottom: solid #CCC 3px;
        border-radius: 0px;
    }

</style>