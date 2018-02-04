<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>OwlAdmin - @yield('title')</title>

    <link rel="stylesheet" type="text/css" href="{{ themes('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ themes('css/metisMenu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ themes('css/sb-admin-2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ themes('css/font-awesome.min.css') }}">
    @yield('css')
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body>

        <div id="wrapper">

            {{-- MENU --}}
            
            @include('layouts.partials.dashboard.menu')
            
            {{-- ENDMENU --}}

            <div id="page-wrapper">

                <div class="container-fluid">
                    @include('flash::message')
                    <!-- Page Heading -->
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">
                                @yield('header')
                            </h1>
                        </div>
                    </div>
                    <!-- /.row -->
                    
                    <div class="row">
                        <div class="col-lg-12">
                            @yield('content')
                        </div>
                    </div>
                    <!-- /.row -->

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!-- JS -->
        <script src="{{ themes('js/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ themes('js/bootstrap.min.js') }}"></script>
        <script src="{{ themes('js/metisMenu.js') }}"></script>
        <script src="{{ themes('js/sb-admin-2.js') }}"></script>
        @yield('js')
        
        <script>
            $('#flash-overlay-modal').modal();
        </script>
    </body>

    </html>
