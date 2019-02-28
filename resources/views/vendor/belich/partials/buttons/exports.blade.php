{{-- Options --}}
<div id="exports-container" class="hidden button-selected btn btn-dropdown border border-green-light mr-2 bg-green-lightest text-green-dark hover:bg-green-light hover:text-white">
    {{-- Set button icon --}}
    @icon('download', '', 'opacity-100')

    {{-- Start with form --}}
    <form method="POST" action="{{ route('dashboard.exports.download') }}" name="belich-form-exports" id="belich-form-exports" dusk="dusk-form-exports" class="btn-dropdown-content pin-r rounded-lg border border-grey shadow text-grey-dark text-left bg-white">
        @csrf
        <input type="hidden" name="resource_model" value="{{ Belich::getModelPath() }}">
        <input type="hidden" id="exports_selected" name="exports_selected" value="">

        {{-- Export format component --}}
        <belich::options field="format" css="rounded-t-lg" required="true" :text="trans('belich::default.format')">
            <slot name="options">
               <option><option>
                <option value="xls">Excel 2003</option>
                <option value="xlsx">Excel 2007</option>
                <option value="csv">CSV</option>
            </slot>
        </belich::options>

        {{-- Export quantity component --}}
        <belich::options field="quantity" css="rounded-t-lg" required="true" :text="trans('belich::default.items')">
            <slot name="options">
               <option><option>
                <option value="all">@lang('belich::default.all')</option>
                <option value="selected">@lang('belich::default.selected')</option>
            </slot>
        </belich::options>

        <div class="float-right p-2 mb-2">
            <button type="submit" class="btn btn-default" onclick="addCheckboxesToField('exports_selected');">{!! icon('download', trans('belich::buttons.base.download')) !!}</button>
        </div>
    </form>
</div>
