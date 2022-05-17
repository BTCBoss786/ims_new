<div>

    @if(date('d-m-Y') <= '31-03-2022')
    <div class="row pt-5 pb-0">
        <x-add-button title="New Invoice" wire:click.prevent="newInvoice"/>
    </div>
    @endif

    <div class="row pt-0">
        <div class="col">
            <h6>Manage Invoices</h6>
            <div class="table-responsive">
                <table class="table align-middle table-bordered table-hover">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Date</th>
                        <th scope="col">Reference</th>
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
                            <td>@money($invoice->grand_total)</td>
                            <td>@money($invoice->tax)</td>
                            <td class="text-center">
                                <x-print-button wire:click.prevent="printInvoice({{ $invoice }})" title="Print"/>
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
    </div>

    <div class="row pb-5">
        <div class="col">
            {{ $invoices->links() }}
        </div>
    </div>

    <div class="modal fade" id="invoiceModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="invoiceModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <form autocomplete="off" wire:submit.prevent="createInvoice">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Invoice</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <x-input-select label="Customer Name" id="customer_id" :data="$customers"/>
                            <x-input-text label="Invoice No" id="inv_ref" maxlength="8"/>
                            <x-input-date label="Invoice Date" id="inv_date"/>
                        </div>
                        <div class="row mb-3">
                            <x-input-text label="Challan No" id="chal_no" maxlength="10"/>
                            <x-input-date label="Challan Date" id="chal_date"/>
                            <x-input-text label="Purchase Order No" id="po_no" maxlength="10"/>
                        </div>
                        <div class="row mb-3">
                            <x-input-text label="Transporter Name" id="transporter_name" maxlength="30"/>
                            <x-input-text label="LR No" id="lr_no" maxlength="15"/>
                            <x-input-text label="Vehicle No" id="vehicle_no" maxlength="10"/>
                        </div>
                        <livewire:invoice-items-livewire />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times pe-1"></i>
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save pe-1"></i>
                            Generate
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
                $('#invoiceModal').modal('show');
            },
            'hideModal': (e) => {
                $('#invoiceModal').modal('hide');
                Swal.fire(
                    'Success',
                    e.detail.msg,
                    'success'
                )
                @this.call('$refresh')
            }
        })
    </script>
@endpush
