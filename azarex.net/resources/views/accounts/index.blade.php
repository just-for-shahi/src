@extends('partials.panel')

@section('content')
    <div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::زیر هدر-->
        <div class="subheader py-2 py-lg-6  subheader-transparent " id="kt_subheader">
            <div class=" container  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::اطلاعات-->
                <div class="d-flex align-items-center flex-wrap mr-1">

                    <div class="d-flex align-items-baseline flex-wrap mr-5">
                        <h5 class="text-dark font-weight-bold my-1 mr-5">حساب‌های مالی</h5>
                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                            <li class="breadcrumb-item">
                                <a href="{{route('panel.dashboard')}}" class="text-muted">پیشخوان</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{route('panel.accounts.index')}}" class="text-muted">حساب‌های مالی</a>
                            </li>
                        </ul>
                        <!--end::Breadcrumb-->
                    </div>
                    <!--end::Page Heading-->
                </div>
                <!--end::اطلاعات-->
            </div>
        </div>
        <!--end::زیر هدر-->

        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class=" container ">
                <!--begin::Notice-->
                <div class="alert alert-custom alert-white alert-shadow gutter-b" role="alert">
                    <div class="alert-icon">
		<span class="svg-icon svg-icon-xl svg-icon-primary"><!--begin::Svg Icon | path:assets/media/svg/icons/ابزارها/Compass.svg--><svg
                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"></rect>
        <path
            d="M7.07744993,12.3040451 C7.72444571,13.0716094 8.54044565,13.6920474 9.46808594,14.1079953 L5,23 L4.5,18 L7.07744993,12.3040451 Z M14.5865511,14.2597864 C15.5319561,13.9019016 16.375416,13.3366121 17.0614026,12.6194459 L19.5,18 L19,23 L14.5865511,14.2597864 Z M12,3.55271368e-14 C12.8284271,3.53749572e-14 13.5,0.671572875 13.5,1.5 L13.5,4 L10.5,4 L10.5,1.5 C10.5,0.671572875 11.1715729,3.56793164e-14 12,3.55271368e-14 Z"
            fill="#000000" opacity="0.3"></path>
        <path
            d="M12,10 C13.1045695,10 14,9.1045695 14,8 C14,6.8954305 13.1045695,6 12,6 C10.8954305,6 10,6.8954305 10,8 C10,9.1045695 10.8954305,10 12,10 Z M12,13 C9.23857625,13 7,10.7614237 7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 C17,10.7614237 14.7614237,13 12,13 Z"
            fill="#000000" fill-rule="nonzero"></path>
    </g>
</svg><!--end::Svg Icon--></span></div>
                    <div class="alert-text">برای ثبت حساب مالی و استفاده از خدمات صرافی آذر بایستی حساب
                        کاربری شما تایید شده باشد.
                        برای اطلاعات بیشتر <a class="font-weight-bold"
                                              href="{{route('panel.profile.verifications.index')}}">اینجا کلیک کنید</a>.
                    </div>
                </div>
                <!--end::Notice-->

                <!--begin::Card-->
                <div class="card card-custom">
                    <div class="card-header flex-wrap py-5">
                        <div class="card-title">
                            <h3 class="card-label">
                                لیست حساب‌های مالی
                                <div class="text-muted pt-2 font-size-sm"></div>
                            </h3>
                        </div>
                        <div class="card-toolbar">
                            <!--begin::دراپ دان-->
                            <div class="dropdown dropdown-inline mr-2">
                                <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		<span class="svg-icon svg-icon-md"><!--begin::Svg Icon | path:assets/media/svg/icons/desgin/PenAndRuller.svg--><svg
                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"></rect>
        <path
            d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z"
            fill="#000000" opacity="0.3"></path>
        <path
            d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z"
            fill="#000000"></path>
    </g>
