<?php
namespace App\Http\Home\Controllers;

use App\Http\Common\Responses\ResponseBase;
use App\Http\Home\Contracts\IConfiguration;
use App\Http\Destination\Contracts\IDestination;

class ConfigurationController extends ResponseBase
{
    protected $IConfiguration;
    protected $IDestination;

    public function __construct(
        IConfiguration $IConfiguration,
        IDestination $IDestination
    )
    {
        $this->IConfiguration = $IConfiguration;
        $this->IDestination = $IDestination;
        $this->middleware('guest');
    }

    public function index()
    {
        $configurations = $this->IConfiguration->first();
        $destinations = $this->IDestination->all();
        $data = [
            'configuration' => $configurations,
            'destinations' => $destinations,
            'days_available' => [
                [
                    'id' => 1,
                    'key' => '3-days',
                    'value' => '3 días (Sábado - Lunes)'
                ],
                [
                    'id' => 2,
                    'key' => '3-days',
                    'value' => '3 días (Viernes - Domingo)'
                ],
                [
                    'id' => 3,
                    'key' => '5-days',
                    'value' => '5 días (Lunes - Viernes)'
                ],
                [
                    'id' => 4,
                    'key' => '5-days',
                    'value' => '5 días (Lunes - Miercoles)'
                ],
            ],
            'schedule' => [
                [
                    'key' => 'morning',
                    'value' => 'Mañana'
                ],
                [
                    'key' => 'night',
                    'value' => 'Noche'
                ]
            ],
            'seasons' => [
                [
                    'id' => 1,
                    'key' => 'season_down',
                    'value' => 'Temporada baja',
                    'price' => 40,
                    'dates' => ['2018-06-22', '2018-06-23', '2018-06-24', '2018-06-25', '2018-07-01', '2018-07-05'],
                ],
                [
                    'id' => 2,
                    'key' => 'season_up',
                    'value' => 'Temporada alta',
                    'price' => 100,
                    'dates' => ['2018-12-22', '2018-12-23', '2018-12-24', '2018-12-25', '2018-12-30', '2018-12-31', '2018-01-01', '2018-01-02'],
                ],
                [
                    'id' => 3,
                    'key' => 'season_middle',
                    'value' => 'Temporada Media',
                    'price' => 40,
                    'dates' => ['2018-04-22', '2018-04-23', '2018-04-24', '2018-04-25'],
                ],
                [
                    'id' => 4,
                    'key' => 'sold_out',
                    'value' => 'Agotado',
                    'price' => 0,
                    'dates' => ['2018-02-22', '2018-02-23', '2018-02-24', '2018-02-25'],
                ]
            ]
        ];
        return $this->sendResponse($data, 'Configurations retrieved successfully.');
    }

    public function store()
    {
        $destination = $this->IConfiguration->store(request()->all());
        return $this->sendResponse($destination, 'Destination created successfully.');
    }

    public function update($id)
    {
        $destination = $this->IConfiguration->update($id, request()->all());
        return $this->sendResponse($destination, 'Destination updated successfully.');
    }

    public function search(){
        $destinations = $this->IConfiguration->findAllBy(request()->query());
        return $this->sendResponse($destinations, 'Destination list successfully.');
    }

}