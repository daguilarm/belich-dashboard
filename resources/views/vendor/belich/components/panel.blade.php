<div class="form-container {{ $loop->first ? '' : 'mt-4' }} {{ $loop->last ? '' : 'mb-4' }}">
    {{-- Label --}}
    @if(!empty($label))
        <h4 class="p-6 text-grey-darker uppercase border-b border-grey-lighter">{{ $label }}</h4>
    @endif

    {{-- Get all the fields --}}
    @foreach($panel as $field)

        {{-- Render fields --}}
        @isset($toField)
            {{-- Render field by type --}}
            @includeIf('belich::fields.' . $field->type, ['field' => $field])

        {{-- Render values --}}
        @else
            {{-- Only if there is results --}}
            @if(!empty($field->label))
                <belich::fields :label="$field->label">
                    <slot name="field">

                        {{-- Enable or disable html scape --}}
                        @if($field->asHtml)
                            {!! Belich::html()->resolve($field) !!}
                        @else
                            {{ Belich::html()->resolve($field)}}
                        @endif

                    </slot>
                </belich::fields>
            @endif
        @endif
    @endforeach
</div>
