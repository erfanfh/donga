<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'دنگا')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
<body class="bg-gray-100">

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

<section class="flex flex-row">
    <x-dashboard_sidebar/>
    <div class="p-8 w-5/6">
        @yield('content')
    </div>
</section>
</body>
</html>
