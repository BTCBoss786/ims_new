@props(['label' => null, 'id'])
<div class="col-md">
    @if($label)
        <label for="{{ $id }}" class="form-label">{{ $label }}</label>
    @endif
    <input type="text" id="{{ $id }}" class="form-control @error($id) is-invalid @enderror" wire:model.defer="data.{{ $id }}" {{ $attributes }}>
    @error($id)
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
