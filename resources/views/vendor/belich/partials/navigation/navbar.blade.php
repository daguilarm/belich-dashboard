{{-- This section is segregate in case you want to customize --}}
<nav id="navbar" class="h-16 {{ config('belich.navbar') === 'top' ? 'bg-teal-light' : 'bg-white' }}">
    {!!
        Belich::navbar()
            ->get();
    !!}
</nav>

