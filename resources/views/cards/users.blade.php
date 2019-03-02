<belich::card width="w-full">
    <slot name="content">
        <h1 class="mb-6">List of users</h1>
        <div class="flex flex-wrap justify-center">
            @foreach($users as $user)
                <div class="w-24 m-2 p-2 shadow text-center text-blue bg-grey-ligthest">{{ $user->name }}</div>
            @endforeach
        </div>
    </slot>
</belich::card>
