@extends('layout.panel')
@section('pageTitle', 'لیست کیف پول های رمزارز')
@section('content')
    <div class="padding">
        <div class="row">
            <div class="col-sm-12">
                @include('partials.errors')
                <div class="box">
                    <div class="box-header">
                        <div class="pull-left">
                            <h2>لیست کیف پول های رمزارز</h2>
                            <small>
                                در لیست زیر میتوانید تمامی کیف پول های رمزارز خود را مشاهده کنید
                            </small>
                        </div>
                        <a data-toggle="modal" data-target="#new"
                           class="btn btn-sm text-sm text-sm-center btn-primary text-white pull-right">ثبت کیف پول
                            رمزارز</a>
                        <div id="new" class="modal" data-backdrop="true">
                            <div class="row-col h-v">
                                <div class="row-cell v-m">
                                    <div class="modal-dialog modal-md">
                                        <form action="{{route('admin.wallets.store')}}" method="post"
                                              class="modal-content">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title">ثبت کیف پول رمزارز</h5>
                                            </div>
                                            <div class="modal-body text-center p-lg">
                                                <div class="row">
                                                    <div class="col-sm-12 form-group">
                                                        @include('components.inputs.username')
                                                    </div>
                                                    <div class="col-sm-12 form-group">
                                                        <label class="control-label text-right pull-left" for="address">
                                                            آدرس کیف پول<span class="text-danger"> *</span></label>
                                                        <input class="form-control" id="address" name="address" required
                                                               type="text" placeholder="لطفا آدرس کیف پول را وارد کنید">
                                                    </div>
                                                    <div class="col-sm-12 form-group">
                                                        <label class="control-label text-right pull-left"
                                                               for="currency">نوع رمزارز</label>
                                                        <select class="form-control" name="currency">
                                                            <option value="0" selected>Tether (ERC20)</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn dark-white pull-left p-x-md"
                                                        data-dismiss="modal">انصراف
                                                </button>
                                                <button type="submit" class="btn btn-primary pull-right p-x-md">ثبت کیف
                                                    پول رمزارز
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        @if(count($wallets) === 0)
                            <img class="img-fluid center-block center" src="{{asset('img/empty.png')}}"
                                 alt="چیزی پیدا نکردیم!"/>
                            <h5 class="text-center text-muted p-b-lg">اوپس، هنوز کیف پول رمزارز ثبت نکردید، معطل چی
                                هستی؟</h5>
                        @else
                            <table class="table table-striped b-t">
                                <thead>
                                <tr>
                                    <th>آدرس کیف پول</th>
                                    <th>نام کاربری</th>
                                    <th>نام کاربر</th>
                                    <th>نوع رمزارز</th>
                                    <th>وضعیت</th>
                                    <th>گزینه‌ها</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($wallets as $item)
                                    <tr>
                                        <td>{{$item->address}}</td>
                                        <td>{{$item->user->username}}</td>
                                        <td>{{$item->user->full_name}}</td>
                                        <td>Tether (ERC20)</td>
                                        <td>{!! \App\Helpers\BankAccountHelper::status($item->status) !!}</td>
                                        <td>
                                            @if(auth()->user()->role === 6 && $item->status != 1)
                                                <a href="{{route('admin.wallets.accept', $item->uuid)}}"
                                                   class="btn btn-success btn-sm text-sm text-white">تایید</a>
                                            @endif
                                            <a data-toggle="modal" data-target="#delete-{{$item->id}}"
                                               class="btn btn-danger btn-sm text-sm text-white">حذف</a>
                                            <div id="delete-{{$item->id}}" class="modal" data-backdrop="true">
                                                <div class="row-col h-v">
                                                    <div class="row-cell v-m">
                                                        <div class="modal-dialog modal-md">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">حذف کیف پول</h5>
                                                                </div>
                                                                <div class="modal-body text-center p-lg">
                                                                    <p>آیا از حذف کیف پول خود مطمئن هستید؟</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn dark-white p-x-md"
                                                                            data-dismiss="modal">انصراف
                                                                    </button>
                                                                    <form
                                                                        action="{{route('admin.wallets.destroy', $item->uuid)}}"
                                                                        method="post">
                                                                        @method('DELETE')
                                                                        @csrf
                                                                        <button type="submit"
                                                                                class="btn danger text-white pull-right p-x-md">
                                                                            حذف میکنم
                                                                        </button>
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
                    {{$wallets->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
