<!DOCTYPE html>
<html lang="en">

<head>

	<title>{{ $title }}</title>
	
	<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.png') }}" />

	<link href="{{ asset('css/bootstrap.css') }}" media="screen" rel="stylesheet" type="text/css" />
	<link href="{{ asset('css/icons/fontawesome/all.min.css') }}" media="screen" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/icons/themify-icons/themify-icons.css') }}" media="screen" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/app.css') }}" media="screen" rel="stylesheet" type="text/css" />

    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/cms/scripts/access.js') }}"></script>

	<script type="text/javascript">
		var base_url = "{{ url('/').'/' }}";
	</script>

	<style type="text/css">
		html {
            height: 100%;
        }
        body {
            font-family: 'Montserrat', sans-serif;
            min-height: 100%;
        }
	</style>

</head>
<body class="login d-flex align-items-center text-center">

	<div class="container">
		<div class="ajax-response mx-auto">
        	<div class="ajax-message"></div>
        </div>
		<div class="card border-0 mx-auto">
			<div class="card-body">
				<form id="frmLogin">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="mb-5">
						<a href="{{ url('/') }}">
							<img src="{{ asset('images/logo.jpg') }}" width="75%">
						</a>
					</div>
					<div class="form-group">
			            <div class="inner-addon left-addon">
			                <i class="fas fa-user"></i>
			                <input class="form-control" type="text" placeholder="Email Address" name="email">
			            </div>
			        </div>
					<div class="form-group">
			            <div class="inner-addon left-addon">
			                <i class="fas fa-lock"></i>
			                <input class="form-control" type="password" placeholder="Password" name="password">
			            </div>
			        </div>
			        <div class="form-group">
			        	<button type="submit" class="btn btn-warning" id="btnLogin">LOGIN</button>
			        </div>
			    </form>
			</div>
		</div>
		<div class="mt-4">
			<img src="{{ asset('images/PB_PoweredBy.png') }}" height="40">
		</div>
	</div>

</body>
</html>