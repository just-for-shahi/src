@extends('layout.panel')
@section('pageTitle', 'افزودن کتاب')
@section('content')
    <div class="padding">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h2>افزودن کتاب</h2>
                        <small>
                            با استفاده از فرم زیر میتوانید کتاب جدید ثبت کنید.
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
                            <form role="form" method="post" action="{{route('ebooks.store')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label for="title" class="form-control-label">عنوان</label>
                                        <input type="text" name="title" id="title" class="form-control" placeholder="عنوان کتاب را وارد کنید" value="{{old('title')}}">
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="description" class="form-control-label">توضیحات</label>
                                        <input type="text" name="description" id="description" class="form-control" placeholder="توضیحات معرفی کتاب در یک جمله بنویسید" value="{{old('description')}}">
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="writer" class="form-control-label">نویسنده</label>
                                        <input type="text" name="writer" id="writer" class="form-control" placeholder="نام نویسنده کتاب را وارد کنید" value="{{old('writer')}}">
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="publisher" class="form-control-label">انتشارات</label>
                                        <input type="text" name="publisher" id="publisher" class="form-control" placeholder="نام انتشارات کتاب را وارد کنید" {{old('publisher')}}>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="year" class="form-control-label">سال</label>
                                        <input dir="ltr" type="text" maxlength="4" name="year" id="year" class="form-control text-right" placeholder="e.g. 1388 or 2009" value="{{old('year')}}">
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="isbn" class="form-control-label">ISBN</label>
                                        <input dir="ltr" type="text" name="isbn" maxlength="13" id="isbn" class="form-control text-right" placeholder="e.g. 9786008671909" value="{{old('isbn')}}">
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="level" class="form-control-label">سطح کتاب</label>
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
                                        <label for="cover" class="form-control-label">جلد روی کتاب</label>
                                        <input type="file" name="cover" id="cover" class="form-control text-right">
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="file" class="form-control-label">فایل کتاب (PDF)</label>
                                        <input type="file" name="file" id="file" class="form-control text-right">
                                    </div>
                                    <br/>
                                    <div class="col-sm-12">
                                        <label for="introduction" class="form-control-label">معرفی کامل کتاب</label>
                                        <textarea class="form-control" id="introduction" name="introduction"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row m-t-md">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary pull-right">ثبت کتاب</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
