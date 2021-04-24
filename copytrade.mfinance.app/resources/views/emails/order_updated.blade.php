@component('mail::message')
# Order Updated of '{{$order->subscription_title}}'

@component('mail::panel')
**ID: **{{ $order->ticket }}<br>
**Symbol:** {{ $order->symbol }}<br>
**Type:** @if( $order->type_ == 0) Buy @else Sell @endif<br>
**Stoploss:** {{ $order->sl }}<br>
**Takeprofit:** {{ $order->tp }}<br>
@endcomponent

@endcomponent