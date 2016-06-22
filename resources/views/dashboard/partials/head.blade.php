<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">

    <meta name="env" content="{{ app('env') }}">
    <meta name="token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/png" href="/images/favicon.ico">
    <link rel="shortcut icon" href="/images/favicon.png" type="image/x-icon">

    <link rel="apple-touch-icon" href="/img/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="57x57" href="/img/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/img/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/img/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/img/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/img/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/img/apple-touch-icon-152x152.png">

    <title>{{ $page_title or $site_title }}</title>

    <link rel="stylesheet" href="{{ elixir('dist/css/all.css') }}">
    @yield('css')
    <script src="{{ elixir('dist/js/all.js') }}"></script>
    <script type="text/javascript">
        Hifone.Config = {
            'current_user_id' : {{ Auth::user() ? Auth::user()->id : 'null' }},
            'token' : '{{ csrf_token() }}',
            'emoj_cdn' : '{{ cdn() }}',
            'uploader_url' : '{{ route('upload_image') }}',
            'notification_url' : '{{ route('notification.count') }}'
        };
    </script>
</head>