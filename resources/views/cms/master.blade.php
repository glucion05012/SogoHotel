<!DOCTYPE html>
<html lang="en">

<head>

	<title>{{ $title }}</title>
  	<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  	<meta name="csrf-token" content="{{ csrf_token() }}">

	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}" />

	{!! $cms_css_plugin_files.$cms_css_files !!}
	{!! $cms_js_plugin_files.$cms_js_files !!}

	<script type="text/javascript">
		var base_url = "{{ url('/') }}";
	</script>

</head>
<body class="fixed-nav sticky-footer" id="page-top">

	@include('cms.elements.header')
	@include('cms.elements.navigation')
	@yield('body')
	@include('cms.elements.footer')

	<script type="text/javascript">
		var loading = $.loading({ajax: false});
	</script>

</body>
</html>