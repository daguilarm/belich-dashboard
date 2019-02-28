<div class="flex w-full justify-end bg-{{ $background ?? 'grey-lightest' }} border-b border-grey-lighter shadow-md p-4 px-6">
    <a href="{{ $url }}" class="btn btn-{{ $color ?? 'secondary' }}" {!! isset($loading) ? 'onclick="loading(this);"' : '' !!}>
        {!! $title !!}
    </a>
</div>
