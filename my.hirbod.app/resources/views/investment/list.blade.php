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
                        <a href="{{route('investments.create')}}" class="btn btn-sm text-sm text-sm-center btn-primary pull-right">سرمایه‌گذاری میکنم</a>
                    </div>
                    <div class="table-responsive">

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
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{\App\Helpers\AccountHelper::summary($item->account)}}</td>
                                    <td>@if($item->transaction != null)<a href="{{route('transactions.show', ['transaction' => $item->transaction])}}" class="btn btn-outline-info btn-sm text-sm">مشاهده تراکنش</a>@else بدون تراکنش @endif</td>
                                    <td>{{number_format($item->amount)}} <small>تومان</small></td>
                                    <td>{{\Morilog\Jalali\Jalalian::forge($item->invested_at)}}</td>
                                    <td>@if($item->withdraw_at == null)خیر@else{{\Morilog\Jalali\Jalalian::forge($item->withdraw_at)}}@endif</td>
                                    <td>{!! \App\Helpers\AccountHelper::investmentStatus($item->status) !!}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{$investments->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
