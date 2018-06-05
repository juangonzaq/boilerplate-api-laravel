<?php
namespace App\Http\Destination\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Destination\Contracts\IDestination;

class DestinationController extends Controller
{

    public function __construct(IDestination $IDestination)
    {
        $this->IDestination = $IDestination;
        $this->middleware('guest');
    }

    public function show()
    {
        $this->IDestination->show(1);
    }

    public function store()
    {

    }

    public function update($id)
    {

    }

    public function destroy($id)
    {

    }

}
