@extends('layout.panel')
@section('pageTitle', 'تیکت پشتیبانی')
@section('content')
    <div class="padding">
        <div class="row">
            <div class="col-sm-12">
                <div class="box row-col" style="min-height:450px">
                    <div class="box-header b-b">
                        <div class="pull-left">
                            <strong>{{$ticket->title}}</strong>
                        </div>
                        <div class="pull-right">
                            @if($ticket->attachment != null)
                                <a href="{{route('index').'/uploads/'.$ticket->attachment}}" target="_blank" class="m-l-2 btn btn-sm text-sm btn-outline-success">دانلود پیوست</a>
                            @else
                                <span class="text-warning m-l-2">بدون پیوست</span>
                            @endif
                            {!! \App\Helpers\Support\TicketHelper::status($ticket->status) !!}
                        </div>
                        <br>
                    </div>
                    <div class="row-row light dk">
                        <div class="row-body">
                            <div class="row-inner">
                                <div class="p-a-md">
                                    <div class="m-b">
                                        <a href="#" class="pull-left w-40 m-r-sm">
                                            <img src="{{asset('assets/images/avatar.jpg')}}" alt="{{auth()->user()->first_name.' '.auth()->user()->last_name}}" class="w-full img-circle">
                                        </a>
                                        <div class="clear">
                                            <div>
                                                <div class="p-a p-y-sm dark-white inline r">
                                                    {{\App\Helpers\UserHelper::summary($ticket->user)}}: {!! $ticket->message !!}
                                                </div>
                                            </div>
                                            <div class="text-muted text-xs m-t-xs"><i class="fa fa-ok text-success"></i> {{\Morilog\Jalali\Jalalian::forge($ticket->created_at)->ago()}}</div>
                                        </div>
                                    </div>
                                    @foreach($ticket->replies as $reply)
                                        @if(\App\HModels\User::find($reply->user)->role == 6)
                                            <div class="m-b">
                                                <a href="#" class="pull-right w-40 m-l-sm">
                                                    <img src="{{asset('assets/images/avatar.jpg')}}" class="w-full img-circle" alt="uinvest admin">
                                                </a>
                                                <div class="clear text-right">
                                                    <div class="p-a p-y-sm info inline text-left r">
                                                        {!! $reply->message !!}
                                                        <br>
                                                        @if($reply->attachment != null)
                                                            <a href="{{route('index').'/uploads/'.$reply->attachment}}" target="_blank" class="btn col-sm-2 pull-right btn-sm">دانلود پیوست</a>
                                                        @endif
                                                    </div>
                                                    <div class="text-muted text-xs m-t-xs">{{\Morilog\Jalali\Jalalian::forge($reply->created_at)->ago()}}</div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="m-b">
                                                <a href="#" class="pull-left w-40 m-r-sm">
                                                    <img src="{{asset('assets/images/avatar.jpg')}}" alt="..." class="w-full img-circle">
                                                </a>
                                                <div class="clear">
                                                    <div class="p-a p-y-sm dark-white inline r">
                                                        {{\App\Helpers\UserHelper::summary($reply->user)}}: {!! $reply->message !!}
                                                        <br>
                                                        @if($reply->attachment != null)
                                                            <a href="{{route('index').'/uploads/'.$reply->attachment}}" target="_blank" class="btn col-sm-2 pull-right btn-sm">دانلود پیوست</a>
                                                        @endif
                                                    </div>
                                                    <div class="text-muted text-xs m-t-xs"><i class="fa fa-ok text-success"></i> {{\Morilog\Jalali\Jalalian::forge($reply->created_at)->ago()}}</div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer b-t">
                        <form action="{{route('tickets.reply', ['uuid' => $ticket->uuid])}}" method="post">
                            @csrf
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{$error}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="input-group">
                                <input type="text" class="form-control" name="message" value="{{old('message')}}" placeholder="پاسخ خود را بنویسید">
                                <span class="input-group-btn">
                                <button class="btn white b-a no-shadow" type="submit">ارسال</button>
                            </span>
                            </div>
                            {{--                            <div class="form-group m-t-1">--}}
                            {{--                                <p class="col-md-1 pull-left">فایل پیوست: </p>--}}
                            {{--                                <div class="col-md-3 m-b-1 pull-left">--}}
                            {{--                                    <input type="file" class="form-control" name="attachment">--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
