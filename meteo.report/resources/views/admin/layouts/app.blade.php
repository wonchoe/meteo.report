
<!DOCTYPE html>
<html>
    <head><title>@yield('title')</title>
        <link rel="stylesheet" href="{{URL::asset('css/custom.css')}}">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <link href="{{URL::asset('css/style.css')}}" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        @yield('src_top')
    </head>
    <body class="app">
        <div id="loader">
            <div class="spinner"></div>
        </div>
        <script type="application/javascript">window.addEventListener('load', () => {
                const loader = document.getElementById('loader');
                setTimeout(() => {
                loader.classList.add('fadeOut');
                }, 300);
                });
            </script>
            <div>
                <div class="sidebar">
                    @include('admin.layouts.sidebar')
                </div>


                <div class="page-container">
                    <div class="header navbar">
                        <div class="header-container">
                            @include('admin.layouts.navbar')
                        </div>
                    </div>
                    <main class="main-content bgc-grey-100">
                        <div id="mainContent">
                            @yield('content')
                        </div>
                    </main>
                    @include('admin.layouts.footer')
                </div>
            </div>
            @yield('src_bottom')           
            <script type="application/javascript" src="{{URL::asset('js/vendor.js')}}"></script>
            <script type="application/javascript" src="{{URL::asset('js/bundle.js')}}"></script>
            <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/a2bd7673/cloudflare-static/rocket-loader.min.js" data-cf-settings="c01a3a4ae58abc864018c423-|49" defer=""></script>
        </body>
    </html>
