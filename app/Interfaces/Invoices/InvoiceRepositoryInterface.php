<?php

namespace App\Interfaces\Invoices;

interface InvoiceRepositoryInterface
{
    public function index($request);
    public function create();
    public function store($request);
    public function getPatientData($id);
}
