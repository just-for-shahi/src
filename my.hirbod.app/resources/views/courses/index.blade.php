@extends('layout.panel')
@section('pageTitle', 'دوره‌ها')
@section('content')
    <div class="padding">
        <div class="row">
            <div class="col-sm-12">
                <div class="box">
                    <div class="box-header">
                        <div class="pull-left">
                            <h2>دوره‌ها</h2>
                            <small>
                                در لیست زیر میتوانید تمامی دوره‌های خود را مشاهده کنید
                            </small>
                        </div>
                        <a href="{{route('courses.create')}}" class="btn text-sm btn-sm text-sm-center btn-primary pull-right">افزودن دوره</a>
                    </div>
                    <div class="table-responsive">

                        <table class="table table-striped b-t">
                            <thead>
                            <tr>
                                <th>کاور دوره</th>
                                <th>عنوان</th>
                                <th>دسته‌بندی</th>
                                <th>فروش</th>
                                <th>وضعیت</th>
                                <th>گزینه‌ها</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $item)
                                <tr>
                                    <td><img src="{{\Illuminate\Support\Facades\Storage::url($item->cover)}}" height="36" width="36" alt="{{$item->title}}"/></td>
                                    <td>{{$item->title}}</td>
                                    <td>{{$item->title}}</td>
                                    <td>0</td>
                                    <td>{!! \App\Helpers\Podcast::status($item->status) !!}</td>
                                    <td>
                                        <a href="{{route('courses.show', ['uuid' => $item->uuid])}}" class="btn btn-primary btn-sm text-sm text-white">ویرایش</a>
                                        <a href="{{route('lectures.index', ['uuid' => $item->uuid])}}" class="btn btn-info btn-sm text-sm text-white">سرفصل‌ها</a>
                                    @if(auth()->user()->role === 6 && $item->status != 1)
                                            <a href="{{route('courses.index', ['uuid' => $item->uuid])}}" class="btn btn-success btn-sm text-sm text-white">تایید</a>
                                        @endif
                                        <a data-toggle="modal" data-target="#delete-{{$item->uuid}}" class="btn btn-danger btn-sm text-sm text-white">حذف</a>
                                        <div id="delete-{{$item->uuid}}" class="modal" data-backdrop="true">
                                            <div class="row-col h-v">
                                                <div class="row-cell v-m">
                                                    <div class="modal-dialog modal-md">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">حذف دوره</h5>
                                                            </div>
                                                            <div class="modal-body text-center p-lg">
                                                                <p>آیا از حذف دوره مطمئن هستید؟</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn dark-white p-x-md" data-dismiss="modal">انصراف</button>
                                                                <form action="{{route('courses.destroy', ['uuid' => $item->uuid])}}" method="post">
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
