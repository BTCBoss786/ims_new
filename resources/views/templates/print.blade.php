<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style type="text/css">
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            padding: .5cm;
            font-family: 'DejaVu Sans';
            font-size: 13px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding-left: 4px;
            padding-right: 4px;
        }

        .border {
            border: 1px solid #000;
        }
    </style>
</head>
<body>
<table>
    <tr>
        <td class="border" style="text-align: center; border-bottom: 0; position: relative;">
            <img src="{{ public_path('/storage/logo.png') }}" alt="" width="123px" height="70px" style="position: absolute; top: 22px; left: 6px;">
            <strong style="font-size: 1.5rem; text-decoration: underline;">PRATIK NARROW FABRICS</strong> <br>
            <span>Shed No. L/244/10, Near Goal Canteen, GIDC, Umbergaon, Gujarat - 396171</span> <br>
            <span>Contact No.: +91 9967683293 | Email: pratikdsnirwan@gmail.com</span> <br>
            <span>State Code of Company: 24</span> <br>
            <span><strong>GSTIN / UIN of Company: 24AMPPN8721N1ZD</strong></span>
        </td>
    </tr>
</table>

<table style="width: 46%; float: left;">
    <tr>
        <td class="border" style="border-right: 0;">
            <strong style="text-decoration: underline; display: inline-block; padding-bottom: 6px;">CUSTOMER
                DETAILS:</strong> <br>
            <strong>{{ $invoice->customer->name }}</strong> <br>
            <span>{{ $invoice->customer->address1 }}</span> <br>
            <span>{{ $invoice->customer->address2 }}</span> <br>
            <span>{{ $invoice->customer->city . ' - ' . $invoice->customer->state->name }}</span> <br>
            <span><strong>State Code:</strong> {{ $stateCode = $invoice->customer->state->code }}</span> <br>
            <span><strong>GSTIN/UIN:</strong> {{ $invoice->customer->gstin }}</span> <br>
            <span><strong>Amount of Tax Subject to Reverse Charge:</strong> {{ ($invoice->reverse_charge) ? 'Yes' : 'No' }}</span>
        </td>
    </tr>
</table>

<table style="width: 54%; float: right;">
    <tr>
        <td class="border" style="width: 30%">Challan No.:</td>
        <td class="border" style="width: 26%">{{ $invoice->chal_no ?? '-' }}</td>
        <td rowspan="2" class="border" style="width: 23%">Invoice No.:</td>
        <td rowspan="2" class="border" style="width: 21%">{{ $invoice->inv_ref ?? '-' }}</td>
    </tr>
    <tr>
        <td class="border">Challan Date:</td>
        <td class="border">{{ $invoice->chal_date ? $invoice->chal_date->format('d-m-Y') : '-' }}</td>
    </tr>
    <tr>
        <td class="border">Purchase Order <br>Reference:</td>
        <td class="border">{{ $invoice->po_no ?? '-' }}</td>
        <td class="border">Invoice Date:</td>
        <td class="border">{{ $invoice->inv_date ? $invoice->inv_date->format('d-m-Y') : '-' }}</td>
    </tr>
    <tr>
        <td class="border">Transport Name:</td>
        <td colspan="3" class="border">{{ $invoice->transporter_name ?? '-' }}</td>
    </tr>
    <tr>
        <td class="border">LR No.:</td>
        <td colspan="3" class="border" style="clear: both;">{{ $invoice->lr_no ?? '-' }}
            <span style="float: right; margin-right: 6px;">Customer's Copy &#11036;</span>
        </td>
    </tr>
    <tr>
        <td class="border">Vehicle No.:</td>
        <td colspan="3" class="border" style="clear: both;">{{ $invoice->vehicle_no ?? '-' }}
            <span style="float: right; margin-right: 6px;">Transporter's Copy &#11036;</span>
        </td>
    </tr>
    <tr>
        <td class="border">Remarks:</td>
        <td colspan="3" class="border" style="clear: both;">-
            <span style="float: right; margin-right: 6px;">Extra's Copy &#11036;</span>
        </td>
    </tr>
</table>

