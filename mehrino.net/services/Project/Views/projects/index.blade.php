@extends('partials.panel')
@section('page.title', 'پروژه‌ها')
@section('wrapper')
<div class="dashboard-content">
    <div id="titlebar">
        <div class="row">
            <div class="col-md-12">
                <h2>پروژه‌ها</h2>
                <nav id="breadcrumbs">
                    <ul>
                        <li><a href="{{route('index')}}">صفحه اصلی</a></li>
                        <li><a href="{{route('dashboard')}}">داشبورد</a></li>
                        <li>پروژه‌ها</li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="dashboard-list-box margin-top-0">
                <div class="booking-requests-filter">
                    <a href="{{route('panel.projects.create')}}" class="button"><i class="sl sl-icon-plus"></i>ارسال پروژه</a>
                </div>
                <h4>لیست پروژه‌های شما</h4>
                @if(count($items) === 0)
                @include('partials.empty')
                @else
                <ul>
                    @foreach($items as $item)
                    <li class="pending-booking">
                        <div class="list-box-listing bookings">
                            <div class="list-box-listing-img">
                                @if(!$item->cover)
                                <img src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&amp;s=120" alt="">
                                @else
                                <img src="{{getSmallUri($item->cover)}}" alt="">
                                @endif
                            </div>
                            <div class="list-box-listing-content">
                                <div class="inner">
                                    <h3>{{$item->title}}
                                    @if($item->status===0)
                                        <span class="booking-status pending">در انتظار</span>
                                    @else
                                        <span class="booking-status perpul">تایید شد</span>
                                    @endif
                                    @if($item->current_balance===0)
                                    <span class="booking-status unpaid">بدون پرداخت هزینه</span>
                                    @else
                                        <span class="booking-status pending">  پرداخت  {{number_format($item->current_balance)}} <small>تومان</small></span>
                                    @endif
                                    </h3>
                                    <div class="inner-booking-list">
                                        <h5>زیر نظر: </h5>
                                        <ul class="booking-list">
                                            <li class="highlighted">{!! getProjectSupervision($item) !!}</li>
                                        </ul>
                                    </div>
                                    <div class="inner-booking-list">
                                        <h5>افراد: </h5>
                                        <ul class="booking-list">
                                            <li class="highlighted">{{number_format($item->collaborators)}} <small>نفر</small></li>
                                        </ul>
                                    </div>
                                    <div class="inner-booking-list">
                                        <h5>مبلغ هدف: </h5>
                                        <ul class="booking-list">
                                            <li class="highlighted">{{number_format($item->target)}} <small>تومان</small></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="buttons-to-right">
                            <a href="{{route('panel.projects.show', ['uuid' => $item->uuid])}}" class="button gray approve"><i class="sl sl-icon-pencil"></i> ویرایش</a>
                            <a href="{{route('panel.report.list', ['service'=>'project','uuid' => $item->uuid])}}" class="button gray approve"><i class="sl sl-icon-report"></i> گزارش</a>
                            <a href="{{route('panel.projects.destroy', ['uuid' => $item->uuid])}}" class="button gray reject">
                                <i class="sl sl-icon-close"></i> حذف
                            </a>
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
