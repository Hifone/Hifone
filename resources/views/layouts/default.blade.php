<!DOCTYPE html>
<html lang="{{ $user_locale or $site_locale }}">
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
        <script type="text/javascript">
            Hifone.Config = {
                'locale' : '{{ $user_locale or $site_locale }}',
                'current_user_id' : {{ Auth::user() ? Auth::user()->id : 'null' }},
                'token' : '{{ csrf_token() }}',
                'emoj_cdn' : '{{ cdn() }}',
                'uploader_url' : '{{ route('upload_image') }}',
                'notification_url' : '{{ route('notification.count') }}'
            };
        </script>

        @if($stylesheet)
		<style type="text/css">
		{!! $stylesheet !!}
		</style>
		@endif
    </head>
    <body class="forum" data-page="forum">
       @include('partials.nav')
		<div id="main" class="main-container container">
				@include('partials.errors')
                {!! $breadcrumb or '' !!}
                @include('partials.top')

				@yield('content')

                @include('partials.bottom')
		</div>

        @include('partials.footer')

	</body>
</html>
