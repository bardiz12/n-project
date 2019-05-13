<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('asset/style/style.css')}}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">        
        <!--<link rel="manifest" href="/manifest.json">-->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> @yield('title') </title>
</head>

<body>
    <div class="wrapper">
        <section id="header">
            <div class="wrap">
                <div class="row">
                    <div class="col-md-3">
                        <div class="logo">
                            <a href="/">
                                <h1><i class="fa fa-poll"></i> N-Project</h1>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <nav>
                            <ul>
                                <li>
                                    <a href="#"><i class="fa fa-poll-h "></i> Survey </a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-map "></i> Maps</a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-tachometer-alt "></i>  Dashboard</a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-cog "></i> Manage</a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-exclamation-circle "></i>  Issue</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-md-3">
                        <nav style="text-align:right;">
                            <ul>
                                <li>
                                    <a href="/register"><i class="fa fa-user-plus"></i> Register </a>
                                </li>
                                <li>
                                    <a href="/login"><i class="fa fa-user-lock "></i> Login </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <div id="contents">

         @yield('content')        
        </div>
    </div>
    <footer>
        <div class="wrap">
            <h4>Copyright &copy; Rombel 1 Ilkom UNNES</h4> 
        </div>
    </footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
        <!--<script src="{{asset('js-r/idb.js')}} "></script>
        <script src="{{asset('js-r/utility.js')}} "></script>-->
        
        <script>
                /*if('serviceWorker' in navigator) {
                  navigator.serviceWorker
                           .register('/firebase-messaging-sw.js')
                           .then(function() { console.log("Service Worker Registered"); });
                }*/
        </script>
                
    @stack('scripts')
</body>

</html>