@extends('layout.panel')
@section('pageTitle', 'لیست پرداخت‌های بانکی')
@section('content')
    <div class="padding">
        <div class="row">
            <div class="col-sm-12">
                <div class="box">
                    <div class="box-header">
                        <div class="pull-left">
                            <h2>لیست پرداخت‌های بانکی</h2>
                            <small>
                                در لیست زیر میتوانید تمامی پرداخت‌های بانکی خود را مشاهده کنید
                            </small>
                        </div>
                        <a data-toggle="modal" data-target="#new" class="btn btn-sm text-sm text-sm-center btn-primary text-white pull-right">ثبت پرداخت بانکی</a>
                        <div id="new" class="modal" data-backdrop="true">
                            <div class="row-col h-v">
                                <div class="row-cell v-m">
                                    <div class="modal-dialog modal-md">
                                        <form action="{{route('bankPayments.store')}}" enctype="multipart/form-data" method="post" class="modal-content">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title">ثبت پرداخت بانکی</h5>
                                            </div>
                                            <div class="modal-body text-center p-lg">
                                                <div class="row">
                                                    @if(count($bankAccounts) === 0)
                                                        <a href="{{route('bankAccounts.index')}}" class="alert alert-danger">مشتری گرامی جهت ثبت پرداخت بانکی باید حساب بانکی تایید شده داشته باشید. کلیک کنید.</a>
                                                    @else
                                                    <div class="col-sm-12 form-group">
                                                        <label class="control-label text-right pull-left" for="amount"> مبلغ پرداختی<span class="text-danger"> *</span></label>
                                                        <input class="form-control" id="amount" name="amount" type="number" placeholder="لطفا مبلغ سند پرداختی را به تومان وارد کنید">
                                                    </div>
                                                    <div class="col-sm-6 form-group">
                                                        <label class="control-label text-right pull-left" for="bank-account">حساب بانکی</label>
                                                        <select class="form-control" name="bank-account">
                                                            @foreach($bankAccounts as $item)
                                                                <option value="{{$item->id}}">{{\App\Helpers\BankAccountHelper::summary($item->id)}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-6 form-group">
                                                        <label class="control-label text-right pull-left" for="receipt">فایل رسید</label>
                                                        <input class="form-control" id="receipt" name="receipt" type="file">
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn dark-white pull-left p-x-md" data-dismiss="modal">انصراف</button>
                                                <button type="submit" class="btn btn-primary pull-right p-x-md">ثبت پرداخت بانکی</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        @if(count($bankPayments) === 0)
                            <img class="img-fluid center-block center" src="{{asset('img/empty.png')}}" alt="چیزی پیدا نکردیم!"/>
                            <h5 class="text-center text-muted p-b-lg">اوپس، هنوز پرداخت بانکی ثبت نکردید، معطل چی هستی؟</h5>
                        @else
                        <table class="table table-striped b-t">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>حساب مالی</th>
                                <th>تراکنش</th>
                                <th>مبلغ</th>
                                <th>رسید</th>
                                <th>وضعیت</th>
                                <th>گزینه‌ها</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($bankPayments as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{\App\Helpers\AccountHelper::summary($item->account)}}</td>
                                    <td>#{{$item->transaction}}</td>
                                    <td>{{number_format($item->amount)}} <small>تومان</small></td>
                                    <td>@if($item->receipt === null)ندارد@else <a href="{{asset('usercontent/'.$item->receipt)}}" class="btn btn-sm text-sm btn-light">مشاهده</a> @endif</td>
                                    <td>{!! \App\Helpers\BankPaymentHelper::status($item->status) !!}</td>
                                    <td>
                                        @if($item->status === 0 && auth()->user()->role === 6)
                                            <a href="{{route('mbank-transfers.accept', ['id' => $item->id])}}" class="btn btn-success btn-sm text-sm text-white">تایید</a>
                                        @endif
                                        <a data-toggle="modal" data-target="#delete-{{$item->id}}" class="btn btn-danger btn-sm text-sm text-white">حذف</a>
                                        <div id="delete-{{$item->id}}" class="modal" data-backdrop="true">
                                            <div class="row-col h-v">
                                                <div class="row-cell v-m">
                                                    <div class="modal-dialog modal-md">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">حذف انتقال بانکی</h5>
                                                            </div>
                                                            <div class="modal-body text-center p-lg">
                                                                <p>آیا از حذف انتقال بانکی خود مطمئن هستید؟</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn dark-white p-x-md" data-dismiss="modal">انصراف</button>
                                                                <a href="{{route('bankPayments.destroy', ['uuid' => $item->uuid])}}" type="button" class="btn danger p-x-md">بلی</a>
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
                        @endif
                    </div>
                    {{$bankPayments->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
