<?php

namespace Services\Support\Repositories;


/**
 * ICallRequestRepository
 * @author Sajadweb
 * 2020-06-12 04:20:13
 */
interface ICallRequestRepository
{
    public function all();

    public function store($data);

    public function show($uuid);

    public function update($uuid,$data);

    public function destroy($uuid);
}
