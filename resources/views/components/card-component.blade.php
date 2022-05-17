@props(['header', 'title'])

<div class="col-md">
    <div class="card text-center">
        <h5 class="card-header py-3">{{ $header }}</h5>
        <div class="card-body py-4">
            <h2 class="card-title">{{ $title }}</h2>
        </div>
    </div>
</div>
