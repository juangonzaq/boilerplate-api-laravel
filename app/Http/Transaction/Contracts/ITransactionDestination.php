<?php
namespace App\Http\Transaction\Contracts;
use App\Http\Common\Contracts\ICommonRepository;

interface ITransactionDestination extends ICommonRepository
{
    public function updateDeletedDestinations($code, $destinations);
}