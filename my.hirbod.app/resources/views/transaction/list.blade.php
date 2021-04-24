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
                                    <td>{{$item->description}}</td>
                                    <td>{{number_format($item->amount)}} <small>تومان</small></td>
                                    <td><code>{{$item->authority}}</code></td>
                                    <td>{{$item->trace_number}}</td>
                                    <td>{!! \App\Helpers\Payment::transactionStatus($item->status) !!}</td>
                                    <td>{{Morilog\Jalali\Jalalian::forge($item->updated_at)->ago()}}</td>
                                    <td>
                                        <a href="{{route('transactions.show', ['uuid' => $item->uuid])}}" class="btn btn-primary btn-sm text-sm">مشاهده</a>
                                        @if($item->status == 0)
                                            <a href="{{route('payment.pay', ['uuid' => $item->uuid])}}" class="btn btn-success btn-sm text-sm">پرداخت</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
