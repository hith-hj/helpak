<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="title" content="Helpak">
        <meta property="og:title" content="Helpak">
        <meta name="description" content="your place for exchanging services">        
        <meta property="og:description" content="your place for exchanging services" >
        <meta property="og:url" content="https://hlpk.bixa.in" >
        <link rel="shortcut icon" href="../storage/app_images/icon.png" type="image/x-icon">
        <title>helpak</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                /* font-size: 84px; */
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
            .links > label{
                color: #636b6f;
                padding: 0 15px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 10px;
                letter-spacing: .1rem;
            }
            .mb5{
                margin-bottom: 180px;
                transition: all 1s cubic-bezier(0.6, -0.28, 0.735, 0.045);
            }
            .an5{
                transition: all 1s cubic-bezier(0.6, -0.28, 0.735, 0.045);
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height"style="background-image: url('storage/app_images/icon2.png');background-repeat: no-repeat;background-size:40%; background-position-x:center;background-position-y:center; ">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content" >
                <div class="title m-b-md">
                    {{-- ISERVE --}}
                    <img id="helpack" src="storage/app_images/helpak2.png" width="40%"  alt="">
                    <div class="links"><label>10 Star Nation</label></div>
                </div>
            </div>
        </div>
        <script>
            function respo(){
                let wid = window.innerWidth || document.body.clientWidth
                const help = document.querySelector("#helpack")
                if(wid < 500 )
                {
                    help.classList.add('mb5')
                    help.classList.remove('an5')
                }else {
                    help.classList.remove('mb5')
                    help.classList.add('an5')
                }
            }
            window.addEventListener('resize',respo)
            window.addEventListener('load',respo)
        </script>
    </body>
</html>
