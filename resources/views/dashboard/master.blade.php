<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'دنگا')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#000000">
    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="application-name" content="PWA">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo-nobg.png') }}">

    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="PWA">
    <link rel="apple-touch-icon" href="{{ asset('images/logo-nobg.png') }}">

    <!-- Tile for Win8 -->
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/images/icons/icon-512x512.png">
</head>
@laravelPWA
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
<body class="bg-gray-100 pb-10 mt-8 md:mt-0 md:pb-0">

<!-- Notifications -->
@if(session()->has('notification-success'))
    <x-notification_success/>
@endif

@if(session()->has('notification-error'))
    <x-notification_error/>
@endif

@if(session()->has('notification-warning'))
    <x-notification_warning/>
@endif

<section class="flex flex-row justify-end">
    <x-dashboard_sidebar/>
    <x-mobile_navbar/>
    <div class="p-8 w-full md:w-5/6">
        @yield('content')
    </div>
</section>
<script type="text/javascript">
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('/serviceworker.js', {
            scope: '.'
        }).then(function (registration) {
            console.log('Laravel PWA: ServiceWorker registration successful with scope: ', registration.scope);
        }, function (err) {
            console.log('Laravel PWA: ServiceWorker registration failed: ', err);
        });
    }
</script>
</body>
</html>
