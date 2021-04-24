@extends('partials.panel')
@section('page.title', 'موسسات من')
@section('wrapper')
    <div class="dashboard-content">
        <div id="titlebar">
            <div class="row">
                <div class="col-md-12">
                    <h2>موسسات من</h2>
                    <nav id="breadcrumbs">
                        <ul>
                            <li><a href="{{route('index')}}">صفحه اصلی</a></li>
                            <li><a href="{{route('dashboard')}}">داشبورد</a></li>
                            <li>موسسات من</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="dashboard-list-box margin-top-0">
                    <div class="booking-requests-filter">
                        <a href="{{route('institutes.create')}}" class="button"><i class="sl sl-icon-plus"></i>ثبت موسسه</a>
                    </div>
                    <h4>لیست موسسات من</h4>
                    @if(count($items) === 0)
                        @include('partials.empty')
                    @else
                        <ul>
                        @foreach($items as $item)
                                <li class="pending-booking">
                                    <div class="list-box-listing bookings">
                                        <div class="list-box-listing-img">
                                            <img src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&amp;s=120" alt=""></div>
                                        <div class="list-box-listing-content">
                                            <div class="inner">
                                                <h3>{{$item->title}} <span class="booking-status pending">در انتظار</span><span class="booking-status unpaid">بدون پرداخت هزینه</span></h3>
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
                                        <a href="{{route('institutes.show', ['uuid' => $item->uuid])}}" class="button gray approve"><i class="sl sl-icon-pencil"></i> ویرایش</a>
                                        <a href="{{route('institutes.destroy', ['uuid' => $item->uuid])}}" class="button gray reject"><i class="sl sl-icon-close"></i> حذف</a>
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
