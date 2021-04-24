@extends('partials.panel')
@section('page.title', 'وبلاگ')
@section('plus')
    <a href="{{ route('post.create') }}" class="button border with-icon">افزودن آگهی <i class="sl sl-icon-plus"></i></a>
@endsection
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
                            <li>وبلاگ</li>
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

            <!-- Listings -->
            <div class="col-lg-12 col-md-12">
                <div class="dashboard-list-box margin-top-0">
                    <h4>وبلاگ ها</h4>
                    <ul>
                        @foreach($weblogs as $weblog)
                            <li>
                                <div class="list-box-listing">
                                    <div class="list-box-listing-img">
                                        <img src="{{ getBaseUri($weblog->cover) }}" alt="{{ $weblog->title }}">
                                    </div>
                                    <div class="list-box-listing-content">
                                        <div class="inner">
                                            <h3><a href="#">{{ $weblog->title }}</a></h3>
                                            <span>{{ Str::limit($weblog->abstract , 100) }}</span>
{{--                                            <div class="star-rating" data-rating="3.5">--}}
{{--                                                <div class="rating-counter">(12 reviews)</div>--}}
{{--                                                <span class="star"></span><span class="star"></span><span class="star"></span><span class="star half"></span><span class="star empty"></span>--}}
{{--                                            </div>--}}
                                        </div>
                                    </div>
                                </div>
                                <div class="buttons-to-right">
                                    <a href="{{ route('post.edit' , ['uuid' => $weblog->uuid]) }}" class="button gray"><i class="sl sl-icon-note"></i> ویرایش</a>
                                    <a class="button gray" onclick="deleteForm()"><i class="sl sl-icon-close"></i> حذف</a>
                                    <form action="{{ route('post.destroy' , ['uuid' => $weblog->uuid]) }}" method="POST" id="delete">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>


            <!-- Copyrights -->
            <div class="col-md-12">
                <div class="copyrights">© 2019 Listeo. All Rights Reserved.</div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        function deleteForm() {
            document.getElementById('delete').submit()
        }
    </script>
@endpush
