@extends('layout.panel')
@section('pageTitle', 'لیست انتقال‌های بانکی')
@section('content')
    <div class="padding">
        <div class="row">
            <div class="col-sm-12">
                <div class="box">
                    <div class="box-header">
                        <div class="pull-left">
                            <h2>لیست انتقال‌های بانکی</h2>
                            <small>
                                در لیست زیر میتوانید تمامی انتقال‌های بانکی خود را مشاهده کنید
                            </small>
                        </div>
                        <a href="{{route('bank-transfers.create')}}" class="btn text-sm btn-sm text-sm-center btn-primary pull-right">ثبت انتقال بانکی</a>
                    </div>
                    <div class="table-responsive">

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
                            @foreach($bankTransfers as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{\App\Helpers\AccountHelper::summary($item->account)}}</td>
                                    <td>#{{$item->transaction}}</td>
                                    <td>{{number_format($item->amount)}} <small>تومان</small></td>
                                    <td>@if($item->receipt === null)ندارد@else <a href="{{asset('usercontent/'.$item->receipt)}}" class="btn btn-sm text-sm btn-light">مشاهده</a> @endif</td>
                                    <td>{!! \App\Helpers\BankTransferHelper::status($item->status) !!}</td>
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
                                                                <a href="{{route('bank-transfers.destroy', ['bank_transfer' => $item->id])}}" type="button" class="btn danger p-x-md">بلی</a>
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
                    {{$bankTransfers->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
