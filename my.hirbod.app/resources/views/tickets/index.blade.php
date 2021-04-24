@extends('layout.panel')
@section('pageTitle', 'لیست تیکت‌ها')
@section('content')
    <div class="padding">
        <div class="row">
            <div class="col-sm-12">
                <div class="box">
                    <div class="box-header">
                        <div class="pull-left">
                            <h2>لیست تیکت‌ها</h2>
                            <small>
                                در لیست زیر میتوانید تمامی تیکت‌های سیستم را مشاهده کنید
                            </small>
                        </div>
                        <a href="{{route('tickets.create')}}" class="btn btn-sm text-sm text-sm-center btn-primary pull-right">ایجاد تیکت</a>
                    </div>
                    <div class="table-responsive">

                        <table class="table table-striped b-t">
                            <thead>
                            <tr>
                                <th>عنوان</th>
                                <th>سطح اهمیت</th>
                                <th>دپارتمان</th>
                                <th>وضعیت</th>
                                <th>تاریخ درخواست</th>
                                <th>تاریخ بروزرسانی</th>
                                <th>گزینه‌ها</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tickets as $item)
                                <tr>
                                    <td>{{$item->title}}</td>
                                    <td>{{\App\Helpers\Support\TicketHelper::priority($item->priority)}}</td>
                                    <td>{{\App\Helpers\Support\TicketHelper::department($item->department)}}</td>
                                    <td>{!! \App\Helpers\Support\TicketHelper::status($item->status) !!}</td>
                                    <td>{{Morilog\Jalali\Jalalian::forge($item->created_at)}}</td>
                                    <td>{{Morilog\Jalali\Jalalian::forge($item->updated_at)}}</td>
                                    <td>
                                        @if(auth()->user()->role === 6)
                                            <a href="{{route('tickets.show', ['uuid' => $item->uuid])}}" class="btn btn-primary btn-sm text-sm">مشاهده</a>
                                        @else
                                            <a href="{{route('tickets.show', ['uuid' => $item->uuid])}}" class="btn btn-primary btn-sm text-sm">مشاهده</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{$tickets->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
