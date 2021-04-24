<?php

namespace App\Admin\Extensions\Nav;

use Illuminate\Contracts\Support\Renderable;

class Dropdown implements Renderable
{
    public function render()
    {
        return <<<HTML
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-th"></i>
    </a>
    <ul class="dropdown-menu" style="padding: 0;box-shadow: 0 2px 3px 0 rgba(0,0,0,.2);">
        <li>
           <div class="box box-solid" style="width: 300px;height: 300px;margin-bottom: 0;">
            <!-- /.box-header -->
            <div class="box-body">
              <a class="btn btn-app" href="/graphql-playground">
            <i class="fa fa-edit"></i> GraphQL
              </a>
              <a class="btn btn-app" href="users">
                <i class="fa fa-users"></i> Users
              </a>
              <a class="btn btn-app" href="/apilogs">
                <i class="fa fa-picture-o"></i> ApiLogs
              </a>
              <a class="btn btn-app" href="/auth/menu">
                <i class="fa fa-play"></i> Menu
              </a>
              <a class="btn btn-app" href="/auth/permissions">
                <i class="fa fa-file-text"></i> Permissions
              </a>
              <a class="btn btn-app" href="/scheduling">
                <i class="fa fa-tags"></i> Scheduling
              </a>
              <a class="btn btn-app" href="/helpers/terminal/artisan">
                <i class="fa fa-file-o"></i> Artizan
              </a>
              <a class="btn btn-app" href="/log-viewer/logs">
                <i class="fa fa-line-chart"></i> Logs
              </a>
            </div>
            <!-- /.box-body -->
          </div>
      </li>
    </ul>
</li>
HTML;

    }
}