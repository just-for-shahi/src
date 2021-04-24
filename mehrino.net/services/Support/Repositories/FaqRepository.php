<?php


namespace Services\Support\Repositories;


use Services\Support\Models\Faq;
use Services\Support\Response\ResFaq;

class FaqRepository implements IFaqRepository
{
    /**
     * The model being queried.
     *
     * @var Faq
     */
    protected $model;

    public function __construct(Faq $model)
    {
        $this->model = $model::query();
    }

    public function all()
    {
        $faqs = $this->model->latest()->get();
        $data=[];
        foreach ($faqs as $item) {
            $faq = new ResFaq();
            $faq->uuid = $item->uuid;
            $faq->answer = $item->answer;
            $faq->question = $item->question;
            $faq->parent = $item->parent;
            $data[] = $faq;
        }
        return $data;
    }

    public function store($data)
    {
        return $this->model->create($data);
    }

    public function show($uuid)
    {
        return $this->model->where('uuid', $uuid)->first();
    }

    public function update($uuid, $data)
    {
        return $this->model->where('uuid', $uuid)->update($data);
    }

    public function destroy($uuid)
    {
        return $this->model->where('uuid', $uuid)->destroy();
    }
}
