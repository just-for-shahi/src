@extends('layout.panel')
@section('pageTitle', 'ریزفعالیت ها')
@section('content')
    <div class="padding">
        <div class="row">
            <div class="col-sm-12">
                <div class="box">
                    <div class="box-header">
                        <div class="pull-left">
                            <h2>ریزفعالیت ها</h2>
                            <small>
                                در لیست زیر میتوانید تمامی ریزفعالیت های خود را مشاهده کنید
                            </small>
                        </div>
                    </div>
                    <div class="table-responsive">

                        <table class="table table-striped b-t">
                            <thead>
                            <tr>
                                <th>توضیح فعالیت</th>
                                <th>تاریخ و زمان</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($activities as $item)
                                <tr>
                                    <td>{{$item->description}}</td>
                                    <td>{{Morilog\Jalali\Jalalian::forge($item->created_at)}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{$activities->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
