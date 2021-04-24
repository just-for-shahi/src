@extends('partials.panel')
@section('page.title', 'ارسال پروژه')
@section('wrapper')
<style>
.button.preview {
    margin-bottom: 50px;
}
</style>
    <div class="dashboard-content">
        <div id="titlebar">
            <div class="row">
                <div class="col-md-12">
                    <h2>ارسال پروژه</h2>
                    <nav id="breadcrumbs">
                        <ul>
                            <li><a href="{{route('index')}}">صفحه اصلی</a></li>
                            <li><a href="{{route('dashboard')}}">داشبورد</a></li>
                            <li>ارسال پروژه</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                @if($errors->any())
                    <div class="notification error closeable margin-bottom-30">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                        <a class="close" href="#"></a>
                    </div>
                    <br/>
                @endif
                <form id="form" action="{{route('panel.projects.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div id="add-listing">
                        <div class="add-listing-section">
                            <div class="add-listing-headline">
                                <h3><i class="sl sl-icon-doc"></i> اطلاعات پایه</h3>
                            </div>
                            <div class="row with-forms">
                                <div class="col-md-4">
                                    <h5>عنوان پروژه <i class="tip" data-tip-content="نام کار خوبی که میخوایین انجام بدین"></i></h5>
                                    <input class="search-field" type="text" name="title" value="{{old('title')}}" placeholder="لطفا عنوان مناسبی برای پروژه مدنظرتان وارد کنید"/>
                                </div>
                                <div class="col-md-4">
                                    <h5>کاربر <i class="tip" data-tip-content="شماره موبایل یا ایمیل کاربر را وارد کنید"></i></h5>
                                    <input type="text" name="user" value="{{old('user')}}" placeholder="شماره موبایل (09123450000) یا ایمیل کاربر ">
                                </div>
                                <div class="col-md-4">
                                    <h5>موسسه</h5>
                                    <select class="chosen-select-no-single" name="institute">
                                        <option value="null" disabled label="خالی">انتخاب یک موسسه</option>
                                        @foreach($institutes as $institute)
                                            <option value="{{$institute->id}}">{{$institute->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row with-forms">

                                <div class="col-md-4">
                                    <h5>مبلغ هدف <i class="tip" data-tip-content="مبلغ مورد نیاز پروژه را بنویسید"></i></h5>
                                    <input type="text" name="target" value="{{old('target')}}" placeholder="مبلغ مورد نیاز پروژه را به تومان بنویسید">
                                </div>
                                <div class="col-md-4">
                                    <h5>تصویر پروژه <i class="tip" data-tip-content="تصویر اصلی پروژه را انتخاب کنید"></i></h5>
                                    <input type="file" name="cover">
                                </div>
                                <div class="col-md-4">
                                    <h5>وضعیت</h5>
                                    <select class="chosen-select-no-single" name="status">
                                        <option value="0" label="در انتظار"> درانتظار</option>
                                        <option value="1" label="تایید شد">تایید شد</option>
                                    </select>
                                </div>
                                <div class="col-md 12">
                                    <h5>توضیحات</h5>
                                    <textarea class="WYSIWYG" name="content" cols="40" rows="3" id="content" spellcheck="true"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="add-listing-section margin-top-45">
                            <div class="add-listing-headline">
                                <h3><i class="sl sl-icon-location"></i> موقعیت</h3>
                            </div>
                            <div class="submit-section">
                                <div class="row with-forms">
                                    <div class="col-md-6">
                                        <h5>طول جغرافیایی</h5>
                                        <input type="text" name="latitude" value="{{old('latitude')}}" placeholder="مانند 38.251245">
                                    </div>
                                    <div class="col-md-6">
                                        <h5>عرض جغرافیایی</h5>
                                        <input type="text" name="longitude" value="{{old('longitude')}}" placeholder="مانند 39.65148752">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="add-listing-section margin-top-45">
                            <div class="add-listing-headline">
                                <h3><i class="sl sl-icon-picture"></i> تصاویر و مستندات</h3>
                                <label class="switch" style="width: auto !important;">
                                    <a onclick="addField()" class="button"><i class="sl sl-icon-plus"></i>افزودن فایل</a>
                                </label>
                            </div>
                            <div class="row submit-section" id="uploads">
                                <div class="col-md-4 dyfile">
                                    <input class="form-control" name="files[]" type="file">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="button preview">ثبت پروژه <i class="fa fa-arrow-circle-right"></i></button>
                        <br/>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        function addField(){
            $('<div class="col-md-4 dyfile"><input class="form-control" name="files[]" type="file"></div>').insertAfter($('.dyfile').last());
        };
    </script>
@endsection
