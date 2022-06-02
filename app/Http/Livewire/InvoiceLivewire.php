<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;

class InvoiceLivewire extends Component
{

    use WithPagination;

    protected string $paginationTheme = 'bootstrap';
    public array $data = [];
    public ?Invoice $invoiceId = null;

    public function render()
    {
        $invoices  = Invoice::orderBy('inv_ref')->paginate(10);
        $customers = Customer::orderBy('name')->get();

        return view('livewire.invoice', [
            'invoices'  => $invoices,
            'customers' => $customers,
        ]);
    }

    public function newInvoice(): void
    {
        $this->data = [];
        $this->emit('resetInvoiceItem');
        $this->dispatchBrowserEvent('showModal');
    }

    public function createInvoice(): void
    {
        $validatedData = Validator::validate($this->data, [
            'inv_ref'          => 'required|unique:invoices,inv_ref,NULL,id,inv_date,'
                                  .($this->data['inv_date'] ?? ''),
            'inv_date'         => 'required|date',
            'customer_id'      => 'required|integer',
            'chal_no'          => 'nullable',
            'chal_date'        => 'sometimes|date',
            'po_no'            => 'nullable',
            'transporter_name' => 'sometimes|string',
            'lr_no'            => 'nullable',
            'vehicle_no'       => 'nullable',
        ]);
        $this->emit('createInvoiceItem', $validatedData);
    }

    public function printInvoice(Invoice $invoice)
    {
        $invoice->load([
            'customer'     => fn($q) => $q->with('state'),
            'invoiceItems' => fn($q) => $q->with([
                'unit',
                'inventory' => fn($q) => $q->with('category', 'tax'),
            ]),
        ]);

        $pdf = Pdf::loadView('templates.print', [
            'invoice' => $invoice,
        ])->output();

        return response()->streamDownload(fn() => print($pdf), "Invoice_{$invoice->inv_ref}.pdf");
    }

    public function summaryInvoice($startDate, $endDate)
    {
        $invoices = Invoice::with('customer')
                           ->whereBetween('inv_date', [$startDate, $endDate])
                           ->get();

        $pdf = Pdf::loadView('templates.summary', [
            'startDate' => new Carbon($startDate),
            'endDate' => new Carbon($endDate),
            'invoices' => $invoices,
        ])->output();

        return response()->streamDownload(fn() => print($pdf), "Invoice_Summary_{$startDate}_to_{$endDate}.pdf");
    }

    public function confirmDelete(Invoice $invoice)
    {
        $this->invoiceId = $invoice;
        $this->dispatchBrowserEvent('deleteModal');
    }

    public function deleteInvoice()
    {
        $this->invoiceId->delete();
    }

}
