<?php

namespace Services\Post\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Services\Category\Models\Category;
use Services\Post\Models\Post;
use App\Repository\Repository;

/**
 * Post
 * @author Sajadweb
 * Sun Jan 24 2021 14:52:20 GMT+0330 (Iran Standard Time)
 */
class PostRepository extends Repository implements IPostRepository
{
      /**
     * The model being queried.
     *
     * @var Post
     */
    public $model;
    /**
     * @var mixed
     */
    private $category;

    public function __construct(Post $model , Category $category)
    {
        $this->model = new $model();
        $this->category = new $category();
    }

    public function store($data)
    {
        DB::beginTransaction();
        $result = $this->model->create([
            'title' => $data->title,
            'abstract' => $data->abstract,
            'description' => $data->description,
            'cover' => $data->file('cover')->store(uploadPath('blog/cover/')),
        ]);
        if (!$result) {
            DB::rollBack();
            alert(__('message.alert.error.title')  , __('message.alert.error.message') , 'error');
            return back();
        }
        $categories = $this->category->whereIn('uuid' , $data->categories)->get();
        $result->categories()->sync($categories);
        DB::commit();
        alert(__('message.alert.success.title')  , __('message.alert.success.message' , ['name' => 'وبلاگ' , 'type' => 'ثبت']) , 'success');
    }

    public function updateAll($data , $weblog)
    {
        DB::beginTransaction();
        $prev_file = $weblog->cover;

        $result = $weblog->update([
            'title' => $data->title ?? $weblog->title,
            'abstract' => $data->abstract ?? $weblog->abstract,
            'description' => $data->description ?? $weblog->description,
            'cover' => $data->hasFile('cover') ? $data->file('cover')->store(uploadPath('blog/cover/')) : $weblog->cover,
        ]);

        if ($data->hasFile('cover') && $prev_file !== null && Storage::disk('liara')->exists($prev_file)) {
            Storage::disk('liara')->delete($prev_file);
        }

        if (!$result) {
            DB::rollBack();
            alert(__('message.alert.error.title')  , __('message.alert.error.message') , 'error');
            return back();
        }

        $categories = $this->category->whereIn('uuid' , $data->categories)->get();
        $weblog->categories()->sync($categories);

        DB::commit();
        alert(__('message.alert.success.title')  , __('message.alert.success.message' , ['name' => 'وبلاگ' , 'type' => 'ویرایش']) , 'success');
    }

    public function destroyAll($weblog)
    {
        DB::beginTransaction();

        if ($weblog->cover !== null && Storage::disk('liara')->exists($weblog->cover)) {
            Storage::disk('liara')->delete($weblog->cover);
        }

        $result = $weblog->delete();

        if (!$result) {
            DB::rollBack();
            alert(__('message.alert.error.title')  , __('message.alert.error.message') , 'error');
            return back();
        }

        DB::commit();
        alert(__('message.alert.success.title')  , __('message.alert.success.message' , ['name' => 'وبلاگ' , 'type' => 'حذف']) , 'success');
    }
}
