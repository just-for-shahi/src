@extends('layout.panel')
@section('pageTitle', 'ویرایش '.$course->title)
@section('content')
    <div class="padding">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h2>ویرایش {{$course->title}}</h2>
                        <small>
                            با استفاده از فرم زیر میتوانید دوره {{$course->title}} را ویرایش کنید.
                        </small>
                        </div>
                        <div class="box-divider m-a-0"></div>
                        <div class="box-body">
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{$error}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form role="form" method="post" action="{{route('courses.update', ['uuid' => $course->uuid])}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-sm-3">
                                        <label for="title" class="form-control-label">عنوان</label>
                                        <input type="text" name="title" id="title" class="form-control" placeholder="عنوان دوره را وارد کنید" value="{{$course->title}}">
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="description" class="form-control-label">توضیحات</label>
                                        <input type="text" name="description" id="description" class="form-control" placeholder="توضیحات معرفی دوره در یک جمله بنویسید" value="{{$course->description}}">
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="cover" class="form-control-label">کاور دوره</label>
                                        <input type="file" name="cover" id="cover" class="form-control text-right">
                                        <span class="text-warning">اگر نمیخواهید تغییر دهید، خالی رها کنید</span>
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="price" class="form-control-label">قیمت</label>
                                        <input class="form-control" name="price" placeholder="به تومان وارد کنید" value="{{$course->prices[0]->price}}">
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="special-price" class="form-control-label">قیمت ویژه</label>
                                        <input class="form-control" name="special-price" placeholder="به تومان وارد کنید" value="{{$course->prices[0]->special_price}}">
                                        <span class="text-warning">در صورتی که نمیخواهید تحفیف دهید، خالی رها کنید</span>
                                    </div>
                                    <br/>
                                    <div class="col-sm-12">
                                        <label for="introduction" class="form-control-label">معرفی کامل</label>
                                        <textarea class="form-control" rows="5" id="introduction" name="introduction">{{$course->introduction}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row m-t-md">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary pull-right">ویرایش دوره</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
