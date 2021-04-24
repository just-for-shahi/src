@extends('partials.panel')
@section('page.title', 'ایجاد کاربر')
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
                <h2>ایجاد کاربر</h2>
                <nav id="breadcrumbs">
                    <ul>
                        <li><a href="{{route('index')}}">صفحه اصلی</a></li>
                        <li><a href="{{route('dashboard')}}">داشبورد</a></li>
                        <li>ایجاد کاربر</li>
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
            <br />
            @endif
            <form id="form" action="{{route('panel.users.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div id="add-listing">
                    <div class="add-listing-section">
                        <div class="add-listing-headline">
                            <h3><i class="sl sl-icon-doc"></i> اطلاعات پروفایل</h3>
                        </div>
                        <div class="row with-forms">
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <h5>تصویر کاربر <i class="tip" data-tip-content="تصویر کاربر را انتخاب کنید"></i></h5>
                                    <input type="file" name="file">
                                </div>
                                <div class="col-md-4">
                                    <h5>نوع کاربر</h5>
                                    <select class="chosen-select-no-single" name="role">
                                        <option value="0" label="کاربر">کاربر</option>
                                        <option value="1" label="مدیر">مدیریت</option>
                                    </select>
                                </div>
                            </div>
                            <br />
                            <div class="col-md-4">
                                <h5>نام</h5>
                                <input class="search-field" type="text" name="name" value="{{old('name')}}" placeholder="نام و نام خانوادگی" />
                            </div>

                            <div class="col-md-4">
                                <h5>موبایل</h5>
                                <input class="search-field" type="text" name="mobile" value="{{old('mobile')}}" placeholder=" شماره همراه مثل 09123456789" />
                            </div>
                            <div class="col-md-4">
                                <h5>ایمیل</h5>
                                <input class="search-field" type="text" name="email" value="{{old('email')}}" placeholder="ایمیل" />
                            </div>
                        </div>

                    </div>
                    <button type="submit" class="button preview">ثبت کاربر <i class="fa fa-arrow-circle-right"></i></button>
                    <br />
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
@section('scripts')
<script type="text/javascript">
    function addField() {
        $('<div class="col-md-4 dyfile"><input class="form-control" name="files[]" type="file"></div>').insertAfter($('.dyfile').last());
    };
</script>
@endsection
