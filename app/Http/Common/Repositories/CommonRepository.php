<?php

namespace App\Http\Common\Repositories;

use Illuminate\Container\Container as App;
use App\Http\Common\Contracts\ICommonRepository;

abstract class CommonRepository implements ICommonRepository
{
    private $app;

    protected $model;

    public function __construct(App $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    public function all(array $columns = ['*'], array $relations = [])
    {
        if( count($relations) > 0 ){
            $this->model = $this->model->with($relations);
        }
        return $this->model->get($columns);
    }

    public function find($id, array $columns = ['*'], array $relations = [])
    {
        return $this->model->with($relations)->find($id, $columns);
    }

    public function first(array $columns = ['*'], array $where = [], array $relations = [])
    {
        try{

            if( count($relations) > 0 ){
                $this->model = $this->model->with($relations);
            }
            if( count($where) > 0 ){
                $this->model = $this->addWhere($where);
            }
            return $this->model->first($columns);

        } catch (\Exception $e){
            \Log::info($e->getMessage());
            return [];
        }
    }

    public function findBy($attribute, $value, array $columns = ['*'], array $relations = [])
    {
        if( count($relations) > 0 ){
            $this->model = $this->model->with($relations);
        }
        return $this->model->where($attribute, '=', $value)->first($columns);
    }

    public function findByOrderBy($attribute, $value, array $columns = ['*'], array $relations = [], array $order_by = [])
    {
        if( count($relations) > 0 ){
            $this->model = $this->model->with($relations);
        }
        return $this->model->where($attribute, '=', $value)->orderBy($order_by[0], $order_by[1])->first($columns);
    }

    public function findAllBy(array $where = [], array $columns = ['*'], array $relations = [])
    {
        try {
            if( count($relations) > 0 ){
                $this->model = $this->model->with($relations);
            }
            if( count($where) > 0 ){
                $this->model = $this->addWhere($where);
            }
            return $this->model->get($columns);
        } catch (\Exception $e){
            \Log::info($e->getMessage());
            return [];
        }
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function saveModel(array $data)
    {
        foreach ($data as $k => $v){
            $this->model->$k = $v;
        }
        return $this->model->save();
    }

    public function update($id, array $data)
    {
        $model = $this->model->find($id);
        $model->fill($data);
        if(!$model->isDirty()){
            return false;
        }
        return $model->save();
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function select($key, $column, array $where = [])
    {
        try {
            $model = $this->model;
            if( count($where) > 0 ){
                $model = $this->addWhere($where);
            }
            return $model->orderBy($column)->pluck($column, $key)->prepend('** Seleccione **', "");

        } catch (\Exception $e){
            \Log::info($e->getMessage());
            return [];
        }
    }

    public function makeModel()
    {
        $model = $this->app->make($this->model);
        if(!$model instanceof $this->model)
            throw new \Exception("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        return $this->model = $model;
    }

    public function addWhere(array $where)
    {
        $model = $this->model;
        foreach ( $where as $field => $value ){
            if( is_array( $value ) ){
                if( count($value) === 3 ){
                    list($field, $operator, $value) = $value;
                    $model = $model->where( $field, $operator, $value );
                }elseif( count($value) === 2 ){
                    list($field, $value) = $value;
                    $model = $model->where( $field, '=', $value );
                }
            }else{
                $model = $model->where( $field, '=', $value );
            }
        }
        return $model;
    }
}