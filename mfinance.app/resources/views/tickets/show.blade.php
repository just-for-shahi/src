{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

    <div class="col-12 row">

        <div class="card card-custom col-8">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">Show Ticket
                        <div class="text-muted pt-2 font-size-sm">To get back your smile into Uinvest family.</div>
                    </h3>
                </div>
            </div>

            <div class="card-body">
                <div class="scroll scroll-pull ps ps__rtl">
                    <div class="messages">
                        <div class="d-flex flex-column mb-5 align-items-start">
                            <div class="d-flex align-items-center">
                                <div class="symbol symbol-circle symbol-40 mr-3">
                                    <img alt="{{$account['first_name']}} {{$account['last_name']}}" src="{{asset('media/users/blank.png')}}">
                                </div>
                                <div>
                                    <a class="text-dark-75 text-hover-primary font-weight-bold font-size-h6">{{$account['first_name']}} {{$account['last_name']}}</a>
                                    <span class="text-muted font-size-sm">{{$ticket->created_at}}</span>
                                </div>
                            </div>
                            <div class="mt-2 rounded p-5 bg-light-success text-dark-50 font-weight-bold font-size-lg text-left max-w-400px">{!!$ticket->message!!}</div>
                        </div>
                        @foreach($ticket->replies as $reply)
                            @php $rAcc = \App\Http\Controllers\Account\Account::find($reply->account_id);@endphp
                            @if($rAcc['id'] === $account['id'])
                                <div class="d-flex flex-column mb-5 align-items-start">
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-circle symbol-40 mr-3">
                                            <img alt="{{$rAcc['first_name']}} {{$rAcc['last_name']}}" src="{{asset('media/users/blank.png')}}">
                                        </div>
                                        <div>
                                            <a class="text-dark-75 text-hover-primary font-weight-bold font-size-h6">{{$rAcc['first_name']}} {{$rAcc['last_name']}}</a>
                                            <span class="text-muted font-size-sm">{{$reply->created_at}}</span>
                                        </div>
                                    </div>
                                    <div class="mt-2 rounded p-5 bg-light-success text-dark-50 font-weight-bold font-size-lg text-left max-w-400px">{!!$reply->message!!}</div>
                                </div>
                            @else
                                <div class="d-flex flex-column mb-5 align-items-end">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <span class="text-muted font-size-sm">{{$reply->created_at}}</span>
                                            <a class="text-dark-75 text-hover-primary font-weight-bold font-size-h6">{{$rAcc['first_name']}} {{$rAcc['last_name']}}</a>
                                        </div>
                                        <div class="symbol symbol-circle symbol-40 ml-3">
                                            <img alt="{{$rAcc['first_name']}} {{$rAcc['last_name']}}" src="{{asset('media/users/blank.png')}}">
                                        </div>
                                    </div>
                                    <div class="mt-2 rounded p-5 bg-light-primary text-dark-50 font-weight-bold font-size-lg text-left max-w-400px">{!!$reply->message!!}</div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <br>
                <hr/>
                <form action="{{route('tickets.reply', ['uuid' => $ticket->uuid])}}" method="post">
                    @csrf
                    @include('partials.errors')
                    <div class="form-group row">
                        <label for="message" class="col-2 col-form-label">Reply</label>
                        <div class="col-10">
                            <textarea class="form-control" id="message" name="message" rows="5"
                                      required
                                      placeholder="Please write your reply for our support experts."></textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-2">
                            </div>
                            <div class="col-10">
                                <button type="submit" class="btn btn-primary btn-success font-weight-bolder mr-2">Send Reply</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card col-4 pull-right">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">Help Desk
                        <div class="text-muted pt-2 font-size-sm">Tickets, So simple way to take support from our support experts.</div>
                    </h3>
                </div>
            </div>

            <div class="card-body">
                <ul>
                    <li>Enter your message for reply into message section.</li>
                    <li>Please explain complete of what is subject and how we can help you.</li>
                    <li>If our support experts is not enough or did not solve the problem, you can rate every answer.</li>
                    <li>Write a full message of your support request and explain it.</li>
                    <li>Click on "Send Reply" and just few minutes for getting support from Uinvest.</li>
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
    <script src="{{asset('assets/js/pages/custom/chat/chat.js')}}"></script>
@endsection
