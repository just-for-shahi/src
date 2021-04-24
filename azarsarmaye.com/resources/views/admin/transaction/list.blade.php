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
                                <th>#</th>
                                <th>نام کاربری</th>
                                <th>نام کاربر</th>
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
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->user->username}}</td>
                                    <td>{{$item->user->full_name}}</td>
                                    <td>{{number_format($item->amount)}} <small>تتر</small></td>
                                    <td>{{$item->authority}}</td>
                                    <td>{{$item->trace_number}}</td>
                                    <td>{!! \App\Helpers\PaymentHelper::transactionStatus($item->status) !!}</td>
                                    <td>{{Morilog\Jalali\Jalalian::forge($item->updated_at)}}</td>
                                    <td>
                                        <a href="{{route('transactions.show', ['uuid' => $item->uuid])}}"
                                           class="btn btn-primary btn-sm text-sm">مشاهده</a>
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
