{{-- Conditional form --}}
@if(!empty($form))
    <form method="POST" id="form-{{ \Illuminate\Support\Str::kebab($id) }}" name="form-{{ \Illuminate\Support\Str::kebab($id) }}" action="{{ $action }}">
        {{-- Form CSRF --}}
        @csrf
        {{-- Form method field --}}
        {!! $method ?? null !!}
        {{-- Selected fields --}}
        @isset($hidden)
            <input type="hidden" id="{{ $hidden ?? null }}" name="{{ $hidden ?? null }}" value="">
        @endisset
@endif

    {{-- Modal body --}}
    <div id="modal-{{ $id }}" class="modal absolute h-full top-0 right-0 button-0 left-0 invisible opacity-0 z-40">

        {{-- This link will close the modal when clicking outside --}}
        <a class="absolute w-full h-full cursor-default" href="#"></a>

        {{-- Load the modal container --}}
        <div class="relative w-1/3 mt-24 mx-auto shadow-md rounded bg-white border border-gray-400">

            {{-- Close icon --}}
            <div class="float-right m-2 p-1">
                <a href="#" class="close text-white font-bold text-lg">@icon('times')</a>
            </div>

            {{-- Header --}}
            @isset($header)
                <h2 id="header-{{ $id }}" class="{{ isset($background) ? 'bg-' . $background : 'bg-gray-600' }} {{ isset($color) ? 'text-' . $color : 'text-white' }} font-bold rounded-t p-4">
                    {!! $header !!}
                </h2>
            @endisset

            {{-- Content --}}
            @isset($content)
                <div class="p-8 leading-loose text-lg text-gray-700">
                    {!! $content !!}
                </div>
            @endisset

            {{-- Footer --}}
            @isset($footer)
                <div class="bg-gray-200 text-white p-4 text-{{ $footerAlign ?? 'right' }}">
                    {!! $footer !!}
                </div>
            @endisset
        </div>
    </div>

{{-- Conditional form --}}
@if(!empty($form))
    </form>
@endif
