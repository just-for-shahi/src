@extends('layout.panel')
@section('pageTitle', 'پادکست‌ها')
@section('content')
    <div class="padding">
        <div class="row">
            <div class="col-sm-12">
                <div class="box">
                    <div class="box-header">
                        <div class="pull-left">
                            <h2>پادکست‌ها</h2>
                            <small>
                                در لیست زیر میتوانید تمامی پادکست‌های خود را مشاهده کنید
                            </small>
                        </div>
                        <a href="{{route('podcasts.create')}}" class="btn text-sm btn-sm text-sm-center btn-primary pull-right">افزودن پادکست</a>
                    </div>
                    <div class="table-responsive">

                        <table class="table table-striped b-t">
                            <thead>
                            <tr>
                                <th>لوگو</th>
                                <th>عنوان</th>
                                <th>توضیحات</th>
                                <th>وب‌سایت</th>
                                <th>وضعیت</th>
                                <th>گزینه‌ها</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $item)
                                <tr>
                                    <td>
                                    @if(!empty($item->logo))
                                    <img src="{{\Illuminate\Support\Facades\Storage::url($item->logo)}}" height="36" width="36" alt="{{$item->title}}"/>
                                    @endif
                                    </td>
                                    <td>{{$item->title}}</td>
                                    <td>{{$item->description}}</td>
                                    <td><a href="{{$item->website}}" target="_blank" title="{{$item->title}}">{{$item->website}}</a></td>
                                    <td>{!! \App\Helpers\Podcast::status($item->status) !!}</td>
                                    <td>
                                    <a href="{{route('podcasts.episodes', ['uuid' => $item->uuid])}}" class="btn btn-primary btn-sm text-sm text-white">اپیزودها</a>
                                    <a href="{{route('podcasts.show', ['uuid' => $item->uuid])}}" class="btn btn-primary btn-sm text-sm text-white">ویرایش</a>
                                    @if(auth()->user()->role === 6 && $item->status != 1)
                                            <a href="{{route('podcasts.index', ['id' => $item->id])}}" class="btn btn-success btn-sm text-sm text-white">تایید</a>
                                        @endif
                                        <a data-toggle="modal" data-target="#episode-{{$item->id}}" class="btn btn-success btn-sm text-sm text-white">افزودن اپیزود</a>
                                        <div id="episode-{{$item->id}}" class="modal" data-backdrop="true">
                                            <div class="row-col h-v">
                                                <div class="row-cell v-m">
                                                    <form role="form" method="post" action="{{route('episods.store')}}" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="podcast" value="{{$item->id}}">
                                                        <div class="modal-dialog modal-md">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">افزودن اپیزود</h5>
                                                                </div>
                                                                <div class="modal-body text-center p-lg">
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-4">
                                                                            <label for="title" class="form-control-label">عنوان</label>
                                                                            <input type="text" name="title" id="title" class="form-control" placeholder="عنوان اپیزود را وارد کنید">
                                                                        </div>
                                                                        <div class="col-sm-4">
                                                                            <label for="file" class="form-control-label">فایل اپیزود</label>
                                                                            <input type="file" name="file" id="file" class="form-control text-right">
                                                                        </div>
                                                                        <div class="col-sm-4">
                                                                            <label for="plus" class="form-control-label">هیربدپلاس</label>
                                                                            <select class="form-control" name="plus">
                                                                                <option selected value="0">تمایلی ندارم</option>
                                                                                <option value="1">بله استفاده شود</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-sm-12">
                                                                            <label for="description" class="form-control-label">توضیحات</label>
                                                                            <textarea name="description" rows="5" id="description" class="form-control" placeholder="توضیحات معرفی اپیزود در یک جمله بنویسید"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn dark-white pull-left p-x-md" data-dismiss="modal">انصراف</button>
                                                                    <button type="submit" class="btn btn-success p-x-md">افزودن</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <a data-toggle="modal" data-target="#delete-{{$item->id}}" class="btn btn-danger btn-sm text-sm text-white">حذف</a>
                                        <div id="delete-{{$item->id}}" class="modal" data-backdrop="true">
                                            <div class="row-col h-v">
                                                <div class="row-cell v-m">
                                                    <div class="modal-dialog modal-md">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">حذف پادکست</h5>
                                                            </div>
                                                            <div class="modal-body text-center p-lg">
                                                                <p>آیا از حذف پادکست و اپیزودهای مربوط به آن مطمئن هستید؟</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn dark-white p-x-md" data-dismiss="modal">انصراف</button>
                                                                <form action="{{route('podcasts.destroy', ['podcast' => $item->id])}}" method="post">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <button type="submit" class="btn danger text-white pull-right p-x-md">حذف می‌کنم</button>
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
                    </div>
                    {{$items->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
