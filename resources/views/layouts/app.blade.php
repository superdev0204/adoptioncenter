<!DOCTYPE html>
<html lang="en">

<head>
    @push('meta')
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    @endpush

    @push('link')
        <link rel="stylesheet" href="{{ asset('css/style.min.css') }}">
    @endpush

    @stack('meta')
    @stack('title')
    @stack('link')

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-11548587-32"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-11548587-32');
    </script>

    <!-- jQuery -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>

    <!--[if IE 9]>
    <link rel="stylesheet" type="text/css" href="css/ie9.css" />
    <![endif]-->
    <script type="text/javascript">
        $(document).ready(function(){
            $('.mobile_toggle').click(function(){
                $('#navigation').slideToggle();
            });
        });
    </script>
</head>

<body>
    <div id="header">
        <div>
            <div id="logo">
                <a href="/"><img src="{{ asset('images/logo.png') }}" alt="Logo" /></a>
            </div>
            @if( !isset($user) || !$user )
                <div class="login" style="width:auto">
                    <a href="/user/login" title="Log In">Log In</a>
                    <a href="/user/new">Signup</a>
                </div>
            @endif
            <a href="#" class="mobile_toggle"><img src="{{ asset('images/icon_nav.png') }}"></a>
            <div id="navigation">
                <div>
                    <ul>
                        <li class="current"><a href="/">Home</a></li>
                        <li><a href="/search">Search</a></li>
                        <li><a href="/resources">Resources</a></li>
                        <li><a href="/agency/new">Add New Listing</a></li>
                        <li>
                            <a href="/about">About</a>
                            <ul>
                                <li><a href="/contact">Contact</a></li>
                            </ul>
                        </li>
                        @if( isset($user) && $user )
                            <li><a href="/user/logout">Logout</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- content -->
    @yield('content')

    <div id="footer">
        <div>
            <div class="first">
                <p>AdoptionCenter © 2015. All Rights Reserveed</p>
                <div>
                    <ul>
                        <li>
                            <a href="#">About Us</a>
                        </li>
                        <li>
                            <a href="#">Term and Conditions</a>
                        </li>
                        <li>
                            <a href="#">Privacy Policy</a>
                        </li>
                        <li>
                            <a href="#">Help</a>
                        </li>
                        <li class="clear"></li>
                    </ul>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</body>
</html>
