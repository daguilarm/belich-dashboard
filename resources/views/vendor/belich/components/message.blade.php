<div id="menssage-alert" class="relative rounded-lg pt-4 pl-6 pr-8 pb-6 w-1/3 bg-{{ $color }}-100 shadow-md fade-out" role="alert">

    {{-- Header --}}
    <p class="text-lg text-{{ $color }}-600 border-b border-{{ $color }}-200 capitalize font-bold mb-3 pb-2">
        {{-- Session header or custom --}}
        {!! $header !!}
    </p>

    {{-- Messages --}}
    {{-- App\Http\Helpsers\Messages --}}
    @foreach(messages($type) as $message)
        <li class="mb-2 text-black">{{ $message }}</li>
    @endforeach

    {{-- Close alert --}}
    <a href="#" class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer text-black" onclick="closeMenssage();">
        @icon('times')
    </a>

</div>
