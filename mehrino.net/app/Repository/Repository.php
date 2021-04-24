<?php


namespace App\Repository;


class Repository implements IRepository
{

    public $model;

    public function query()
    {
        return $this->model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function findMany($where, $select, $paginate )
    {
        return $this->model->
        where($where)
            ->select($select)
            ->paginate($paginate["count"], '*', 'page', $paginate["page"]);
    }

    public function paginate(int $count = 15, int $page = 1, array $columns = ['*'])
    {
        return $this->model->paginate($count, $columns, $pageName = null, $page);
    }

    public function show($uuid)
    {
        return $this->model->where('uuid', $uuid)->first();
    }

    public function db()
    {
        return $this->model;
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function insert(array $data)
    {
        return $this->model->insert($data);
    }

    public function update($where, array $data)
    {
        return $this->model->where($where)->update($data);
    }

    public function destroy($uuid)
    {
        return $this->model->me()->where('uuid', $uuid)->delete();
    }
}
