{{-- Dropdown option --}}
<div class="w-full mb-1">
    {{-- Title --}}
    <div class="w-full p-4 bg-gray-200 border-b border-gray-200 {{ $css ?? null }}">{{ $text ?? emptyResults() }}</div>

    {{-- Container --}}
    <div class="p-2 my-2 text-lg">
        @isset($options)
            {{-- Select options --}}
            <select name="{{ $field }}" class="w-full h-10 border border-gray-400" {{ isset($required) ? 'required' : '' }}>
                {!! $options !!}
            </select>
        @else
            {{-- No results --}}
            {{ $custom ?? emptyResults() }}
        @endisset
    </div>
</div>
