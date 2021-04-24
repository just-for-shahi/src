{{-- List Widget 9 --}}

<div class="card card-custom {{ @$class }}">
    {{-- Header --}}
    <div class="card-header align-items-center border-0 mt-4">
        <h3 class="card-title align-items-start flex-column">
            <span class="font-weight-bolder text-dark">Recent Activities</span>
            <span class="text-muted mt-3 font-weight-bold font-size-sm">890,344 Sales</span>
        </h3>
        <div class="card-toolbar">
            <div class="dropdown dropdown-inline">
                <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="ki ki-bold-more-ver"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                    {{-- Navigation--}}
                    <ul class="navi navi-hover">
                        <li class="navi-header font-weight-bold">
                            Jump to:
                            <i class="flaticon2-information" data-toggle="tooltip" data-placement="right" title="Click to learn more..."></i>
                        </li>
                        <li class="navi-separator mb-3"></li>
                        <li class="navi-item">
                            <a href="#" class="navi-link">
                                <span class="navi-icon"><i class="flaticon2-drop"></i></span>
                                <span class="navi-text">Recent Orders</span>
                            </a>
                        </li>
                        <li class="navi-item">
                            <a href="#" class="navi-link">
                                <span class="navi-icon"><i class="flaticon2-calendar-8"></i></span>
                                <span class="navi-text">Support Cases</span>
                            </a>
                        </li>
                        <li class="navi-item">
                            <a href="#" class="navi-link">
                                <span class="navi-icon"><i class="flaticon2-telegram-logo"></i></span>
                                <span class="navi-text">Projects</span>
                            </a>
                        </li>
                        <li class="navi-item">
                            <a href="#" class="navi-link">
                                <span class="navi-icon"><i class="flaticon2-new-email"></i></span>
                                <span class="navi-text">Messages</span>
                                <span class="navi-label">
                                    <span class="label label-success label-rounded">5</span>
                                </span>
                            </a>
                        </li>
                        <li class="navi-separator mt-3"></li>
                        <li class="navi-footer">
                            <a class="btn btn-light-primary font-weight-bolder btn-sm" href="#">Upgrade plan</a>
                            <a class="btn btn-clean font-weight-bold btn-sm" href="#" data-toggle="tooltip" data-placement="right" title="Click to learn more...">Learn more</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- Body --}}
    <div class="card-body pt-4">
        <div class="timeline timeline-5 mt-3">
            {{-- Item --}}
            <div class="timeline-item align-items-start">
                {{-- Label --}}
                <div class="timeline-label font-weight-bolder text-dark-75 font-size-lg text-right pr-3">08:42</div>

                {{-- Badge --}}
                <div class="timeline-badge">
                    <i class="fa fa-genderless text-success icon-xxl"></i>
                </div>

                {{-- Text --}}
                <div class="timeline-content text-dark-50">
                    Outlines of the recent activities that happened last weekend
                </div>
            </div>

            {{-- Item --}}
            <div class="timeline-item align-items-start">
                {{-- Label --}}
                <div class="timeline-label font-weight-bolder text-dark-75 font-size-lg text-right pr-3">3 hr</div>

                {{-- Badge --}}
                <div class="timeline-badge">
                    <i class="fa fa-genderless text-danger icon-xxl"></i>
                </div>

                {{-- Content --}}
                <div class="timeline-content d-flex">
                    <span class="mr-4 font-weight-bolder text-dark-75">AEOL meeting with</span>

                    {{-- Section --}}
                    <div class="d-flex align-items-start mt-n2">
                        {{-- Symbol --}}
                        <a href="#" class="symbol symbol-35 symbol-light-success mr-2">
                            <span class="symbol-label">
                                <img src="{{ asset('media/svg/avatars/004-boy-1.svg') }}" class="h-75 align-self-end"/>
                            </span>
                        </a>

                        {{-- Symbol --}}
                        <a href="#" class="symbol symbol-35 symbol-light-success">
                            <span class="symbol-label">
                                <img src="{{ asset('media/svg/avatars/002-girl.svg') }}" class="h-75 align-self-end"/>
                            </span>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Item --}}
            <div class="timeline-item align-items-start">
                {{-- Label --}}
                <div class="timeline-label font-weight-bolder text-dark-75 font-size-lg text-right pr-3">14:37</div>

                {{-- Badge --}}
                <div class="timeline-badge">
                    <i class="fa fa-genderless text-info icon-xxl"></i>
                </div>

                {{-- Desc --}}
                <div class="timeline-content font-weight-bolder text-dark-75">
                    Submit initial budget -
                    <a href="#" class="text-primary">USD 700</a>.
                </div>
            </div>

            {{-- Item --}}
            <div class="timeline-item align-items-start">
                {{-- Label --}}
                <div class="timeline-label font-weight-bolder text-dark-75 font-size-lg text-right pr-3">16:50</div>

                {{-- Badge --}}
                <div class="timeline-badge">
                    <i class="fa fa-genderless text-danger icon-xxl"></i>
                </div>

                {{-- Text --}}
                <div class="timeline-content text-dark-50">
                    Stakeholder meeting scheduling.
                </div>
            </div>

            {{-- Item --}}
            <div class="timeline-item align-items-start">
                {{-- Label --}}
                <div class="timeline-label font-weight-bolder text-dark-75 font-size-lg text-right pr-3">17:30</div>

                {{-- Badge --}}
                <div class="timeline-badge">
                    <i class="fa fa-genderless text-success icon-xxl"></i>
                </div>

                {{-- Text --}}
                <div class="timeline-content text-dark-50">
                    Project scoping & estimations with stakeholders.
                </div>
            </div>

            {{-- Item --}}
            <div class="timeline-item align-items-start">
                {{-- Label --}}
                <div class="timeline-label font-weight-bolder text-dark-75 font-size-lg text-right pr-3">21:03</div>

                {{-- Badge --}}
                <div class="timeline-badge">
                    <i class="fa fa-genderless text-warning icon-xxl"></i>
                </div>

                {{-- Desc --}}
                <div class="timeline-content font-weight-bolder text-dark-75">
                    New order placed <a href="#" class="text-primary">#XF-2356</a>.
                </div>
            </div>

            <!--begin: Item-->
            <div class="timeline-item align-items-start">
                {{-- Label --}}
                <div class="timeline-label font-weight-bolder text-dark-75 font-size-lg text-right pr-3">21:07</div>

                {{-- Badge --}}
                <div class="timeline-badge">
                    <i class="fa fa-genderless text-danger icon-xxl"></i>
                </div>

                {{-- Text --}}
                <div class="timeline-content text-dark-50">
                    Company BBQ to celebrate the last quater achievements and goals.
                </div>
            </div>

            {{-- Item --}}
            <div class="timeline-item align-items-start">
                {{-- Label --}}
                <div class="timeline-label font-weight-bolder text-dark-75 font-size-lg text-right pr-3">20:30</div>

                {{-- Badge --}}
                <div class="timeline-badge">
                    <i class="fa fa-genderless text-info icon-xxl"></i>
                </div>

                {{-- Text --}}
                <div class="timeline-content text-dark-50">
                    Marketing campaign planning with customer.
                </div>
            </div>
        </div>
    </div>
</div>
