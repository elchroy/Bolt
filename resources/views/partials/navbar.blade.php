<div class="navbar navbar-fixed-top fadeInDown wow animated" id="navigation">
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
                    <li><a href="{{ url('/videos') }}">All Videos</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <span class="hidden-xs"></span>
                            <img src="{{ Auth::user()->getAvatar() }}" width="20" class="img-rounded" id="user-avatar">
                            <span class="hidden-sm">{{ Auth::user()->name }}</span> <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li class="menu-item"><a href="{{ url('/dashboard') }}"><i class="fa fa-home"></i> Home</a></li>
                            <li class="menu-item"><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                        </ul>
                    </li>
                @endif
      </ul>
             
             <form method="GET" action="{{ url('videos/search') }}" class="navbar-form search-form pull-right">
                <!-- <div class="form-group" style="display:inline;"> -->
                  <!-- <div class="input-group" style="display:table;"> -->
                    <!-- <span class="input-group-addon" style="width:50%;background: transparent; border: none;"> -->
                        <input class="form-control input-group-addon" id="search-videos" name="search" placeholder="Search for videos" autocomplete="off" autofocus="autofocus" type="text">
                        <i class="fa fa-search"></i>
                    <!-- </span> -->
                  <!-- </div> -->
                <!-- </div> -->
              </form>


    </div><!--/.nav-collapse -->
  </div>
</div>
</nav>

<style type="text/css">

    #navigation {
      background: #FFFFFF;
      border: 0 none;
      margin: 0;
      border-bottom: rgba(255, 255, 255, 0.1) solid 3px;
      
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
        color: #1EA78D;
        font-size: 40px;
        font-family: monospace;
    }

    .navbar-brand:hover {
        color: #172E35;
    }

    .navbar li {
        margin: 0 2px;
        background: transparent;
    }

    ul {
        padding: 0px;
        margin: 0px;
    }

    .navbar-nav li a,
    .navbar-nav li .dropdown a {
        color: #fff;
        font-size: 100%;
        margin-top: 15px;
        display: block;
        background: rgb(30, 167, 141);
        border-radius: 3px;
        padding-top: 10px; 
        padding-bottom: 5px; 
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
        background: rgb(9, 76, 63);
        color: #fff;
    }

    .dropdown-menu {
        padding: 0;
    }

    #user-avatar {
        /*position: relative;*/
        /*float: left;*/
        /*max-width: 30px;*/
        display: inline;
        /*left: 0;*/
        height: auto;
    }

    .dropdown-menu li a{
        background: #fff;
        margin: 5px 0;
        color: #1EA78D;
        /*padding: 0px;*/
        display: block;
        border-radius: 0px;
        widows: 100%;
    }

    ul.dropdown-menu {
        background: rgba(255, 255, 255, 0);
    }

    .dropdown-menu li a:hover,
    .dropdown-menu li a:focus {
        /*background-color: rgba(24, 68, 53, 0.62)*/
        background: rgb(9, 76, 63);
    }

    #search-videos {
        width: 100%;
        padding: 0 10%;
        /*line-height: 30px;*/
        background: transparent;
        border: none;
        border-bottom: solid #1EA78D 3px;
        /*border-radius: 0px;*/
        color: #172E35;
        font-weight: bold;
        font-family: monospace;
    }

    .navbar-toggle {
        padding: 0px;
        margin-right: inherit;
        color: #1EA78D;
    }

</style>