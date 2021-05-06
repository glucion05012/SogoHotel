<!DOCTYPE html>
<html lang="en">

<head>

    <title>Page Not Found</title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel='shortcut icon' type='image/x-icon' href='{{ asset('images/favicon.ico') }}' />

    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,700,800,900" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.css') }}" media="screen" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>

    <style>
        html {
            height: 100%;
        }
        body {
            font-family: 'Montserrat', sans-serif;
            color: #333;
            min-height: 100%;
        }
        .btn {
            -webkit-box-shadow: 1px 2px 10px 0 rgba(0, 0, 0, 0.15);
                    box-shadow: 1px 2px 10px 0 rgba(0, 0, 0, 0.15);
            padding: 15px 45px;
            white-space: pre-wrap;
        }
        .btn.btn-primary {
            background-color: #fe0002;
            border-color: #fe0002;
        }

        .btn.btn-primary:hover, .btn.btn-primary:focus, .btn.btn-primary:active, .btn.btn-primary:not(:disabled):active {
            background-color: rgba(254, 0, 2, 0.8);
            border-color: #fe0002;
        }
        h1 {
            font-weight: 700;
            color: #fe0002;
            font-size: 64px;
        }
        h2 {
            font-size: 24px;
        }
        h4 {
            font-size: 18px;
        }
        img {
            width: 100%;
        }
        @media (max-width: 991px) {
            h1 {
                font-size: 8vw;
            }
            img {
                width: auto;
                height: 250px;
            }
        }
        @media (max-width: 767px) {
            h2 {
                font-size: 20px;
            }
            h4 {
                 font-size: 16px;
            }
            img {
                height: 200px;
            }
        }
        .card {
            background-color: #fdcd01;
        }
    </style>

    </head>
    <body class="d-flex align-items-center" style="background-image: url({{ asset('images/404Sogo_bg.png') }}); background-repeat: no-repeat;">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 mx-lg-auto">
                    <div class="card">
                        <div class="card-body text-lg-left text-center p-3">
                            <div class="d-flex flex-column flex-lg-row justify-content-between align-items-md-center">
                                <div class="pr-lg-4 mb-lg-0 mb-3">
                                    <img src="{{ asset('images/SogoLady.jpg') }}">
                                </div>
                                <div class="pl-lg-4">
                                    <h1>WHOOPS!</h1>
                                    <h2>The Page You're Looking for was Not Found</h2>
                                    <h4>If the problem continues and you think something is wrong, please send us a report and we'll look into it.</h4>

                                    <a href="{{ url('/') }}" class="btn btn-primary mt-3">BACK TO HOTEL SOGO HOME</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
