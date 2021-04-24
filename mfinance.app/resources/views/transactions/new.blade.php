{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

    <div class="col-12 row">

        <div class="card card-custom col-8">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">New Bank Account
                        <div class="text-muted pt-2 font-size-sm">Register your bank  account.</div>
                    </h3>
                </div>
            </div>

            <div class="card-body">
                <form action="{{route('bankAccounts.store')}}" method="post">
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
                        <label class="col-2 col-form-label">Currency</label>
                        <div class="col-10">
                            <select class="form-control" name="currency">
                                <option selected value="{{\App\Enums\BankAccount\Currency::USD}}">Dollar (USD)</option>
                                <option value="{{\App\Enums\BankAccount\Currency::EUR}}">Euro (EUR)</option>
                                <option value="{{\App\Enums\BankAccount\Currency::AED}}">Dirham (AED)</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="iban" class="col-2 col-form-label">IBAN</label>
                        <div class="col-10">
                            <input class="form-control" type="text" name="iban" placeholder="Please enter IBAN of your account" id="iban"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="card" class="col-2 col-form-label">Card</label>
                        <div class="col-10">
                            <input class="form-control" type="text" name="card" placeholder="Please enter card number of your account" id="card"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="no" class="col-2 col-form-label">No.</label>
                        <div class="col-10">
                            <input class="form-control" type="text" name="no" placeholder="Please enter no of your account" id="no"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="swift" class="col-2 col-form-label">Swift</label>
                        <div class="col-10">
                            <input class="form-control" type="text" name="swift" placeholder="Please enter swift code of your account" id="swift"/>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-2">
                            </div>
                            <div class="col-10">
                                <button type="submit" class="btn btn-primary btn-success font-weight-bolder mr-2">Register</button>
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
                        <div class="text-muted pt-2 font-size-sm">All your preferred bank accounts with our website's available currencies can be added here.</div>
                    </h3>
                </div>
            </div>

            <div class="card-body">
                <ul>
                    <li>Bank account should be owner`s name equal account name.</li>
                    <li>Select your bank account currency.</li>
                    <li>You can whether add your own bank account.</li>
                    <li>Insert the bank information</li>
                    <li>Mentioning swift code for Dollar transfers and IBAN number for Euro transfers is obligatory.</li>
                    <li>Indicate your bank accounts priority.</li>
                    <li>Deactivate your account if you don't need it.</li>
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
