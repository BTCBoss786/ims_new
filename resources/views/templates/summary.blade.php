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
            padding: 1cm;
            font-family: 'DejaVu Sans';
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 4px;
        }

        .border {
            border: 1px solid #000;
        }
    </style>
</head>
<body>
<table>
    <tr>
        <th style="text-align: center;">
            <strong style="font-size: 1.5rem; text-decoration: underline;">INVOICE SUMMARY</strong>
        </th>
    </tr>
    <tr>
        <th style="text-align: center;">
            <strong style="font-size: 1rem;">
                From {{ $startDate->format('d-m-Y') }} To {{ $endDate->format('d-m-Y') }}
            </strong>
        </th>
    </tr>
</table>

<br>

<table>
    <tr>
        <th class="border" style="width: 12%">Invoice <br>No</th>
        <th class="border" style="width: 15%">Invoice <br>Date</th>
        <th class="border" style="width: 50%">Customer Name</th>
        <th class="border" style="width: 23%">Bill Amount</th>
    </tr>
    @php
        $fmt = new NumberFormatter('en-IN',NumberFormatter::DECIMAL);
        $fmt->setAttribute(NumberFormatter::FRACTION_DIGITS, 2);
    @endphp
    @foreach($invoices as $invoice)
    <tr>
        <td class="border" style="text-align: center;">{{ $invoice->inv_ref }}</td>
        <td class="border" style="text-align: center;">{{ $invoice->inv_date->format('d-m-Y') }}</td>
        <td class="border">{{ $invoice->customer->name }}</td>
        <td class="border" style="text-align: right;">&#8377;{{ $fmt->format($invoice->grand_total) }}</td>
    </tr>
    @endforeach
    <tr>
        <th class="border">&nbsp;</th>
        <th class="border">&nbsp;</th>
        <th class="border" style="text-align: right;">Total</th>
        <th class="border" style="text-align: right;">&#8377;{{ $fmt->format($invoices->sum('grand_total')) }}</th>
    </tr>
</table>
</body>
</html>
