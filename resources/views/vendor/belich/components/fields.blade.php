<div class="w-full flex items-center py-8 px-6 bg-white text-grey-darker border-b border-grey-lighter text-sm shadow-md">
    <div class="w-1/3">
        <label class="capitalize font-bold">{{ $field->label ?? null }}</label>
    </div>
    <div class="w-2/3 my-auto">
        {{-- Displaying the field --}}
        {{ $input ?? null }}

        @isset($field->help)
            <div class="font-normal lowercase italic mt-2 uppercase-first-letter">{{ $field->help }}</div>
        @endisset

        @isset($field->id)
            <p id="error-{{ $field->id }}" class="text-red font-normal italic mt-2"></p>
        @endif

        @include('belich::fields.cast')
    </div>
</div>
