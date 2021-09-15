<!DOCTYPE html>
<html lang="en">

<style>
    @import url("https://fonts.googleapis.com/css2?family=Righteous&display=swap");

    body {
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        font-family: "Righteous", cursive;
        min-height: 100vh;
        background-color: #a9c9ff;
        background-image: linear-gradient(180deg, #a9c9ff 0%, #ffbbec 100%);
    }

    body .container {
        max-width: 100vw;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        grid-gap: 35px;
        margin: 0 auto;
        padding: 40px 0;
    }

    body .container .card {
        position: relative;
        width: 300px;
        height: 400px;
        margin: 0 auto;
        background: #000;
        border-radius: 15px;
        box-shadow: 0 15px 60px rgba(0, 0, 0, 0.5);
    }

    body .container .card .face {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    body .container .card .face.face1 {
        box-sizing: border-box;
        padding: 20px;
    }

    body .container .card .face.face1 h2 {
        margin: 0;
        padding: 0;
    }

    body .container .card .face.face1 .java {
        background-color: #fffc00;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    body .container .card .face.face1 .python {
        background-color: #00fffc;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    body .container .card .face.face1 .cSharp {
        background-color: #fc00ff;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    body .container .card .face.face2 {
        transition: 0.5s;
    }

    body .container .card .face.face2 h2 {
        margin: 0;
        padding: 0;
        font-size: 10em;
        color: #fff;
        transition: 0.5s;
        text-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        z-index: 10;
    }

    body .container .card:hover .face.face2 {
        height: 60px;
    }

    body .container .card:hover .face.face2 h2 {
        font-size: 2em;
    }

    body .container .card:nth-child(1) .face.face2 {
        background-image: linear-gradient(40deg, #fffc00 0%, #fc00ff 45%, #00fffc 100%);
        border-radius: 15px;
    }

    body .container .card:nth-child(2) .face.face2 {
        background-image: linear-gradient(40deg, #fc00ff 0%, #00fffc 45%, #fffc00 100%);
        border-radius: 15px;
    }

    body .container .card:nth-child(3) .face.face2 {
        background-image: linear-gradient(40deg, #00fffc 0%, #fc00ff 45%, #fffc00 100%);
        border-radius: 15px;
    }

</style>

<head>
    <meta charset="UTF-8">
    <title>Admin Template Testing Page</title>

</head>

<body>
    <!-- partial:index.partial.html -->
    <div class="container">

        @foreach (config('auth.guards') as $key => $item)
            @php
                $item = Auth::guard($key)->user();
            @endphp

            <div class="card">
                <div class="face face1">
                    <div class="content">
                        <span class="stars"></span>
                        <h2 class="java"> {{ $item ? $item->name : 'Guest User' }}</h2>
                        <p class="java">User Type: {{ $key }}

                        </p>
                        @if(!is_null($item) && $key == 'admin') 
                        <a class="dropdown-item" href="{{ route('admin.logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        @endif
                    </div>
                </div>
                <div class="face face2">
                    <h2>01</h2>
                </div>
            </div>

        @endforeach




    </div>
    <!-- partial -->

</body>

</html>



<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>
