<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessInvoiceSpreadsheet;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function upload(Request $request)
    {
        // Validate request
        $request->validate([
            'data' => 'required|file|mimes:csv,txt'
        ]);

        // Check that file was uploaded without any errors
        if ($request->hasFile('data') && $request->file('data')->isValid()) {
            // Store file on local storage
            $path = $request->data->storeAS('spreadsheets', 'data.csv');
        } else {
            abort(400);
        }

        // Process file as a queued job
        ProcessInvoiceSpreadsheet::dispatch($path);

        // Start indexing invoices after a successful upload
        return redirect(route('index'));
    }

    public function index()
    {
        $invoices = Invoice::paginate(50);
        return view('index', ['invoices' => $invoices]);
    }
}
