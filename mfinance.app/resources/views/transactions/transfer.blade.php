{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

    <div class="col-12 row">

        <div class="card card-custom col-8">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">Transfer Amount
                        <div class="text-muted pt-2 font-size-sm">Transfer money to Uinvest platform.</div>
                    </h3>
                </div>
            </div>

            <div class="card-body text-center">
                <img class="img-fluid" src="{{asset('media/qr_bitcoin.png')}}" alt="Wallet"/>
                <br/>
                <code>THISv99nu8ty7yvb37b2vbh1dhin</code>
                <br/>
                <br/>
                <a href="{{route('transactions.index')}}" class="btn btn-light">Back to Transactions</a>
            </div>
        </div>
        <div class="card col-4 pull-right">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">Help Desk
                        <div class="text-muted pt-2 font-size-sm">In this page you can transfer your money to generated wallet for charge your account.</div>
                    </h3>
                </div>
            </div>

            <div class="card-body">
                <ul>
                    <li>All of transactions checked automatically.</li>
                    <li>Our network scanners check every 15 minutes.</li>
                    <li>Please send Exactly amount of transaction to wallet address via scan qr code or enter address manually.</li>
                    <li>After transfer and confirmed transaction, please wait. We send notification as soon as possible after receive your transfer.</li>
                </ul>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
@endsection
