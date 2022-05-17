@extends('layouts.main')
@section('content')
<section class="container-fluid">
   <div class="row">
      <div class="col">
         @include('partials.breadcrumb')
         <div class="my-3 text-end">
            <a href="javascript:print()" class="btn btn-success">Print</a>
         </div>
         <div id="printable">
            <table class="table table-bordered table-condensed mb-0" style="font-family: 'Arial'">
               <tr>
                  <td class="text-center position-relative" colspan="6">
                     <img src="{{ Storage::url('logo.png') }}" alt="" height="85" class="position-absolute top-50 start-0 ms-4 translate-middle-y">
                     <span class="fw-bold fs-4"><u>PRATIK NARROW FABRICS</u></span> <br>
                     <span>Shed No. L/244/10, Near Goal Canteen, GIDC, Umbergaon, Gujarat - 396171</span> <br>
                     <span>Contact No.: +91 9967683293 | Email: pratikdsnirwan@gmail.com</span> <br>
                     <span>State Code of Company: 24</span> <br>
                     <span class="fw-bold">GSTIN / UIN of Company: 24AMPPN8721N1ZD</span>
                  </td>
               </tr>
               <tr>
                  <td rowspan="8" style="width: 45%">
                     <span class="fw-bold"><u>CUSTOMER DETAILS:</u></span> <br>
                     <span class="fw-bold">{{ $invoiceData->customer->name }}</span> <br>
                     <span>{{ $invoiceData->customer->address1 }}</span> <br>
                     <span>{{ $invoiceData->customer->address2 }}</span> <br>
                     <span>{{ $invoiceData->customer->city . ' - ' . $invoiceData->customer->state->name }}</span> <br>
                     <span><strong>State Code:</strong> {{ $sc = $invoiceData->customer->state->code }}</span> <br>
                     <span><strong>GSTIN/UIN:</strong> {{ $invoiceData->customer->gstin }}</span> <br>
                     <span><strong>Amount of Tax Subject to Reverse Charge:</strong> {{ ($invoiceData->reverse_charge) ? 'Yes' : 'No' }}</span> <br>
                  </td>
               </tr>
               <tr>
                  <td style="width: 16%">Challan No.:</td>
                  <td style="width: 13%">{{ $invoiceData->chal_no ?? '-' }}</td>
                  <td rowspan="2" class="align-middle" style="width: 13%">Invoice No.:</td>
                  <td rowspan="2" class="align-middle" style="width: 13%">{{ $invoiceData->inv_ref ?? '-' }}</td>
               </tr>
               <tr>
                  <td>Challan Date:</td>
                  <td>{{ $invoiceData->chal_date ? $invoiceData->chal_date->format('d-m-Y') : '-' }}</td>
               </tr>
               <tr>
                  <td>Order <br>Reference:</td>
                  <td class="align-middle">{{ $invoiceData->po_no ?? '-' }}</td>
                  <td class="align-middle">Invoice Date:</td>
                  <td class="align-middle">{{ $invoiceData->inv_date ? $invoiceData->inv_date->format('d-m-Y') : '-' }}</td>
               </tr>
               <tr>
                  <td>Transport Name:</td>
                  <td colspan="3">{{ $invoiceData->transporter_name ?? '-' }}</td>
               </tr>
               <tr>
                  <td>LR No.:</td>
                  <td colspan="3" class="position-relative">{{ $invoiceData->lr_no ?? '-' }} <span class="position-absolute top-50 end-0 me-2 translate-middle-y">Customer's Copy &#11036;</span></td>
               </tr>
               <tr>
                  <td>Vehicle No.:</td>
                  <td colspan="3" class="position-relative">{{ $invoiceData->vehicle_no ?? '-' }} <span class="position-absolute top-50 end-0 me-2 translate-middle-y">Transporter's Copy &#11036;</span></td>
               </tr>
               <tr>
                  <td>Remarks:</td>
                  <td colspan="3" class="position-relative">- <span class="position-absolute top-50 end-0 me-2 translate-middle-y">Extra's Copy &#11036;</span></td>
               </tr>
            </table>
            <table class="table table-bordered table-condensed mb-0" style="font-family: 'Arial'">
               <tr class="align-middle text-center">
                  <th>Sr. <br>No.</th>
                  <th style="width: 40%">Description of Goods</th>
                  <th>HSN <br>Code</th>
                  <th>Qty</th>
                  <th>Rate</th>
                  <th>Disc</th>
                  <th>Taxable <br>Value</th>
                  <th>GST <br>Rate</th>
                  <th>Total <br>Amount</th>
               </tr>
               @for ($i = 0; $i < 8; $i++)
                  @if ($i < $invoiceData->invoiceItems->count())
                  <tr class="border-bottom-0 border-top-0">
                     <td class="text-center">{{ $i+1 }}</td>
                     <td>{{ $invoiceData->invoiceItems[$i]->inventory->name }} <br>{!! is_null($invoiceData->invoiceItems[$i]->inventory->description) ? '&nbsp;' : '(' . $invoiceData->invoiceItems[$i]->inventory->description . ')' !!}</td>
                     <td class="text-center">{{ $invoiceData->invoiceItems[$i]->inventory->hsn }}</td>
                     <td class="text-end">{{ ($invoiceData->invoiceItems[$i]->inventory->unit->name == 'NA' ? '-' : $invoiceData->invoiceItems[$i]->qty . ' ' .  $invoiceData->invoiceItems[$i]->inventory->unit->name) }}</td>
                     <td class="text-end">{{ money($invoiceData->invoiceItems[$i]->rate, false) }}</td>
                     <td class="text-center">{{ $invoiceData->invoiceItems[$i]->disc == 0 ? '-' : $invoiceData->invoiceItems[$i]->disc . '%' }}</td>
                     <td class="text-end">{{ money($invoiceData->invoiceItems[$i]->value, false) }}</td>
                     <td class="text-center">{{ $invoiceData->invoiceItems[$i]->inventory->tax->rate == 0 ? '-' : $invoiceData->invoiceItems[$i]->inventory->tax->rate . '%' }}</td>
                     <td class="text-end">{{ money($invoiceData->invoiceItems[$i]->total, false) }}</td>
                  </tr>
                  @else
                  <tr class="border-bottom-0 border-top-0">
                     <td class="text-center">&nbsp; <br>&nbsp;</td>
                     <td></td>
                     <td class="text-center"></td>
                     <td class="text-end"></td>
                     <td class="text-end"></td>
                     <td class="text-center"></td>
                     <td class="text-end"></td>
                     <td class="text-center"></td>
                     <td class="text-end"></td>
                  </tr>
                  @endif
               @endfor
               <tr>
                  <th colspan="5">Amount in Words:</th>
                  <td colspan="2" class="text-end fw-bold">Total</td>
                  <td colspan="2" class="fw-bold text-end">{{ money($invoiceData->total, false) }}</td>
               </tr>
               <tr>
                  <td rowspan="3" colspan="5">{{ spell($invoiceData->grand_total) }}</td>
               </tr>
               <tr>
                  <td colspan="2" class="text-end fw-bold">Round Off</td>
                  <td colspan="2" class="fw-bold text-end">{{ money($invoiceData->round_off, false) }}</td>
               </tr>
               <tr>
                  <td colspan="2" class="text-end fw-bold py-1">Grand Total</td>
                  <td colspan="2" class="fw-bold text-end py-1">{{ money($invoiceData->grand_total) }}</td>
               </tr>
               <tr>
                  <td colspan="9">&nbsp;</td>
               </tr>
            </table>
            <table class="table table-bordered table-condensed mb-0" style="font-family: 'Arial'">
               <tr>
                  <th colspan="10">Detail of Tax:</th>
               </tr>
               <tr class="align-middle text-center">
                  <th rowspan="2">Sr <br> No</th>
                  <th rowspan="2">HSN Code</th>
                  <th rowspan="2">Taxable Value</th>
                  <th colspan="2">CGST</th>
                  <th colspan="2">SGST</th>
                  <th colspan="2">IGST</th>
                  <th rowspan="2">Total Tax Amount</th>
               </tr>
               <tr class="text-center">
                  <th>Rate</th>
                  <th>Amount</th>
                  <th>Rate</th>
                  <th>Amount</th>
                  <th>Rate</th>
                  <th>Amount</th>
               </tr>
               @for ($i = 0; $i < 5; $i++)
                  @if ($i < $invoiceData->invoiceItems->count())
                     <tr class="border-bottom-0 border-top-0">
                        <td class="text-center">{{ $i+1 }}</td>
                        <td class="text-center">{{ $invoiceData->invoiceItems[$i]->inventory->hsn }}</td>
                        <td class="text-end">{{ money($invoiceData->invoiceItems[$i]->value, false) }}</td>
                        <td class="text-center">
                           @if ($sc == 24) {{ ($invoiceData->invoiceItems[$i]->inventory->tax->rate / 2) . '%' }} @endif
                        </td>
                        <td class="text-end">
                           @if ($sc == 24) {{ money($invoiceData->invoiceItems[$i]->tax / 2, false) }} @endif
                        </td>
                        <td class="text-center">
                           @if ($sc == 24) {{ ($invoiceData->invoiceItems[$i]->inventory->tax->rate / 2) . '%' }} @endif
                        </td>
                        <td class="text-end">
                           @if ($sc == 24) {{ money($invoiceData->invoiceItems[$i]->tax / 2, false) }} @endif
                        </td>
                        <td class="text-center">
                           @if ($sc != 24) {{ $invoiceData->invoiceItems[$i]->inventory->tax->rate . '%' }} @endif
                        </td>
                        <td class="text-end">
                           @if ($sc != 24) {{ money($invoiceData->invoiceItems[$i]->tax, false) }} @endif
                        </td>
                        <td class="text-end">{{ money($invoiceData->invoiceItems[$i]->tax, false) }}</td>
                     </tr>
                  @else
                     <tr class="border-bottom-0 border-top-0">
                        <td class="text-center">{{ $i+1 }}</td>
                        <td class="text-center"></td>
                        <td class="text-end"></td>
                        <td class="text-center"></td>
                        <td class="text-end"></td>
                        <td class="text-center"></td>
                        <td class="text-end"></td>
                        <td class="text-center"></td>
                        <td class="text-end"></td>
                        <td class="text-end"></td>
                     </tr>
                  @endif
               @endfor
               <tr>
                  <th class="text-end" colspan="3">Total</th>
                  <th class="text-end" colspan="2">
                     @if ($sc == 24) {{ money($invoiceData->tax / 2) }} @endif
                  </th>
                  <th class="text-end" colspan="2">
                     @if ($sc == 24) {{ money($invoiceData->tax / 2) }} @endif
                  </th>
                  <th class="text-end" colspan="2">
                     @if ($sc != 24) {{ money($invoiceData->tax) }} @endif
                  </td>
                  <th class="text-end">{{ money($invoiceData->tax) }}</th>
               </tr>
               <tr>
                  <th colspan="2">Tax Amount in Words: </th>
                  <td colspan="8">{{ spell($invoiceData->tax) }}</td>
               </tr>
               <tr>
                  <td colspan="10">&nbsp;</td>
               </tr>
            </table>
            <table class="table table-bordered table-condensed" style="font-family: 'Arial'">
               <tr class="border-bottom-0">
                  <th><u>Company's Bank Detail:</u></th>
                  <td class="text-center w-25">E & OE</td>
               </tr>
               <tr class="border-bottom-0 border-top-0">
                  <td><strong>Bank Name & Branch: </strong> Union Bank of India, Umbergaon</td>
                  <th class="text-center">For Pratik Narrow Fabrics</th>
               </tr>
               <tr class="border-bottom-0 border-top-0">
                  <td><strong>IFSC Code: </strong> UBIN0541362</td>
                  <td></td>
               </tr>
               <tr class="border-bottom-0 border-top-0">
                  <td><strong>Account No: </strong> 413605010800048</td>
                  <td></td>
               </tr>
               <tr class="border-top-0">
                  <td>
                     <small>
                        <u>Terms & Conditions: </u><br>
                        1) Interest @ 24% will be charged if payment not made in 30 days. <br>
                        2) If consignment is short, please refuse to receive that material until the came agent notes the shortage in writing. <br>
                        3) We pack & check the goods carefully & are not responsible for damage or theft in transit. <br>
                        4) Subject to Umbergaon Jurisdiction.
                     </small>
                  </td>
                  <td class="align-bottom text-center">Authorized Signatory</td>
               </tr>
            </table>
         </div>
      </div>
   </div>
