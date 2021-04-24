@extends('layout.panel')
@section('pageTitle', 'لیست سرمایه‌گذاری های من')
@section('content')
    <div class="padding">
        <div class="row">
            <div class="col-sm-12">
                <div class="box">
                    <div class="box-header">
                        <div class="pull-left">
                            <h2>لیست سرمایه‌گذاری های من</h2>
                            <small>
                                در لیست زیر میتوانید تمامی سرمایه‌گذاری های خود را مشاهده کنید
                            </small>
                        </div>
                        <a data-toggle="modal" data-target="#new" class="btn btn-sm text-sm text-sm-center btn-primary text-white pull-right">سرمایه‌گذاری جدید</a>
                        <div id="new" class="modal" data-backdrop="true">
                            <div class="row-col h-v">
                                <div class="row-cell v-m">
                                    <div class="modal-dialog modal-md">
                                        <form action="{{route('investments.store')}}" method="post" class="modal-content">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title">سرمایه‌گذاری جدید</h5>
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
                                                        <label class="control-label text-right pull-left" for="amount">مبلغ سرمایه‌گذاری</label>
                                                        <input class="form-control" id="amount" name="amount" type="number" placeholder="لطفا مبلغ مدنظرتان را وارد کنید">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn dark-white pull-left p-x-md" data-dismiss="modal">انصراف</button>
                                                <button type="submit" class="btn btn-primary pull-right p-x-md">سرمایه‌گذاری</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        @if(count($investments) === 0)
                            <img class="img-fluid center-block center" src="{{asset('img/empty.png')}}" alt="چیزی پیدا نکردیم!"/>
                            <h5 class="text-center text-muted p-b-lg">اوپس، هنوز سرمایه گذاری نکردید، معطل چی هستی؟</h5>
                        @else
                        <table class="table table-striped b-t">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>حساب مالی</th>
                                <th>تراکنش</th>
                                <th>مبلغ</th>
                                <th>سرمایه‌گذاری شده</th>
                                <th>تسویه شده</th>
                                <th>وضعیت</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($investments as $item)
                                @php
                                    $transaction = \App\Models\Transaction::find($item->transaction);
                                @endphp
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{\App\Helpers\AccountHelper::summary($item->account)}}</td>
                                    <td>@if($item->transaction != null)<a href="{{route('transactions.show', ['uuid' => $transaction['uuid']])}}" class="btn btn-outline-info btn-sm text-sm">مشاهده تراکنش</a>@else بدون تراکنش @endif</td>
                                    <td>{{number_format($item->amount)}} <small>تتر</small></td>
                                    <td>{{\Morilog\Jalali\Jalalian::forge($item->invested_at)}}</td>
                                    <td>@if($item->withdraw_at == null)خیر@else{{\Morilog\Jalali\Jalalian::forge($item->withdraw_at)}}@endif</td>
                                    <td>{!! \App\Helpers\AccountHelper::investmentStatus($item->status) !!}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>
                    {{$investments->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
