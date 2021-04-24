@extends('layout.panel')
@section('pageTitle', 'کتاب‌ها')
@section('content')
    <div class="padding">
        <div class="row">
            <div class="col-sm-12">
                <div class="box">
                    <div class="box-header">
                        <div class="pull-left">
                            <h2>کتاب‌ها</h2>
                            <small>
                                در لیست زیر میتوانید تمامی کتاب‌های خود را مشاهده کنید
                            </small>
                        </div>
                        <a href="{{route('ebooks.create')}}" class="btn text-sm btn-sm text-sm-center btn-primary pull-right">افزودن کتاب</a>
                    </div>
                    <div class="table-responsive">

                        <table class="table table-striped b-t">
                            <thead>
                            <tr>
                                <th>روی جلد</th>
                                <th>عنوان</th>
                                <th>نویسنده</th>
                                <th>انتشارات</th>
                                <th>وضعیت</th>
                                <th>گزینه‌ها</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $item)
                                <?php
                                    $writer = null;
                                    $publisher = null;
                                    foreach ($item->writers as $witem){
                                        $writer = $witem->name;
                                    }
                                    foreach ($item->publishers as $pitem){
                                        $publisher = $pitem->name;
                                    }
                                    try{
                                        $cover = \Illuminate\Support\Facades\Storage::url($item->cover);
                                    }catch (Exception $e){
                                        $cover = 'https://s.hirbod.ac/defaults/ebook.png';
                                    }
                                ?>
                                <tr>
                                    <td><img src="{{$cover}}" height="36" width="36" alt="{{$item->title}}"/></td>
                                    <td>{{$item->title}}</td>
                                    <td>{{$writer}}</td>
                                    <td>{{$publisher}}</td>
                                    <td>{!! \App\Helpers\Podcast::status($item->status) !!}</td>
                                    <td>
                                        <a href="{{route('ebooks.show', ['uuid' => $item->uuid])}}" class="btn btn-primary btn-sm text-sm text-white">ویرایش</a>
                                    @if(auth()->user()->role === 6 && $item->status != 1)
                                            <a href="{{route('ebooks.index', ['uuid' => $item->uuid])}}" class="btn btn-success btn-sm text-sm text-white">تایید</a>
                                        @endif
                                        <a data-toggle="modal" data-target="#delete-{{$item->uuid}}" class="btn btn-danger btn-sm text-sm text-white">حذف</a>
                                        <div id="delete-{{$item->uuid}}" class="modal" data-backdrop="true">
                                            <div class="row-col h-v">
                                                <div class="row-cell v-m">
                                                    <div class="modal-dialog modal-md">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">حذف کتاب</h5>
                                                            </div>
                                                            <div class="modal-body text-center p-lg">
                                                                <p>آیا از حذف کتاب مطمئن هستید؟</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn dark-white p-x-md" data-dismiss="modal">انصراف</button>
                                                                <form action="{{route('ebooks.destroy', ['uuid' => $item->uuid])}}" method="post">
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
