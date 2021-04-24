@component('mail::message')
# Order Closed of '{{$order->subscription_title}}'

@component('mail::panel')
*Source: *{{ $order->source_title }}<br>
*ID: *{{ $order->ticket }}<br>
*Symbol:* {{ $order->symbol }}<br>
*Type:* @if( $order->type_ == 0) Buy @else Sell @endif<br>
*Lots:* {{ $order->lots }}<br>
*Entry Price:* {{ $order->price }} @ (*Entry Time:* {{ $order->time_open }} ) <br>
*Closed Price:* {{ $order->price_close }} @ (*Close Time:* {{ $order->time_close }} )<br>
*Profit/Loss:* {{ $order->pl }}<br>
*Pips:* {{ $order->pips }}<br>

@endcomponent

@endcomponent