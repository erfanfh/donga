<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>دنگا</title>
    <link rel="icon" sizes="512x512" href="{{ asset('images/icons/icon-512x512.png') }}">
    <style>
        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url("{{ asset('images/main-green-bg.jpg') }}");
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>
</head>
<body>
<div class="grid grid-cols-12">
    <div class="col-span-12 flex flex-col items-center mt-10 gap-12 h-fit">
        <img  src="{{ asset('images/logo-nobg.png') }}" alt="logo" class="w-1/2 md:w-1/3">
        <div class="text-xl md:text-4xl text-white font-bold text-center">..با دنگا، دنگ های خود را مدیریت کنید</div>
        <a href="{{ route('register') }}" class="text-gray-900 bg-gradient-to-r from-lime-200 via-lime-400 to-lime-500 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-lime-300 dark:focus:ring-lime-800 shadow-lg shadow-lime-500/50 dark:shadow-lg dark:shadow-lime-800/80 font-medium rounded-lg text-sm px-7 py-3 text-center me-2 mb-2">ثبت نام</a>
    </div>
</div>
</body>
</html>
