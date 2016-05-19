<div class="navbar navbar-fixed-top" id="navigation">
    <div class="container">

        <div class="navbar-header" id="bolt-brand">

          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>

          <a class="navbar-brand" href="{{ url('/') }}">Bolt</a>

        </div>

        <div class="navbar-collapse collapse bolt-nav-menu">
         
          <ul class="nav navbar-nav navbar-right">
                        <li>
                            <form method="GET" action="{{ url('videos/search') }}" id="search-form">
                                <div>
                                    <!-- <i class="fa fa-search pull-left"></i> -->
                                    <input class="" id="search-videos" name="search" placeholder="Search..." autocomplete="off" autofocus="autofocus" type="search">
                                </div>
                            </form>
                        </li>
            <!-- Authentication Links -->
                        <li><a href="{{ url('/videos') }}">All Videos</a></li>
                        
                    @if (Auth::user())
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <span class="hidden-sm">{{ Auth::user()->name }}</span>
                                <!-- <img class="hidden-xs" src="{{ Auth::user()->getAvatar() }}" id="navbar-avatar"> -->
                                <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li class="menu-item"><a href="{{ url('/dashboard') }}"><i class="fa fa-home"></i> Home</a></li>
                                <li class="menu-item"><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
          </ul>
        </div>
        
  
    </div>
</div>


<style type="text/css">

    #navigation {
        background: #312c32;
        font-size: 120%;
    }

    .navbar a{
        /*display: block;*/
        color: #daad86;
    }

    .navbar-nav li a:hover,
    .navbar-nav li a:focus {
        color: #312c32;
        background-color: #daad86;
    }

    .navbar-nav li a{
        line-height: inherit;
    }

    .navbar-nav li#search-list-item {
        margin: 0 100px;
    }

    #search-videos {
        background: transparent;
        display: inline;
        margin: 0;
        line-height: 45px;
        border: none;
        position: relative;
        color: #312c32;
    }

    #search-videos:focus {
        background: #daad86;
        padding: 0 10px;
    }

    #search-form div i {
        padding: 14px 0px;
        position: absolute;
    }

    #search-form {
        width: 100%;
        padding: 0px;
        margin: 0px;
    }

    #search-form div {
        border: none;
    }
    #dropdown-toggle-image {
        padding: 0;
        margin: 0;
        border: solid;
        display: inline-block;
    }
    #dropdown-toggle-image img {
        padding: 0;
        margin: 0;
        display: inline-block;
    }

    #navbar-avatar {
        height: 3.1em;
        width: auto;
    }

    .open a{
        color: #312c32 !important;
        /*background-color: #daad86 !important;*/
    }



    /*#navigation {
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
    }*/

    /*#user-avatar {
       display: inline;
        height: auto;
    }

    .dropdown-menu li a{
        background: #fff;
        margin: 5px 0;
        color: #1EA78D;
        display: block;
        border-radius: 0px;
        widows: 100%;
    }

    ul.dropdown-menu {
        background: rgba(255, 255, 255, 0);
    }

    .dropdown-menu li a:hover,
    .dropdown-menu li a:focus {
        background: rgb(9, 76, 63);
    }

    #search-videos {
        width: 100%;
        padding: 0 10%;
        background: transparent;
        border: none;
        border-bottom: solid #1EA78D 3px;
        color: #172E35;
        font-weight: bold;
        font-family: monospace;
    }

    .navbar-toggle {
        padding: 0px;
        margin-right: inherit;
        color: #1EA78D;
    }*/

</style>