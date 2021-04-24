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
                        <a href="{{route('admin.tickets.create')}}"
                           class="btn btn-sm text-sm text-sm-center btn-primary pull-right">ایجاد تیکت</a>
                    </div>
                    <div class="table-responsive">
                        @if(count($tickets) === 0)
                            <img class="img-fluid center-block center" src="{{asset('img/empty.png')}}"
                                 alt="چیزی پیدا نکردیم!"/>
                            <h5 class="text-center text-muted p-b-lg">اوپس، هنوز تیکت ثبت نکردید، معطل چی هستی؟</h5>
                        @else
                            <table class="table table-striped b-t">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>نام کاربری</th>
                                    <th>نام کاربر</th>
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
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->user->username}}</td>
                                        <td>{{$item->user->full_name}}</td>
                                        <td>{{$item->title}}</td>
                                        <td>{{\App\Helpers\TicketHelper::priority($item->priority)}}</td>
                                        <td>{{\App\Helpers\TicketHelper::department($item->department)}}</td>
                                        <td>{!! \App\Helpers\TicketHelper::status($item->status) !!}</td>
                                        <td>{{Morilog\Jalali\Jalalian::forge($item->created_at)}}</td>
                                        <td>{{Morilog\Jalali\Jalalian::forge($item->updated_at)}}</td>
                                        <td>
                                            <a href="{{route('admin.tickets.show', $item->uuid)}}"
                                               class="btn btn-primary btn-sm text-sm">مشاهده</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                    {{$tickets->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
