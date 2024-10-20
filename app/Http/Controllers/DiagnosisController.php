<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDiagnosisRequest;
use App\Interfaces\Diagnoses\DiagnosisRepositoryInterface;
use App\Models\Diagnosis;
use Illuminate\Http\Request;

class DiagnosisController extends Controller
{
    private $Diagnoses;
    public function __construct(DiagnosisRepositoryInterface $Diagnoses)
    {
        $this->Diagnoses = $Diagnoses;
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDiagnosisRequest $request)
    {
        return $this->Diagnoses->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Diagnosis $diagnosis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Diagnosis $diagnosis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Diagnosis $diagnosis)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Diagnosis $diagnosis)
    {
        //
    }
}
