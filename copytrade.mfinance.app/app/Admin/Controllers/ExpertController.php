<?php

namespace App\Admin\Controllers;

use App\Enums\FileType;
use App\Models\Expert;
use Encore\Admin\Controllers\HasResourceActions;
use Carbon\Carbon;
use App\Models\Account;
use App\Models\File;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ExpertController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {
            $content->header('Experts');
            $content->description('Manage Experts');

            $content->body($this->grid());
        });
    }

    protected function show($id)
    {
        $show = new Show(Expert::findOrFail($id));

        $show->name('Name');
        $show->created_at('Created');
        $show->updated_at('Updated');

        /* $show->templates('Templates', function ($template) {
            $template->resource('/admin/templates');
        }); */

        return $show;
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {
            $content->header('Expert');
            $content->description('Edit Expert');
            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {
            $content->header('Expert');
            $content->description('New Expert');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Expert::class, function (Grid $grid) {
            $grid->id('ID');

            $grid->model()
                ->whereManagerId(Admin::user()->id);

            $grid->name('Name');
            $grid->ex4_file()->name('Ex4 File');

            $grid->updated_at('Updated')->display(function ($updated_at) {
                return Carbon::parse($updated_at)->diffForHumans();
            });

            $grid->rows(function (Grid\Row $row) {
            });

            $grid->filter(function ($filter) {
                $filter->like('name');
                $filter->disableIdFilter();
            });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Expert::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->hidden('manager_id')->value(Auth::guard('admin')->user()->id);

            $form->text('name', 'Name')->required();

            $files = File::whereType(FileType::EX4)->whereManagerId(Admin::user()->id)->pluck('name', 'id');
            $form->select('ex4_file_id', 'Ex4 File')->options($files)->required();

            $form->switch('enabled', 'Enabled?')->default(1);

            $form->textarea('template_default', 'Default Options')->required();

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
