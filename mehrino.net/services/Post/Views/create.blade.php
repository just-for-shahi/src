@extends('partials.panel')
@section('page.title', 'وبلاگ')
{{--@section('plus')--}}
{{--    <a href="{{ route('post.create') }}" class="button border with-icon">افزودن آگهی <i class="sl sl-icon-plus"></i></a>--}}
{{--@endsection--}}
@section('wrapper')
    <div class="dashboard-content">

        <!-- Titlebar -->
        <div id="titlebar">
            <div class="row">
                <div class="col-md-12">
                    <h2>سلام، {{ auth('web')->user()->name }}</h2>
                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs">
                        <ul>
                            <li><a href="{{ route('dashboard') }}">صفحه اصلی</a></li>
                            <li><a href="{{ route('post.index') }}">وبلاگ</a></li>
                            <li>ایجاد وبلاگ</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

{{--        <!-- Notice -->--}}
{{--        <div class="row">--}}
{{--            <div class="col-md-12">--}}
{{--                <div class="notification success closeable margin-bottom-30">--}}
{{--                    <p>آگهی شما <strong>هتل پیروزی</strong> تایید شده است!</p>--}}
{{--                    <a class="close" href="#"></a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

        <div class="row">
            <div class="col-lg-12">

                <div id="add-listing">

                    <!-- Section -->
                    <div class="add-listing-section">

                        <!-- Headline -->
                        <div class="add-listing-headline">
                            <h3><i class="sl sl-icon-doc"></i>ایجاد وبلاگ</h3>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger bg-danger" style="padding: 20px">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row with-forms">

                                <div class="col-md-6">
                                    <h5>
                                        عنوان
                                        <i class="tip" data-tip-content="عنوان خود را وارد کنید">
                                            <div class="tip-content">
                                                عنوان خود را وارد کنید
                                            </div>
                                        </i>
                                    </h5>
                                    <input type="text" name="title" id="title" value="{{ old('title') }}" placeholder="عنوان خود را وارد کنید">
                                </div>

                                <div class="col-md-6">
                                    <h5>
                                        کاور
                                        <i class="tip" data-tip-content="کاور خود را وارد کنید">
                                            <div class="tip-content">
                                                کاور خود را وارد کنید
                                            </div>
                                        </i>
                                    </h5>
                                    <input type="file" name="cover" id="cover" value="{{ old('cover') }}" placeholder="کاور خود را وارد کنید">
                                </div>

                            </div>

                            <!-- Row -->
                            <div class="row with-forms">
                                <!-- Status -->
                                <div class="col-md-6">

                                    <h5>دسته بندی ها</h5>
                                    <select class="chosen-select-no-single" id="categories" name="categories[]" style="display: none;" multiple>
                                        <option label="blank" disabled hidden>انتخاب کنید</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->uuid }}" {{ in_array($category->uuid , old('categories') ?? [] , true) ? 'selected' : '' }}>{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                            <div class="row with-forms">
                                <div class="form">
                                    <h5>خلاصه</h5>
                                    <textarea class="WYSIWYG" name="abstract" cols="40" rows="3" id="abstract" spellcheck="false" data-gramm="false">{{ old('abstract') }}</textarea>
                                </div>
                            </div>

                            <div class="row with-forms">
                                <div class="form">
                                    <h5>توضیخات</h5>
                                    <textarea name="description" id="description" rows="100" cols="80">{{ old('description') }}</textarea>
                                </div>
                            </div>

                            <button type="submit" class="button preview">ذخیره</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script src="//cdn.ckeditor.com/4.15.1/full/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description', {filebrowserImageBrowseUrl: '/file-manager/ckeditor'});
    </script>
@endpush
