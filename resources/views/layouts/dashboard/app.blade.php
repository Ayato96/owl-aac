<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>OwlAdmin - @yield('title')</title>

    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/owl.css') }}">
    <link href="//cdnjs.cloudflare.com/ajax/libs/summernote/0.7.0/summernote.css" rel="stylesheet">
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
            
            @include('layouts.dashboard.menu')
            
            {{-- ENDMENU --}}

            <div id="page-wrapper">

                <div class="container-fluid">

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
        <script src="{{ URL::asset('assets/js/owl.js') }}"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/summernote/0.7.0/summernote.js"></script>
        <script>
            jQuery(document).ready(function() {
                jQuery('#content').summernote({
                    height: 250,
                });
            });

            $(document).ready(function(){
                $('#newsDataTable').DataTable();
            });
        </script>
    </body>

    </html>
