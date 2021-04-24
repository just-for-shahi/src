@extends('partials.panel')

@section('content')
    <div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::زیر هدر-->
        <div class="subheader py-2 py-lg-6  subheader-transparent " id="kt_subheader">
            <div class=" container  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::اطلاعات-->
                <div class="d-flex align-items-center flex-wrap mr-1">

                    <div class="d-flex align-items-baseline flex-wrap mr-5">
                        <h5 class="text-dark font-weight-bold my-1 mr-5">تیکت‌های پشتیبانی</h5>
                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                            <li class="breadcrumb-item">
                                <a href="{{route('panel.dashboard')}}" class="text-muted">پیشخوان</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{route('panel.tickets.index')}}" class="text-muted">تیکت‌های پشتیبانی</a>
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
                <!--begin::Card-->
                <div class="card card-custom">
                    <div class="card-header flex-wrap py-5">
                        <div class="card-title">
                            <h3 class="card-label">
                                لیست تیکت‌های پشتیبانی
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
</svg><!--end::Svg Icon--></span> ارسال تیکت
                            </button>
                            <!--end::دکمه-->

                            <!-- مودال-->
                            <div class="modal fade" id="new" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">ارسال تیکت پشتیبانی</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="بستن">
                                                <i aria-hidden="true" class="ki ki-close"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('panel.tickets.store')}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div>
                                                    <div>

                                                        <div class="form-group row">
                                                            <div class="col-6">
                                                                <label class="font-size-h6 font-weight-bolder text-dark" for="title">عنوان</label>
                                                                <input class="form-control form-control-solid h-auto border-0" type="text" name="title" placeholder="عنوان درخواست پشتیبانی خود را بنویسید" autocomplete autofocus required/>
                                                            </div>
                                                            <div class="col-6">
                                                                <label class="font-size-h6 font-weight-bolder text-dark">اولویت</label>
                                                                <div></div>
                                                                <select class="custom-select form-control form-control-solid" name="priority">
                                                                    <option selected value="0">عمومی</option>
                                                                    <option value="1">ارزهای دیجیتال</option>
                                                                    <option value="2">پرداخت‌های خارجی</option>
                                                                    <option value="3">سرمایه گذاری</option>
                                                                    <option value="4">وام دهی</option>
                                                                    <option value="5">درگاه‌های پرداخت</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <div class="col-6">
                                                                <label class="font-size-h6 font-weight-bolder text-dark">دپارتمان مربوطه</label>
                                                                <div></div>
                                                                <select class="custom-select form-control form-control-solid" name="department">
                                                                    <option selected value="0">عادی</option>
                                                                    <option value="1">پایین</option>
                                                                    <option value="2">مهم</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-6">
                                                                <label>پیوست</label>
                                                                <div></div>
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input" name="attachment" id="attachment">
                                                                    <label class="custom-file-label" for="attachment">فایل پیوست را انتخاب کنید</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group mb-1">
                                                            <label for="message">توضیحات شما</label>
                                                            <textarea class="form-control" id="message" name="message" placeholder="توضیحات خود را اینجا بنویسید" rows="3"></textarea>
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
                                            <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1">عنوان</th>
                                            <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1">اولویت</th>
                                            <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1">دپارتمان</th>
                                            <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1">وضعیت</th>
                                            <th class="sorting_disabled" rowspan="1" colspan="1">عملیات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($items as $item)
                                            <tr role="row" class="odd">
                                                <td>{{$item['title']}}</td>
                                                <td>{{$item['priority']}}</td>
                                                <td>{{$item['department']}}</td>
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
