@extends('layouts.main')
@section('content')
<section class="container-fluid">
   <div class="row">
      <div class="col">
         @include('partials.breadcrumb')
         <div class="row mb-1">
            <div class="col text-end">
               <a href="{{ route('inventory.create') }}" class="btn btn-info">Add Inventory</a>
            </div>
         </div>
         <div class="row mb-1">
            <div class="col text-center">
               @if (session('status'))
                  <span class="alert alert-success py-2">{{ session('status') }}</span>
               @endif
            </div>
         </div>
         <div class="row">
            <div class="col">
               <h4 class="mb-1">Manage Inventories</h4>
               <div class="table-responsive">
                  <table class="table align-middle table-bordered table-hover">
                     <thead>
                        <tr>
                           <th scope="col">#</th>
                           <th scope="col">Inventory Name</th>
                           <th scope="col">Description</th>
                           <th scope="col">HSN Code</th>
                           <th scope="col">Rate</th>
                           <th scope="col">Options</th>
                        </tr>
                     </thead>
                     <tbody>
                        @forelse ($inventories as $inventory)
                        <tr>
                           <th scope="row">{{ $loop->iteration + $inventories->firstItem() - 1 }}</th>
                           <td>{{ $inventory->name }}</td>
                           <td>{{ $inventory->description ?? '-' }}</td>
                           <td>{{ $inventory->hsn }}</td>
                           <td>{{ money($inventory->rate) }}</td>
                           <td class="d-flex">
                              <a href="{{ route('inventory.edit', $inventory->id) }}" class="btn btn-warning me-1">Edit</a>
                              {{-- <form action="{{ route('inventory.destroy', $inventory->id) }}" method="post">
                                 @csrf
                                 @method('DELETE')
                                 <button type="submit" class="btn btn-danger">Delete</button>
                              </form> --}}
                           </td>
                        </tr>
                        @empty
                        <tr>
                           <td score="row" colspan="6" class="text-center">No Inventory Available</td>
                        </tr>
                        @endforelse
                     </tbody>
                  </table>
               </div>
            </div>
            <div class="row mt-2">
               <div class="col">
                  <div class="d-flex justify-content-center">
                     {{ $inventories->links() }}
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
@endsection