</section>
@endsection
@push('script')
<script>
   function print() {
      let win = window.open();
      win.document.write('<html><head><title>{{ "Tax Invoice - " . $invoiceData->inv_ref }}</title><link rel="stylesheet" type="text/css" href="{{ asset("css/app.css") }}"></head><body>');
      win.document.write(document.querySelector('#printable').innerHTML);
      win.document.write('</body></html>');
      let printDiv = win.document.body;
      printDiv.style.cssText = 'background: white;';
      printDiv.querySelector('img').style.cssText = 'height: 60px; margin-left: .7rem !important;';
      printDiv.querySelectorAll('table')[0].style.cssText = 'border: 1px solid black; line-height: 1.14rem; font-size: 0.8rem;';
      printDiv.querySelectorAll('table')[1].style.cssText = 'border: 1px solid black; line-height: 1.14rem; font-size: 0.8rem;';
      printDiv.querySelectorAll('table')[2].style.cssText = 'border: 1px solid black; line-height: 1.14rem; font-size: 0.8rem;';
      printDiv.querySelectorAll('table')[3].style.cssText = 'border: 1px solid black; line-height: 1.14rem; font-size: 0.8rem;';
      printDiv.querySelector('td').style.paddingTop = '.5rem';
      printDiv.querySelector('table:last-child tr td').style.width = '30%';
      printDiv.querySelector('table:nth-child(3) tr:nth-child(10) th').setAttribute('colspan', 3);
      printDiv.querySelector('small').closest('td').style.cssText = 'line-height: .7rem;';
      win.setTimeout(() => {
         win.print();
         win.close();
      }, 100);
   }
</script>
@endpush