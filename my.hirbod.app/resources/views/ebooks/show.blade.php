@extends('layout.panel')
@section('pageTitle', 'ویرایش '.$ebook->title)
@section('content')
    <div class="padding">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h2>ویرایش {{$ebook->title}}</h2>
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
                            <form role="form" method="post" action="{{route('ebooks.update', ['uuid' => $ebook->uuid])}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-sm-3">
                                        <label for="title" class="form-control-label">عنوان</label>
                                        <input type="text" name="title" id="title" class="form-control" placeholder="عنوان کتاب را وارد کنید" value="{{$ebook->title}}">
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="description" class="form-control-label">توضیحات</label>
                                        <input type="text" name="description" id="description" class="form-control" placeholder="توضیحات معرفی کتاب در یک جمله بنویسید" value="{{$ebook->description}}">
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="year" class="form-control-label">سال</label>
                                        <input dir="ltr" type="text" maxlength="4" name="year" id="year" class="form-control text-right" placeholder="e.g. 1388 or 2009" value="{{$ebook->year}}">
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="cover" class="form-control-label">جلد روی کتاب</label>
                                        <input type="file" name="cover" id="cover" class="form-control text-right">
                                        <span class="text-sm text-warning">اگر نمیخواهید تغییر دهید، خالی رها کنید.</span>
                                    </div>
                                    <br/>
                                    <div class="col-sm-12">
                                        <label for="introduction" class="form-control-label">معرفی کامل کتاب</label>
                                        <textarea class="form-control" rows="5" id="introduction" name="introduction">{{$ebook->introduction}}</textarea>
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