<table style="clear: both; vertical-align: top;">
    <tr style="font-size: .9rem;">
        <th class="border">Sr. <br>No.</th>
        <th class="border" style="width: 35%">Description of Goods</th>
        <th class="border">HSN <br>Code</th>
        <th class="border">Qty</th>
        <th class="border">Rate</th>
        <th class="border">Disc</th>
        <th class="border">Taxable <br>Value</th>
        <th class="border">GST <br>Rate</th>
        <th class="border">Total <br>Amount</th>
    </tr>
    @for ($i = 0; $i < 7; $i++)
        @if ($i < $invoice->invoiceItems->count())
            <tr style="vertical-align: top; font-size: .85rem;">
                <td class="border" style="border-top: 0; border-bottom: 0; text-align: center;">{{ $i+1 }}</td>
                <td class="border" style="border-top: 0; border-bottom: 0;">{{ $invoice->invoiceItems[$i]->inventory->name }}
                    <br>
                    {!! is_null($invoice->invoiceItems[$i]->inventory->description) ? '&nbsp;' : '(' . $invoice->invoiceItems[$i]->inventory->description . ')' !!}
                </td>
                <td class="border" style="border-top: 0; border-bottom: 0; text-align: center;">{{ $invoice->invoiceItems[$i]->hsn }}</td>
                <td class="border" style="border-top: 0; border-bottom: 0; text-align: right;">{{ ($invoice->invoiceItems[$i]->unit->name == 'NA' ? '-' : $invoice->invoiceItems[$i]->qty . ' ' .  $invoice->invoiceItems[$i]->unit->name) }}</td>
                <td class="border" style="border-top: 0; border-bottom: 0; text-align: right;">
                    &#8377;{{ $invoice->invoiceItems[$i]->rate }}</td>
                <td class="border" style="border-top: 0; border-bottom: 0; text-align: center;">{{ $invoice->invoiceItems[$i]->disc == 0 ? '-' : $invoice->invoiceItems[$i]->disc . '%' }}</td>
                <td class="border" style="border-top: 0; border-bottom: 0; text-align: right;">
                    &#8377;{{ $invoice->invoiceItems[$i]->value }}</td>
                <td class="border" style="border-top: 0; border-bottom: 0; text-align: center;">{{ $invoice->invoiceItems[$i]->inventory->tax->rate == 0 ? '-' : $invoice->invoiceItems[$i]->inventory->tax->rate . '%' }}</td>
                <td class="border" style="border-top: 0; border-bottom: 0; text-align: right;">
                    &#8377;{{ $invoice->invoiceItems[$i]->total }}</td>
            </tr>
        @else
            <tr>
                <td class="border" style="border-top: 0; border-bottom: 0;">&nbsp; <br>&nbsp;</td>
                <td class="border" style="border-top: 0; border-bottom: 0;"></td>
                <td class="border" style="border-top: 0; border-bottom: 0;"></td>
                <td class="border" style="border-top: 0; border-bottom: 0;"></td>
                <td class="border" style="border-top: 0; border-bottom: 0;"></td>
                <td class="border" style="border-top: 0; border-bottom: 0;"></td>
                <td class="border" style="border-top: 0; border-bottom: 0;"></td>
                <td class="border" style="border-top: 0; border-bottom: 0;"></td>
                <td class="border" style="border-top: 0; border-bottom: 0;"></td>
            </tr>
        @endif
    @endfor
</table>

<table>
    <tr>
        <th class="border" style="text-align: left;">Amount in Words:</th>
        <td class="border" style="width: 20%; text-align: right;">Total</td>
        <td class="border" style="width: 15%; text-align: right;">&#8377;{{ $invoice->total }}</td>
    </tr>
    <tr>
        @php
            $fmt = new NumberFormatter('en-IN',NumberFormatter::SPELLOUT);
        @endphp
        <td rowspan="2" class="border">{{ Str::title($fmt->format($invoice->grand_total)) }} Only/-</td>
        <td class="border" style="text-align: right;">Round Off</td>
        <td class="border" style="text-align: right;">&#8377;{{ $invoice->round_off }}</td
        >
    </tr>
    <tr>
        <th class="border" style="text-align: right;">Grand Total</th>
        <th class="border" style="text-align: right;">&#8377;{{ $invoice->grand_total }}</th>
    </tr>
</table>

