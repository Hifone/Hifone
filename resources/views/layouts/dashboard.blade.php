<!DOCTYPE html>
<html lang="{{ $user_locale or $site_locale }}">
@include('dashboard.partials.head')

<body class="dashboard" data-page="dashboard">
    <div class="wrapper">
        @include('dashboard.partials.sidebar')
        <div class="page-content">
            @yield('content')
        </div>
    </div>
    @yield('js')
</body>
</html>