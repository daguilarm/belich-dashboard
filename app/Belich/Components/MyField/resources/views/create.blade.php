{{-- BladeX example for input[type=text] --}}
<belich::fields :field="$field">
    <slot name="input">
        <input
            id="testing-id-1"
            {!! Helper::formAttribute($field, 'addClass', 'mr-3') !!}
            {!! Helper::formAttribute($field, 'type', 'text') !!}
            {!! $field->render !!}
        >

        <input
            id="testing-id-2"
            {!! Helper::formAttribute($field, 'addClass', 'mr-3') !!}
            {!! Helper::formAttribute($field, 'type', 'text') !!}
            {!! $field->render !!}
        >
    </slot>
</belich::fields>

