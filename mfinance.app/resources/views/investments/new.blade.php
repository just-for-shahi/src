{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')
    <div class="col-12 row">
        <div class="card card-custom col-8">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">New investment
                        <div class="text-muted pt-2 font-size-sm">So simple entry position for markets.</div>
                    </h3>
                </div>
                <div class="card-toolbar">
                    <!--begin::Dropdown-->
                    <div class="dropdown dropdown-inline mr-2">
                        <button type="button" class="btn btn-light-primary font-weight-bolder" data-toggle="modal" data-target="#callRequest">
                    <span class="svg-icon svg-icon-md">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"/>
                                <path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" fill="#000000" opacity="0.3"/>
                                <path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" fill="#000000"/>
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span>Call Request
                        </button>
                    </div>
                    <!--end::Dropdown-->
                    <!--begin::Button-->
                    <a type="button" class="btn btn-light-primary mr-2 font-weight-bolder" data-toggle="modal" data-target="#commissions">
                <span class="svg-icon svg-icon-md">
                    <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <circle fill="#000000" cx="9" cy="15" r="6"/>
                            <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3"/>
                        </g>
                    </svg>
                    <!--end::Svg Icon-->
                </span>Commissions</a>
                    <!--end::Button-->

                    <div class="modal fade" id="commissions" tabindex="-1" role="dialog" aria-labelledby="profits" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Commissions</h5>
                                    <button type="button" class="close" data-dismiss="modal">
                                        <i aria-hidden="true" class="ki ki-close"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th scope="col">Initial Deposit</th>
                                            <th scope="col">90 days</th>
                                            <th scope="col">180 days</th>
                                            <th scope="col">365 days</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <th scope="row">1,000-5,000 <small>USDT</small></th>
                                            <td>10%</td>
                                            <td>9%</td>
                                            <td>7%</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">5,000-20,000 <small>USDT</small></th>
                                            <td>8%</td>
                                            <td>7%</td>
                                            <td>5%</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">20,000-50,000 <small>USDT</small></th>
                                            <td>5%</td>
                                            <td>4%</td>
                                            <td>2%</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <small>* All of commissions calculate from profit or lose.</small>
                                    <br/>
                                    <small>* All percents calculate dynamically based on your ucoins.</small>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">OK</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="callRequest" tabindex="-1" role="dialog" aria-labelledby="callRequest" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Call Request (Consulting)</h5>
                                    <button type="button" class="close" data-dismiss="modal">
                                        <i aria-hidden="true" class="ki ki-close"></i>
                                    </button>
                                </div>
                                <form action="{{route('callRequests.store')}}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group row">
                                            <label class="col-4 form-control-label">Name</label>
                                            <input class="col-8 form-control" name="name" value="{{auth()->user()->first_name}} {{auth()->user()->last_name}}">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-4 form-control-label">Phone number</label>
                                            <input class="col-8 form-control" name="phone" value="{{auth()->user()->mobile}}" placeholder="Please enter your phone number">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-danger font-weight-bold float-left" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary font-weight-bold">Send</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="card-body">
                <form action="{{route('investments.store')}}" method="post">
                    @csrf
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="form-group row">
                        <label class="col-4 col-form-label">CryptoCurrency</label>
                        <div class="col-8">
                            <select class="form-control" name="cryptocurrency">
                                <option selected value="0">Tether (USDT)</option>
                                <option value="1">Binance (BNB)</option>
                                <option value="2">True USD (TUSD)</option>
                                <option value="3">PAX (PAX)</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-4 col-form-label">Amount</label>
                        <div class="col-8">
                            <input class="form-control" type="text" name="amount" placeholder="Min 1,000 USDT" id="amount"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-4 col-form-label">Period</label>
                        <div class="col-8">
                            <select class="form-control" name="period">
                                <option selected value="90">90 days</option>
                                <option value="180">180 days</option>
                                <option value="365">365 days</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <button type="submit" class="btn btn-primary font-weight-bolder">Invest</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card col-4 pull-right">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">Help Desk
                        <div class="text-muted pt-2 font-size-sm">You can start anywhere, anytime your investments.</div>
                    </h3>
                </div>
            </div>

            <div class="card-body">
                <ul>
                    <li>Your amount effect on your money growth.</li>
                    <li>Select period of you want to invest.</li>
                    <li>Commissions calculated based on ucoins.</li>
                    <li>ucoins the official coin of system. You can earn ucoin by do activities or invite your friends.</li>
                    <li>All of deposit and withdraw on cryptocurrency networks. We support just stable coins.</li>
                </ul>
            </div>
        </div>
    </div>

@endsection

@section('styles')
    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('scripts')
    <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
@endsection
