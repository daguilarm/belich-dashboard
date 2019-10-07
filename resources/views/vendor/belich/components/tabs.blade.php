<div class="tabs">
    {{-- Create tabs links --}}
    <ul class="list-reset bg-gray-100 py-4 shadow-md">
        {{-- List the tab links --}}
        @foreach($tabs as $label => $panel)
            <li class="inline m-0">
                <a
                    id="menu_{{ stringTokebab($label) }}"
                    onclick="javascript:switchTab('{{ stringTokebab($label) }}', '{{ md5(stringTokebab($label)) }}');"
                    href="#{{ md5(stringTokebab($label)) }}"
                    class="p-4 px-6 text-gray-700 border border-b-0 border-gray-200 {{ $loop->first ? 'active' : '' }}"
                >
                    {{ $label }}
                </a>
            </li>
        @endforeach
    </ul>

    {{-- List the tab containers --}}
    @foreach($tabs as $label => $panel)
        <div class="content {{ $loop->first ? 'block' : 'hidden' }}" id="content_{{ stringTokebab($label) }}">

            {{-- Form --}}
            @isset($toField)
                <belich::panel :label="$label" :panel="$panel" :loop="$loop" toField="true"></belich::panel>

            {{-- Detail --}}
            @else
                <belich::panel :label="$label" :panel="$panel" :loop="$loop"></belich::panel>
            @endif
        </div>
    @endforeach
</div>

{{-- Custom active tab --}}
@push('css')
    <style>
        .tabs li a {
            background-color: white;
            border: 0;
            border-bottom: 2px solid var(--20);
            margin: 0 1px;
        }
        .tabs li a.active {
            font-weight: 700;
            color: #3490dc;
            border-bottom: 2px solid #3490dc;
        }
    </style>
@endpush
