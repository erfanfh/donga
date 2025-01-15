@extends('dashboard.master')

@section('title', 'پشتیبانی')
@section('content')
    <div class="flex flex-row gap-6">
        <div class="text-3xl font-bold">تیکت ها</div>
        <button type="button" data-modal-target="create-ticket-modal" data-modal-toggle="create-ticket-modal"
                class="flex flex-row items-center gap-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            ایجاد تیکت جدید
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle"
                 viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                <path
                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
            </svg>
        </button>
    </div>
    <!-- Create Ticket Modal -->
    <div id="create-ticket-modal" tabindex="-1" aria-hidden="true"
         class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        ایجاد تیکت جدید
                    </h3>
                    <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-toggle="create-ticket-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <livewire:create-ticket/>
            </div>
        </div>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-12">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    #
                </th>
                <th scope="col" class="px-6 py-3">
                    عنوان
                </th>
                <th scope="col" class="px-6 py-3">
                    تاریخ ثبت
                </th>
                <th scope="col" class="px-6 py-3">
                    مربوط به
                </th>
                <th scope="col" class="px-6 py-3">
                    نوع
                </th>
                <th scope="col" class="px-6 py-3">
                    وضعیت
                </th>
                <th scope="col" class="px-6 py-3">
                    عملیات
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($tickets as $ticket)
                <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $ticket->id }}
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <a href="{{ route('support.show', $ticket) }}">{{ $ticket->title }}</a>
                    </th>
                    <td class="px-6 py-4">
                        {{ \Morilog\Jalali\Jalalian::fromCarbon($ticket->created_at)->format('H:i:s Y/m/d') }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $ticket->section }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $ticket->category }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            @if($ticket->status == 'باز')
                                <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div>
                            @elseif($ticket->status == 'بسته')
                                <div class="h-2.5 w-2.5 rounded-full bg-red-500 me-2"></div>
                            @elseif($ticket->status == 'پاسخ داده شده')
                                <div class="h-2.5 w-2.5 rounded-full bg-gray-500 me-2"></div>
                            @else
                                <div class="h-2.5 w-2.5 rounded-full bg-blue-500 me-2"></div>
                            @endif
                            {{ $ticket->status }}
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <form method="post" action="{{ route('support.close-ticket', $ticket) }}">
                            @csrf
                            <button @if($ticket->status == 'بسته') disabled @endif type="submit"
                                    class="@if($ticket->status == 'بسته') cursor-not-allowed text-gray-600 @else cursor-pointer text-red-600 @endif"
                                    href="{{ route('support.close-ticket', $ticket) }}">بستن
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-3">
        {{ $tickets->links() }}
    </div>
@endsection
