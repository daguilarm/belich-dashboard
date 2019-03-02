<div class="form-group">
    <div class="form-inline-label">
        <label>{{ $label ?? null }}</label>
    </div>
    <div class="form-inline-field">
        {{-- Displaying the field --}}
        {{ $field ?? null }}

        {{-- Displaying the helping text --}}
        {{ $help ?? null }}
    </div>
</div>
