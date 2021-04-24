@extends('partials.panel')
@section('page.title', 'کاربرها')
@section('wrapper')
<div class="dashboard-content">
    <div id="titlebar">
        <div class="row">
            <div class="col-md-12">
                <h2>کاربرها</h2>
                <nav id="breadcrumbs">
                    <ul>
                        <li><a href="{{route('index')}}">صفحه اصلی</a></li>
                        <li><a href="{{route('dashboard')}}">داشبورد</a></li>
                        <li>کاربرها</li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="dashboard-list-box margin-top-0">
                <div class="booking-requests-filter">
                    <a href="{{route('panel.users.create')}}" class="button"><i class="sl sl-icon-plus"></i>ایجاد کاربر</a>
                </div>
                <h4>لیست کاربرها شما</h4>
                @if(count($items) === 0)
                @include('partials.empty')
                @else
                <ul>
                    @foreach($items as $item)
                    <li class="pending-booking">
                        <div class="list-box-listing bookings">
                            <div class="list-box-listing-img">
                                @if(!$item->avatar)
                                <img src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&amp;s=120" alt="">
                                @else
                                <img src="{{getSmallUri($item->avatar)}}" alt="">
                                @endif

                            </div>
                            <div class="list-box-listing-content">
                                <div class="inner">
                                    <h3>{{$item->name}}
                                        @if($item->status ===1)
                                        <span class="booking-status success">تایید</span>
                                        @else
                                        <span class="booking-status unpaid">در انتظار تایید</span>
                                        @endif
                                        @if($item->role ===role('admin'))
                                        <span class="booking-status pending">مدیر</span>
                                        @else
                                        <span class="booking-status pending">کاربر</span>
                                        @endif
                                    </h3>
                                    <div class="inner-booking-list">
                                        <h5>موبایل: </h5>
                                        <ul class="booking-list">
                                            <li class="highlighted">{{$item->mobile}} <small>{{$item->country}} </small></li>
                                        </ul>
                                    </div>
                                    <div class="inner-booking-list">
                                        <h5>ایمیل: </h5>
                                        <ul class="booking-list">
                                            <li class="highlighted">{{$item->email}} </li>
                                        </ul>
                                    </div>
                                    <div class="inner-booking-list">
                                        <h5>مبلغ کیف پول: </h5>
                                        <ul class="booking-list">
                                            <li class="highlighted">{{number_format($item->balance)}} <small>تومان</small></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="buttons-to-right">
                            <a href="{{route('panel.users.show', ['uuid' => $item->uuid])}}" class="button gray approve"><i class="sl sl-icon-pencil"></i> ویرایش</a>
                            <a href="{{route('panel.users.destroy', ['uuid' => $item->uuid])}}" class="button gray reject"><i class="sl sl-icon-close"></i> حذف</a>
                        </div>
                    </li>
                    @endforeach
                </ul>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
