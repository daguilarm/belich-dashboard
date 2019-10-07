{{-- Rounded container (bottom) --}}
<div class="flex flex-row-reverse content-center bg-blue-100 h-18 shadow-md rounded-b-lg p-4 border-t border-gray-400">
    @isset($button)
        <div class="flex">
            {{ $button }}
        </div>
    @endif
</div>
