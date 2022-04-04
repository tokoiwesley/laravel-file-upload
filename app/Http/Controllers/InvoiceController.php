<?php

namespace App\Http\Controllers;

use App\Imports\InvoiceImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class InvoiceController extends Controller
{
    public function upload(Request $request)
    {
        ini_set('memory_limit', '1024M');
        ini_set('max_execution_time', '900');

        Excel::import(new InvoiceImport, $request->file('data'));

        return redirect(route('upload.success'));
    }
}
