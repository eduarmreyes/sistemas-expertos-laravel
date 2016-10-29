<!DOCTYPE html>
<!--
Landing page based on Pratt: http://blacktie.co/demo/pratt/
-->
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Adminlte-laravel - {{ trans('adminlte_lang::message.landingdescription') }} ">
        <meta name="author" content="Sergi Tur Badenas - acacha.org">

        <meta property="og:title" content="Adminlte-laravel" />
        <meta property="og:type" content="website" />
        <meta property="og:description" content="Adminlte-laravel - {{ trans('adminlte_lang::message.landingdescription') }}" />
        <meta property="og:url" content="http://demo.adminlte.acacha.org/" />
        <meta property="og:image" content="http://demo.adminlte.acacha.org/img/AcachaAdminLTE.png" />
        <meta property="og:image" content="http://demo.adminlte.acacha.org/img/AcachaAdminLTE600x600.png" />
        <meta property="og:image" content="http://demo.adminlte.acacha.org/img/AcachaAdminLTE600x314.png" />
        <meta property="og:sitename" content="demo.adminlte.acacha.org" />
        <meta property="og:url" content="http://demo.adminlte.acacha.org" />

        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:site" content="@acachawiki" />
        <meta name="twitter:creator" content="@acacha1" />

        <title>{{ trans('adminlte_lang::message.landingdescriptionpratt') }}</title>

        <!-- Bootstrap core CSS -->
        <link href="{{ asset('/css/bootstrap.css') }}" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="{{ asset('/css/main.css') }}" rel="stylesheet">

        <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Raleway:400,300,700' rel='stylesheet' type='text/css'>

        <script src="{{ asset('/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
        <script src="{{ asset('/js/smoothscroll.js') }}"></script>


    </head>

    <body data-spy="scroll" data-offset="0" data-target="#navigation">

    <!-- Fixed navbar -->
    <div id="navigation" class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><b>UEES - Sistemas Expertos</b></a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">{{ trans('adminlte_lang::message.login') }}</a></li>
                        <li><a href="{{ url('/register') }}">{{ trans('adminlte_lang::message.register') }}</a></li>
                    @else
                        <li><a href="/home">{{ Auth::user()->name }}</a></li>
                    @endif
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </div>

    <div id="showcase">
        <div class="container">
            <div class="row">
                <h1 class="centered">{{ trans('adminlte_lang::message.screenshots') }}</h1>
                <br>
                <div class="col-lg-8 col-lg-offset-2">
                    <div id="carousel-example-generic" class="carousel slide">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            <div class="item active">
                                <img src="{{ asset('/img/item-01.png') }}" alt="">
                            </div>
                            <div class="item">
                                <img src="{{ asset('/img/item-02.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <br>
            <br>
        </div><!-- /container -->
    </div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="{{ asset('/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script>
        $('.carousel').carousel({
            interval: 3500
        })
    </script>
    </body>
</html>
