{{-- For Tabs --}}
@if(Belich::tabs() === true)
    <div class="form-container">

{{-- For Panels --}}
@else
    <div class="form-container {{ $loop->first ? '' : 'mt-4' }} {{ $loop->last ? '' : 'mb-4' }}">
@endif

    {{-- Label --}}
    @if(!empty($label) && !Belich::tabs())
        <h4 class="p-6 text-blue-600 uppercase border-b border-gray-200 bg-blue-100 shadow-md">{{ $label }}</h4>
    @endif

    {{-- Get all the fields --}}
    @foreach($panel as $key => $field)

        {{-- Render fields: create, edit --}}
        @isset($toField)

            {{-- Render field by type --}}
            @includeIf('belich::fields.' . $field->type, ['field' => $field])

        {{-- Render values: show --}}
        @else

            {{-- Only if there is results --}}
            @if(!empty($field->label))
                <belich::fields :field="$field" :toField="$toField ?? null">
                    <slot name="input">

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
