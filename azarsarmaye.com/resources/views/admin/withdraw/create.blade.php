@extends('layout.panel')
@section('pageTitle', 'درخواست برداشت')
@section('content')
    <div class="padding">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h2>درخواست برداشت</h2>
                        <small>
                            با استفاده از فرم زیر میتوانید درخواست برداشت انجام بدید.
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
                            @if(\Illuminate\Support\Facades\Session::has('error'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{\Illuminate\Support\Facades\Session::get('error')}}</li>
                                        </ul>
                                    </div>
                            @endif
                            <form role="form" method="post" action="{{route('withdraws.store')}}">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label for="account" class="form-control-label">حساب مالی</label>
                                        <select id="account" class="form-control" name="account">
                                            @foreach($accounts as $account)
                                                <option value="{{$account->id}}">{{\App\Helpers\AccountHelper::summary($account->id)}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="bank_account" class="form-control-label">حساب بانکی</label>
                                        <select id="bank_account" class="form-control" name="bank_account">
                                            @foreach($bank_accounts as $account)
                                                <option value="{{$account->id}}">{{\App\Helpers\BankAccountHelper::summary($account->id)}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="amount" class="form-control-label"> مبلغ<small> (تومان)</small></label>
                                        <input type="number" class="form-control" name="amount" placeholder="به تومان وارد کنید" value="{{old('amount')}}">
                                    </div>
                                </div>
                                <div class="form-group row m-t-md">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-success pull-right">برداشت میکنم</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
