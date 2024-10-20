<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppointmentRequest;
use App\Interfaces\Appointments\AppointmentRepositoryInterface;
use App\Models\Appointment;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\String_;

class AppointmentController extends Controller
{
    private $Appointments;
    public function __construct(AppointmentRepositoryInterface $Appointments)
    {
        $this->Appointments = $Appointments;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->Appointments->index($request);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->Appointments->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAppointmentRequest $request)
    {
        return $this->Appointments->store($request);
    }

    public function getDoctors(String $id)
    {
        return $this->Appointments->getDoctors($id);
    }

    public function getServices(Request $request, String $id)
    {
        return $this->Appointments->getServices($request, $id);
    }

    public function getServiceDetails(Request $request, String $id)
    {
        return $this->Appointments->getServiceDetails($request, $id);
    }


    public function dailyAppointments(Request $request)
    {
        return $this->Appointments->dailyAppointments($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        return $this->Appointments->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String  $id)
    {
        return $this->Appointments->destroy($id);
    }
}
