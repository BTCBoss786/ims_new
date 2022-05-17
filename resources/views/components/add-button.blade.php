@props(['title'])

<div class="col text-end">
    <button {{ $attributes }} class="btn btn-info">
        <i class="fa-solid fa-circle-plus pe-1"></i>
        {{ $title }}
    </button>
</div>
