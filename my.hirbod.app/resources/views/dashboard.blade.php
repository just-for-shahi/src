@extends('layout.panel')
@section('pageTitle', 'پیشخوان')
@section('content')
    <div class="row-col">
        <div class="col-lg b-r">
            <div class="row no-gutter">
                <div class="col-xs-6 col-sm-4 b-r b-b">
                    <div class="padding">
                        <div>
                            <span class="pull-right"><i class="fa fa-caret-up text-primary m-y-xs"></i></span>
                            <span class="text-muted l-h-1x"><i class="ion-ios-grid-view text-muted"></i></span>
                        </div>
                        <div class="text-center">
                            <h2 class="text-center _600">{{number_format($coursesCount)}}</h2>
                            <p class="text-muted m-b-md">دوره‌های من</p>
                            <div>
                                <span data-ui-jp="sparkline" data-ui-options="[2,3,2,2,1,3,6,3,2,1], {type:'line', height:20, width: '60', lineWidth:1, valueSpots:{'0:':'#818a91'}, lineColor:'#818a91', spotColor:'#818a91', fillColor:'', highlightLineColor:'rgba(120,130,140,0.3)', spotRadius:0}" class="sparkline inline"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-4 b-r b-b">
                    <div class="padding">
                        <div>
                            <span class="pull-right"><i class="fa fa-caret-up text-primary m-y-xs"></i></span>
                            <span class="text-muted l-h-1x"><i class="ion-document text-muted"></i></span>
                        </div>
                        <div class="text-center">
                            <h2 class="text-center _600">{{number_format($podcastsCount)}}</h2>
                            <p class="text-muted m-b-md">پادکست‌های من</p>
                            <div>
                                <span data-ui-jp="sparkline" data-ui-options="[1,1,0,2,3,4,2,1,2,2], {type:'line', height:20, width: '60', lineWidth:1, valueSpots:{'0:':'#818a91'}, lineColor:'#818a91', spotColor:'#818a91', fillColor:'', highlightLineColor:'rgba(120,130,140,0.3)', spotRadius:0}" class="sparkline inline"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-4 b-r b-b">
                    <div class="padding">
                        <div>
                            <span class="pull-right"><i class="fa fa-caret-down text-danger m-y-xs"></i></span>
                            <span class="text-muted l-h-1x"><i class="ion-pie-graph text-muted"></i></span>
                        </div>
                        <div class="text-center">
                            <h2 class="text-center _600">{{number_format($ebooksCount)}}</h2>
                            <p class="text-muted m-b-md">کتاب‌های من</p>
                            <div>
                                <span data-ui-jp="sparkline" data-ui-options="[9,2,5,5,7,4,4,3,2,2], {type:'line', height:20, width: '60', lineWidth:1, valueSpots:{'0:':'#818a91'}, lineColor:'#818a91', spotColor:'#818a91', fillColor:'', highlightLineColor:'rgba(120,130,140,0.3)', spotRadius:0}" class="sparkline inline"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="padding">
                <div class="row m-b">
                    <div class="col-sm-6 col-xs-12">
                        <div class="box">
                            <div class="box-header light lt">
                                <h3>دوره‌های آموزشی</h3>
                                <small>آخرین ۳ دوره آموزشی شما</small>
                            </div>
                            <div class="box-tool">
                                <a href="{{route('courses.create')}}" class="md-btn md-raised m-b-sm orange">افزودن دوره‌آموزشی</a>
                            </div>
                            @if(count($courses) < 1)
                                <div class="box-body text-center">
                                    <h6 class="m-a-0 text-center">اوپس، تا حالا دوره‌آموزشی در هیربد ارسال نکردین 😢</h6>
                                    <br>
                                    <a href="{{route('courses.create')}}" class="btn btn-outline rounded b-success text-success">اضافه میکنم</a>
                                </div>
                            @else
                            <table class="table table-striped b-t">
                                <thead>
                                <tr>
                                    <th>عنوان</th>
                                    <th>فروش</th>
                                    <th>امتیاز</th>
                                    <th>وضعیت</th>
                                    <th>گزینه‌ها</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($courses as $account)
                                    //@TODO: Complete this section
                                    <tr>
                                        <td>{{$account->no}}</td>
                                        <td>{{\App\Helpers\AccountHelper::type($account->type)}}</td>
                                        <td>{{\App\Helpers\AccountHelper::plan($account->plan)}}</td>
                                        <td>{{number_format($account->balance)}} <small>تومان</small></td>
                                        <td>{!! \App\Helpers\AccountHelper::status($account->status) !!}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-12">
                        <div class="box">
                            <div class="box-header light lt">
                                <h3>پادکست‌ها</h3>
                                <small>آخرین ۳ پادکست شما</small>
                            </div>
                            <div class="box-tool">
                                <a href="{{route('podcasts.create')}}" class="md-btn md-raised m-b-sm orange">افزودن پادکست</a>
                            </div>
                            @if(count($podcasts) < 1)
                                <div class="box-body text-center">
                                    <h6 class="m-a-0 text-center">اوپس، تا حالا پادکستی ارسال نکردین 😢</h6>
                                    <br>
                                    <a href="{{route('podcasts.create')}}" class="btn btn-outline rounded b-success text-success">اضافه میکنم</a>
                                </div>
                            @else
                                <table class="table table-striped b-t">
                                    <thead>
                                    <tr>
                                        <th>عنوان</th>
                                        <th>فروش</th>
                                        <th>وب‌سایت</th>
                                        <th>وضعیت</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($podcasts as $item)
                                        <?php
                                            $purchases = \App\Http\Controllers\Finance\Transaction::where([
                                                'transactional_type' => \App\Helpers\Podcast::class,
                                                'transactional_id' => $item->id,
                                                'status' => 1
                                            ])->get()->count();
                                        ?>
                                        <tr>
                                            <td><a href="{{route('podcasts.show', ['uuid' => $item->uuid])}}" title="{{$item->title}}">{{$item->title}}</a></td>
                                            <td>{{number_format($purchases)}}</td>
                                            <td><a href="{{$item->website}}" title="{{$item->title}}">{{$item->website}}</a></td>
                                            <td>{!! \App\Helpers\Podcast::status($item->status) !!}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row m-b">
                    <div class="col-sm-6 col-xs-12">
                        <div class="box">
                            <div class="box-header light lt">
                                <h3>کتاب‌ها</h3>
                                <small>آخرین ۳ کتاب شما</small>
                            </div>
                            <div class="box-tool">
                                <a href="{{route('ebooks.create')}}" class="md-btn md-raised m-b-sm orange">افزودن کتاب</a>
                            </div>
                            @if(count($ebooks) < 1)
                                <div class="box-body text-center">
                                    <h6 class="m-a-0 text-center p-t-1">اوه کتابی در هیربد ندارید 😢</h6>
                                    <br>
                                    <a href="{{route('ebooks.create')}}" class="btn btn-outline rounded b-success text-success">الان اضافه می‌کنم</a>
                                </div>
                            @else
                                <table class="table table-striped b-t">
                                    <thead>
                                    <tr>
                                        <th>عنوان</th>
                                        <th>نویسنده</th>
                                        <th>انتشارات</th>
                                        <th>وضعیت</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($ebooks as $item)
                                        <tr>
                                        <?php
                                        $writer = null;
                                        $publisher = null;
                                        foreach ($item->writers as $witem){
                                            $writer = $witem->name;
                                        }
                                        foreach ($item->publishers as $pitem){
                                            $publisher = $pitem->name;
                                        }
                                        ?>
                                        <tr>
                                            <td><a href="{{route('ebooks.show', ['uuid' => $item->uuid])}}" title="{{$item->title}}">{{$item->title}}</a></td>
                                            <td>{{$writer}}</td>
                                            <td>{{$publisher}}</td>
                                            <td>{!! \App\Helpers\Podcast::status($item->status) !!}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-12">
                        <div class="box">
                            <div class="box-header light lt">
                                <h3>پشتیبانی</h3>
                                <small>تیکت‌های پشتیبانی شما در مرکز پشتیبانی</small>
                            </div>
                            <div class="box-tool">
                                <a href="{{route('tickets.create')}}" class="md-btn md-raised m-b-sm orange">پشتیبانی میخوام</a>
                            </div>
                            @if(count($tickets) < 1)
                                <div class="box-body text-center">
                                    <h6 class="m-a-0 text-center p-t-1">عالیه، همه چی ردیفه 😊</h6>
                                    <br>
                                    <a href="{{route('tickets.create')}}" class="btn btn-outline rounded b-success text-success">پشتیبانی میخوام</a>
                                </div>
                            @else
                                <table class="table table-striped b-t">
                                    <thead>
                                    <tr>
                                        <th>عنوان</th>
                                        <th>اهمیت</th>
                                        <th>دپارتمان</th>
                                        <th>وضعیت</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($tickets as $item)
                                        <tr>
                                            <td><a href="{{route('tickets.show', ['uuid' => $item->uuid])}}" title="{{$item->title}}">{{$item->title}}</a></td>
                                            <td>{{\App\Helpers\Support\TicketHelper::priority($item->priority)}}</td>
                                            <td>{{\App\Helpers\Support\TicketHelper::department($item->department)}}</td>
                                            <td>{!! \App\Helpers\Support\TicketHelper::status($item->status) !!}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
