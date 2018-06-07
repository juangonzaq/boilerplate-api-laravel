<?php
namespace App\Http\Destination\Contracts;
use App\Http\Common\Contracts\ICommonRepository;

interface IDestination extends ICommonRepository
{
    public function index();

    public function show($id);

    public function store($data);

    public function destroy($id);
}