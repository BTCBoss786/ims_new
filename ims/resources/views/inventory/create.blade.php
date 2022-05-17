@extends('layouts.main')
@section('content')
<section class="container-fluid">
   <div class="row">
      <div class="col">
         @include('partials.breadcrumb')
         <div class="card mt-4">
            <div class="card-header h5">
               Add Inventory
               {{ route() }}
            </div>
            <div class="card-body">
               <form action="{{ route('inventory.store') }}" method="post">
                  @csrf
                  <div class="row mb-3">
                     <div class="col-md-6">
                        <label for="name" class="form-label">Inventory Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                           <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                     </div>
                     <div class="col-md-6">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" name="description" id="description" value="{{ old('description') }}" class="form-control @error('description') is-invalid @enderror">
                        @error('description')
                           <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                     </div>
                  </div>
                  <div class="row mb-3">
                     <div class="col-md-6">
                        <label for="hsn" class="form-label">HSN Code</label>
                        <input type="text" name="hsn" id="hsn" value="{{ old('hsn') }}" class="form-control @error('hsn') is-invalid @enderror">
                        @error('hsn')
                           <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                     </div>
                     <div class="col-md-6">
                        <label for="rate" class="form-label">Rate</label>
                        <input type="number" name="rate" id="rate" value="{{ old('rate') }}" class="form-control @error('rate') is-invalid @enderror" step="any">
                        @error('rate')
                           <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                     </div>
                  </div>
                  <div class="row mb-3">
                     <div class="col-md-6">
                        <label for="unit" class="form-label">Unit</label>
                        <select name="unit" id="unit" class="form-select @error('unit') is-invalid @enderror">
                           <option value="" selected hidden>Choose Unit...</option>
                           @forelse  ($units as $unit)
                              <option value="{{ $unit->id }}" {{ old('unit') == $unit->id ? "selected" : "" }}>{{ $unit->name }}</option>
                           @empty
                              <option value="">No Unit Available</option>
                           @endforelse
                        </select>
                        @error('unit')
                           <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                     </div>
                     <div class="col-md-6">
                        <label for="category" class="form-label">Category</label>
                        <select name="category" id="category" class="form-select @error('category') is-invalid @enderror">
                           <option value="" selected hidden>Choose Category...</option>
                           @forelse  ($categories as $category)
                              <option value="{{ $category->id }}" {{ old('category') == $category->id ? "selected" : "" }}>{{ $category->name }}</option>
                           @empty
                              <option value="">No Category Available</option>
                           @endforelse
                        </select>
                        @error('category')
                           <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                     </div>
                  </div>
                  <div class="row mb-3">
                     <div class="col-md-6">
                        <label for="tax" class="form-label">Tax Rate</label>
                        <select name="tax" id="tax" class="form-select @error('tax') is-invalid @enderror">
                           <option value="" selected hidden>Choose Tax...</option>
                           @forelse  ($taxes as $tax)
                              <option value="{{ $tax->id }}" {{ old('tax') == $tax->id ? "selected" : "" }}>{{ $tax->rate . '%' }}</option>
                           @empty
                              <option value="">No Tax Available</option>
                           @endforelse
                        </select>
                        @error('tax')
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