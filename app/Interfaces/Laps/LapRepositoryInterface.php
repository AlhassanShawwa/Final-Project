<?php

namespace App\Interfaces\Laps;

interface LapRepositoryInterface
{
    public function index($request);
    public function create();
    public function store($request);
    public function show($id);
    public function edit($id);
    public function update($request, $id);
    public function destroy($id);
}
