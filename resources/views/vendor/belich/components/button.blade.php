@isset($url)
    <a
        {!! isset($id) ? 'id="' . $id . '"' : '' !!}
        href="{{ $url ?? '#' }}"
        class="btn btn-{{ $color ?? 'secondary' }} {{ $class ?? '' }} ml-2"
        data-title="{{ $title }}"
        {!! isset($loading) ? 'onclick="loading(this);"' : '' !!}
        {!! isset($onclick) ? 'onclick="' . $onclick . '"' : '' !!}
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
        {!! isset($onclick) ? 'onclick="' . $onclick . '"' : '' !!}
    >
        {!! $title !!}
    </button>
@endif
