@extends('belich::layout')

@section('content')
    <div class="shadow-md bg-white rounded my-8 mx-6 p-4">

        {{-- Calendar --}}
        <div class="w-32 flex-none text-center">
            <div class="block overflow-hidden shadow-md rounded-t">
                <div class="bg-blue text-white text-xl py-2">
                    {{ now()->englishMonth }}
                </div>
                <div class="pt-1">
                    <span class="text-5xl font-bold leading-tight">
                        {{ now()->day }}
                    </span>
                </div>
                <div class="text-center border-white py-2 mb-1">
                    <span class="text-sm">
                        {{ now()->englishDayOfWeek }}
                    </span>
                </div>
            </div>
        </div>

    </div>
@endsection
