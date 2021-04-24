<!DOCTYPE html>
<html lang="fa-IR">
<head>
    <meta charset="utf-8"/>
    <title>@yield('pageTitle') - {{config('app.name')}}</title>
    <meta name="description" content="@yield('description')"/>
    <meta name="keywords" content="@yield('keywords')"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-barstyle" content="black-translucent">
    <link rel="apple-touch-icon" href="{{asset('apple-touch-icon.png')}}">
    <meta name="apple-mobile-web-app-title" content="ManaInvest">
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="shortcut icon" sizes="196x196" href="{{asset('apple-touch-icon.png')}}">
    <link rel="stylesheet" href="{{asset('assets/css/animate.css/animate.min.css')}}" type="text/css"/>
    <link rel="stylesheet" href="{{asset('assets/css/glyphicons/glyphicons.css')}}" type="text/css"/>
    <link rel="stylesheet" href="{{asset('assets/css/font-awesome/css/font-awesome.min.css')}}" type="text/css"/>
    <link rel="stylesheet" href="{{asset('assets/css/material-design-icons/material-design-icons.css')}}"
          type="text/css"/>
    <link rel="stylesheet" href="{{asset('assets/css/ionicons/css/ionicons.min.css')}}" type="text/css"/>
    <link rel="stylesheet" href="{{asset('assets/css/simple-line-icons/css/simple-line-icons.css')}}" type="text/css"/>
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap/dist/css/bootstrap.min.css')}}" type="text/css"/>
    <link rel="stylesheet" href="{{asset('assets/css/styles/app.css')}}" type="text/css"/>
    <link rel="stylesheet" href="{{asset('assets/css/styles/style.css')}}" type="text/css"/>
    <link rel="stylesheet" href="{{asset('assets/css/styles/font.css')}}" type="text/css"/>
    <link href="{{asset('assets/css/bootstrap-rtl/dist/bootstrap-rtl.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/styles/app.rtl.css')}}" rel="stylesheet"/>
