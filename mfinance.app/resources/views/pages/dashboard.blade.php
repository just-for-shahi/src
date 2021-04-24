{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

    {{-- Dashboard 1 --}}

    <div class="row">
        <div class="col-lg-6 col-xxl-4 order-1 order-xxl-1">
            <div class="card card-custom card-stretch gutter-b">
                {{-- Header --}}
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label font-weight-bolder text-dark">Quick Access</span>
                        <span class="text-muted mt-3 font-weight-bold font-size-sm">Uinvest, Next Generation of Trading.</span>
                    </h3>
                </div>

                {{-- Body --}}
                <div class="card-body pt-8">
                    {{-- Item --}}
                    <div class="d-flex align-items-center mb-10">
                        {{-- Symbol --}}
                        <div class="symbol symbol-40 symbol-light-primary mr-5">
                <span class="symbol-label">
                    {{ Metronic::getSVG("media/svg/icons/Communication/Clipboard-check.svg", "svg-icon-lg svg-icon-primary") }}
                </span>
                        </div>

                        {{-- Text --}}
                        <div class="d-flex flex-column font-weight-bold">
                            <a href="{{route('investments.index')}}" class="text-dark text-hover-primary mb-1 font-size-lg">Investment</a>
                            <span class="text-muted">Invest in Uinvest algorithms</span>
                        </div>
                    </div>

                    {{-- Item --}}
                    <div class="d-flex align-items-center mb-10">
                        {{-- Symbol --}}
                        <div class="symbol symbol-40 symbol-light-success mr-5">
                <span class="symbol-label">
                    {{ Metronic::getSVG("media/svg/icons/Communication/Group-chat.svg", "svg-icon-lg svg-icon-success") }}
                </span>
                        </div>

                        {{-- Text --}}
                        <div class="d-flex flex-column font-weight-bold">
                            <a href="{{route('faqs')}}" class="text-dark text-hover-primary mb-1 font-size-lg">FAQs</a>
                            <span class="text-muted">Frequently asked questions.</span>
                        </div>
                    </div>

                    {{-- Item --}}
                    <div class="d-flex align-items-center mb-2">
                        <a href="{{route('tickets.index')}}">
                            <div class="symbol symbol-40 symbol-light-info mr-5">
                            <span class="symbol-label">
                                {{ Metronic::getSVG("media/svg/icons/General/Smile.svg", "svg-icon-lg  svg-icon-info") }}
                            </span>
                            </div>
                            <div class="d-flex flex-column font-weight-bold">
                                <a href="{{route('tickets.index')}}" class="text-dark text-hover-primary mb-1 font-size-lg">Support</a>
                                <span class="text-muted">Get your support online!</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-xxl-8 order-2 order-xxl-1">
            <div class="card card-custom card-stretch gutter-b">
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label font-weight-bolder text-dark">Investments</span>
                        <span class="text-muted mt-3 font-weight-bold font-size-sm">Join more than 400+ new members</span>
                    </h3>
                    <div class="card-toolbar">
                        <ul class="nav nav-pills nav-pills-sm nav-dark-75">
                            <li class="nav-item">
                                <a href="{{route('investments.new')}}" class="nav-link py-2 px-4 active">New Investment?</a>
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- Body --}}
                <div class="card-body pt-3 pb-0">
                    {{-- Table --}}
                    @if(count($investments) === 0)
                        <img src="{{asset('media/error/nothing.png')}}" class="img-fluid" alt="No Investmented yet"/>
                    @else
                    <div class="table-responsive">
                        <table class="table table-vertical-center">
                            <thead>
                            <tr>
                                <th class="p-0" style="width: 50px"></th>
                                <th class="p-0" style="min-width: 200px"></th>
                                <th class="p-0" style="min-width: 90px"></th>
                                <th class="p-0" style="min-width: 115px"></th>
                                <th class="p-0" style="min-width: 180px"></th>
                                <th class="p-0" style="min-width: 150px"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($investments as $investment)
                                <tr>
                                    <td class="pl-0 py-4">
                                        <div class="symbol symbol-50 symbol-light mr-1">
                                <span class="symbol-label">
                                    {{ Metronic::getSVG("media/svg/icons/General/Like.svg", "svg-icon-lg svg-icon-primary") }}
                                </span>
                                        </div>
                                    </td>
                                    <td class="pl-0">
                                        <div>
                                            <span class="font-weight-bolder">Invested At:</span>
                                            <a class="text-muted font-weight-bold text-hover-primary" href="#">@if($investment->invested_at===null) Not yet @else {{$investment->invested_at}}@endif</a>
                                        </div>
                                        <div>
                                            <span class="font-weight-bolder">Last Change:</span>
                                            <a class="text-muted font-weight-bold text-hover-primary" href="#">@if($investment->last_change===null) Not yet @else {{$investment->last_change}} @endif</a>
                                        </div>
                                    </td>
                                    <td class="text-right">
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                ${{number_format($investment->amount)}}
                            </span>
                                    </td>
                                    <td class="text-right">
                                        {!! \App\Helpers\Investment\Status::status($investment->status) !!}
                                    </td>
                                    <td class="text-right pr-0">
                                        <a href="#" class="btn btn-icon btn-light btn-sm mx-3">
                                            {{ Metronic::getSVG("media/svg/icons/Communication/Write.svg", "svg-icon-md svg-icon-primary") }}
                                        </a>
                                        <a href="#" class="btn btn-icon btn-light btn-sm">
                                            {{ Metronic::getSVG("media/svg/icons/General/Trash.svg", "svg-icon-md svg-icon-primary") }}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>

        </div>
        <div class="col-xxl-12 order-2 order-xxl-1">
            <div class="card card-custom card-stretch gutter-b">
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label font-weight-bolder text-dark">MAccount</span>
                        <span class="text-muted mt-3 font-weight-bold font-size-sm">Join more than 1200+ members of Uinvest family.</span>
                    </h3>
                    <div class="card-toolbar">
                        <ul class="nav nav-pills nav-pills-sm nav-dark-75">
                            <li class="nav-item">
                                <a href="{{route('maccounts.new')}}" class="nav-link py-2 px-4 active">Another Account?</a>
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- Body --}}
                <div class="card-body pt-3 pb-0">
                    {{-- Table --}}
                    @if(count($uaccounts) === 0)
                        <img src="{{asset('media/error/nothing.png')}}" class="img-fluid" alt="No UAccounts yet"/>
                    @else
                    <div class="table-responsive">
                        <table class="table table-vertical-center">
                            <thead>
                            <tr>
                                <th class="p-0" style="width: 50px"></th>
                                <th class="p-0" style="min-width: 200px"></th>
                                <th class="p-0" style="min-width: 90px"></th>
                                <th class="p-0" style="min-width: 115px"></th>
                                <th class="p-0" style="min-width: 180px"></th>
                                <th class="p-0" style="min-width: 150px"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($uaccounts as $uaccount)
                                <tr>
                                    <td class="pl-0 py-4">
                                        <div class="symbol symbol-50 symbol-light mr-1">
                                <span class="symbol-label">
                                    {{ Metronic::getSVG("media/svg/icons/General/Like.svg", "svg-icon-lg svg-icon-primary") }}
                                </span>
                                        </div>
                                    </td>
                                    <td class="pl-0">
                                        <div>
                                            <span class="font-weight-bolder">Broker:</span>
                                            <a class="text-muted font-weight-bold text-hover-primary" href="#">{!!\App\Helpers\UAccount\Broker::Broker($uaccount->broker)!!}</a>
                                        </div>
                                        <div>
                                            <span class="font-weight-bolder">Balance:</span>
                                            <a class="text-muted font-weight-bold text-hover-primary" href="#">${{number_format($uaccount->balance)}}</a>
                                        </div>
                                    </td>
                                    <td class="text-right">
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                ${{number_format($uaccount->equity)}}
                            </span>
                                    </td>
                                    <td class="text-right">
                            <span class="text-muted font-weight-500">
                                {!! \App\Helpers\UAccount\EA::ea($uaccount->ea) !!}
                            </span>
                                    </td>
                                    <td class="text-right">
                                        {!!\App\Helpers\UAccount\Status::status(($uaccount->status))!!}
                                    </td>
                                    <td class="text-right pr-0">
                                        <a href="#" class="btn btn-icon btn-light btn-sm mx-3">
                                            {{ Metronic::getSVG("media/svg/icons/Communication/Write.svg", "svg-icon-md svg-icon-primary") }}
                                        </a>
                                        <a href="#" class="btn btn-icon btn-light btn-sm">
                                            {{ Metronic::getSVG("media/svg/icons/General/Trash.svg", "svg-icon-md svg-icon-primary") }}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>

        </div>

    </div>

@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
@endsection
