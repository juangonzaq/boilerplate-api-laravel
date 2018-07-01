<?php
namespace App\Http\Transaction\Contracts;
use App\Http\Common\Contracts\ICommonRepository;

interface ITransactionUser extends ICommonRepository
{
    public function updateDeletedDestinations($code, $destinations);
}