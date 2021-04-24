@extends('layout.panel')
@section('pageTitle', 'داشبورد')
@section('content')
    <div class="row-col">
        <div class="col-lg b-r">
            <div class="row no-gutter">
                <div class="col-xs-6 col-sm-4 b-r b-b">
                    <div class="padding">
                        <div>
                            <span class="pull-right"><i class="fa fa-caret-up text-primary m-y-xs"></i></span>
                            <span class="text-muted l-h-1x"><i class="ion-ios-grid-view text-muted"></i></span>
                        </div>
                        <div class="text-center">
                            <h2 class="text-center _600">{{number_format($accounts_num)}}</h2>
                            <p class="text-muted m-b-md">حساب‌ مالی</p>
                            <div>
                                <span data-ui-jp="sparkline" data-ui-options="[2,3,2,2,1,3,6,3,2,1], {type:'line', height:20, width: '60', lineWidth:1, valueSpots:{'0:':'#818a91'}, lineColor:'#818a91', spotColor:'#818a91', fillColor:'', highlightLineColor:'rgba(120,130,140,0.3)', spotRadius:0}" class="sparkline inline"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-4 b-r b-b">
                    <div class="padding">
                        <div>
                            <span class="pull-right"><i class="fa fa-caret-up text-primary m-y-xs"></i></span>
                            <span class="text-muted l-h-1x"><i class="ion-document text-muted"></i></span>
                        </div>
                        <div class="text-center">
                            <h2 class="text-center _600">{{number_format($balance)}} <small>تتر</small></h2>
                            <p class="text-muted m-b-md">موجودی کل آنلاین</p>
                            <div>
                                <span data-ui-jp="sparkline" data-ui-options="[1,1,0,2,3,4,2,1,2,2], {type:'line', height:20, width: '60', lineWidth:1, valueSpots:{'0:':'#818a91'}, lineColor:'#818a91', spotColor:'#818a91', fillColor:'', highlightLineColor:'rgba(120,130,140,0.3)', spotRadius:0}" class="sparkline inline"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-4 b-r b-b">
                    <div class="padding">
                        <div>
                            <span class="pull-right"><i class="fa fa-caret-down text-danger m-y-xs"></i></span>
                            <span class="text-muted l-h-1x"><i class="ion-pie-graph text-muted"></i></span>
                        </div>
                        <div class="text-center">
                            <h2 class="text-center _600">{{number_format($transactions_num)}}</h2>
                            <p class="text-muted m-b-md">تراکنش مالی</p>
                            <div>
                                <span data-ui-jp="sparkline" data-ui-options="[9,2,5,5,7,4,4,3,2,2], {type:'line', height:20, width: '60', lineWidth:1, valueSpots:{'0:':'#818a91'}, lineColor:'#818a91', spotColor:'#818a91', fillColor:'', highlightLineColor:'rgba(120,130,140,0.3)', spotRadius:0}" class="sparkline inline"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="padding">
                @if(auth()->user()->status != 1)
                    <div class="alert alert-danger">
                        <a href="{{route('profile.show')}}">مشتری گرامی حساب کاربری شما تایید نشده است. جهت خدمات رسانی لطفا از منوی پروفایل، حساب کاربری خود را تایید کنید.</a>
                    </div>
                @endif
                <div class="row m-b">
                    <div class="col-sm-6 col-xs-12">
                        <div class="box">
                            <div class="box-header light lt">
                                <h3>حساب مالی</h3>
                                <small>افتتاج حساب مالی در سیستم</small>
                            </div>
                            <div class="box-tool">
                                <a href="{{route('accounts.index')}}" class="md-btn md-raised m-b-sm orange">افتتاح حساب</a>
                            </div>
                            <table class="table table-striped b-t">
                                <thead>
                                <tr>
                                    <th>شماره حساب</th>
                                    <th>موجودی</th>
                                    <th>قابل برداشت</th>
                                    <th>رشد</th>
                                    <th>وضعیت</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($accounts as $account)
                                    <tr>
                                        <td>{{$account->no}}</td>
                                        <td>{{number_format($account->balance)}} <small>تتر</small></td>
                                        <td>{{number_format($account->harvstable)}} <small>تتر</small></td>
                                        <td>{{number_format($account->growth)}} <small>تتر</small></td>
                                        <td>{!! \App\Helpers\AccountHelper::status($account->status) !!}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-12">
                        <div class="box">
                            <div class="box-header light lt">
                                <h3>سرمایه‌گذاری</h3>
                                <small>سرمایه گذاری شما در سیستم مالی آذرسرمایه</small>
                            </div>
                            <div class="box-tool">
                                <a href="{{route('investments.index')}}" class="md-btn md-raised m-b-sm orange">سرمایه‌گذاری جدید</a>
                            </div>
                            @if(count($investments) < 1)
                                <div class="box-body text-center">
                                    <h6 class="m-a-0 text-center">اوپس، تا حالا سرمایه‌گذاری نکردین 😢</h6>
                                    @if($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach($errors->all() as $error)
                                                    <li>{{$error}}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <form role="form" class="padding text-center" method="post" action="{{route('investments.store')}}">
                                        @csrf
                                        <input type="hidden" name="account" value="{{$accounts[0]->id}}">
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <input type="number" class="form-control" name="amount" placeholder="به تتر وارد کنید">
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-outline rounded b-success text-success">سرمایه‌گذاری میکنم</button>
                                    </form>
                                </div>
                            @else
                                <table class="table table-striped b-t">
                                    <thead>
                                    <tr>
                                        <th>حساب</th>
                                        <th>مبلغ</th>
                                        <th>وضعیت</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($investments as $investment)
                                        <tr>
                                            <td>{{\App\Helpers\AccountHelper::summary($investment->account)}}</td>
                                            <td>{{number_format($investment->amount)}} <small>تتر</small></td>
                                            <td>{!! \App\Helpers\AccountHelper::investmentStatus($investment->status) !!}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row m-b">
                    <div class="col-sm-6 col-xs-12">
                        <div class="box">
                            <div class="box-header light lt">
                                <h3>تراکنش‌ها</h3>
                                <small>تراکنش‌های مالی شما در سیستم</small>
                            </div>
                            <div class="box-tool">
                                <a href="{{route('investments.index')}}" class="md-btn md-raised m-b-sm orange">شارژ حساب</a>
                            </div>
                            @if(count($transactions) < 1)
                                <div class="box-body text-center">
                                    <h6 class="m-a-0 text-center p-t-1">اوه تراکنشی ندارین 😢</h6>
                                    <br>
                                    <a href="{{route('investments.index')}}" class="btn btn-outline rounded b-success text-success">شارژش میکنم</a>
                                </div>
                            @else
                                <table class="table table-striped b-t">
                                    <thead>
                                    <tr>
                                        <th>مبلغ</th>
                                        <th>شماره یکتا</th>
                                        <th>شماره پیگیری</th>
                                        <th>وضعیت</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($transactions as $transaction)
                                        <tr>
                                            <td>{{number_format($transaction->amount)}} <small>تتر</small></td>
                                            <td><code>{{$transaction->authority}}</code></td>
                                            <td>@if($transaction->trace_number == null)ندارد @else<code>{{$transaction->trace_number}}</code>@endif</td>
                                            <td>{!! \App\Helpers\PaymentHelper::transactionStatus($transaction->status) !!}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-12">
                        <div class="box">
                            <div class="box-header light lt">
                                <h3>پشتیبانی</h3>
                                <small>تیکت‌های پشتیبانی شما در مرکز پشتیبانی</small>
                            </div>
                            <div class="box-tool">
                                <a href="{{route('tickets.create')}}" class="md-btn md-raised m-b-sm orange">پشتیبانی میخوام</a>
                            </div>
                            @if(count($tickets) < 1)
                                <div class="box-body text-center">
                                    <h6 class="m-a-0 text-center p-t-1">عالیه، همه چی ردیفه 😊</h6>
                                    <br>
                                    <a href="{{route('tickets.create')}}" class="btn btn-outline rounded b-success text-success">پشتیبانی میخوام</a>
                                </div>
                            @else
                                <table class="table table-striped b-t">
                                    <thead>
                                    <tr>
                                        <th>پیگیری</th>
                                        <th>عنوان</th>
                                        <th>اهمیت</th>
                                        <th>دپارتمان</th>
                                        <th>وضعیت</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($tickets as $ticket)
                                        <tr>
                                            <td>{{$ticket->id}}</td>
                                            <td>{{$ticket->title}}</td>
                                            <td>{{\App\Helpers\TicketHelper::priority($ticket->priority)}}</td>
                                            <td>{{\App\Helpers\TicketHelper::department($ticket->department)}}</td>
                                            <td>{!! \App\Helpers\TicketHelper::status($ticket->status) !!}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