<table>
    {{--<tr>
        <th colspan="10" class="border" style="border-top: 0;">&#160;</th>
    </tr>--}}
    <tr>
        <th colspan="10" class="border" style="border-top: 0;">Details of Tax:</th>
    </tr>
    <tr>
        <th rowspan="2" class="border">Sr <br> No</th>
        <th rowspan="2" class="border">HSN Code</th>
        <th rowspan="2" class="border">Taxable Value</th>
        <th colspan="2" class="border">CGST</th>
        <th colspan="2" class="border">SGST</th>
        <th colspan="2" class="border">IGST</th>
        <th rowspan="2" class="border">Total Tax Amount</th>
    </tr>
    <tr>
        <th class="border">Rate</th>
        <th class="border">Amount</th>
        <th class="border">Rate</th>
        <th class="border">Amount</th>
        <th class="border">Rate</th>
        <th class="border">Amount</th>
    </tr>
    @for ($i = 0; $i < 5; $i++)
        @if ($i < $invoice->invoiceItems->count())
            <tr>
                <td class="border" style="border-top: 0; border-bottom: 0; text-align: center;">{{ $i+1 }}</td>
                <td class="border" style="border-top: 0; border-bottom: 0; text-align: center;">{{ $invoice->invoiceItems[$i]->hsn }}</td>
                <td class="border" style="border-top: 0; border-bottom: 0; text-align: right;">
                    &#8377;{{ $invoice->invoiceItems[$i]->value }}</td>
                <td class="border" style="border-top: 0; border-bottom: 0; text-align: center;">
                    @if ($stateCode == 24) {{ ($invoice->invoiceItems[$i]->inventory->tax->rate / 2) . '%' }} @endif
                </td>
                <td class="border" style="border-top: 0; border-bottom: 0; text-align: right;">
                    @if ($stateCode == 24) &#8377;{{ $invoice->invoiceItems[$i]->tax / 2 }} @endif
                </td>
                <td class="border" style="border-top: 0; border-bottom: 0; text-align: center;">
                    @if ($stateCode == 24) {{ ($invoice->invoiceItems[$i]->inventory->tax->rate / 2) . '%' }} @endif
                </td>
                <td class="border" style="border-top: 0; border-bottom: 0; text-align: right;">
                    @if ($stateCode == 24) &#8377;{{ $invoice->invoiceItems[$i]->tax / 2 }} @endif
                </td>
                <td class="border" style="border-top: 0; border-bottom: 0; text-align: center;">
                    @if ($stateCode != 24) {{ $invoice->invoiceItems[$i]->inventory->tax->rate . '%' }} @endif
                </td>
                <td class="border" style="border-top: 0; border-bottom: 0; text-align: right;">
                    @if ($stateCode != 24) &#8377;{{ $invoice->invoiceItems[$i]->tax }} @endif
                </td>
                <td class="border" style="border-top: 0; border-bottom: 0; text-align: right;">
                    &#8377;{{ $invoice->invoiceItems[$i]->tax }}</td>
            </tr>
        @else
            <tr>
                <td class="border" style="border-top: 0; border-bottom: 0; text-align: center;">{{ $i+1 }}</td>
                <td class="border" style="border-top: 0; border-bottom: 0;"></td>
                <td class="border" style="border-top: 0; border-bottom: 0;"></td>
                <td class="border" style="border-top: 0; border-bottom: 0;"></td>
                <td class="border" style="border-top: 0; border-bottom: 0;"></td>
                <td class="border" style="border-top: 0; border-bottom: 0;"></td>
                <td class="border" style="border-top: 0; border-bottom: 0;"></td>
                <td class="border" style="border-top: 0; border-bottom: 0;"></td>
                <td class="border" style="border-top: 0; border-bottom: 0;"></td>
                <td class="border" style="border-top: 0; border-bottom: 0;"></td>
            </tr>
        @endif
    @endfor
    <tr>
        <th colspan="3" class="border" style="text-align: right;">Total</th>
        <th colspan="2" class="border" style="text-align: right;">
            @if ($stateCode == 24) &#8377;{{ $invoice->tax / 2 }} @endif
        </th>
        <th colspan="2" class="border" style="text-align: right;">
            @if ($stateCode == 24) &#8377;{{ $invoice->tax / 2 }} @endif
        </th>
        <th colspan="2" class="border" style="text-align: right;">
            @if ($stateCode != 24) &#8377;
        {{ $invoice->tax }} @endif
        </td>
        <th class="border" style="text-align: right;">&#8377;{{ $invoice->tax }}</th>
    </tr>
    <tr>
        <th colspan="2" class="border" style="text-align: left;">Tax Amount in Words:</th>
        <td colspan="8" class="border">{{ Str::title($fmt->format($invoice->tax)) }} Only/-</td>
    </tr>
</table>

<table>
    <tr>
        <th class="border" style="border-bottom: 0; border-top: 0; text-align: left; text-decoration: underline;">
            Company's Bank Detail:
        </th>
        <td class="border" style="width: 27%; border-bottom: 0; border-top: 0; text-align: center;">E & OE</td>
    </tr>
    <tr>
        <td class="border" style="border-top: 0; border-bottom: 0;"><strong>Bank Name & Branch: </strong> Union Bank of
            India, Umbergaon
        </td>
        <th class="border" style="border-top: 0; border-bottom: 0;">For Pratik Narrow Fabrics</th>
    </tr>
    <tr>
        <td class="border" style="border-top: 0; border-bottom: 0;"><strong>IFSC Code: </strong> UBIN0541362</td>
        <td class="border" style="border-top: 0; border-bottom: 0;"></td>
    </tr>
    <tr>
        <td class="border" style="border-top: 0; border-bottom: 0;"><strong>Account No: </strong> 413605010800048</td>
        <td class="border" style="border-top: 0; border-bottom: 0;"></td>
    </tr>
    <tr>
        <td class="border" style="border-top: 0;">
            <small style="font-size: 9px;">
                <u>Terms & Conditions: </u><br> 1) Interest @ 24% will be charged if payment not made in 30 days. <br>
                2) If consignment is short, please refuse to receive that material until the came agent notes shortage
                in writing. <br> 3) We pack & check the goods carefully & are not responsible for damage or
                theft in transit. <br> 4) Subject to Umbergaon Jurisdiction.
            </small>
        </td>
        <td class="border" style="border-top: 0; text-align: center;"><br>Authorized Signatory</td>
    </tr>
</table>
</body>
</html>
