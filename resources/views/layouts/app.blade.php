<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        Bolt {{ isset($title) ? '| ' . $title : '' }}
    </title>

    <link rel="icon" type="image/png" href="{{ asset('img/bolt-icon.png') }}">

    <!-- Fonts -->
    <!-- <link rel="stylesheet" href="{{ asset('bootstrap/css/font-awesome.min.css') }}"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <!-- <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.rawgit.com/konpa/devicon/master/devicon.min.css">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    <!-- Fontawesome Icon font -->
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <!-- jquery.fancybox  -->
    <link rel="stylesheet" href="{{ asset('css/jquery.fancybox.css') }}">
    <!-- animate -->
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bolt.css') }}">
    
    <!-- STYLES FOR SOCIAL AUTHENTICATION -->
    <link href="{{ asset('css/bootstrap-social.css') }}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/video-item.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bolt-form.css') }}">

    @yield('styles')

    <style>
        body {
            font-family: "Roboto", sans-serif;
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="bolt-body">

    @include('partials.navbar')

    @yield('landing')

    <div class="bolt-welcome">
        @yield('welcome')
    </div>

    @if(Session::has('success'))
        <div class="bolt-presenter bounceInDown animated ">
            {{ Session::get('success') }}
        </div>
    @endif

    @if(Session::has('error'))
        <div class="bolt-presenter bounceInDown animated ">
            {{ Session::get('error') }}
        </div>
    @endif
    
    </div>
    
    <div class="bolt-section">
        @yield('content')
    </div>

    @include('partials.footer')
   
    <a href="#bolt-body" href="javascript:void(0);" id="back-top"><i class="fa fa-angle-up fa-3x"></i></a>

    <!-- JavaScripts -->
    <!-- <script src="{{ asset('bootstrap/js/jquery-1.12.3.min.js') }}"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <!-- <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}

    <script type="text/javascript" src="{{ asset('js/cage.js') }}"></script>
    @yield('scripts')
    <script type="text/javascript">

        $(window).load(function(){
            $("#processor").fadeOut('slide');
        });

    </script>
</body>
</html>
