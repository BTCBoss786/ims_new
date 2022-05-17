@extends('layouts.main')
@section('content')
<section class="container-fluid">
   <div class="row">
      <div class="col">
         @include('partials.breadcrumb')
         <div class="card mt-4">
            <div class="card-header h5">
               New Invoice
            </div>
            <div class="card-body">
               <form action="{{ route('invoice.store') }}" method="post">
                  @csrf
                  <div class="row mb-3">
                     <div class="col-md-6">
                        {{-- <label for="customer" class="form-label">State</label> --}}
                        <select name="customer" id="customer" class="form-select @error('customer') is-invalid @enderror">
                           <option value="" selected hidden>Select Customer...</option>
                           @forelse  ($customers as $customer)
                              <option value="{{ $customer->id }}" {{ old('customer') == $customer->id ? "selected" : "" }}>{{ $customer->name }}</option>
                           @empty
                              <option value="">No Customer Available</option>
                           @endforelse
                        </select>
                        @error('customer')
                           <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                     </div>
                     <div class="col-md-3">
                        {{-- <label for="inv_ref" class="form-label">Invoice Ref</label> --}}
                        <input type="text" name="inv_ref" id="inv_ref" value="{{ old('inv_ref') }}" class="form-control @error('inv_ref') is-invalid @enderror" placeholder="Invoice Ref">
                        @error('inv_ref')
                           <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                     </div>
                     <div class="col-md-3">
                        {{-- <label for="inv_date" class="form-label">Invoice Date</label> --}}
                        <input type="date" name="inv_date" id="inv_date" value="{{ old('inv_date') ?? date('Y-m-d') }}" class="form-control @error('inv_date') is-invalid @enderror" placeholder="Invoice Date">
                        @error('inv_date')
                           <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                     </div>
                  </div>
                  <div class="row mb-3">
                     <div class="col-md-6">
                        {{-- <label for="transporter_name" class="form-label">Transporter Name</label> --}}
                        <input type="text" name="transporter_name" id="transporter_name" value="{{ old('transporter_name') }}" class="form-control @error('transporter_name') is-invalid @enderror" placeholder="Transporter Name">
                        @error('transporter_name')
                           <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                     </div>
                     <div class="col-md-3">
                        {{-- <label for="chal_no" class="form-label">Challan No</label> --}}
                        <input type="text" name="chal_no" id="chal_no" value="{{ old('chal_no') }}" class="form-control @error('chal_no') is-invalid @enderror" placeholder="Challan No">
                        @error('chal_no')
                           <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                     </div>
                     <div class="col-md-3">
                        {{-- <label for="chal_date" class="form-label">Challan Date</label> --}}
                        <input type="date" name="chal_date" id="chal_date" value="{{ old('chal_date') }}" class="form-control @error('chal_date') is-invalid @enderror" placeholder="Challan Date">
                        @error('chal_date')
                           <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                     </div>
                  </div>
                  <div class="row mb-3">
                     <div class="col-md-3">
                        {{-- <label for="lr_no" class="form-label">LR No</label> --}}
                        <input type="text" name="lr_no" id="lr_no" value="{{ old('lr_no') }}" class="form-control @error('lr_no') is-invalid @enderror" placeholder="LR No">
                        @error('lr_no')
                           <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                     </div>
                     <div class="col-md-3">
                        {{-- <label for="vehicle_no" class="form-label">Vehicle No</label> --}}
                        <input type="text" name="vehicle_no" id="vehicle_no" value="{{ old('vehicle_no') }}" class="form-control @error('vehicle_no') is-invalid @enderror" placeholder="Vehicle No">
                        @error('vehicle_no')
                           <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                     </div>
                     <div class="col-md-3">
                        {{-- <label for="po_no" class="form-label">Purchase Order No</label> --}}
                        <input type="text" name="po_no" id="po_no" value="{{ old('po_no') }}" class="form-control @error('po_no') is-invalid @enderror" placeholder="Purchase Order No">
                        @error('po_no')
                           <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                     </div>
                     <div class="col-md-3">
                        <label class="form-label mb-0">Reverse Charge Applicable?</label>
                        <div class="form-check form-check-inline">
                           <input type="radio" name="reverse_charge" id="reverse_charge_yes" value="1" {{ old('reverse_charge') ? 'checked' : '' }} class="form-check-input @error('reverse_charge') is-invalid @enderror">
                           <label class="form-check-label" for="reverse_charge_yes">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                           <input type="radio" name="reverse_charge" id="reverse_charge_no" value="0" {{ old('reverse_charge') ? '' : 'checked' }} class="form-check-input @error('reverse_charge') is-invalid @enderror">
                           <label class="form-check-label" for="reverse_charge_no">No</label>
                        </div>
                        @error('reverse_charge')
                           <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                     </div>
                  </div>
                  @livewire('inventory-form')
                  <div class="row">
                     <div class="col">
                        <button type="submit" class="btn btn-primary">Generate</button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</section>
@endsection