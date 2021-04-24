<?php


namespace Services\Support\Repositories;


interface IFaqRepository
{
    public function all();

    public function store($data);

    public function show($uuid);

    public function update($uuid,$data);

    public function destroy($uuid);
}
