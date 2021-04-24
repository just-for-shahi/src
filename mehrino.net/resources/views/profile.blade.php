@extends('partials.panel')
@section('page.title', 'مشاهده پروفایل')
@section('wrapper')
    <div class="dashboard-content">
        <div id="titlebar">
            <div class="row">
                <div class="col-md-12">
                    <h2>پروفایل من</h2>
                    <nav id="breadcrumbs">
                        <ul>
                            <li><a href="{{route('index')}}">صفحه اصلی</a></li>
                            <li><a href="{{route('dashboard')}}">داشبورد</a></li>
                            <li>پروفایل من</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="dashboard-list-box margin-top-0">
                    <h4 class="gray">مشخصات</h4>
                    <div class="dashboard-list-box-static">
                        <div>
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
                                <div class="col-md-12">
                                    <div class="notification success closeable margin-bottom-30">
                                        <ul>
                                            <li>{{\Illuminate\Support\Facades\Session::get('error')}}</li>
                                        </ul>
                                    </div>
                                </div>
                            @endif
                            @if(\Illuminate\Support\Facades\Session::has('success'))
                                <div class="col-md-12">
                                    <div class="notification success closeable margin-bottom-30">
                                        <p>تغییرات درخواستی شما با موفقیت بروزرسانی شد.</p>
                                        <a class="close"></a>
                                    </div>
                                </div>
                            @endif
                            <form role="form" method="post" action="{{route('profile.update')}}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

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
                                        <input type="text" name="email" class="form-control" id="email" value="{{$user->email}}">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-sm-4">
                                        <label for="mobile" class="form-control-label">شماره موبایل</label>
                                        <input type="text" name="mobile" class="form-control" id="mobile" value="{{$user->mobile}}">
                                    </div>
{{--                                    <div class="col-sm-4">--}}
{{--                                        <label for="current_password" class="form-control-label">رمزعبور فعلی</label>--}}
{{--                                        <input type="password" name="current_password" class="form-control" id="current_password">--}}
{{--                                        <small class="help-block text-warning">اگر میخواهید تغییر ندهید، خالی رها کنید</small>--}}
{{--                                    </div>--}}

                                    <div class="col-sm-4">
                                        <label for="avatar" class="form-control-label">پروفایل</label>
                                        <input type="file" name="avatar" class="form-control" id="avatar">
                                        {{--                                        <small class="help-block text-warning">اگر میخواهید تغییر ندهید، خالی رها کنید</small>--}}
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="new_password" class="form-control-label">رمز عبور جدید</label>
                                        <input type="password" name="new_password" class="form-control" id="new_password">
{{--                                        <small class="help-block text-warning">اگر میخواهید تغییر ندهید، خالی رها کنید</small>--}}
                                    </div>
                                </div>
                                <div class="form-group row m-t-md">
                                    <div class="col-sm-12">
                                        <button type="submit" class="button margin-top-15">بروزرسانی پروفایل</button>
                                    </div>
                                </div>
                            </form>
                                @if ($user->avatar !== null)
                                    <div class="row justify-content-start">
                                        <div class="col-sm-4">
                                            <img src="{{ getBaseUri($user->avatar) }}" alt="avatar" style="max-height: 300px">
                                        </div>
                                    </div>
                                @endif
{{--                            <hr/>--}}
{{--                            <br/>--}}
{{--                            <h5>لینک معرفی شما</h5>--}}
{{--                            <h5 class="center-block text-center">--}}
{{--                                <a class="text-center text-primary" href="{{route('register', ['c' => $user->username])}}"><code style="font-family: Verdana, Arial, Helvetica, sans-serif !important;">{{route('register', ['c' => $user->username])}}</code></a>--}}
{{--                            </h5>--}}
{{--                            <hr>--}}
{{--                            @if(count($team) === 0)--}}
{{--                                <div class="alert alert-info text-center">--}}
{{--                                    <h6>اوه نه، هنوز دوستان خود را دعوت نکردید. همین الان میتونین شروع کنین 😊</h6>--}}
{{--                                </div>--}}
{{--                            @else--}}
{{--                                <div class="table-responsive">--}}
{{--                                    <table class="table table-striped b-t">--}}
{{--                                        <thead>--}}
{{--                                        <tr>--}}
{{--                                            <th>نام</th>--}}
{{--                                            <th>شماره تماس</th>--}}
{{--                                            <th>تاریخ ثبت‌نام</th>--}}
{{--                                            <th>وضعیت</th>--}}
{{--                                        </tr>--}}
{{--                                        </thead>--}}
{{--                                        <tbody>--}}
{{--                                        @foreach($team as $item)--}}
{{--                                            <tr>--}}
{{--                                                <td>{{$item->name}}</td>--}}
{{--                                                <td>{{substr($item->mobile, -4) . '***' . substr($item->mobile, 0, 4)}}</td>--}}
{{--                                                <td>{{$item->jCreated}}</td>--}}
{{--                                                --}}{{--                                            <td>{{ \App\Helpers\UserHelper::status($item->status) }}</td>--}}
{{--                                            </tr>--}}
{{--                                        @endforeach--}}
{{--                                        </tbody>--}}
{{--                                    </table>--}}
{{--                                </div>--}}
{{--                            @endif--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
