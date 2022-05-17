<div class="row mb-1">
   <div class="col">
      <div style="--bs-breadcrumb-divider: '>'">
         <ol class="breadcrumb mb-0">
            @if ($segments = Request::segments())
               <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
               @foreach ($segments as $segment)
                  @if ($loop->last)
                     <li class="breadcrumb-item active">{{ Str::ucfirst($segment) }}</li>
                  @elseif ($loop->first)
                     <li class="breadcrumb-item"><a href="{{ route($segment . '.index') }}">{{ Str::ucfirst($segment) }}</a></li>
                  @endif
               @endforeach
            @else
               <li class="breadcrumb-item active">Dashboard</li> 
            @endif
         </ol>
      </div>
   </div>
</div>