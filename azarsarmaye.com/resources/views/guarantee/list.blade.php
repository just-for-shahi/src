@extends('layout.panel')
@section('pageTitle', 'لیست ضمانت‌های من')
@section('content')
    <div class="padding">
        <div class="row">
            <div class="col-sm-12">
                <div class="box">
                    <div class="box-header">
                        <div class="pull-left">
                            <h2>لیست ضمانت‌های من</h2>
                            <small>
                                در لیست زیر میتوانید تمامی ضمانت‌های خود را مشاهده کنید
                            </small>
                        </div>
                        <a href="{{route('guarantees.create')}}" class="btn btn-sm text-sm text-sm-center btn-primary pull-right">ضمانت میخوام</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped b-t">
                            <thead>
                            <tr>
                                <th>سرمایه‌گذاری</th>
                                <th>نوع</th>
                                <th>سند مربوطه</th>
                                <th>کدپستی</th>
                                <th>شماره مرسوله</th>
                                <th>هزینه صدور و ارسال</th>
                                <th>وضعیت</th>
                                <th>گزینه‌ها</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($guarantees as $item)
                                <tr>
                                    <td>{{\App\Helpers\InvestmentHelper::summary($item->id)}}</td>
                                    <td>{{\App\Helpers\GuaranteeHelper::type($item->type)}}</td>
                                    <td>@if($item->document != null) <a href="{{asset('uploads', $item->document)}}" class="btn btn-primary btn-sm">مشاهده</a> @else <span>بارگذاری نشده</span> @endif</td>
                                    <td>{{$item->zip}}</td>
                                    <td>@if($item->trace === null) در انتظار ارسال @else {{$item->trace}} @endif</td>
                                    <td>@if($item->price === null) محاسبه نشده @else {{number_format($item->price)}} <small>تومان</small> @endif</td>
                                    <td>{!! \App\Helpers\GuaranteeHelper::status($item->status) !!}</td>
                                    <td>
                                        @if($item->status == 1)
                                            <a class="btn btn-success btn-sm text-sm text-white">پرداخت</a>
                                        @endif
                                        @if(auth()->user()->role === 6 && $item->status === 0)
                                            <a data-toggle="modal" data-target="#withdraw-{{$item->id}}" class="btn btn-success btn-sm text-sm text-white">ثبت هزینه</a>
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
                                                                    <h5 class="modal-title">انصراف از درخواست</h5>
                                                                </div>
                                                                <div class="modal-body text-center p-lg">
                                                                    <p>مشتری عزیز، آیا از انصراف خود مبنی بر لغو درخواست صدور ضمانت اصل سرمایه مطمئن هستید؟</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn dark-white p-x-md pull-left" data-dismiss="modal">بستن</button>
                                                                    <form method="post" class="pull-right" action="{{route('guarantees.destroy', ['guarantee' => $item->id])}}">
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
                    {{$guarantees->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
