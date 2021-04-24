@extends('layout.panel')
@section('pageTitle', 'لیست حساب‌های من')
@section('content')
    <div class="padding">
        <div class="row">
            <div class="col-sm-12">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="box">
                    <div class="box-header">
                        <div class="pull-left">
                            <h2>لیست حساب‌های من</h2>
                            <small>
                                در لیست زیر میتوانید تمامی حساب‌های خود را مشاهده کنید
                            </small>
                        </div>
                        <a href="{{route('accounts.create')}}" class="btn btn-sm text-sm text-sm-center btn-primary pull-right">افتتاح حساب</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped b-t">
                            <thead>
                            <tr>
                                <th>شماره حساب</th>
                                <th>نوع</th>
                                <th>طرح</th>
                                <th>موجودی</th>
                                <th>قابل برداشت</th>
                                <th>وضعیت</th>
                                <th>گزینه‌ها</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($accounts as $item)
                                <tr>
                                    @php
                                        $investments = 0;
                                        foreach ($item->investments as $investment){
                                            $investments += $investment->amount;
                                        }
                                        $withdraw = $item->balance - $investments;
                                    @endphp
                                    <td>{{$item->no}}</td>
                                    <td>{{\App\Helpers\AccountHelper::type($item->type)}}</td>
                                    <td>{{\App\Helpers\AccountHelper::plan($item->plan)}}</td>
                                    <td>{{number_format($item->balance)}} <small>تومان</small></td>
                                    <td>{{number_format($withdraw)}} <small>تومان</small></td>
                                    <td>{!! \App\Helpers\AccountHelper::status($item->status) !!}</td>
                                    <td>
                                        @if(auth()->user()->role === 6 && $item->status != 0)
                                            <a href="{{route('maccounts.accept', ['account' => $item->id])}}" class="btn btn-success btn-sm text-sm text-white">تایید</a>
                                        @endif
                                        <a data-toggle="modal" data-target="#delete-{{$item->id}}" class="btn btn-danger btn-sm text-sm text-white">انحلال (حذف)</a>
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
                                                                    <p>برای تسویه حساب باید موجودی حساب شما صفر باشد. برای این منظور درخواست تسویه ثبت کنید یا انتقال داخلی انجام دهید.</p>
                                                                @endif
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn dark-white pull-left p-x-md" data-dismiss="modal">انصراف</button>
                                                                @if($item->balance == 0)
                                                                    <form action="{{route('accounts.destroy', ['account' => $item->id])}}" method="post">
                                                                        @method('DELETE')
                                                                        @csrf
                                                                        <button type="submit" class="btn danger text-white pull-right p-x-md">منحل میکنم</button>
                                                                    </form>
                                                                @else
                                                                <a href="{{route('tickets.create')}}" class="btn primary pull-right p-x-md">درخواست تسویه</a>
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
