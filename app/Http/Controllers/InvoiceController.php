<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function upload(Request $request)
    {
        return redirect(route('upload.success'));
    }
}
