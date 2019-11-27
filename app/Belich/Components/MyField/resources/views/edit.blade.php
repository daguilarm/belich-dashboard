{{-- Vanilla code --}}
{{-- <div class="form-item-field w-full flex items-center py-8 px-6 bg-white text-gray-600 border-b border-gray-200 text-sm shadow-md">
    <div class="w-1/3">
        <label class="capitalize font-bold">{{ $field->label }}</label>
    </div>
    <div class="w-2/3 my-auto">
        <input class="mr-3" type="text" value="{{ $field->value }}" dusk="{{ $field->dusk }}" id="{{ $field->id }}" name="{{ $field->name }}">
        <p id="error-{{ $field->id }}" class="validation-error text-red-500 font-normal italic mt-2"></p>
    </div>
</div> --}}

{{-- BladeX code for text --}}
<belich::fields :field="$field">
    <slot name="input">
        <input
            {!! Helper::formAttribute($field, 'addClass', 'mr-3') !!}
            {!! Helper::formAttribute($field, 'type', 'text') !!}
            {!! Helper::formAttribute($field, 'value') !!}
            {!! $field->render !!}
        >
    </slot>
</belich::fields>
