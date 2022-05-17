@extends('layouts.main')
@section('content')
<section class="container-fluid">
   <div class="row">
      <div class="col">
         @include('partials.breadcrumb')
         <div class="card mt-4">
            <div class="card-header h5">
               Add Customer
            </div>
            <div class="card-body">
               <form action="{{ route('customer.store') }}" method="post">
                  @csrf
                  <div class="row mb-3">
                     <div class="col-md-6">
                        <label for="name" class="form-label">Customer Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                           <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                     </div>
                     <div class="col-md-6">
                        <label for="gstin" class="form-label">GSTIN</label>
                        <input type="text" name="gstin" id="gstin" value="{{ old('gstin') }}" class="form-control @error('gstin') is-invalid @enderror">
                        @error('gstin')
                           <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                     </div>
                  </div>
                  <div class="row mb-3">
                     <div class="col-md-6">
                        <label for="address1" class="form-label">Address Line 1</label>
                        <input type="text" name="address1" id="address1" value="{{ old('address1') }}" class="form-control @error('address1') is-invalid @enderror">
                        @error('address1')
                           <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                     </div>
                     <div class="col-md-6">
                        <label for="address2" class="form-label">Address Line 2</label>
                        <input type="text" name="address2" id="address2" value="{{ old('address2') }}" class="form-control @error('address2') is-invalid @enderror">
                        @error('address2')
                           <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                     </div>
                  </div>
                  <div class="row mb-3">
                     <div class="col-md-6">
                        <label for="city" class="form-label">City</label>
                        <input type="text" name="city" id="city" value="{{ old('city') }}" class="form-control @error('city') is-invalid @enderror">
                        @error('city')
                           <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                     </div>
                     <div class="col-md-6">
                        <label for="state" class="form-label">State</label>
                        <select name="state" id="state" class="form-select @error('state') is-invalid @enderror">
                           <option value="" selected hidden>Choose State...</option>
                           @forelse  ($states as $state)
                              <option value="{{ $state->id }}" {{ old('state') == $state->id ? "selected" : "" }}>{{ $state->code . ' - ' . $state->name }}</option>
                           @empty
                              <option value="">No State Available</option>
                           @endforelse
                        </select>
                        @error('state')
                           <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                     </div>
                  </div>
                  <div class="row">
                     <div class="col">
                        <button type="submit" class="btn btn-primary">Create</button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</section>
@endsection