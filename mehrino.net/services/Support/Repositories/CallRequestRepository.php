<?php

namespace Services\Support\Repositories;

use Services\Support\Models\CallRequest;

/**
 * CallrequestRepositrory
 * @author Sajadweb
 * 2020-06-12 04:20:13
 */
class CallRequestRepository implements ICallRequestRepository
{
     /**
     * The model being queried.
     *
     * @var CallRequest
     */
    protected $model;
    public function __construct(CallRequest $model)
    {
        $this->model = $model::query();
    }

    public function all()
    {
        return $this->model->paginate();
    }

    public function store($data)
    {
        return $this->model->create($data);
    }

    public function show($uuid)
    {
        return $this->model->where('uuid',$uuid)->first();
    }

    public function update($uuid,$data)
    {
       return $this->model->where('uuid',$uuid)->update($data);
    }

    public function destroy($uuid)
    {
        return $this->model->where('uuid',$uuid)->destroy();
    }
}
