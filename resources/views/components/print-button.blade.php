@props(['title'])

<button {{ $attributes }} class="btn btn-warning">
    <i class="fa-solid fa-print pe-1"></i>
    {{ $title }}
</button>
