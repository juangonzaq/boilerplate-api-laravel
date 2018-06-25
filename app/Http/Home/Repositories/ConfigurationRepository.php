<?php
namespace App\Http\Home\Repositories;

use App\Http\Home\Contracts\IConfiguration;
use App\Http\Common\Repositories\CommonRepository;

class ConfigurationRepository extends CommonRepository implements IConfiguration
{
    protected $configEntity;
    protected $model;

    public function __construct($configEntity)
    {
        $this->model = $configEntity;
    }

    public function store($data)
    {
        return $this->model->create($data);
    }

    public function destroy($id)
    {
        return $this->model->destroy($id);
    }

}