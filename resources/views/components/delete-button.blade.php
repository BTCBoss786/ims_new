@props(['title'])

<button {{ $attributes }} class="btn btn-danger">
    <i class="fa-solid fa-trash pe-1"></i>
    {{ $title }}
</button>
