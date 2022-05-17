<div class="row">
    <div class="col">
        @error('inventory.*')
            <span class="alert alert-danger py-1">The inventory details required.</span>
        @enderror
        <div class="table-responsive">
            <table class="table align-middle table-hover table-bordered">
                <thead>
                    <tr>
                    <th scope="col">Inventory Name</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Rate</th>
                    <th scope="col">Disc(%)</th>
                    <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $index => $product)
                        <tr>
                            <td>
                            <select name="inventory[{{ $index }}][id]" wire:model="products.{{ $index }}.id" class="form-select">
                                <option value="" selected hidden>Select Inventory...</option>
                                @forelse  ($inventories as $inventory)
                                    <option value="{{ $inventory->id }}">{{ $inventory->name . (is_null($inventory->description) ? '' : ' - ' . $inventory->description) }}</option>
                                @empty
                                    <option value="">No Inventory Available</option>
                                @endforelse
                            </select>
                            </td>
                            <td><input type="number" name="inventory[{{ $index }}][qty]" wire:model="products.{{ $index }}.qty" class="form-control" min="0" step="any"></td>
                            <td><input type="number" name="inventory[{{ $index }}][rate]" wire:model="products.{{ $index }}.rate" class="form-control" min="0" step="any"></td>
                            <td><input type="number" name="inventory[{{ $index }}][disc]" wire:model="products.{{ $index }}.disc" class="form-control" min="0" max="100" step="any"></td>
                            <td class="d-flex">
                                <a href="#" wire:click.prevent="addProduct" class="btn btn-success me-1">+</a>
                                <a href="#" wire:click.prevent="removeProduct({{ $index }})" class="btn btn-danger">-</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
       </div>
    </div>
 </div>