</svg><!--end::Svg Icon--></span> خروجی گرفتن
                                </button>

                                <!--begin::دراپ دان Menu-->
                                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                    <!--begin::Navigation-->
                                    <ul class="navi flex-column navi-hover py-2">
                                        <li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">
                                            گزینه ای را انتخاب کنید:
                                        </li>
                                        <li class="navi-item">
                                            <a href="#" class="navi-link">
                                                <span class="navi-icon"><i class="la la-print"></i></span>
                                                <span class="navi-text">چاپ</span>
                                            </a>
                                        </li>
                                        <li class="navi-item">
                                            <a href="#" class="navi-link">
                                                <span class="navi-icon"><i class="la la-file-excel-o"></i></span>
                                                <span class="navi-text">اکسل</span>
                                            </a>
                                        </li>
                                        <li class="navi-item">
                                            <a href="#" class="navi-link">
                                                <span class="navi-icon"><i class="la la-file-text-o"></i></span>
                                                <span class="navi-text">CSV</span>
                                            </a>
                                        </li>
                                        <li class="navi-item">
                                            <a href="#" class="navi-link">
                                                <span class="navi-icon"><i class="la la-file-pdf-o"></i></span>
                                                <span class="navi-text">PDF</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <!--end::Navigation-->
                                </div>
                                <!--end::دراپ دان Menu-->
                            </div>
                            <!--end::دراپ دان-->

                            <!--begin::دکمه-->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#new">
	<span class="svg-icon svg-icon-md"><!--begin::Svg Icon | path:assets/media/svg/icons/طرح/Flatten.svg--><svg
            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
            viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"></rect>
        <circle fill="#000000" cx="9" cy="15" r="6"></circle>
        <path
            d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z"
            fill="#000000" opacity="0.3"></path>
    </g>
</svg><!--end::Svg Icon--></span> افتتاح حساب
                            </button>
                            <!--end::دکمه-->

                            <!-- مودال-->
                            <div class="modal fade" id="new" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">افتتاح حساب</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="بستن">
                                                <i aria-hidden="true" class="ki ki-close"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('panel.accounts.store')}}" method="post">
                                                @csrf
                                                <div>
                                                    <div>

                                                        <div class="form-group">
                                                            <label class="font-size-h6 font-weight-bolder text-dark" for="name">نام حساب</label>
                                                            <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg border-0" type="text" name="name" placeholder="نام حساب مالی خود را اینجا بنویسید" autocomplete autofocus required/>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="font-size-h6 font-weight-bolder text-dark" for="currency">ارز پایه</label>
                                                            <select class="form-control form-control-solid" name="currency">
                                                                <option value="0" selected>ریال ایران</option>
                                                                <option value="1">توکن آذر</option>
                                                                <option value="2">تتر</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="font-size-h6 font-weight-bolder text-dark" for="type">نوع حساب</label>
                                                            <select class="form-control form-control-solid" name="type">
                                                                <option selected value="0">جاری (بدون دسته چک)</option>
                                                                <option value="1">قرض الحسنه</option>
                                                                <option value="2">جاری (با دسته چک)</option>
                                                            </select>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary font-weight-bold">ثبت اطلاعات</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card-body">
                        <!--begin: جدول داده ها-->
                        <div id="kt_datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table
                                        class="table table-separate table-head-custom table-checkable dataTable no-footer dtr-inline"
                                        id="kt_datatable" role="grid" aria-describedby="kt_datatable_info">
                                        <thead>
                                        <tr role="row">
                                            <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1">ارز پایه</th>
                                            <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1">نام حساب</th>
                                            <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1">شماره حساب</th>
                                            <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1">شماره کارت</th>
                                            <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1">موجودی</th>
                                            <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1">موجودی قابل برداشت</th>
                                            <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1">وضعیت</th>
                                            <th class="sorting_disabled" rowspan="1" colspan="1">عملیات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($items as $item)
                                            <tr role="row" class="odd">
                                                <td><span class="label label-primary label-dot mr-2"></span><span class="font-weight-bold text-primary">بانک ملت</span></td>
                                                <td>{{$item['name']}}</td>
                                                <td>{{$item['number']}}</td>
                                                <td>{{$item['card']}}</td>
                                                <td>{{$item['balance']}}</td>
                                                <td>{{$item['hervestable']}}</td>
                                                <td><span class="label label-lg font-weight-bold label-light-info label-inline">در انتظار تایید</span></td>
                                                <td nowrap="">
                                                    <a href="javascript:;" class="btn btn-sm btn-danger btn-clean btn-icon" title="Delete"> <i class="la la-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

        </table></div></div>
    <div class="row">
        <div class="col-sm-12 col-md-7">
            {{$items->links()}}
        </div>
    </div></div>
    <!--end: جدول داده ها-->
    </div>
    </div>
    <!--end::Card-->
    </div>
    <!--end::Container-->
    </div>
    <!--end::Entry-->
    </div>
@endsection
