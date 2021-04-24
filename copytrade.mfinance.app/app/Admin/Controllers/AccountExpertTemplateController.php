<?php

namespace App\Admin\Controllers;

use App\Enums\TemplateLoadStatusType;
use App\Http\Controllers\Controller;

use App\Models\Account;
use App\Models\AccountExpertTemplate;
use App\Models\BrokerSymbol;
use App\Models\Expert;
use Carbon\Carbon;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use App\Admin\Extensions\Tools\AddExpertAccountButton;
use Illuminate\Support\Facades\Request;

class AccountExpertTemplateController extends Controller
{
    use HasResourceActions;

    public $expertId;

    protected function show($id)
    {
        $show = new Show(AccountExpertTemplate::findOrFail($id));

        $show->symbol('Symbol');
        $show->timeframe('Timeframe');
        $show->options('Options');
        $show->snapshot('Snapshot');

        $show->created_at('Created');
        $show->updated_at('Updated');

        return $show;
    }

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {
            $content->header('Accounts & Experts');
            $content->description('Accounts & Experts');

            $content->body($this->prepare());
        });
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
            $content->header('Accounts & Experts');
            $content->description('Expert on Account');
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
            $this->expertId = Request::get('expert_id');
            $content->header('Accounts & Experts');
            $content->description('Expert on Account');

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
        return Admin::grid(AccountExpertTemplate::class, function (Grid $grid) {
            $grid->id('ID');

            $grid->disableCreation();

            $grid->model()
                ->whereExpertId($this->expertId)
                ->whereHas('account', static function ($q) {
                    $q->whereManagerId(Admin::user()->id);
                });

            $grid->account()->account_number('Account');
            $grid->expert()->name('Expert');
            $grid->symbol('Symbol');
            $grid->timeframe('TimeFrame');

            $grid->enabled()->switch(['1' => ['text' => 'Yes'], '0' => ['text' => 'No']])->sortable();

            $grid->load_status('Status')->display(function ($type) {
                return TemplateLoadStatusType::title($type);
            });

            $grid->updated_at('Updated')->display(function ($updated_at) {
                return Carbon::parse($updated_at)->diffForHumans();
            });

            $grid->rows(function (Grid\Row $row) {
            });

            $grid->filter(function ($filter) {
                $filter->disableIdFilter();
            });

            $grid->actions(function ($actions) {
                //$actions->disableView();
            });

            $grid->tools(function ($tools) {
                if(!empty($this->expertId))
                    $tools->append(new AddExpertAccountButton($this->expertId));
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
        return Admin::form(AccountExpertTemplate::class, function (Form $form) {
            $form->hidden('expert_id')->value($this->expertId);

            $form->display('id', 'ID');

            $accounts = Account::whereManagerId(Admin::user()->id)->pluck('account_number', 'id');
            $form->select('account_id', 'Account')->options($accounts)->required();

            $symbols = BrokerSymbol::all()->pluck('name', 'name');
            $form->select('symbol', 'Symbol')->options($symbols)->required();

            $options = [1 => 'M1', 5 => 'M5', 15 => 'M15', 30 => 'M30', 60 => 'H1'];
            $form->select('timeframe', 'TimeFrame')->options($options)->required();

            $form->switch('enabled', 'Enabled?')->default(1);

            $def = null;
            if(!empty($this->expertId))
                $def = Expert::find($this->expertId)->template_default;
            $form->textarea('options', 'Options')->required()->default($def);

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }

    private function prepare()
    {
        $this->expertId = Request::get('expert_id');
        $experts = array();

        $items = Expert::whereManagerId(Admin::user()->id)->get();

        foreach ($items as $item) {
            $expert['title'] = $item->name;
            $expert['link'] = url()->current() . '?expert_id=' . $item->id;

            if (empty($this->expertId) || $this->expertId == 0) {
                $this->expertId = $item->id;
                $expert['active'] = true;
            } else {
                $expert['active'] = $this->expertId == $item->id;
            }

            $experts[] = $expert;
        }

        $vars = [
            'experts'       => $experts,
            'panel'          => $this->grid(),
        ];

        return view('admin.experts', $vars);
    }
}
