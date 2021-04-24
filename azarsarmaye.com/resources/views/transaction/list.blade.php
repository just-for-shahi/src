@extends('layout.panel')
@section('pageTitle', 'لیست تراکنش‌ها')
@section('content')
    <div class="padding">
        <div class="row">
            <div class="col-sm-12">
                <div class="box">
                    <div class="box-header">
                        <div class="pull-left">
                            <h2>لیست تراکنش‌ها</h2>
                            <small>
                                در لیست زیر میتوانید تمامی تراکنش‌های سیستم را مشاهده کنید
                            </small>
                        </div>
                    </div>
                    <div class="table-responsive">
                        @if(count($transactions) === 0)
                            <img class="img-fluid center-block center" src="{{asset('img/empty.png')}}" alt="چیزی پیدا نکردیم!"/>
                            <h5 class="text-center text-muted p-b-lg">اوپس، هنوز تراکنشی ثبت نکردید، معطل چی هستی؟</h5>
                        @else
                        <table class="table table-striped b-t">
                            <thead>
                            <tr>
                                <th>سفارش</th>
                                <th>مبلغ</th>
                                <th>شماره تراکنش</th>
                                <th>شماره پیگیری</th>
                                <th>وضعیت</th>
                                <th>آخرین بروزرسانی</th>
                                <th>گزینه‌ها</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($transactions as $item)
                                <tr>
                                    <td>سرمایه‌گذاری شماره {{$item->order}}</td>
                                    <td>{{number_format($item->amount)}} <small>تتر</small></td>
                                    <td>{{$item->authority}}</td>
                                    <td>{{$item->trace_number}}</td>
                                    <td>{!! \App\Helpers\PaymentHelper::transactionStatus($item->status) !!}</td>
                                    <td>{{Morilog\Jalali\Jalalian::forge($item->updated_at)}}</td>
                                    <td>
                                        <a href="{{route('transactions.show', ['uuid' => $item->uuid])}}" class="btn btn-primary btn-sm text-sm">مشاهده</a>
                                        @if($item->status == 0)
                                            <a href="{{route('accounts.charging', ['uuid' => $item->uuid])}}" class="btn btn-success btn-sm text-sm">پرداخت</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
