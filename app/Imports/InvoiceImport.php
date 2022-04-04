<?php

namespace App\Imports;

use App\Models\Invoice;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

class InvoiceImport implements ToModel, WithChunkReading, WithBatchInserts, WithStartRow, ShouldQueue
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Invoice([
            'invoice_no' => $row[0],
            'stock_code' => $row[1],
            'description' => $row[2],
            'quantity' => $row[3],
            'invoice_date' => $row[4],
            'unit_price' => $row[5],
            'customer_id' => $row[6],
            'country' => $row[7],
        ]);
    }

    public function chunkSize(): int
    {
        return 4096;
    }

    public function batchSize(): int
    {
        return 2048;
    }

    public function startRow(): int
    {
        return 2;
    }
}
