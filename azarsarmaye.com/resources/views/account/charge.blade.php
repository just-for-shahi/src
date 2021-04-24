@extends('layout.panel')
@section('pageTitle', 'افزایش موجودی')
@section('content')
    <div class="padding">
        <div class="row">
            <div class="col-sm-12">
                @include('partials.errors')
                <div class="box">
                    <div class="box-header">
                        <div class="pull-left">
                            <h2>افزایش موجودی</h2>
                            <small>
                                در قسمت پایین میتوانید افزایش موجودی انجام دهید
                            </small>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <img class="img-fluid center-block center" src="{{asset('img/wallet0.jpg')}}" alt="چیزی پیدا نکردیم!"/>
                        <h3 class="text-center text-code">0x3b38fe14ba84282f960EA237e111e89A1b9e5A99</h3>
                        <hr>
                        <h6 class="text-center text-warning p-b-lg">پرداخت ها کاملا سیستمی بر روی بستر بلاکچین است و بصورت خودکار هر یک ساعت یکبار بررسی و در صورت انجام تایید میشوند.</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
