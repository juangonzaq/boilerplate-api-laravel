<?php
namespace App\Http\Destination\Contracts;

interface IDestination
{
    public function index();

    public function findBy($column, $value);

    public function show($id);

    public function store($data);

    public function update();

    public function destroy($id);
}