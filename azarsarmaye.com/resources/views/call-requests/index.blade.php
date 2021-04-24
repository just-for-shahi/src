@extends('layout.panel')
@section('pageTitle', 'درخواست تماس')
@section('content')
    <div class="padding">
        <div class="row">
            <div class="col-sm-12">
                <div class="box">
                    <div class="box-header">
                        <div class="pull-left">
                            <h2>لیست درخواست‌های تماس</h2>
                            <small>
                                در لیست زیر میتوانید تمامی درخواست‌های تماس خود را مشاهده کنید
                            </small>
                        </div>
                        <a data-toggle="modal" data-target="#new" class="btn btn-sm text-sm text-sm-center btn-primary text-white pull-right">درخواست تماس</a>
                        <div id="new" class="modal" data-backdrop="true">
                            <div class="row-col h-v">
                                <div class="row-cell v-m">
                                    <div class="modal-dialog modal-md">
                                        <form action="{{route('callRequests.store')}}" method="post" class="modal-content">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title">درخواست تماس جدید</h5>
                                            </div>
                                            <div class="modal-body text-center p-lg">
                                                <div class="row">
                                                    <div class="col-sm-6 form-group">
                                                        <label class="control-label text-right pull-left" for="phone">شماره تماس</label>
                                                        <input class="form-control" id="phone" name="phone" type="number" placeholder="لطفا شماره تماس مدنظرتان را وارد کنید">
                                                    </div>
                                                    <div class="col-sm-6 form-group">
                                                        <label class="control-label text-right pull-left" for="name">نام شما</label>
                                                        <input class="form-control" id="name" name="name" type="text" placeholder="لطفا نام خود را وارد کنید">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn dark-white pull-left p-x-md" data-dismiss="modal">انصراف</button>
                                                <button type="submit" class="btn btn-primary pull-right p-x-md">ثبت درخواست</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        @if(count($items) === 0)
                            <img class="img-fluid center-block center" src="{{asset('img/empty.png')}}" alt="چیزی پیدا نکردیم!"/>
                            <h5 class="text-center text-muted p-b-lg">اوپس، هنوز درخواست تماسی ثبت نکردید، معطل چی هستی؟</h5>
                        @else
                        <table class="table table-striped b-t">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>حساب کاربری</th>
                                <th>نام</th>
                                <th>شماره تماس</th>
                                <th>وضعیت</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($items as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->user->summary}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->phone}}</td>
                                    <td>{!! \App\Helpers\CallRequestHelper::status($item->status) !!}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>
                    {{$items->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
