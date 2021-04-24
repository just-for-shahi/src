@extends('partials.panel')

@section('content')
    <div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
        @include('profile.breadcrumb')
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class=" container ">
                <!--begin::پروفایل اطلاعات شخصی-->
                <div class="d-flex flex-row">
                    <!--begin::Aside-->
                    @include('profile.aside')
                    <!--end::Aside-->
                    <!--begin::Content-->
                    <div class="flex-row-fluid ml-lg-8">
                        <!--begin::Card-->
                        <div class="card card-custom card-stretch">
                            <!--begin::Header-->
                            <div class="card-header py-3">
                                <div class="card-title align-items-start flex-column">
                                    <h3 class="card-label font-weight-bolder text-dark">اطلاعات شخصی</h3>
                                    <span class="text-muted font-weight-bold font-size-sm mt-1">اطلاعات شخصی خود را به روز کنید</span>
                                </div>
                                <div class="card-toolbar">
                                    <button type="reset" class="btn btn-success mr-2">ذخیره تغییرات</button>
                                </div>
                            </div>
                            <!--end::Header-->

                            <!--begin::Form-->
                            <form class="form">
                                <!--begin::Body-->
                                <div class="card-body">
                                    <div class="row">
                                        <label class="col-xl-3"></label>
                                        <div class="col-lg-9 col-xl-6">
                                            <h5 class="font-weight-bold mb-6">مشتری اطلاعات</h5>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label text-right">نام</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <input class="form-control form-control-lg form-control-solid" type="text" value="{{$user['first_name']}}"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label text-right">نام خانوادگی</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <input class="form-control form-control-lg form-control-solid" type="text" value="{{$user['last_name']}}"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label text-right">نام کاربری</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <input class="form-control form-control-lg form-control-solid" type="text" value="{{$user['username']}}"/>
                                            <span class="form-text text-muted">برای پرداخت ها و لینک های کوتاه استفاده میشود.</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-xl-3"></label>
                                        <div class="col-lg-9 col-xl-6">
                                            <h5 class="font-weight-bold mt-10 mb-6">اطلاعات تماس</h5>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label text-right">شماره ثابت</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <div class="input-group input-group-lg input-group-solid">
                                                <div class="input-group-prepend"><span class="input-group-text"><i class="la la-phone"></i></span></div>
                                                <input type="text" class="form-control form-control-lg form-control-solid" value="{{$user['phone']}}" placeholder="شماره ثابت خود را بنویسید"/>
                                            </div>
                                            <span class="form-text text-muted">این اطلاعات نزد ما محرمانه می ماند.</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label text-right">شماره همراه</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <div class="input-group input-group-lg input-group-solid">
                                                <div class="input-group-prepend"><span class="input-group-text"><i class="la la-mobile"></i></span></div>
                                                <input type="text" class="form-control form-control-lg form-control-solid" value="{{$user['mobile']}}" placeholder="شماره موبایل خود را بنویسید"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Body-->
                            </form>
                            <!--end::Form-->
                        </div>
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::پروفایل اطلاعات شخصی-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
@endsection