</head>
<body>
<div class="app" id="app">
    <div id="aside" class="app-aside fade nav-dropdown black">
        <div class="navside dk" data-layout="column">
            <div class="navbar no-radius">
                <a href="{{route('index')}}" class="navbar-brand">
                    <div data-ui-include="'images/logo.svg'"></div>
                    <img src="{{asset('assets/images/logo.png')}}" alt="{{config('app.name')}}" class="hide">
                    <span class="hidden-folded inline">{{config('app.name')}}</span>
                </a>
            </div>
            <div data-flex class="hide-scroll">
                <nav class="scroll nav-stacked nav-stacked-rounded nav-color">
                    <ul class="nav" data-ui-nav>

                        @if(auth()->user()->is_admin)
                            <li class="nav-header hidden-folded">
                                <span class="text-xs">ادمین</span>
                            </li>
                            <li>
                                <a href="{{route('admin.dashboard')}}" class="b-danger">
                      <span class="nav-icon text-white no-fade">
                        <i class="ion-filing"></i>
                      </span>
                                    <span class="nav-text">داشبورد</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('admin.accounts.index')}}" class="b-success">
                              <span class="nav-icon text-white no-fade">
                                <i class="ion-arrow-graph-up-right"></i>
                              </span>
                                    <span class="nav-text">حساب‌های مالی</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{route('admin.bank-accounts.index')}}" class="b-success">
                              <span class="nav-icon text-white no-fade">
                                <i class="ion-card"></i>
                              </span>
                                    <span class="nav-text">حساب های بانکی</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{route('admin.wallets.index')}}" class="b-success">
                              <span class="nav-icon text-white no-fade">
                                <i class="ion-card"></i>
                              </span>
                                    <span class="nav-text">کیف پول ها</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{route('admin.investments.index')}}" class="b-info">
                              <span class="nav-icon text-white no-fade">
                                <i class="ion-compass"></i>
                              </span>
                                    <span class="nav-text">سرمایه‌گذاری‌ها</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('admin.withdraws.index')}}" class="b-info">
                              <span class="nav-icon text-white no-fade">
                                <i class="ion-arrow-return-left"></i>
                              </span>
                                    <span class="nav-text">برداشت‌ها</span>
                                </a>
                            </li>
                            {{--                            <li>--}}
                            {{--                                <a href="{{route('admin.guarantees.index')}}" class="b-info">--}}
                            {{--                                  <span class="nav-icon text-white no-fade">--}}
                            {{--                                    <i class="ion-document-text"></i>--}}
                            {{--                                  </span>--}}
                            {{--                                    <span class="nav-text">ضمانت سرمایه‌ها</span>--}}
                            {{--                                </a>--}}
                            {{--                            </li>--}}
                            <li>
                                <a href="{{route('admin.tickets.index')}}" class="b-info">
                                  <span class="nav-icon text-white no-fade">
                                    <i class="ion-help-buoy"></i>
                                  </span>
                                    <span class="nav-text">تیکت‌های پشتیبانی</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{route('admin.transactions.index')}}" class="b-info">
                              <span class="nav-icon text-white no-fade">
                                <i class="ion-briefcase"></i>
                              </span>
                                    <span class="nav-text">تراکنش‌های مالی</span>
                                </a>
                            </li>
                            {{--                            <li>--}}
                            {{--                                <a href="{{route('admin.bank-transfers.index')}}" class="b-info">--}}
                            {{--                              <span class="nav-icon text-white no-fade">--}}
                            {{--                                <i class="ion-briefcase"></i>--}}
                            {{--                              </span>--}}
                            {{--                                    <span class="nav-text">انتقال‌های بانکی</span>--}}
                            {{--                                </a>--}}
                            {{--                            </li>--}}
                            <li>
                                <a href="{{route('admin.activities.index')}}" class="b-info">
                              <span class="nav-icon text-white no-fade">
                                <i class="ion-clipboard"></i>
                              </span>
                                    <span class="nav-text">ریزفعالیت ها</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('admin.users.index')}}" class="b-info">
                              <span class="nav-icon text-white no-fade">
                                <i class="ion-clipboard"></i>
                              </span>
                                    <span class="nav-text">مشتریان</span>
                                </a>
                            </li>
                        @endif

                        <li class="nav-header hidden-folded">
                            <span class="text-xs">منوی اصلی</span>
                        </li>
                        <li>
                            <a href="{{route('dashboard')}}" class="b-info">
                                  <span class="nav-icon text-white no-fade">
                                    <i class="ion-filing"></i>
                                  </span>
                                <span class="nav-text">داشبورد</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('accounts.index')}}" class="b-info">
                              <span class="nav-icon text-white no-fade">
                                <i class="ion-arrow-graph-up-right"></i>
                              </span>
                                <span class="nav-text">حساب‌های مالی</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('wallets.index')}}" class="b-info">
                              <span class="nav-icon text-white no-fade">
                                <i class="ion-android-apps"></i>
                              </span>
                                <span class="nav-text">کیف پول ها</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('investments.index')}}" class="b-info">
                              <span class="nav-icon text-white no-fade">
                                <i class="ion-compass"></i>
                              </span>
                                <span class="nav-text">سرمایه‌گذاری های من</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('bankAccounts.index')}}" class="b-info">
                          <span class="nav-icon text-white no-fade">
                            <i class="ion-card"></i>
                          </span>
                                <span class="nav-text">حسابهای بانکی</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{route('bankPayments.index')}}" class="b-info">
                          <span class="nav-icon text-white no-fade">
                            <i class="ion-android-document"></i>
                          </span>
                                <span class="nav-text">پرداختی های بانکی</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{route('tickets.index')}}" class="b-info">
                                  <span class="nav-icon text-white no-fade">
                                    <i class="ion-help-buoy"></i>
                                  </span>
                                <span class="nav-text">تیکت‌های پشتیبانی</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{route('transactions.index')}}" class="b-info">
                              <span class="nav-icon text-white no-fade">
                                <i class="ion-briefcase"></i>
                              </span>
                                <span class="nav-text">تراکنش‌های مالی</span>
                            </a>
                        </li>
                        {{--                        <li>--}}
                        {{--                            <a href="{{route('bank-transfers.index')}}" class="b-info">--}}
                        {{--                              <span class="nav-icon text-white no-fade">--}}
                        {{--                                <i class="ion-briefcase"></i>--}}
                        {{--                              </span>--}}
                        {{--                                <span class="nav-text">انتقال‌های بانکی</span>--}}
                        {{--                            </a>--}}
                        {{--                        </li>--}}
                        <li>
                            <a href="{{route('callRequests.index')}}" class="b-info">
                              <span class="nav-icon text-white no-fade">
                                <i class="ion-android-call"></i>
                              </span>
                                <span class="nav-text">درخواست تماس‌</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('activities')}}" class="b-info">
                              <span class="nav-icon text-white no-fade">
                                <i class="ion-clipboard"></i>
                              </span>
                                <span class="nav-text">ریزفعالیت ها</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('profile.show')}}" class="b-info">
                          <span class="nav-icon text-white no-fade">
                            <i class="ion-person"></i>
                          </span>
                                <span class="nav-text">حساب کاربری</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>

        </div>
    </div>
    <div id="content" class="app-content box-shadow-z2 bg pjax-container" role="main">
        <div class="app-header white bg b-b">
            <div class="navbar" data-pjax>
                <a data-toggle="modal" data-target="#aside" class="navbar-item pull-left hidden-lg-up p-r m-a-0">
                    <i class="ion-navicon"></i>
                </a>
                <div class="navbar-item pull-left h5" id="pageTitle">@yield('pageTitle')</div>
                <ul class="nav navbar-nav pull-right">
                    <li class="nav-item"><a onclick="window.open('https://azarsarmaye.com')"
                                            class="btn btn-sm text-sm btn-primary text-white m-t-1">صفحه‌نخست</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link clear" data-toggle="dropdown">
                            <span class="avatar w-32">
                                <img src="{{asset('assets/images/a0.jpg')}}" class="w-full rounded"
                                     alt="{{auth()->user()->first_name}}">
                            </span>
                        </a>
                        <div class="dropdown-menu w dropdown-menu-scale pull-right">
                            <a class="dropdown-item" href="{{route('profile.show')}}">
                                <span>پروفایل</span>
                            </a>
                            <a class="dropdown-item" href="{{route('logout')}}">خروج</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="app-footer white bg p-a b-t">
            <div class="pull-right text-sm text-muted">نسخه {{config('azarsarmaye.version')}}</div>
            <span class="text-sm text-muted">&copy;تمامی حقوق برای <strong>«آذران تجارت الکترونیک شهریار»</strong> محفوظ است. </span>
        </div>
        <div class="app-body">
            <div class="padding">
                <div class="row">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('assets/libs/jquery/dist/jquery.js')}}"></script>
