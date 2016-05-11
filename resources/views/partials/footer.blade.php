<div class="navbar navbar-fixed-bottom" id="footer">
  
  <div class="container">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="{{ url('/login') }}">Login</a></li>
        <li><a href="{{ url('/register') }}">Register</a></li>        
      </ul>
  </div>

</div>
</nav>

<style type="text/css">

    #footer {
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

    .navbar li {
        margin: 0 2px;
    }

    .navbar-nav li a {
        /*border-top: 1px solid transparent;*/
    }

</style>