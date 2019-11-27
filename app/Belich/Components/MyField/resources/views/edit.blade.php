{{-- BladeX example for text --}}
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
