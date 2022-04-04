<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body class="antialiased">
<div class="container mt-5">
    <h1>Invoices</h1>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>Invoice No.</th>
            <th>Stock Code</th>
            <th>Description</th>
            <th>Quantity</th>
            <th>Invoice Date</th>
            <th>Unit Price</th>
            <th>Customer ID</th>
            <th>Country</th>
        </tr>
        </thead>
        <tbody>
        @if($invoices->isEmpty())
            <tr class="text-center">
                <td colspan="8">There are no invoices to display!</td>
            </tr>
        @else
            @foreach($invoices as $invoice)
                <tr>
                    <td>{{ $invoice->invoice_no }}</td>
                    <td>{{ $invoice->stock_code }}</td>
                    <td>{{ $invoice->description }}</td>
                    <td>{{ $invoice->quantity }}</td>
                    <td>{{ $invoice->invoice_date }}</td>
                    <td>{{ $invoice->unit_price }}</td>
                    <td>{{ $invoice->customer_id }}</td>
                    <td>{{ $invoice->country }}</td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>

    <div class="d-flex justify-content-between mb-5">
        <div>
            Page {{ $invoices->currentPage() }} of {{ $invoices->lastPage() }}.
            Displaying {{ $invoices->count() }} items.
            Total items: {{ $invoices->total() }}
        </div>
        <div>
            {{ $invoices->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
</div>
</body>
</html>
