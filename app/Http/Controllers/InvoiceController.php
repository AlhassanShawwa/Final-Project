<?php

namespace App\Http\Controllers;

use App\Interfaces\Invoices\InvoiceRepositoryInterface;
use App\Models\Invoice;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\String_;

class InvoiceController extends Controller
{
    private $Invoices;
    public function __construct(InvoiceRepositoryInterface $Invoices)
    {
        $this->Invoices = $Invoices;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->Invoices->index($request);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->Invoices->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->Invoices->store($request);
    }
    public function getPatientData(String $id)
    {
        return $this->Invoices->getPatientData($id);
    }
    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
