@extends('dashboard.master')

@section('title', $meeting->title)

@section('content')
    <link rel="stylesheet" href="{{ asset('css/MultiSelect.css') }}">
    <section class="flex flex-col">
        <x-meeting_header :meeting="$meeting"/>

        @error('title')
        <div class="p-4 my-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
            <span class="font-medium">خطا!</span> {{ $message }}
        </div>
        @enderror

        <x-meeting_datails :meeting="$meeting"/>

        <!-- New Expense Modal -->
        <x-meeting_new_expense_modal :meeting="$meeting"/>

        <!-- New User Modal -->
        <x-meeting_new_user_modal :meeting="$meeting"/>

        <x-meeting_users_table :meeting="$meeting"/>
    </section>
    <script src="{{ asset('js/MultiSelect.js') }}"></script>
    <script>
        function changeTitle() {
            const old_meeting = document.getElementById('meeting-title');
            const new_meeting = document.getElementById('meeting-title-form');
            const change_meeting_title_button = document.getElementById('change-meeting-title-button');
            const close_form_button = document.getElementById('close-form-button');

            old_meeting.classList.add('hidden');
            change_meeting_title_button.classList.add('hidden');
            new_meeting.classList.remove('hidden');
            close_form_button.classList.remove('hidden');
        }

        function closeForm() {
            const old_meeting = document.getElementById('meeting-title');
            const new_meeting = document.getElementById('meeting-title-form');
            const change_meeting_title_button = document.getElementById('change-meeting-title-button');
            const close_form_button = document.getElementById('close-form-button');

            old_meeting.classList.remove('hidden');
            change_meeting_title_button.classList.remove('hidden');
            new_meeting.classList.add('hidden');
            close_form_button.classList.add('hidden');
        }
    </script>
    <script>
        new MultiSelect(document.getElementById('user-multi-select'));
    </script>
    <script>
        // Format the price input
        document.getElementById('price').addEventListener('input', function (e) {
            let input = e.target.value.replace(/\D/g, '');
            input = input.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            e.target.value = input;
        });
    </script>
    <script>
        // Set the price inout unformat
        document.getElementById('expenseForm').addEventListener('submit', function (e) {
            let inputField = document.getElementById('price');
            inputField.value = inputField.value.replace(/,/g, '');
        });
    </script>

@endsection
