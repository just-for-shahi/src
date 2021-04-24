<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\AccountStatus;
use App\Models\Order;
use App\Models\Product;
use App\User;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\Table;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index()
    {
//        $user = User::withCount('accounts')->find(Admin::user()->id);

        foreach(Admin::user()->roles()->get() as $role) {
            if (!empty($role->start_page)) {
                return redirect($role->start_page);
            }
        }

        return Admin::content(function (Content $content) {
            $content->header(null);
            $content->description(' ');

            if (Admin::user()->can('user.orders_not_filled')) {
                $content->body($this->gridOrdersNotFilled());
            }

            if (Admin::user()->can('mng.orders_not_filled')) {
                $content->body($this->gridManagerOrdersNotFilled());
            }

            if (Admin::user()->can('mng.products')) {
                $this->widgetManagerProducts($content);

                if(Product::whereManagerId(User::GetManagerId())->count() < 3) {
                    $this->addEmbededProductsHelpVideo($content);
                }

            }

            if (Admin::user()->can('mng.how_to_video')) {
                $this->addEmbededCopierHelpVideo($content);
            }


            /*            $content->row(function ($row) {
                            $row->column(3, new InfoBox('Users', 'users', 'aqua', '/admin/users', User::where('creator_id', Admin::user()->id)->count()));
                            $row->column(3, new InfoBox('Accounts', 'book', 'green', '/admin/accounts', Account::where('creator_id', Admin::user()->id)->count()));
                            $row->column(3, new InfoBox('Subscribers', 'file', 'red', '/admin/copiers', Copier::where('creator_id', Admin::user()->id)->count()));
                        }); */

            /*$tab = new Tab();
            $tab->title('');
            $headers = ['Ticket', 'Symbol', 'Type', 'Lots', 'Price', 'SL', 'TP', 'Time'];

             foreach(CopierSubscription::all() as $subscription) {
                $orders = Order::working($subscription->id);
                $data = array();
                foreach ($orders as $order) {
                    $item = array();

                    $item[] = $order->ticket;
                    $item[] = $order->symbol;
                    $item[] = $order->type_str;
                    $item[] = $order->lots;
                    $item[] = $order->price;
                    $item[] = $order->stoploss;
                    $item[] = $order->takeprofit;
                    $item[] = $order->time_open;

                    $data[] = $item;
                }
                $tab->add($subscription->title, new Table($headers, $data));
            }

            $content->row((new Box('Working Orders', $tab))->style('info')->solid());
            // ---

            $tab1 = new Tab();
            $tab1->title('');

            $tab1->add('Not Copied Open', new Table($headers, $data));
            $tab1->add('Not Copied Closed', new Table($headers, $data));

            $content->row((new Box('Issues', $tab1))->style('danger')->removable());  */
        });
    }

    protected function gridOrdersNotFilled()
    {
        return new Grid( new Order(), function (Grid $grid) {

            $grid->model()
                ->where('ticket', '<', 0)
                ->whereHas('account', function ($q) {
                    $q->whereUserId(Admin::user()->id);
                })
                ->orderBy('time_created', 'DESC');

            $grid->time_created('Time')->sortable();
            $grid->account_number('Account');
            // $grid->account()->status('Status')->display(function ($status) {
            //     return AccountStatus::title($status);
            // });
            $grid->last_error('Last Error');

            $grid->filter(function ($filter) {
                $filter->between('time_created', 'Time')->datetime();
                $filter->equal('account_number', 'Account')
                    ->select(Account::whereUserId(Admin::user()->id)->pluck('account_number','account_number'));
                $filter->like('last_error', 'Last Error');
                $filter->disableIdFilter();
            });

            $grid->expandFilter();
            $grid->disableCreateButton();
            $grid->disableExport();
            $grid->disableActions();
        });
    }

    protected function gridManagerOrdersNotFilled()
    {
        return Admin::grid(Order::class, function (Grid $grid) {
            //$accounts = Account::whereManagerId( Auth('admin')->user()->id)->pluck('account_number')->toArray();

            $grid->model()->with('account_stat')
                ->where('ticket', '<', 0)
                ->whereHas('account', function ($q) {
                    $q->whereManagerId(User::GetManagerId());
                })
                ->orderBy('time_created', 'DESC');

            $grid->time_created('Time')->sortable();
            $grid->account_number('Account');
            $grid->column('account_stat.name','Name');
            $grid->account()->account_status('Status')->display(function ($status) {
                return AccountStatus::title($status);
            });

            $grid->last_error('Last Error');

            //$grid->disableFilter();

            $grid->filter(function ($filter) {
                $filter->between('time_created', 'Time')->datetime();
                $filter->equal('account_stat.name', 'Name');
                $filter->equal('account_number', 'Account')
                    ->select(Account::whereManagerId(User::GetManagerId())->pluck('account_number','account_number'));
                $filter->like('last_error', 'Last Error');
                $filter->disableIdFilter();
            });

            $grid->expandFilter();
            $grid->disableCreateButton();
            $grid->disableExport();
            $grid->disableActions();
        });
    }

    private function widgetManagerProducts(Content $content) {

        $products = Product::with('files')->whereManagerId(User::GetManagerId())->get();

        $n = count($products);

        for( $i = 0; $i < $n; $i++) {

            $row = new Row;

            for($j = 0; $j < 2; $j++) {
                $this->prepareRow($row, $products[$i], 6);
                $i++;
                if($i >= $n) {
                    break;
                }
            }
            $i--;

            $content->row($row);
        }

    }
    private function prepareRow(Row $row, Product $product, int $size) {
        $headers = ['File', 'Type', 'Created', 'Updated'];

        $files = $product->files()->get();

        if(count($files) < 1)
            return;

        $data = array();
        foreach($files as $file) {
            $item = array();
            $src = Storage::disk(config('admin.upload.disk'))->url($file->path);
            $item[] = "<a href='$src' download='{$file->name}' target='_blank' class='text-muted'><i class=\"fa fa-download\"></i> {$file->name}</a>";
            $item[] = $file->type;
            $item[] = $file->created_at;
            $item[] = $file->updated_at;

            $data[] = $item;
        }
        $table = new Table($headers, $data);

        $src = '/download/'.Admin::user()->id.'/'.$product->key;
        $arch = "<a href='$src' download='{$product->name}' target='_blank' class='text-muted'><i class=\"fa fa-download\"></i> Download package {$product->title}</a>  <a style=\"float:right;\" href=\"/pfiles\" >(Manage Files)</a>";
        $row->column($size, (new Box($product->title, $table, $arch))->style('info')->solid() );
    }

    private function addEmbededProductsHelpVideo(Content $content) {
        $html = '<iframe src="https://www.youtube.com/embed/nQI8fFn-iSw" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
        $content->row((new Box('How to Videos', $html))->style('info')->solid());
    }

    private function addEmbededCopierHelpVideo(Content $content) {
        $html =
            '<iframe src="https://www.youtube.com/embed/ApNLZ5GfkHs" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>&nbsp;&nbsp;'.
            '<iframe src="https://www.youtube.com/embed/4TMzL8MHO5s" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>&nbsp;&nbsp;'.
            '<iframe src="https://www.youtube.com/embed/4USr4plRsWI" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
        $content->row((new Box('How to Videos', $html))->style('info')->solid());
    }
}
