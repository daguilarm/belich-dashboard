@isset($url)
    <a
        {!! isset($id) ? 'id="' . $id . '"' : '' !!}
        href="{{ $url ?? '#' }}"
        class="btn btn-{{ $color ?? 'secondary' }} {{ $class ?? '' }} ml-2"
        data-title="{{ $title }}"
        {!! isset($loading) ? 'onclick="loading(this);"' : '' !!}
    >
        {!! $title !!}
    </a>
@else
    <button
        {!! isset($id) ? 'id="' . $id . '"' : '' !!}
        type="{{ $type ?? 'button' }}"
        class="btn btn-{{ $color ?? 'secondary' }} mx-2 {{ $class ?? '' }} ml-4"
        data-title="{{ $title }}"
        {!! isset($loading) ? 'onclick="loading(this);"' : '' !!}
    >
        {!! $title !!}
    </button>
@endif

@push('javascript')
    {{-- Global Javascript --}}
    <script>
        function loading(item, event) {
            item.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            event.stopPropagation();
        }
    </script>
@endpush
