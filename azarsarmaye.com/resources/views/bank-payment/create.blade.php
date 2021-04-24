@extends('layout.panel')
@section('pageTitle', 'ثبت انتقال بانکی')
@section('content')
    <div class="padding">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h2>ثبت انتقال بانکی</h2>
                        <small>
                            با استفاده از فرم زیر میتوانید انتقال بانکی جدید ثبت کنید.
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
                            <form role="form" method="post" action="{{route('bank-transfers.store')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label class="form-control-label" for="account">حساب مالی</label>
                                        <select class="form-control" id="account" name="account">
                                            @foreach($accounts as $account)
                                                <option value="{{$account->id}}">{{\App\Helpers\AccountHelper::summary($account->id)}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="amount" class="form-control-label">مبلغ انتقال</label>
                                        <input type="number" name="amount" id="amount" class="form-control text-right" placeholder="مبلغ را به تومان وارد کنید">
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="receipt" class="form-control-label">فایل رسید</label>
                                        <input type="file" name="receipt" id="receipt" class="form-control text-right">
                                    </div>
                                </div>
                                <div class="form-group row m-t-md">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary pull-right">ثبت انتقال بانکی</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
