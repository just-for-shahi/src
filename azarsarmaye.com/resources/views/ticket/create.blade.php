@extends('layout.panel')
@section('pageTitle', 'ایجاد تیکت پشتیبانی')
@section('content')
    <div class="padding">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h2>ایجاد تیکت پشتیبانی</h2>
                        <small>
                            با استفاده از فرم زیر میتوانید تیکت پشتیبانی جدید اضافه کنید.
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
                            <form role="form" method="post" action="{{route('tickets.store')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-sm-3">
                                        <label for="title" class="form-control-label">عنوان تیکت</label>
                                        <input type="text" name="title" class="form-control" id="title">
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="department" class="form-control-label">دپارتمان</label>
                                        <select class="form-control" id="department" name="department">
                                            <option value="0">عمومی</option>
                                            <option value="1">حساب مالی</option>
                                            <option value="2">سرمایه گذاری</option>
                                            <option value="3">همکاری و مدیریت</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="priority" class="form-control-label">سطح اهمیت</label>
                                        <select class="form-control" id="priority" name="priority">
                                            <option value="0">عادی</option>
                                            <option value="1">کم اهمیت</option>
                                            <option value="2">مهم و فوری</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="attachment" class="form-control-label">پیوست</label>
                                        <input type="file" name="attachment" class="form-control" id="attachment">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label for="message" class="form-control-label">توضیحات تیکت پشتیبانی</label>
                                        <textarea id="message" class="form-control" name="message" rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row m-t-md">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary pull-right">ایجاد تیکت</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
