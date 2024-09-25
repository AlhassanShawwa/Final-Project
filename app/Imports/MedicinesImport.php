<?php

namespace App\Imports;

use App\Models\Medicine;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MedicinesImport implements ToModel, WithHeadingRow
{
    protected $callback;

    public function __construct(callable $callback = null)
    {
        $this->callback = $callback;
    }

    public function model(array $row)
    {
        if (!isset($row['name'], $row['code'], $row['manufacturer'])) {
            return null;
        }

        $name = trim($row['name']);
        $code = trim($row['code']);
        $manufacturer = trim($row['manufacturer']);

        $existingMedicine = Medicine::where('name', $name)->first();
        if ($existingMedicine) {
            return null;
        }

        if ($this->callback) {
            call_user_func($this->callback, true);
        }

        return new Medicine([
            'name' => $name,
            'code' => $code,
            'manufacturer' => $manufacturer,
        ]);
    }
}
