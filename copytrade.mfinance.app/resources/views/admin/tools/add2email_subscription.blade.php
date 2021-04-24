<div class="btn-group">
    <a class="btn btn-sm btn-default">  {{ trans('admin.add2email_subscription') }}</a>
    <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
        <span class="caret"></span>
        <span class="sr-only">Toggle Dropdown</span>
    </button>
    <ul class="dropdown-menu" role="menu">
        @foreach($subscriptions as $subscription)
            <li><a href="#" class="grid-add2email_subscription-{{ $subscription->id }}">{{ $subscription->title }}</a></li>
        @endforeach
    </ul>
</div>