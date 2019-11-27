{{-- BladeX example for text --}}
<belich::fields :field="$field">
    <slot name="input">
        <input
            id="testing-id-1"
            {!! Helper::formAttribute($field, 'addClass', 'mr-3') !!}
            {!! Helper::formAttribute($field, 'type', 'text') !!}
            {!! Helper::formAttribute($field, 'value', 'testing-custom-value') !!}
            {!! $field->render !!}
        >
    </slot>
</belich::fields>
