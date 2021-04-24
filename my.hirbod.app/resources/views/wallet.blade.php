@extends('layout.panel')
@section('pageTitle', 'کیف‌پول هیربد')
@section('content')
    <div class="padding">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h2>کیف‌پول هیربد</h2>
                        <small>
                            با استفاده از فرم زیر میتوانید موجودی کیف‌پول هیربد خود را افزایش دهید کنید.
                        </small>
                        </div>
                        <div class="box-divider m-a-0"></div>
                        <div class="box-body">
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{$error}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form role="form" method="post" action="{{route('wallet.pay')}}">
                                @csrf
                                <div class="row form-group">
                                    <div class="col-sm-4">
                                        <label for="amount" class="form-control-label"> مبلغ مدنظر<small>(تومان)</small></label>
                                        <input type="number" name="amount" class="form-control" id="amount">
                                    </div>
                                    <div class="col-sm-4">
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="balance" class="form-control-label"> موجودی فعلی</label>
                                        <h4 class="text-primary font-weight-bold">{{number_format($balance)}} <small>تومان</small></h4>
                                    </div>
                                </div>
                                <div class="form-group row m-t-md">
                                    <div class="col-sm-4">
                                        <button type="submit" class="btn w-full btn-primary pull-right">پرداخت می‌کنم</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
