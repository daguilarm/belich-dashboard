{{-- <li> --}}
    <div class="flex items-center h-16 w-auto font-medium cursor-pointer {{ config('belich.navbar') === 'top' ? 'text-white' : 'text-grey-darker' }}">
        <div class="pr-4">@gravatar()</div>
        <div class="pr-1">{{ auth()->user()->name }}</div>
        <div class="pr-4">@icon('angle-down')</div>
    </div>
    <ul class="pin-r">
        <li class="bg-grey-lighter">
            <a href="{{ Belich::url() . '/profiles/' . auth()->user()->id }}" class="text-grey-darker hover:text-black">
                @icon('user', 'Profile')
            </a>
        </li>
        <li class="bg-grey-lighter">
            <a href="{{ route('logout') }}" class="text-grey-darker hover:text-black" onclick="event.preventDefault(); document.getElementById('dashboard-logout').submit();">
                @icon('times-circle', 'belich::buttons.base.logout')
            </a>
            <form id="dashboard-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
{{-- </li> --}}
