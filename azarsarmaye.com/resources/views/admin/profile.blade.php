@extends('layout.panel')
@section('pageTitle', 'حساب کاربری')
@section('content')
    <div class="padding">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h2>حساب کاربری</h2>
                        <small>
                            با استفاده از فرم زیر میتوانید حساب کاربری خود را بروزرسانی کنید.
                        </small>
                    </div>
                    <div class="box-divider m-a-0"></div>
                    <div class="box-body">
                        @include('partials.errors')

                        <form role="form" method="post" action="{{route('admin.users.update', $user->uuid)}}"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="first_name" class="form-control-label">نام</label>
                                    <input type="text" name="first_name" class="form-control" id="first_name"
                                           value="{{$user->first_name}}">
                                </div>
                                <div class="col-sm-3">
                                    <label for="last_name" class="form-control-label">نام‌خانوادگی</label>
                                    <input type="text" name="last_name" class="form-control" id="last_name"
                                           value="{{$user->last_name}}">
                                </div>
                                <div class="col-sm-3">
                                    <label for="identity_no" class="form-control-label">کدملی</label>
                                    <input type="text" name="identity_no" class="form-control" id="identity_no"
                                           value="{{$user->identity_no}}">
                                </div>
                                <div class="col-sm-3">
                                    <label for="phone" class="form-control-label">تلفن ثابت</label>
                                    <input type="text" name="phone" class="form-control" id="phone"
                                           value="{{$user->phone}}">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-3">
                                    <label for="email" class="form-control-label">ایمیل</label>
                                    <input type="text" disabled="disabled" name="email" class="form-control" id="email"
                                           value="{{$user->email}}">
                                </div>
                                <div class="col-sm-3">
                                    <label for="mobile" class="form-control-label">شماره موبایل</label>
                                    <input disabled="disabled" type="text" name="mobile" class="form-control"
                                           id="mobile" value="{{$user->mobile}}">
                                </div>
                                <div class="col-sm-3">
                                    <label for="current_password" class="form-control-label">رمزعبور فعلی</label>
                                    <input type="password" name="current_password" class="form-control"
                                           id="current_password">
                                    <small class="help-block text-warning">اگر میخواهید تغییر ندهید، خالی رها
                                        کنید</small>
                                </div>
                                <div class="col-sm-3">
                                    <label for="new_password" class="form-control-label">رمز عبور جدید</label>
                                    <input type="password" name="new_password" class="form-control" id="new_password">
                                    <small class="help-block text-warning">اگر میخواهید تغییر ندهید، خالی رها
                                        کنید</small>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-3">
                                    <label for="identity_card_front" class="form-control-label">کارت ملی (تصویر
                                        رو)</label>
                                    <input type="file" name="identity_card_front" class="form-control"
                                           id="identity_card_front">
                                </div>
                                <div class="col-sm-3">
                                    <label for="identity_card_back" class="form-control-label">کارت ملی (تصویر
                                        پشت)</label>
                                    <input type="file" name="identity_card_back" class="form-control"
                                           id="identity_card_back">
                                </div>
{{--                                <div class="col-sm-3">--}}
{{--                                    <label for="confession" class="form-control-label">تعهدنامه</label>--}}
{{--                                    <input type="file" name="confession" class="form-control" id="confession">--}}
{{--                                </div>--}}
{{--                                <div class="col-sm-3">--}}
{{--                                    <label for="residential" class="form-control-label">گواهی سکونت</label>--}}
{{--                                    <input type="file" name="residential" class="form-control" id="residential">--}}
{{--                                </div>--}}
                            </div>
                            <div class="form-group row m-t-md">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary pull-right">بروزرسانی پروفایل</button>
                                </div>
                            </div>
                        </form>
                        <hr/>
                        <br/>
                        <h5>لینک معرفی شما</h5>
                        <h5 class="center-block text-center">
                            <a class="text-center text-primary"
                               href="{{route('register', ['c' => $user->username])}}"><code
                                    style="font-family: Verdana, Arial, Helvetica, sans-serif !important;">{{route('register', ['c' => $user->username])}}</code></a>
                        </h5>
                        <hr>
                        @if(count($team) === 0)
                            <div class="alert alert-info text-center">
                                <h6>اوه نه، هنوز دوستان خود را دعوت نکردید. همین الان میتونین شروع کنین 😊</h6>
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-striped b-t">
                                    <thead>
                                    <tr>
                                        <th>نام</th>
                                        <th>شماره تماس</th>
                                        <th>تاریخ ثبت‌نام</th>
                                        <th>وضعیت</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($team as $item)
                                        <tr>
                                            <td>{{$item->first_name}} {{$item->last_name}}</td>
                                            <td>{{substr($item->mobile, -4) . '***' . substr($item->mobile, 0, 4)}}</td>
                                            <td>{{Morilog\Jalali\Jalalian::forge($item->created_at)->format('H:i:s Y/m/d')}}</td>
                                            <td>{{ \App\Helpers\UserHelper::status($item->status) }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
