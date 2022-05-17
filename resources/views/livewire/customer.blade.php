<div>

    <div class="row pt-5 pb-0">
        <x-add-button title="New Customer" wire:click.prevent="newCustomer"/>
    </div>

    <div class="row pt-0">
        <div class="col">
            <h6>Manage Customers</h6>
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
                            <td class="text-center">
                                <x-edit-button wire:click.prevent="editCustomer({{ $customer }})" title="Edit"/>
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
    </div>

    <div class="row pb-5">
        <div class="col">
            {{ $customers->links() }}
        </div>
    </div>

    <div class="modal fade" id="customerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="customerModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <form autocomplete="off" wire:submit.prevent="{{ $isEdit ? 'updateCustomer' : 'createCustomer' }}">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $isEdit ? 'Edit Customer' : 'Add Customer' }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <x-input-text label="Customer Name" id="name" maxlength="30"/>
                            <x-input-text label="GSTIN" id="gstin" maxlength="15"/>
                        </div>
                        <div class="row mb-3">
                            <x-input-text label="Address Line 1" id="address1" maxlength="35"/>
                            <x-input-text label="Address Line 2" id="address2" maxlength="35"/>
                        </div>
                        <div class="row mb-3">
                            <x-input-text label="City" id="city" maxlength="20"/>
                            <x-input-select label="State" id="state_id" :data="$states"/>
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
                $('#customerModal').modal('show');
            },
            'hideModal': (e) => {
                $('#customerModal').modal('hide');
                Swal.fire(
                    'Success',
                    e.detail.msg,
                    'success'
                )
            }
        })
    </script>
@endpush
