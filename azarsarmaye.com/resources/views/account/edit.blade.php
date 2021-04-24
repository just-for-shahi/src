@extends('layout.panel')
@section('pageTitle', 'بروزرسانی حساب بانکی')
@section('content')
    <div class="padding">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h2>بروزرسانی حساب بانکی</h2>
                        <small>
                            با استفاده از فرم زیر میتوانید حساب بانکی بروزرسانی کنید.
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
                            <form role="form" method="post" action="{{route('mbank-accounts', ['account' => $account->id])}}">
                                @method('PUT')
                                @csrf
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label for="iban" class="form-control-label">شماره شبا</label>
                                        <input dir="ltr" type="text" name="iban" id="iban" class="form-control text-right" placeholder="IR......">
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="account" class="form-control-label">شماره حساب</label>
                                        <input dir="ltr" type="text" name="account" id="account" class="form-control text-right" placeholder="5615000">
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="card" class="form-control-label">شماره کارت</label>
                                        <input dir="ltr" type="text" name="card" id="card" class="form-control text-right" placeholder="6104337912341234">
                                    </div>
                                </div>
                                <div class="form-group row m-t-md">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary pull-right">ثبت حساب بانکی</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
