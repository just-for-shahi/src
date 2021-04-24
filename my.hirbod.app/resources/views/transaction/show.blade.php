@extends('layout.panel')
@section('pageTitle', 'مشاهده تراکنش')
@section('content')
    <div class="padding">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <div class="pull-left">
                            <h2>تراکنش شماره {{$transaction->authority}}</h2>
                            <small>
                                با استفاده از فرم زیر میتوانید تراکنش مدنظرتان را مشاهده کنید.
                            </small>
                        </div>
                        <a onclick="window.print()" class="btn btn-primary btn-sm text-sm text-white pull-right">چاپ تراکنش</a>
                    </div>
                    <br>
                    <br>
                        <div class="box-divider m-a-0"></div>
                        <div class="box-body">
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label for="from" class="form-control-label">از حساب/درگاه</label>
                                    <input type="text" class="form-control" id="from" disabled="disabled" value="@if($transaction->from == 0)درگاه اینترنتی@else حساب مالی شماره {{$transaction->from}} @endif">
                                </div>
                                <div class="col-sm-4">
                                    <label for="authority" class="form-control-label">شماره تراکنش</label>
                                    <input type="text" class="form-control" id="authority" disabled="disabled" value="{{$transaction->authority}}">
                                </div>
                                <div class="col-sm-4">
                                    <label for="amount" class="form-control-label">مبلغ <small>ریال</small></label>
                                    <input type="text" class="form-control" id="amount" disabled="disabled" value="{{number_format($transaction->amount)}} تومان">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label for="trace_number" class="form-control-label">شماره پیگیری</label>
                                    <input type="text" class="form-control" id="user" disabled="disabled" value="{{$transaction->trace_number}}">
                                </div>
                                <div class="col-sm-4">
                                    <label for="trace_number" class="form-control-label">شماره کارت</label>
                                    <input type="text" class="form-control" id="trace_number" disabled="disabled" value="{{$transaction->card_number}}">
                                </div>
                                <div class="col-sm-4">
                                    <label for="description" class="form-control-label">توضیحات</label>
                                    <input type="text" class="form-control" id="description" disabled="disabled" value="{{$transaction->description}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label for="updated_at" class="form-control-label">تاریخ بروزرسانی</label>
                                    <input type="text" class="form-control" id="updated_at" disabled="disabled" value="{{\Morilog\Jalali\Jalalian::forge($transaction->updated_at)->format('Y/m/d H:i:s')}}">
                                </div>
                                <div class="col-sm-4">
                                    <label for="status" class="form-control-label">وضعیت فاکتور</label>
                                    <br/>
                                    {!! \App\Helpers\Payment::transactionStatus($transaction->status) !!}
                                </div>
                            </div>
                            @if($transaction->status == 0)
                                <div class="form-group row m-t-md">
                                    <div class="col-sm-12">
                                        <a href="{{route('payment.pay', ['uuid' => $transaction->uuid])}}" class="btn btn-success text-sm w-full">پرداخت می‌کنم</a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
