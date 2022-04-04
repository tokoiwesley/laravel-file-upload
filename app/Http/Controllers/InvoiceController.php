<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessInvoiceSpreadsheet;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function upload(Request $request)
    {
        // Validate file
        if ($request->hasFile('data') && $request->file('data')->isValid()) {
            $path = $request->data->storeAS('spreadsheets', 'data.csv');
        } else {
            abort(400);
        }

        // Process file on a queue
        ProcessInvoiceSpreadsheet::dispatch($path);

        // Response after a successful upload
        return redirect(route('upload.success'));
    }
}
