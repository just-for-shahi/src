@extends('layout.panel')
@section('pageTitle', 'لیست مشتریان')
@section('content')
    <div class="padding">
        <div class="row">
            <div class="col-sm-12">
                <div class="box">
                    <div class="box-header">
                        <div class="pull-left">
                            <h2>لیست مشتریان</h2>
                            <small>
                                در لیست زیر میتوانید تمامی مشتریان را مشاهده کنید
                            </small>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped b-t">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>نام</th>
                                <th>نام‌کاربری</th>
                                <th>ایمیل</th>
                                <th>موبایل</th>
                                <th>موجودی تقریبی</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $item)
                                @php
                                    $balance = \App\Models\Account::where('user', $item->id)->sum('balance');
                                @endphp
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->username}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->mobile}}</td>
                                    <td>{{number_format($balance)}} <small>تومان</small></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{$users->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
