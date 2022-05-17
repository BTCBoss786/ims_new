<div>

    <div class="row pt-5 pb-0">
        <x-add-button title="New Inventory" wire:click.prevent="newInventory"/>
    </div>

    <div class="row pt-0">
        <div class="col">
            <h6>Manage Inventories</h6>
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
                            <td>{{ $inventory->description }}</td>
                            <td>{{ $inventory->hsn }}</td>
                            <td>@money($inventory->rate)</td>
                            <td class="text-center">
                                <x-edit-button wire:click.prevent="editInventory({{ $inventory }})" title="Edit"/>
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
    </div>

    <div class="row pb-5">
        <div class="col">
            {{ $inventories->links() }}
        </div>
    </div>

    <div class="modal fade" id="inventoryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="inventoryModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <form autocomplete="off" wire:submit.prevent="{{ $isEdit ? 'updateInventory' : 'createInventory' }}">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $isEdit ? 'Edit Inventory' : 'Add Inventory' }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <x-input-text label="Inventory Name" id="name" maxlength="25"/>
                            <x-input-text label="Description" id="description" maxlength="25"/>
                        </div>
                        <div class="row mb-3">
                            <x-input-text label="HSN Code" id="hsn" maxlength="8"/>
                            <x-input-text label="Rate" id="rate"/>
                        </div>
                        <div class="row mb-3">
                            <x-input-select label="Unit" id="unit_id" :data="$units"/>
                            <x-input-select label="Category" id="category_id" :data="$categories"/>
                        </div>
                        <div class="row mb-3">
                            <x-input-select label="Tax Rate" id="tax_id" :data="$taxes"/>
                            <div class="col-md-6"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times pe-1"></i>
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save pe-1"></i>
                            {{ $isEdit ? 'Save Changes' : 'Save' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>


@push('scripts')
    <script>
        $(document).on({
            'showModal': () => {
                $('#inventoryModal').modal('show');
            },
            'hideModal': (e) => {
                $('#inventoryModal').modal('hide');
                Swal.fire(
                    'Success',
                    e.detail.msg,
                    'success'
                )
            }
        })
    </script>
@endpush
