<!DOCTYPE html>
<html lang="en">

<head>

	<title>{{ $title }}</title>
	<meta name="description" content="{{ $description }}">
	<meta name="keywords" content="{{ $keywords }}">
	<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}" />

	{!! $css_plugin_files.$css_files !!}
	{!! $js_plugin_files.$js_files !!}

	<script type="text/javascript">
		var base_url = "{{ url('/') }}";
	</script>
	<meta name="google-site-verification" content="5dh4UBesi-hifWGuMC9VrLnHHGLoWEg8JN-z1SCaTEU" />
 
	<script data-ad-client="ca-pub-3628707345326914" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

	<script>
        window.fbAsyncInit = function() {
          FB.init({
            xfbml            : true,
            version          : 'v8.0'
          });
        };

        (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
  </script>

  <!-- Global site tag (gtag.js) - Google Analytics --> 
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-L6GG22PFX3"></script> 
  <script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'G-L6GG22PFX3'); 
  </script>



</head>
<body>
	<!-- Preloader Start -->
    {{-- <div id="preloader" class="introLoading"></div> --}}
    <!-- End Preloader -->

    <!-- Social Media Share Start -->
    <div class="share"></div>
    <!-- End Social Media Share -->

	<!-- Load Facebook SDK for JavaScript -->
      <div id="fb-root"></div>
      
      <!-- Your Chat Plugin code -->
      <div class="fb-customerchat"
        attribution=setup_tool
        page_id="191779353919">
      </div>




	@include('website.elements.header')
	@include('website.elements.navigation')
	@yield('body')
	@include('website.elements.footer')

</body>
</html>