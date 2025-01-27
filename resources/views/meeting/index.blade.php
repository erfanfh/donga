@extends('dashboard.dashboard')
@section('title', 'تاریخچه دورهمی ها')
@section('content')
    <div class="text-xl md:text-3xl font-bold pb-10">تاریخچه دورهمی ها</div>
    <div class="flex flex-col gap-5">
        @foreach(auth()->user()->meetings as $key => $meeting)
            <div class="flex flex-row justify-between bg-white py-5 px-3 md:py-7 md:px-5 rounded-2xl">
                <div class="flex flex-row items-center gap-5">
                    <span>#{{ $key + 1 }}</span>
                    <div>
                        <span class="hidden md:inline-block text-gray-500">نام:</span>
                        <span>{{ $meeting->title }}</span>
                    </div>
                </div>
                <div>
                    <span class="text-gray-500 hidden md:inline-block">تاریخ ایجاد:</span>
                    <span>{{ \Morilog\Jalali\Jalalian::fromCarbon($meeting->created_at)->format('Y/m/d') }}</span>
                </div>
                <div class="hidden md:inline-block">
                    <span class="text-gray-500">تعداد نفرات :</span>
                    <span>{{ $meeting->persons()->count() }}</span>
                </div>
                <div class="hidden md:inline-block">
                    <span class="text-gray-500">هزینه :</span>
                    <span>{{ number_format($meeting->expenses()->sum('price')) }} تومان</span>
                </div>
                <div>
                    <a href="{{ route('meetings.show', $meeting) }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5"/>
                        </svg>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
