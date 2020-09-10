<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title id="title">helpak &hearts; </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="title" content="Helpak">
    <meta property="og:title" content="Helpak">
    <meta name="description" content="your place for exchanging services">        
    <meta property="og:description" content="your place for exchanging services" >
    <meta property="og:url" content="https://hlpk.bixa.in" >
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('js/app.js')}}" ></script>
    <link rel="shortcut icon" href="../storage/app_images/icon.png" type="image/x-icon">    
    <link href=" {{asset('alt/dist/css/adminlte.min.css')}}" rel="stylesheet">
    <link href=" {{asset('alt/plugins/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
    <link href=" {{asset('css/s2.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">

</head>
<body dir="ltr" >
    <div id="app">
              
        <main id="mainApp" class="col-10 offset-1 " >
            @auth
            <div id="firstNavigation" style="margin-bottom:64px;">@livewire('navbar',Auth::user()->id)</div>  
            <div id="secondNavigation" style="margin-bottom:64px;">@livewire('secondnav',Auth::user()->id)</div>
            @endauth             
            @yield('content')  
        </main>
        @auth
        <div id="navFooter" class="navFooter" style="position: fixed;bottom:0px;width:100vw;height:40px;z-index:100;display: none;background-color:lightsteelblue">
            @livewire('appnavigation')
        </div>
        @endauth
    </div>
    @livewireAssets  
    @jquery
    @toastr_js
    @toastr_render
    <script src="{{ asset('js/wireEvents.js')}}" defer></script>
    <script src="{{ asset('alt/dist/js/adminlte.min.js')}}" defer ></script>
    <script src="{{ asset('alt/plugins/jquery/jquery.min.js')}}" defer ></script>
    <script src="{{ asset('alt/plugins/bootstrap/js/bootstrap.bundle.min.js')}}" defer ></script>  

</body>
</html>
