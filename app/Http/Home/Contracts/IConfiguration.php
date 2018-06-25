<?php
namespace App\Http\Home\Contracts;
use App\Http\Common\Contracts\ICommonRepository;

interface IConfiguration extends ICommonRepository
{
    public function store($data);

    public function destroy($id);
}