<?php

namespace App\Http\Common\Contracts;

interface ICommonRepository
{
    public function all(array $columns = ['*'], array $relations = []);

    public function find($id, array $columns = ['*'], array $relations = []);

    public function first(array $columns = ['*'], array $where = [], array $relations = []);

    public function findBy($field, $value, array $columns = ['*'], array $relations = []);

    public function findByOrderBy($field, $value, array $columns = ['*'], array $relations = [], array $order_by = [ 'id' => 'asc' ]);

    public function findAllBy(array $where, array $columns = ['*'], array $relations = []);

    public function create(array $data);

    public function saveModel(array $data);

    public function update($id, array $data);

    public function delete($id);

    public function select($key, $column, array $where);

}