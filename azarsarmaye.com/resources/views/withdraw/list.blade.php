@extends('layout.panel')
@section('pageTitle', 'لیست برداشت‌های من')
@section('content')
    <div class="padding">
        <div class="row">
            <div class="col-sm-12">
                @if(count($bankAccounts) === 0)
                    <div class="alert alert-danger">
                        <span>مشتری گرامی، شما هیچ حساب بانکی ثبت شده ندارید، لطفا ابتدا یک حساب بانکی ثبت کنید.</span>
                    </div>
                @endif
                <div class="box">
                    <div class="box-header">
                        <div class="pull-left">
                            <h2>لیست برداشت‌های من</h2>
                            <small>
                                در لیست زیر میتوانید تمامی برداشت‌های خود را مشاهده کنید
                            </small>
                        </div>
                        <a data-toggle="modal" data-target="#new" class="btn btn-sm text-sm text-sm-center btn-primary text-white pull-right">برداشت جدید</a>
                        <div id="new" class="modal" data-backdrop="true">
                            <div class="row-col h-v">
                                <div class="row-cell v-m">
                                    <div class="modal-dialog modal-md">
                                        <form action="{{route('withdraws.store')}}" method="post" class="modal-content">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title">برداشت جدید</h5>
                                            </div>
                                            <div class="modal-body text-center p-lg">
                                                <div class="row">
                                                    <div class="col-sm-6 form-group">
                                                        <label class="control-label text-right pull-left" for="account">برداشت از</label>
                                                        <select id="account" name="account" class="form-control">
                                                            @foreach($accounts as $account)
                                                                <option value="{{$account->id}}">{{\App\Helpers\AccountHelper::summary($account->id)}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-6 form-group">
                                                        <label class="control-label text-right pull-left" for="bankAccount">واریز به</label>
                                                        <select id="bankAccount" name="bank-account" class="form-control">
                                                            @foreach($bankAccounts as $bankAccount)
                                                                <option value="{{$bankAccount->id}}">{{\App\Helpers\BankAccountHelper::summary($bankAccount->id)}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-12 form-group">
                                                        <label class="control-label text-right pull-left" for="amount">مبلغ برداشت</label>
                                                        <input class="form-control" id="amount" name="amount" type="number" placeholder="لطفا مبلغ مدنظرتان را وارد کنید">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn dark-white pull-left p-x-md" data-dismiss="modal">انصراف</button>
                                                <button type="submit" class="btn btn-primary pull-right p-x-md">ثبت برداشت</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br/>
                    <div class="box-body">
                        <div class="alert alert-warning">
                            <span>مشتریان گرامی، به منظور اعلام نهادهای نظارتی مبنی بر اصلاحیه رویه برداشت‌ها، جهت جلوگیری از پولشویی حتما کارت بانکی بایستی همان کارت بانکی که سرمایه گذاری از آن انجام شده است باشد.</span>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                        <div class="table-responsive">
                        @if(count($withdraws) === 0)
                            <img class="img-fluid center-block center" src="{{asset('img/empty.png')}}" alt="چیزی پیدا نکردیم!"/>
                            <h5 class="text-center text-muted p-b-lg">اوپس، هنوز برداشت وجهی ثبت نکردید، معطل چی هستی؟</h5>
                        @else
                        <table class="table table-striped b-t">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>حساب بانکی</th>
                                <th>حساب مالی</th>
                                <th>مبلغ</th>
                                <th>پیگیری</th>
                                <th>وضعیت</th>
                                <th>گزینه‌ها</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($withdraws as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{\App\Helpers\BankAccountHelper::summary($item->bank_account)}}</td>
                                    <td>{{\App\Helpers\AccountHelper::summary($item->account)}}</td>
                                    <td>{{number_format($item->amount)}} <small>تتر</small></td>
                                    <td>{{$item->inquiry}}</td>
                                    <td>{!! \App\Helpers\WithdrawHelper::status($item->status) !!}</td>
                                    <td>
                                        @if(auth()->user()->role === 6 && $item->status === 0)
                                            <a data-toggle="modal" data-target="#withdraw-{{$item->id}}" class="btn btn-success btn-sm text-sm text-white">پرداخت</a>
                                            <div id="withdraw-{{$item->id}}" class="modal" data-backdrop="true">
                                                <div class="row-col h-v">
                                                    <div class="row-cell v-m">
                                                        <div class="modal-dialog modal-sm">
                                                            <form method="post" class="pull-right" action="{{route('mwithdraws.accept', ['withdraw' => $item->id])}}">
                                                                @csrf
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">پرداخت برداشتی</h5>
                                                                    </div>
                                                                    <div class="modal-body text-center p-lg">
                                                                        <div class="form-group">
                                                                            <label class="form-control-label" for="inquiry">شماره پیگیری</label>
                                                                            <input class="form-control" id="inquiry" name="inquiry">
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn dark-white p-x-md pull-left" data-dismiss="modal">انصراف</button>
                                                                        <button type="submit" class="btn success p-x-md">دستور پرداخت</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        @if($item->status == 0)
                                            <a data-toggle="modal" data-target="#delete-{{$item->id}}" class="btn btn-danger btn-sm text-sm text-white">انصراف</a>
                                            <div id="delete-{{$item->id}}" class="modal" data-backdrop="true">
                                                <div class="row-col h-v">
                                                    <div class="row-cell v-m">
                                                        <div class="modal-dialog modal-sm">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">انصراف از برداشت</h5>
                                                                </div>
                                                                <div class="modal-body text-center p-lg">
                                                                    <p>آیا از برداشت خودتون مطمئن هستید؟</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn dark-white p-x-md pull-left" data-dismiss="modal">انصراف</button>
                                                                    <form method="post" class="pull-right" action="{{route('withdraws.destroy', ['uuid' => $item->uuid])}}">
                                                                        @method('DELETE')
                                                                        @csrf
                                                                        <button type="submit" class="btn danger p-x-md">بلی</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @endif
                        </div>
                    {{$withdraws->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
