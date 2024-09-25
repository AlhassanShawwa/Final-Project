<?php

namespace App\Interfaces\Groups;

interface GroupRepositoryInterface
{

    public function index($request);
    public function create();
    public function get_services($id);
    public function store($request);
    public function show($id);
    public function edit($id);
    public function update($request, $id);
    public function getStatus($id);
    public function updateStatus($request, $id);
    public function destroy($id);
}
