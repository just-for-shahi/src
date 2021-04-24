 <div class="btn-group" data-toggle="buttons">
    @foreach($options as $option => $label)
    <label class="btn btn-default btn-sm {{ \Request::get('account_status', 'all') == $option ? 'active' : '' }}">
        <input type="radio" class="account-status" value="{{ $option }}">{{$label}}
    </label>
    @endforeach
</div>