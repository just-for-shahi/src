{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

    <div class="col-12 row">

        <div class="card card-custom col-8">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">Send Ticket
                        <div class="text-muted pt-2 font-size-sm">Send new ticket to get back your smile into Uinvest
                            family.
                        </div>
                    </h3>
                </div>
            </div>

            <div class="card-body">
                <form action="{{route('tickets.store')}}" method="post">
                    @csrf
                    @include('partials.errors')

                    <div class="form-group row">
                        <label for="title" class="col-2 col-form-label">Title</label>
                        <div class="col-10">
                            <input class="form-control" type="text" name="title"
                                   placeholder="Please enter title of your ticket" id="title"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="department" class="col-2 col-form-label">Department</label>
                        <div class="col-10">
                            <select class="form-control" name="department">
                                <option selected
                                        value="{{\App\Enums\Ticket\Department::GENERAL}}">{!! \App\Enums\Ticket\Department::GENERAL_HTML !!}</option>
                                <option
                                    value="{{\App\Enums\Ticket\Department::FINANCE}}">{!! \App\Enums\Ticket\Department::FINANCE_HTML !!}</option>
                                <option
                                    value="{{\App\Enums\Ticket\Department::INVESTMENT}}">{!! \App\Enums\Ticket\Department::INVESTMENT_HTML !!}</option>
                                <option
                                    value="{{\App\Enums\Ticket\Department::UACCOUNTS}}">{!! \App\Enums\Ticket\Department::UACCOUNTS_HTML !!}</option>
                                <option
                                    value="{{\App\Enums\Ticket\Department::HODHOD}}">{!! \App\Enums\Ticket\Department::HODHOD_HTML !!}</option>
                                <option
                                    value="{{\App\Enums\Ticket\Department::CORPORATIONS}}">{!! \App\Enums\Ticket\Department::CORPORATIONS_HTML !!}</option>
                                <option
                                    value="{{\App\Enums\Ticket\Department::ADMINS}}">{!! \App\Enums\Ticket\Department::ADMINS_HTML !!}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="priority" class="col-2 col-form-label">Priority</label>
                        <div class="col-10">
                            <select class="form-control" name="priority">
                                <option selected
                                        value="{{\App\Enums\Ticket\Priority::NORMAL}}">{!! \App\Enums\Ticket\Priority::NORMAL_HTML !!}</option>
                                <option
                                    value="{{\App\Enums\Ticket\Priority::NON_SIGNIFICANT}}">{!! \App\Enums\Ticket\Priority::NON_SIGNIFICANT_HTML !!}</option>
                                <option
                                    value="{{\App\Enums\Ticket\Priority::IMPORTANT}}">{!! \App\Enums\Ticket\Priority::IMPORTANT_HTML !!}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="message" class="col-2 col-form-label">Message</label>
                        <div class="col-10">
                            <textarea class="form-control" id="message" name="message" rows="5"
                                      required="required"
                                      placeholder="Please write your message for our support experts.">
                            </textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-2">
                            </div>
                            <div class="col-10">
                                <button type="submit" class="btn btn-primary btn-success font-weight-bolder mr-2">Send
                                    Ticket
                                </button>
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
                        <div class="text-muted pt-2 font-size-sm">Tickets, So simple way to take support from our
                            support experts.
                        </div>
                    </h3>
                </div>
            </div>

            <div class="card-body">
                <ul>
                    <li>Enter title of your ticket (support request)</li>
                    <li>Select department which one your need to talk with us.</li>
                    <li>Select priority of your ticket. We indicate our replies on your priorities.</li>
                    <li>Write a full message of your support request and explain it.</li>
                    <li>Click on "Send Ticket" and just few minutes for getting support from Uinvest.</li>
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
