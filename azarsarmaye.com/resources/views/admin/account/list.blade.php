@extends('layout.panel')
@section('pageTitle', 'لیست حساب‌ها')
@section('content')
    <div class="padding">
        <div class="row">
            <div class="col-sm-12">
                @include('partials.errors')
                <div class="box">
                    <div class="box-header">
                        <div class="pull-left">
                            <h2>لیست حساب‌ها</h2>
                            <small>
                                در لیست زیر میتوانید تمامی حساب‌های خود را مشاهده کنید
                            </small>
                        </div>
                        {{--                        <a data-toggle="modal" data-target="#new"--}}
                        {{--                           class="btn btn-sm text-sm text-sm-center btn-primary text-white pull-right">افتتاح حساب</a>--}}

                        {{--                        <div id="new" class="modal" data-backdrop="true">--}}
                        {{--                            <div class="row-col h-v">--}}
                        {{--                                <div class="row-cell v-m">--}}
                        {{--                                    <div class="modal-dialog modal-md">--}}
                        {{--                                        <form action="{{route('accounts.store')}}" method="post" class="modal-content">--}}
                        {{--                                            @csrf--}}
                        {{--                                            <div class="modal-header">--}}
                        {{--                                                <h5 class="modal-title">افتتاح حساب</h5>--}}
                        {{--                                            </div>--}}
                        {{--                                            <div class="modal-body text-center p-lg">--}}
                        {{--                                                <div class="row">--}}
                        {{--                                                    <div class="col-sm-6 form-group">--}}
                        {{--                                                        <label class="control-label" for="name">نام حساب</label>--}}
                        {{--                                                        <input class="form-control" id="name" name="name" type="text"--}}
                        {{--                                                               placeholder="یک نام برای حساب خود وارد کنید">--}}
                        {{--                                                    </div>--}}
                        {{--                                                    <div class="col-sm-6 form-group">--}}
                        {{--                                                        <label class="control-label" for="color">رنگ حساب</label>--}}
                        {{--                                                        <select name="color" class="form-control" id="color">--}}
                        {{--                                                            <option selected value="0">قرمز</option>--}}
                        {{--                                                            <option value="1">آبی</option>--}}
                        {{--                                                            <option value="2">سبز</option>--}}
                        {{--                                                            <option value="3">زرد</option>--}}
                        {{--                                                            <option value="4">نارنجی</option>--}}
                        {{--                                                            <option value="5">سرمه‌ای</option>--}}
                        {{--                                                        </select>--}}
                        {{--                                                    </div>--}}
                        {{--                                                </div>--}}
                        {{--                                            </div>--}}
                        {{--                                            <div class="modal-footer">--}}
                        {{--                                                <button type="button" class="btn dark-white pull-left p-x-md"--}}
                        {{--                                                        data-dismiss="modal">انصراف--}}
                        {{--                                                </button>--}}
                        {{--                                                <button type="submit" class="btn btn-primary pull-right p-x-md">افتتاح--}}
                        {{--                                                    حساب--}}
                        {{--                                                </button>--}}
                        {{--                                            </div>--}}
                        {{--                                        </form>--}}
                        {{--                                    </div>--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}

                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped b-t">
                            <thead>
                            <tr>
                                <th>شماره حساب</th>
                                <th>نام حساب</th>
                                <th>نام کاربری</th>
                                <th>صاحب حساب</th>
                                <th>رشد حساب</th>
                                <th>موجودی</th>
                                <th>قابل برداشت</th>
                                <th>وضعیت</th>
                                <th>گزینه‌ها</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($accounts as $item)
                                @php
                                    $investments = 0;
                                    foreach ($item->investments as $investment){
                                        $investments += $investment->amount;
                                    }
                                    $withdraw = $item->balance - $investments;
                                @endphp
                                <tr style="background: rgba({{\App\Helpers\AccountHelper::hex2RGB(str_replace('#','', \App\Helpers\AccountHelper::color($item->color)), true)}},0.1);">
                                    <td>{{$item->no}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->user->username}}</td>
                                    <td>{{$item->user->full_name}}</td>
                                    <td>{{$item->growth}}</td>
                                    <td>{{number_format($item->balance)}} <small>تتر</small></td>
                                    <td>{{number_format($withdraw)}} <small>تتر</small></td>
                                    <td>{!! \App\Helpers\AccountHelper::status($item->status) !!}</td>
                                    <td>
                                        @if(auth()->user()->is_admin && !$item->is_confirmed)
                                            <a href="{{route('admin.maccounts.accept', ['account' => $item->id])}}"
                                               class="btn btn-success btn-sm text-sm text-white">تایید</a>
                                        @endif
                                        <a data-toggle="modal" data-target="#charge-{{$item->uuid}}"
                                           class="btn btn-success btn-sm text-sm text-white">افزایش موجودی</a>
                                        <div id="charge-{{$item->uuid}}" class="modal" data-backdrop="true">
                                            <div class="row-col h-v">
                                                <div class="row-cell v-m">
                                                    <div class="modal-dialog modal-md">
                                                        <form method="post"
                                                              action="{{route('admin.accounts.charge',  $item->uuid)}}"
                                                              class="modal-content">
                                                            @csrf
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">افزایش موجودی</h5>
                                                            </div>
                                                            <div class="modal-body text-center p-lg">
                                                                <div class="row">
                                                                    @if(count($item->user->wallets) === 0)
                                                                        <div class="alert alert-danger">
                                                                            کاربر کیف پول تایید شده ای ندارد.
                                                                        </div>
                                                                    @else
                                                                        <div class="form-group col-sm-6">
                                                                            <label class="control-label pull-left"
                                                                                   for="amount"> مبلغ<small>(حداقل 100
                                                                                    تتر)</small></label>
                                                                            <input class="form-control" type="number"
                                                                                   name="amount" id="amount"
                                                                                   placeholder="به تتر وارد کنید">
                                                                        </div>
                                                                        <div class="form-group col-sm-6">
                                                                            <label class="control-label pull-left"
                                                                                   for="wallet">{{"کیف پول " . $item->user->full_name}}</label>
                                                                            <select class="form-control" name="wallet">
                                                                                @foreach($item->user->wallets as $wallet)
                                                                                    <option
                                                                                        value="{{$wallet->id}}">{{$wallet->address}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button"
                                                                        class="btn dark-white pull-left p-x-md"
                                                                        data-dismiss="modal">انصراف
                                                                </button>
                                                                <button type="submit"
                                                                        class="btn btn-primary pull-right p-x-md">افزایش
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a data-toggle="modal" data-target="#delete-{{$item->id}}"
                                           class="btn btn-danger btn-sm text-sm text-white">انحلال (حذف)</a>
                                        <div id="delete-{{$item->id}}" class="modal" data-backdrop="true">
                                            <div class="row-col h-v">
                                                <div class="row-cell v-m">
                                                    <div class="modal-dialog modal-md">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">تسویه حساب</h5>
                                                            </div>
                                                            <div class="modal-body text-center p-lg">
                                                                @if($item->balance == 0)
                                                                    آیا از حذف این حساب مالی مطمئن هستید؟
                                                                @else
                                                                    <p>برای تسویه حساب باید موجودی حساب کاربر صفر باشد.
                                                                        برای این منظور درخواست تسویه ثبت کنید یا انتقال
                                                                        داخلی انجام دهید.</p>
                                                                @endif
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button"
                                                                        class="btn dark-white pull-left p-x-md"
                                                                        data-dismiss="modal">انصراف
                                                                </button>
                                                                @if($item->balance == 0)
                                                                    <form
                                                                        action="{{route('admin.accounts.destroy', ['uuid' => $item->uuid])}}"
                                                                        method="post">
                                                                        @method('DELETE')
                                                                        @csrf
                                                                        <button type="submit"
                                                                                class="btn danger text-white pull-right p-x-md">
                                                                            منحل میکنم
                                                                        </button>
                                                                    </form>
                                                                @else
                                                                    <a href="{{route('admin.withdraws.index')}}"
                                                                       class="btn btn-primary pull-right p-x-md">درخواست
                                                                        تسویه</a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{$accounts->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
