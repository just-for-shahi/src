@extends('layout.panel')
@section('pageTitle', 'لیست حساب‌های بانکی')
@section('content')
    <div class="padding">
        <div class="row">
            <div class="col-sm-12">
                @include('partials.errors')
                <div class="box">
                    <div class="box-header">
                        <div class="pull-left">
                            <h2>لیست حساب‌های بانکی</h2>
                            <small>
                                در لیست زیر میتوانید تمامی حساب‌های بانکی خود را مشاهده کنید
                            </small>
                        </div>
                        <a data-toggle="modal" data-target="#new" class="btn btn-sm text-sm text-sm-center btn-primary text-white pull-right">ثبت حساب بانکی</a>
                        <div id="new" class="modal" data-backdrop="true">
                            <div class="row-col h-v">
                                <div class="row-cell v-m">
                                    <div class="modal-dialog modal-md">
                                        <form action="{{route('bankAccounts.store')}}" enctype="multipart/form-data" method="post" class="modal-content">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title">ثبت حساب بانکی</h5>
                                            </div>
                                            <div class="modal-body text-center p-lg">
                                                <div class="row">
                                                    <div class="col-sm-12 form-group">
                                                        <label class="control-label text-right pull-left" for="iban"> شماره شبا<span class="text-danger"> *</span></label>
                                                        <input class="form-control" id="iban" name="iban" type="text" placeholder="لطفا شماره شبا را وارد کنید">
                                                    </div>
                                                    <div class="col-sm-4 form-group">
                                                        <label class="control-label text-right pull-left" for="card">شماره کارت</label>
                                                        <input class="form-control" id="card" name="card" type="number" placeholder="لطفا شماره کارت را وارد کنید">
                                                    </div>
                                                    <div class="col-sm-4 form-group">
                                                        <label class="control-label text-right pull-left" for="account">شماره حساب</label>
                                                        <input class="form-control" id="account" name="account" type="number" placeholder="لطفا شماره حساب را وارد کنید">
                                                    </div>
                                                    <div class="col-sm-4 form-group">
                                                        <label class="control-label text-right pull-left" for="photo">تصویر کارت بانکی</label>
                                                        <input class="form-control" id="photo" name="photo" type="file">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn dark-white pull-left p-x-md" data-dismiss="modal">انصراف</button>
                                                <button type="submit" class="btn btn-primary pull-right p-x-md">ثبت حساب بانکی</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        @if(count($bank_accounts) === 0)
                            <img class="img-fluid center-block center" src="{{asset('img/empty.png')}}" alt="چیزی پیدا نکردیم!"/>
                            <h5 class="text-center text-muted p-b-lg">اوپس، هنوز حساب بانکی ثبت نکردید، معطل چی هستی؟</h5>
                        @else
                        <table class="table table-striped b-t">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>شماره شبا</th>
                                <th>شماره حساب</th>
                                <th>شماره کارت</th>
                                <th>وضعیت</th>
                                <th>گزینه‌ها</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($bank_accounts as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->iban}}</td>
                                    <td>{{$item->account}}</td>
                                    <td>{{$item->card}}</td>
                                    <td>{!! \App\Helpers\BankAccountHelper::status($item->status) !!}</td>
                                    <td>
                                        @if(auth()->user()->role === 6 && $item->status != 1)
                                            <a href="{{route('admin.mbank-accounts.accept', ['id' => $item->id])}}" class="btn btn-success btn-sm text-sm text-white">تایید</a>
                                        @endif
                                        <a data-toggle="modal" data-target="#delete-{{$item->id}}" class="btn btn-danger btn-sm text-sm text-white">حذف</a>
                                        <div id="delete-{{$item->id}}" class="modal" data-backdrop="true">
                                            <div class="row-col h-v">
                                                <div class="row-cell v-m">
                                                    <div class="modal-dialog modal-md">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">حذف حساب بانکی</h5>
                                                            </div>
                                                            <div class="modal-body text-center p-lg">
                                                                <p>آیا از حذف حساب بانکی خود مطمئن هستید؟</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn dark-white p-x-md" data-dismiss="modal">انصراف</button>
                                                                <form action="{{route('bankAccounts.destroy', ['uuid' => $item->uuid])}}" method="post">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <button type="submit" class="btn danger text-white pull-right p-x-md">حذف میکنم</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>
                    {{$bank_accounts->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
