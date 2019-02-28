{{-- If the model results has been trashed --}}
@hasSoftdeletedResults($model)
    {{-- The user can restore trashed items --}}
    @can('restore', $model)
        <a href="{{ Belich::actionRoute('restore', $model) }}" class="action">@actionIcon('redo')</a>
    @endcan
    {{-- The user can force delete trashed items --}}
    @can('forceDelete', $model)
        <a href="{{ Belich::actionRoute('forceDelete', $model) }}" class="action bg-red-lightest rounded-full">@actionIcon('trash-alt')</a>
    @endcan

{{-- Regular model results --}}
@else
    @can('view', $model)
        <a href="{{ Belich::actionRoute('show', $model) }}" class="action">@actionIcon('eye')</a>
    @endcan

    @can('update', $model)
        <a href="{{ Belich::actionRoute('edit', $model) }}" class="action">@actionIcon('edit')</a>
    @endcan

    @can('delete', $model)
        <a href="#modal-item-delete" data-id="{{ $model->id }}" class="action" onclick="deleteField('form-item-delete', '{{ Belich::actionRoute('destroy', $model) }}');">
            @actionIcon('trash')
        </a>
    @endcan
@endif
