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
                                    <h3 class="card-label font-weight-bolder text-dark">احراز هویت</h3>
                                    <span class="text-muted font-weight-bold font-size-sm mt-1">لیست مدارک ارسال شده خود را اینجا ببینید</span>
                                </div>
                                <div class="card-toolbar">
                                    <button type="button" class="btn btn-success mr-2">ارسال مدرک</button>
                                </div>
                            </div>
                            <!--end::Header-->

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
