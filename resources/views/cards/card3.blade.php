<belich::card :card="$card">
    <slot name="content">
        <h1 class="mb-6">Card 3</h1>
        <div class="flex flex-wrap justify-center">
            {{ implode(',', $card->withMeta['users']) }}
        </div>
    </slot>
</belich::card>
