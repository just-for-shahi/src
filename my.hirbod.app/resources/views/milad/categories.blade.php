@extends('layout.panel')
@section('pageTitle', 'دسته‌بندی‌ها')
@section('content')
    <div class="padding">
        <div class="row">
            <div class="col-sm-12">
                <div class="box">
                    <div class="box-header">
                        <div class="pull-left">
                            <h2>دسته‌بندی‌ها</h2>
                            <small>
                                در لیست زیر میتوانید تمامی دسته‌بندی‌ها را مشاهده کنید
                            </small>
                        </div>
                    </div>
                    <div class="table-responsive">

                        <table class="table table-striped b-t">
                            <thead>
                            <tr>
                                <th>تصویر</th>
                                <th>والد</th>
                                <th>عنوان</th>
                                <th>رنگ</th>
                                <th>نوع</th>
                                <th>گزینه‌ها</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $item)
                                <tr>
                                    <td>
                                    @if(!empty($item->photo))
                                    <img src="{{$item->photo && \Illuminate\Support\Facades\Storage::url($item->photo)}}" height="36" width="36" alt="{{$item->title}}"/>
                                    @endif
                                    </td>
                                    <td>@if($item->parent != null){{\App\Models\Category::find($item->parent)->name}}@endif</td>
                                    <td>{{$item->name}}</td>
                                    <td><span style="padding:3px;border-radius:3px;background-color:#{{$item->color}};color:black   ;font-family: monospace">{{$item->color}}</span></td>
                                    <td>{!! \App\Helpers\Category::type($item->type) !!}</td>
                                    <td>
                                        <a data-toggle="modal" data-target="#episode-{{$item->id}}" class="btn btn-primary btn-sm text-sm text-white">ویرایش</a>
                                        <div id="episode-{{$item->id}}" class="modal" data-backdrop="true">
                                            <div class="row-col h-v">
                                                <div class="row-cell v-m">
                                                    <form role="form" method="post" action="{{route('mcategories.store')}}" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="category" value="{{$item->id}}">
                                                        <div class="modal-dialog modal-md">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">ویرایش دسته‌بندی</h5>
                                                                </div>
                                                                <div class="modal-body text-center p-lg">
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-6">
                                                                            <label for="name" class="form-control-label">عنوان</label>
                                                                            <input type="text" name="name" id="name" class="form-control" value="{{$item->name}}">
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <label for="color" class="form-control-label">رنگ</label>
                                                                            <input type="text" name="color" id="color" class="form-control" value="{{$item->color}}">
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <label for="photo" class="form-control-label">تصویر</label>
                                                                            <input type="file" name="photo" id="photo" class="form-control text-right">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn dark-white pull-left p-x-md" data-dismiss="modal">انصراف</button>
                                                                    <button type="submit" class="btn btn-primary p-x-md">ویرایش</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
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
