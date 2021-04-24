@extends('layout.panel')
@section('pageTitle', 'مشاهده پروفایل')
@section('content')
    <div class="padding">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h2>مشاهده پروفایل</h2>
                        <small>
                            با استفاده از فرم زیر میتوانید پروفایل خود را مشاهده کنید.
                        </small>
                        </div>
                        <div class="box-divider m-a-0"></div>
                        <div class="box-body">
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{$error}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if(\Illuminate\Support\Facades\Session::has('error'))
                                <div class="alert alert-danger">
                                    <ul>
                                        <li>{{\Illuminate\Support\Facades\Session::get('error')}}</li>
                                    </ul>
                                </div>
                            @endif
                            @if(\Illuminate\Support\Facades\Session::has('success'))
                                <div class="alert alert-success">
                                    <p>تغییرات درخواستی شما با موفقیت بروزرسانی شد.</p>
                                </div>
                            @endif
                            <form role="form" method="post" action="{{route('profile.update')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label for="name" class="form-control-label">نام</label>
                                        <input type="text" name="name" class="form-control" id="name" value="{{$user->name}}">
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="username" class="form-control-label">نام‌کاربری</label>
                                        <input type="text" name="username" class="form-control" id="username" value="{{$user->username}}">
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="email" class="form-control-label">ایمیل</label>
                                        <input type="text" disabled="disabled" name="email" class="form-control" id="email" value="{{$user->email}}">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-sm-4">
                                        <label for="mobile" class="form-control-label">شماره موبایل</label>
                                        <input disabled="disabled" type="text" name="mobile" class="form-control" id="mobile" value="{{$user->mobile}}">
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="current_password" class="form-control-label">رمزعبور فعلی</label>
                                        <input type="password" name="current_password" class="form-control" id="current_password">
                                        <small class="help-block text-warning">اگر میخواهید تغییر ندهید، خالی رها کنید</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="new_password" class="form-control-label">رمز عبور جدید</label>
                                        <input type="password" name="new_password" class="form-control" id="new_password">
                                        <small class="help-block text-warning">اگر میخواهید تغییر ندهید، خالی رها کنید</small>
                                    </div>
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
                            @if($user->username != null)
                            <h5 class="center-block text-center">
                                <a class="text-center text-primary" href="{{route('register', ['captain' => $user->username])}}"><code style="font-family: Verdana, Arial, Helvetica, sans-serif !important;">{{route('register', ['captain' => $user->username])}}</code></a>
                            </h5>
                            <hr>
                            @if(count($team) === 0)
                                <div class="alert alert-info text-center">
                                    <h4>اوه نه، هنوز دوستان خود را دعوت نکردید. همین الان میتونین شروع کنین 😊</h4>
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
                                                <td>{{$item->name}}</td>
                                                <td>{{substr($item->mobile, -4) . '****' . substr($item->mobile, 0, 3)}}</td>
                                                <td>{{\Morilog\Jalali\Jalalian::forge($item->created_at)->format('H:i:s Y/m/d')}}</td>
{{--                                                <td>{{ \App\Helpers\UserHelper::status($item->status) }}</td>--}}
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                            @else
                                <h5 class="center-block text-center">
                                    <p class="text-center text-primary">کاربر گرامی، برای دریافت لینک معرفی، لطفا ابتدا نام‌کاربری خود را وارد کنید. </p>
                                </h5>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
