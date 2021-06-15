@extends('website.master')
@section('body')

    <style>
        * {
        box-sizing: border-box;
        }

        body {
        font-family: Arial, Helvetica, sans-serif;
        }

        /* Float four columns side by side */
        .column {
        float: left;
        width: 30%; 
        padding: 0 10px;
        }

        /* Remove extra left and right margins, due to padding */
        .row {margin: 0 -5px;}

        /* Clear floats after the columns */
        .row:after {
        content: "";
        display: table;
        clear: both;
        }

        /* Responsive columns */
        @media screen and (max-width: 600px) {
        .column {
            width: 100%;
            display: block;
            margin-bottom: 20px;
        }
        }

        /* Style the counter cards */
        .card {
        margin:3em;
        margin-bottom: 1em;
        border-radius:25px;
        border: none;
        text-align: center;
        background-color: transparent;
        }
    </style>



    <div class="header pt-header">
        <a href="{{ url('/virtual-tour') }}">
            <img src="{{url('/images/banner/virtualtour.jpg')}}" width="100%">
        </a>
    </div>

	<section class="about-us bg-default py-0 mb-4 scrolly" style="background-image: url({{ asset('images/image-bg.png') }}); background-repeat: no-repeat; background-size: cover;">
        <div class="row" style="justify-content:center">
            <div class="column">
                <a href="https://beyond.3dnest.cn/play/index.html?m=d19487a8_B6Ub_b6f9&o=1" target="_blank">
                    <div class="card">
                        <img src="{{url('/images/virtual/econo.png')}}" 
                        width="100%" height="150rem"
                        style="border-radius:25px" >
                    </div>
                    <p style="text-align:center"><b>Econo Room</b></p>
                </a>
            </div>

            <div class="column">
                <a href="https://beyond.3dnest.cn/play/index.html?m=51cc2020_MwGh_b6f9&o=3" target="_blank">
                    <div class="card">
                    <img src="{{url('/images/virtual/lobby.png')}}" 
                        width="100%" height="150rem"
                        style="border-radius:25px" >
                    </div>
                    <p style="text-align:center"><b>Lobby Area</b></p>
                </a>
            </div>
            
            <div class="column">
                <a href="https://beyond.3dnest.cn/play/index.html?m=573edb3e_50CK_b6f9&o=2" target="_blank">    
                    <div class="card">
                    <img src="{{url('/images/virtual/premium.png')}}" 
                        width="100%" height="150rem"
                        style="border-radius:25px" >
                    </div>
                    <p style="text-align:center"><b>Premium Room</b></p>
                </a>
            </div>
        </div>
        <div class="row" style="justify-content:center">
            <div class="column">
                <a href="https://beyond.3dnest.cn/play/index.html?m=2a994a38_iJ7M_b6f9&o=3" target="_blank">    
                    <div class="card">
                    <img src="{{url('/images/virtual/deluxe.png')}}" 
                        width="100%" height="150rem"
                        style="border-radius:25px" >
                    </div>
                    <p style="text-align:center"><b>Deluxe Room</b></p>
                </a>
            </div>

            <div class="column">
                <a href="https://beyond.3dnest.cn/play/index.html?m=333e0dfc_kiJ8_b6f9&o=3" target="_blank">        
                    <div class="card">
                    <img src="{{url('/images/virtual/executive.png')}}" 
                        width="100%" height="150rem"
                        style="border-radius:25px" >
                    </div>
                    <p style="text-align:center"><b>Executive Room</b></p>
                </a>
            </div>
        </div>
	</section>

@endsection