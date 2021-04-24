@extends('layout.panel')
@section('pageTitle', 'افتتاح حساب')
@section('content')
    <div class="padding">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h2>افتتاح حساب</h2>
                        <small>
                            با استفاده از فرم زیر میتوانید حساب جدید اضافه کنید.
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
                            <form role="form" method="post" action="{{route('accounts.store')}}">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label for="type" class="form-control-label">نوع حساب</label>
                                        <select id="type" class="form-control" name="type">
                                            <option value="0">ماهیانه 15%</option>
                                            <option value="1">ماهیانه 20%</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="plan" class="form-control-label">طرح حساب</label>
                                        <select id="plan" class="form-control" name="plan">
                                            <option value="0">سارینا</option>
                                            <option value="1">ماهینا</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row m-t-md">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary pull-right">افتتاح حساب</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
