@extends('layout.panel')
@section('pageTitle', 'پادکست '.$podcast->title)
@section('content')
    <div class="padding">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h2>پادکست {{$podcast->title}}</h2>
                        <small>
                            با استفاده از فرم زیر میتوانید پادکست {{$podcast->title}} را ویرایش کنید.
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
                            <form role="form" method="post" action="{{route('podcasts.update', ['uuid' => $podcast->uuid])}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label for="title" class="form-control-label">عنوان</label>
                                        <input type="text" name="title" id="title" class="form-control" placeholder="عنوان پادکست را وارد کنید" value="{{$podcast->title}}">
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="description" class="form-control-label">توضیحات</label>
                                        <input type="text" name="description" id="description" class="form-control" placeholder="توضیحات معرفی پادکست در یک جمله بنویسید" value="{{$podcast->description}}">
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="website" class="form-control-label">وب‌سایت</label>
                                        <input dir="ltr" type="text" name="website" id="website" class="form-control text-right" placeholder="e.g. https://hirbod.ac/podcasts/tehran98" value="{{$podcast->website}}">
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="logo" class="form-control-label">لوگو</label>
                                        <input type="file" name="logo" id="logo" class="form-control text-right">
                                        <span class="text-warning text-sm">اگر نمیخواهید تغییر دهید، خالی رها کنید</span>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="cover" class="form-control-label">کاور</label>
                                        <input type="file" name="cover" id="cover" class="form-control text-right">
                                        <span class="text-warning text-sm">اگر نمیخواهید تغییر دهید، خالی رها کنید</span>
                                    </div>
                                </div>
                                <div class="form-group row m-t-md">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary pull-right">افزودن پادکست</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
