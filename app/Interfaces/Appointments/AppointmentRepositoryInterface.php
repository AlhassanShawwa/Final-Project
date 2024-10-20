<?php

namespace App\Interfaces\Appointments;

interface AppointmentRepositoryInterface
{
    public function index($request);
    public function create();
    public function store($request);
    public function show($id);
    public function edit($id);
    public function update($request, $id);
    public function dailyAppointments($request);
    public function getDoctors($id);
    public function getServices($request, $id);
    public function getServiceDetails($request, $id);
    public function destroy($id);
}
