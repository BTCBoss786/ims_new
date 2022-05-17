@extends('layouts.main')
@section('content')
<section class="container-fluid">
   <div class="row">
      <div class="col">
         @include('partials.breadcrumb')
         <div class="row mb-1">
            <div class="col text-end">
               <a href="{{ route('customer.create') }}" class="btn btn-info">Add Customer</a>
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
               <h4 class="mb-1">Manage Customers</h4>
               <div class="table-responsive">
                  <table class="table align-middle table-bordered table-hover">
                     <thead>
                        <tr>
                           <th scope="col">#</th>
                           <th scope="col">Customer Name</th>
                           <th scope="col">GSTIN</th>
                           <th scope="col">City</th>
                           <th scope="col">Options</th>
                        </tr>
                     </thead>
                     <tbody>
                        @forelse ($customers as $customer)
                        <tr>
                           <th scope="row">{{ $loop->iteration + $customers->firstItem() - 1 }}</th>
                           <td>{{ $customer->name }}</td>
                           <td>{{ $customer->gstin ?? '-' }}</td>
                           <td>{{ $customer->city }}</td>
                           <td class="d-flex">
                              <a href="{{ route('customer.edit', $customer->id) }}" class="btn btn-warning me-1">Edit</a>
                              {{-- <form action="{{ route('customer.destroy', $customer->id) }}" method="post">
                                 @csrf
                                 @method('DELETE')
                                 <button type="submit" class="btn btn-danger">Delete</button>
                              </form> --}}
                           </td>
                        </tr>
                        @empty
                        <tr>
                           <td score="row" colspan="5" class="text-center">No Customer Available</td>
                        </tr>
                        @endforelse
                     </tbody>
                  </table>
               </div>
            </div>
            <div class="row mt-2">
               <div class="col">
                  <div class="d-flex justify-content-center">
                     {{ $customers->links() }}
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
@endsection