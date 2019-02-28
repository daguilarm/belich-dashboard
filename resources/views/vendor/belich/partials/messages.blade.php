<div class="flex justify-center w-full leading-normal mb-8">
    {{-- Success --}}
    @if(session()->has('success'))
        <belich::message
            color="teal"
            type="success"
            :header="icon('check', session()->get('header') ?? trans('belich::messages.crud.success.title'))"
        />
    @endif

    {{-- Errors --}}
    @if(session()->has('errors'))
        <belich::message
            color="red"
            type="errors"
            :header="icon('exclamation-triangle', session()->get('header') ?? trans('belich::messages.crud.fail.title'))"
        />
    @endif
</div>
