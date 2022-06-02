@props(['data', 'label' => null, 'id', 'event' => null])

<div class="col-md">
    @if($label)
        <label for="{{ $id }}" class="form-label">{{ $label }}</label>
    @endif
    @if($event)
        <select id="{{ $id }}" class="form-select @error($id) is-invalid @enderror" wire:model.lazy="data.{{ $id }}">
    @else
        <select id="{{ $id }}" class="form-select @error($id) is-invalid @enderror" wire:model.defer="data.{{ $id }}">
    @endif
        <option value="" hidden>Choose {{ $label }}...</option>
        @forelse($data as $val)
            @if($val->code)
                <option value="{{ $val->id }}">{{ $val->code . ' - ' . $val->name }}</option>
            @elseif($val->description)
                <option value="{{ $val->id }}">{{ $val->name . ' - ' . $val->description }}</option>
            @else
                <option value="{{ $val->id }}">{{ $val->name ?? ($val->rate.'%') }}</option>
            @endif
        @empty
            <option value="">Not Available</option>
        @endforelse
    </select>
    @error($id)
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
