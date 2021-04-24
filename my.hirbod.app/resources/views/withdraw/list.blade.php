@extends('layout.panel')
@section('pageTitle', 'لیست برداشت‌های من')
@section('content')
    <div class="padding">
        <div class="row">
            <div class="col-sm-12">
                <div class="box">
                    <div class="box-header">
                        <div class="pull-left">
                            <h2>لیست برداشت‌های من</h2>
                            <small>
                                در لیست زیر میتوانید تمامی برداشت‌های خود را مشاهده کنید
                            </small>
                        </div>
                        <a href="{{route('withdraws.create')}}" class="btn btn-sm text-sm text-sm-center btn-primary pull-right">برداشت میکنم</a>
                    </div>
                    <div class="box-body">
                        <div class="alert alert-danger">
                            <p>مشتریان گرامی، به منظور اعلام نهادهای نظارتی مبنی بر اصلاحیه رویه پرداخت سود جهت جلوگیری از پولشویی حتما کارت بانکی بایستی همان کارت بانکی که سرمایه گذاری از آن انجام شده است باشد. ضمنا عقد قرارداد مکتوب جهت پرداخت سود نیز الزامی شد لذا تا عقد قرارداد اجازه پرداخت سود به مجموعه یوانوست داده نشده است. تمام تلاش همکاران حقوقی بر این است که در هفته آینده تاییدیه نهادهای حاکمیتی در این زمینه اخذ شود. اطمینان میدهیم که سرمایه و سود شما در پیش ما محفوظ است و در اولین فرصت پرداخت سودها از سر گرفته خواهد شد.</p>
                        </div>
                    </div>
                        <div class="table-responsive">
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
                                    <td>{{number_format($item->amount)}} <small>تومان</small></td>
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
                                                                    <form method="post" class="pull-right" action="{{route('withdraws.destroy', ['withdraw' => $item->id])}}">
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
                    </div>
                    {{$withdraws->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
