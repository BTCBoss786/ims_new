@extends('layouts.main')
@section('content')
<section class="container-fluid">
   <div class="row">
      <div class="col">
         @include('partials.breadcrumb')
         @can('subscribed')
         <div class="row mb-1">
            <div class="col text-end">
               <a href="{{ route('invoice.create') }}" class="btn btn-info">New Invoice</a>
            </div>
         </div>   
         @endcan
         <div class="row mb-1">
            <div class="col text-center">
               @if (session('status'))
                  <span class="alert alert-success py-2">{{ session('status') }}</span>
               @endif
            </div>
         </div>
         <div class="row">
            <div class="col">
               <h4 class="mb-1">Manage Invoices</h4>
               <div class="table-responsive">
                  <table class="table align-middle table-bordered table-hover">
                     <thead>
                        <tr>
                           <th scope="col">#</th>
                           <th scope="col">Date</th>
                           <th scope="col">Ref</th>
                           <th scope="col">Customer Name</th>
                           <th scope="col">Amount</th>
                           <th scope="col">Tax</th>
                           <th scope="col">Options</th>
                        </tr>
                     </thead>
                     <tbody>
                        @forelse ($invoices as $invoice)
                        <tr>
                           <th scope="row">{{ $loop->iteration + $invoices->firstItem() - 1 }}</th>
                           <td>{{ $invoice->inv_date->format('d-m-Y') }}</td>
                           <td>{{ $invoice->inv_ref }}</td>
                           <td>{{ $invoice->customer->name }}</td>
                           <td>{{ money($invoice->grand_total) }}</td>
                           <td>{{ money($invoice->tax) }}</td>
                           <td class="d-flex">
                              <a href="{{ route('invoice.show', $invoice->id) }}" class="btn btn-secondary">Show</a>
                           </td>
                        </tr>
                        @empty
                        <tr>
                           <td score="row" colspan="7" class="text-center">No Invoice Available</td>
                        </tr>
                        @endforelse
                     </tbody>
                  </table>
               </div>
            </div>
            <div class="row mt-2">
               <div class="col">
                  <div class="d-flex justify-content-center">
                     {{ $invoices->links() }}
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
@endsection