@extends('layout.panel')
@section('pageTitle', 'افزودن دوره')
@section('content')
    <div class="padding">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h2>افزودن دوره</h2>
                        <small>
                            با استفاده از فرم زیر میتوانید دوره جدید ثبت کنید.
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
                            <form role="form" method="post" action="{{route('courses.store')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-sm-3">
                                        <label for="title" class="form-control-label">عنوان</label>
                                        <input type="text" name="title" id="title" class="form-control" placeholder="عنوان دوره را وارد کنید" value="{{old('title')}}">
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="description" class="form-control-label">توضیحات</label>
                                        <input type="text" name="description" id="description" class="form-control" placeholder="توضیحات معرفی دوره در یک جمله بنویسید" value="{{old('description')}}">
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="level" class="form-control-label">سطح دوره</label>
                                        <select class="form-control" name="level">
                                            <option selected value="0">مقدماتی</option>
                                            <option value="1">متوسط</option>
                                            <option value="2">پیشرفته</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="category" class="form-control-label">دسته‌بندی</label>
                                        <select class="form-control" id="category" name="category">
                                            @foreach($cats as $cat)
                                                <option value="{{$cat->id}}">{{$cat->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="category" class="form-control-label">برچسب‌ها</label>
                                        <input class="form-control" name="tags" placeholder="برچسب‌ها با - (خط تیره) جدا می‌شوند" value="{{old('tags')}}">
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="cover" class="form-control-label">کاور دوره</label>
                                        <input type="file" name="cover" id="cover" class="form-control text-right">
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="price" class="form-control-label">قیمت</label>
                                        <input class="form-control" name="price" placeholder="به تومان وارد کنید" value="{{old('price')}}">
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="special-price" class="form-control-label">قیمت ویژه</label>
                                        <input class="form-control" name="special-price" placeholder="به تومان وارد کنید" value="{{old('special-price')}}">
                                        <span class="text-warning">در صورتی که نمیخواهید تحفیف دهید، خالی رها کنید</span>
                                    </div>
                                    <br/>
                                    <div class="col-sm-12">
                                        <label for="introduction" class="form-control-label">معرفی کامل</label>
                                        <textarea class="form-control" rows="5" id="introduction" name="introduction"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row m-t-md">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary pull-right">ثبت دوره</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
