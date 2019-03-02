{{-- Rounded container (bottom) --}}
<div class="flex flex-row-reverse bg-blue-lightest {{ isset($height) ? 'h-' . $height : 'h-auto' }} shadow-md rounded-b-lg">
    @isset($button)
        <div class="px-6 py-4">
            {{ $button }}
        </div>
    @endif
</div>