<script src="{{asset('assets/libs/tether/dist/js/tether.min.js')}}"></script>
<script src="{{asset('assets/libs/bootstrap/dist/js/bootstrap.js')}}"></script>
<script src="{{asset('assets/libs/jQuery-Storage-API/jquery.storageapi.min.js')}}"></script>
<script src="{{asset('assets/libs/PACE/pace.min.js')}}"></script>
<script src="{{asset('assets/libs/jquery-pjax/jquery.pjax.js')}}"></script>
<script src="{{asset('assets/libs/blockUI/jquery.blockUI.js')}}"></script>
<script src="{{asset('assets/libs/jscroll/jquery.jscroll.min.js')}}"></script>
<script src="{{asset('assets/scripts/config.lazyload.js')}}"></script>
<script src="{{asset('assets/scripts/ui-load.js')}}"></script>
<script src="{{asset('assets/scripts/ui-jp.js')}}"></script>
<script src="{{asset('assets/scripts/ui-include.js')}}"></script>
<script src="{{asset('assets/scripts/ui-device.js')}}"></script>
<script src="{{asset('assets/scripts/ui-form.js')}}"></script>
<script src="{{asset('assets/scripts/ui-modal.js')}}"></script>
<script src="{{asset('assets/scripts/ui-nav.js')}}"></script>
<script src="{{asset('assets/scripts/ui-list.js')}}"></script>
<script src="{{asset('assets/scripts/ui-screenfull.js')}}"></script>
<script src="{{asset('assets/scripts/ui-scroll-to.js')}}"></script>
<script src="{{asset('assets/scripts/ui-toggle-class.js')}}"></script>
<script src="{{asset('assets/scripts/ui-taburl.js')}}"></script>
<script src="{{asset('assets/scripts/app.js')}}"></script>
<script src="{{asset('assets/scripts/ajax.js')}}"></script>
@yield('scripts')
</body>
</html>
