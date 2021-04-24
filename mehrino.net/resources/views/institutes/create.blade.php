@extends('partials.panel')
@section('page.title', 'ثبت موسسه')
@section('wrapper')
    <div class="dashboard-content">
        <div id="titlebar">
            <div class="row">
                <div class="col-md-12">
                    <h2>ثبت موسسه</h2>
                    <nav id="breadcrumbs">
                        <ul>
                            <li><a href="{{route('index')}}">صفحه اصلی</a></li>
                            <li><a href="{{route('dashboard')}}">داشبورد</a></li>
                            <li>ثبت موسسه</li>
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
                <form id="form" action="{{route('institutes.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div id="add-listing">
                        <div class="add-listing-section">
                            <div class="add-listing-headline">
                                <h3><i class="sl sl-icon-doc"></i> اطلاعات پایه</h3>
                            </div>
                            <div class="row with-forms">
                                <div class="col-md-4">
                                    <h5>نام موسسه <i class="tip" data-tip-content="نام تجاری موسسه مانند محک"></i></h5>
                                    <input class="search-field" type="text" name="title" value="{{old('title')}}" placeholder="لطفا نام تجاری موسسه را بنویسید مانند محک"/>
                                </div>
                                <div class="col-md-4">
                                    <h5>لوگو <i class="tip" data-tip-content="یک تصویر 512 در 512 و پایین تر از یک مگابایت"></i></h5>
                                    <input type="file" name="logo">
                                </div>
                                <div class="col-md-4">
                                    <h5>افراد تحت پوشش</h5>
                                    <input class="search-field" type="text" name="covered_persons" value="{{old('covered_persons')}}" placeholder="لطفا تعداد افراد تحت پوشش را بنویسید">
                                </div>
                            </div>
                            <div class="row with-forms">
                                <div class="col-md-4">
                                    <h5>دسته</h5>
                                    <select class="chosen-select-no-single" name="category">
                                        <option value="null" disabled label="خالی">انتخاب یک دسته</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <h5>هشتگ‌ها <i class="tip" data-tip-content="برای بیشتر دیده شدن از هشتگ‌ها استفاده کنید"></i></h5>
                                    <input type="text" name="tags" value="{{old('tags')}}" placeholder="کلمات کلیدی با خط تیره (-) جدا می‌شوند">
                                </div>
                                <div class="col-md-4">
                                    <h5>آدرس </h5>
                                    <input type="text" name="address" value="{{old('address')}}">
                                </div>
                            </div>
                        </div>
                        <div class="add-listing-section margin-top-45">
                            <div class="add-listing-headline">
                                <h3><i class="sl sl-icon-doc"></i> اطلاعات ثبتی و حقوقی</h3>
                            </div>
                            <div class="row with-forms">
                                <div class="col-md-3">
                                    <h5>تاریخ ثبت</h5>
                                    <input class="search-field" type="text" name="registered" value="{{old('registered')}}" placeholder="مانند 1397/07/12"/>
                                </div>
                                <div class="col-md-3">
                                    <h5>تاریخ تاسیس</h5>
                                    <input class="search-field" type="text" name="created" value="{{old('created')}}" placeholder="مانند 1398/07/12"/>
                                </div>
                                <div class="col-md-3">
                                    <h5>شماره ثبت</h5>
                                    <input class="search-field" type="text" name="registered_no" value="{{old('registered_no')}}" placeholder="مانند 1916628"/>
                                </div>
                                <div class="col-md-3">
                                    <h5>اسم ثبتی</h5>
                                    <input class="search-field" type="text" name="registered_name" value="{{old('registered_name')}}" placeholder="مانند موسسه همراه آفرینان محک"/>
                                </div>
                            </div>
                            <div class="row with-forms">
                                <div class="col-md-3">
                                    <h5>شماره گواهی/پروانه</h5>
                                    <input class="search-field" type="text" name="license_no" value="{{old('license_no')}}" placeholder="مانند 1916628"/>
                                </div>
                                <div class="col-md-3">
                                    <h5>اعتبار گواهی/پروانه</h5>
                                    <input class="search-field" type="text" name="license_expire" value="{{old('license_expire')}}" placeholder="مانند 1402/07/16"/>
                                </div>
                                <div class="col-md-3">
                                    <h5>مرکز صدور</h5>
                                    <input class="search-field" type="text" name="license_provider" value="{{old('license_provider')}}" placeholder="مانند اداره کل بهزیستی استان تهران"/>
                                </div>
                                <div class="col-md-3">
                                    <h5>موضوعات اساسنامه</h5>
                                    <input class="search-field" type="text" name="statute" value="{{old('statute')}}" placeholder="مانند توانمندسازی زنان بی سرپرست"/>
                                </div>
                            </div>
                            <div class="row with-forms">
                                <div class="col-md-3">
                                    <h5>حوزه فعالیت</h5>
                                    <input class="search-field" type="text" name="activity_range" value="{{old('activity_range')}}" placeholder="مانند کل کشور"/>
                                </div>
                                <div class="col-md-3">
                                    <h5>مدیرعامل</h5>
                                    <input class="search-field" type="text" name="ceo" value="{{old('ceo')}}" placeholder="مانند مهندس میلاد شاهی"/>
                                </div>
                                <div class="col-md-3">
                                    <h5>اسکن اساسنامه</h5>
                                    <input class="search-field" type="file" name="statute_file"/>
                                </div>
                                <div class="col-md-3">
                                    <h5>اسکن گواهی/پروانه</h5>
                                    <input class="search-field" type="file" name="license_file"/>
                                </div>
                            </div>
                        </div>
                        <div class="add-listing-section margin-top-45">
                            <div class="add-listing-headline">
                                <h3><i class="sl sl-icon-doc"></i> راه‌های ارتباطی</h3>
                            </div>
                            <div class="row with-forms">
                                <div class="col-md-4">
                                    <h5>پایگاه اینترنتی</h5>
                                    <input class="search-field" type="url" name="website" value="{{old('website')}}" placeholder="مانند https://mahak-charity.org"/>
                                </div>
                                <div class="col-md-4">
                                    <h5>پست الکترونیک</h5>
                                    <input class="search-field" type="email" name="email" value="{{old('email')}}" placeholder="مانند info@mahak-charity.org"/>
                                </div>
                                <div class="col-md-4">
                                    <h5>لینکدین</h5>
                                    <input class="search-field" type="text" name="linkedin" value="{{old('linkedin')}}" placeholder="مانند mahak_charity"/>
                                </div>
                            </div>
                            <div class="row with-forms">
                                <div class="col-md-4">
                                    <h5>یوتیوب</h5>
                                    <input class="search-field" type="text" name="youtube" value="{{old('youtube')}}" placeholder="مانند mahak_charity"/>
                                </div>
                                <div class="col-md-4">
                                    <h5>اینستاگرام</h5>
                                    <input class="search-field" type="text" name="instagram" value="{{old('instagram')}}" placeholder="مانند mahak_charity"/>
                                </div>
                                <div class="col-md-4">
                                    <h5>تلگرام</h5>
                                    <input class="search-field" type="text" name="telegram" value="{{old('telegram')}}" placeholder="مانند mahak_charity"/>
                                </div>
                            </div>
                            <div class="row with-forms">
                                <div class="col-md-4">
                                    <h5>آپارات</h5>
                                    <input class="search-field" type="text" name="aparat" value="{{old('aparat')}}" placeholder="مانند mahak_charity"/>
                                </div>
                                <div class="col-md-4">
                                    <h5>واتس اپ</h5>
                                    <input class="search-field" type="text" name="whatsapp" value="{{old('whatsapp')}}" placeholder="مانند 09120000000"/>
                                </div>
                                <div class="col-md-4">
                                    <h5>شماره تماس</h5>
                                    <input class="search-field" type="text" name="phone" value="{{old('phone')}}" placeholder="مانند 02122803000"/>
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
