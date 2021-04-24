@extends('layout.panel')
@section('pageTitle', 'درخواست ضمانت')
@section('content')
    <div class="padding">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h2>درخواست ضمانت</h2>
                        <small>
                            با استفاده از فرم زیر میتوانید درخواست ضمانت انجام بدید.
                        </small>
                        </div>
                        <div class="box-divider m-a-0"></div>
                        <div class="box-body">
                            <div class="alert alert-info">
                                <ol>
                                    <li>یوانوست بر ارائه سود مشخص و ثابت ماهیانه با تجربه 8 ساله و راهکارهای نرم‌افزاری با اطمینان اقدام به سرویس‌دهی را آغاز کرده است؛ لذا ارائه ضمانت تنها جهت خیال آسوده مشتریان عزیز است و در صورتی که حتی ضمانت‌نامه کتبی نداشته باشید هم اصل سرمایه شده محفوظ و <strong>تضمین شده</strong> است.</li>
                                    <li>کارمزد صدور چک صیادی 10,000 تومان است که به هزینه پستی آدرس وارد شده اضافه خواهد شد.</li>
                                    <li>پس از ثبت درخواست، هزینه پستی استعلام شده و درج می‌شود که جهت پرداخت هزینه صدور و ارسال پستی اطلاع رسانی خواهد شد.</li>
                                    <li>تمامی ضمانت‌های سرمایه یوانوست بصورت پست ویژه حداکثر تا 72 ساعت بدست مشتری خواهد رسید.</li>
                                    <li>توجه داشته باشید برای صدور ضمانت‌نامه حتما اسم کامل ثبتی خود شامل پسوند را در پروفایل خود به صورت فارسی درج کنید.</li>
                                </ol>
                            </div>
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{$error}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form role="form" method="post" action="{{route('guarantees.store')}}">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label for="investment" class="form-control-label">سرمایه‌گذاری</label>
                                        <select id="investment" class="form-control" name="investment">
                                            @foreach($investments as $investment)
                                                <option value="{{$investment->id}}">{{\App\Helpers\InvestmentHelper::summary($investment->id)}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="type" class="form-control-label">نوع ضمانت</label>
                                        <select class="form-control" id="type" name="type">
                                            <option value="0">چک صیادی</option>
                                            <option value="1">ضمانت‌نامه بانکی</option>
                                            <option value="2">قرارداد محضری</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="zip" class="form-control-label">کدپستی</label>
                                        <input type="number" class="form-control" name="zip" placeholder="کدپستی 10 رقمی" value="{{old('zip')}}">
                                    </div>
                                    <div class="col-sm-12">
                                        <label class="form-control-label" for="address">آدرس کامل</label>
                                        <input class="form-control" id="address" name="address" value="{{old('address')}}" placeholder="آدرس کامل خود را بنویسید">
                                    </div>
                                </div>
                                <div class="form-group row m-t-md">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-success pull-right">ضمانت میخوام</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
