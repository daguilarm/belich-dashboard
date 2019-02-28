{{-- Options --}}
<div class="btn btn-dropdown border border-grey mr-2 bg-grey-lighter text-grey-dark hover:bg-grey hover:text-white">
    {{-- Set button icon --}}
    @icon('cogs', '', 'opacity-100')

    {{-- Start with form --}}
    <form method="POST" action="{{ route('dashboard.users.settings') }}" name="belich-form-options" id="belich-form-options" dusk="dusk-form-options" class="btn-dropdown-content pin-r rounded-lg border border-grey shadow text-grey-dark text-left bg-white">
        @csrf

        {{-- Per page component --}}
        <belich::options field="perPage" css="rounded-t-lg" :text="trans('belich::default.perPage')">
            <slot name="options">
                {!! createFormSelectOptions([10, 20, 30, 50, 100, 200, 300, 500], 'perPage') !!}
            </slot>
        </belich::options>

        {{-- Trashed component --}}
        @can('withTrashed', $request->autorizedModel)
            {{-- If the model has softdelete --}}
            @hasSoftdelete($request->autorizedModel)
                <belich::options field="withTrashed" css="rounded-t-lg" :text="trans('belich::default.trashed')">
                    <slot name="options">
                        {!! createFormSelectOptions([
                            'none' => trans('belich::default.none'),
                            'all'  => trans('belich::default.all'),
                            'only' => trans('belich::default.trashedOnly'),
                        ], 'withTrashed') !!}
                    </slot>
                </belich::options>
            @endif
        @endcan

        {{-- Submit buttons --}}
        <div class="float-right p-2 mb-2">
            <button type="submit" class="btn btn-default" onclick="loading(this);">
                {!! icon('redo-alt', trans('belich::buttons.base.configure')) !!}
            </button>
        </div>
    </form>
</div>
