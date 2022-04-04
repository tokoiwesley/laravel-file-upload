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

    /**
     * Specify the amount of rows to read from the spreadsheet at one go in order to keep memory usage under control
     *
     * @return int
     */
    public function chunkSize(): int
    {
        return 16384;
    }

    /**
     * Specifies the number of models to be inserted in the database at one go (for every insert query)
     *
     * @return int
     */
    public function batchSize(): int
    {
        return 4096;
    }

    /**
     * Specifies the row at which data import should start
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }
}
