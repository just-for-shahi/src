 <div class="btn-group" data-toggle="buttons">
    @foreach($options as $option => $label)
    <label class="btn btn-default btn-sm {{ \Request::get('order_status', '1') == $option ? 'active' : '' }}">
        <input type="radio" class="order-status" value="{{ $option }}">{{$label}}
    </label>
    @endforeach
</div>