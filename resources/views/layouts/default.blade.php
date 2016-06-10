<!DOCTYPE html>
<html lang="zh">
	<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>@yield('title') {{ $site_name }}@if($site_about) - {{ $site_about }}@endif</title>
        <meta name="keywords" content="Hifone,BBS,Forum,PHP,Laravel" />
        <meta name="author" content="The Hifone Team." />
        <meta name="description" content="@section('description') Hifone" />
        <meta name="env" content="{{ app('env') }}">
        <meta name="token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{ elixir('dist/css/all.css') }}">
        <link rel="shortcut icon" href="/images/favicon.png">
        <link rel="alternate" type="application/atom+xml" href="/feed" />
        <script src="{{ elixir('dist/js/all.js') }}"></script>
        <script>
            Config = {
                'cdnDomain': '{{ cdn() }}',
                'user_id': {{ Auth::user() ? Auth::user()->id : 0 }},
                'routes': {
                    'notification_count' : '{{ route('notification.count') }}',
                    'upload_image' : '{{ route('upload_image') }}'
                },
                'token': '{{ csrf_token() }}',
            };
        </script>

        @yield('styles')
    </head>
    <body class="forum" data-page="forum">
       @include('partials.nav')
		<div id="main" class="main-container container">

				@include('partials.errors')

                @include('partials.top')

				@yield('content')

                @include('partials.bottom')
		</div>

        @include('partials.footer')

	</body>
</html>
