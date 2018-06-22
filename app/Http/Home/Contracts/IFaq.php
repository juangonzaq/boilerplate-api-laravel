<?php
namespace App\Http\Home\Contracts;
use App\Http\Common\Contracts\ICommonRepository;

interface IFaq extends ICommonRepository
{
    public function index();

    public function show($id);

    public function store($data);

    public function destroy($id);
}