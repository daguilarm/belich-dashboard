{{-- Rounded container (bottom) --}}
<div class="flex flex-row-reverse content-center bg-blue-lightest h-18 shadow-md rounded-b-lg p-4 border-t border-grey-light">
    @isset($button)
        <div class="flex">
            {{ $button }}
        </div>
    @endif
</div>
