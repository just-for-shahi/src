{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

    <div class="accordion accordion-light accordion-light-borderless accordion-svg-toggle" id="faq">
        <div class="card p-8">
            <div>
                <div class="card-header" id="faqHeading1">
                    <a class="card-title text-dark" data-toggle="collapse" href="#faq1" aria-expanded="true"
                       aria-controls="faq1" role="button">
                                        <span class="svg-icon svg-icon-primary"><!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-right.svg--><svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <polygon points="0 0 24 0 24 24 0 24"></polygon>
        <path
            d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z"
            fill="#000000" fill-rule="nonzero"></path>
        <path
            d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z"
            fill="#000000" fill-rule="nonzero" opacity="0.3"
            transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) "></path>
    </g>
</svg><!--end::Svg Icon--></span>
                        <div class="card-label text-dark pl-4">How we works?</div>
                    </a>
                </div>
                <div id="faq1" class="collapse show" aria-labelledby="faqHeading1" data-parent="#faq">
                    <div class="card-body text-dark-50 font-size-lg pl-12">
                        We work together happily.
                    </div>
                </div>
            </div>
            <div class="border-top-0">
                <!--begin::Header-->
                <div class="card-header" id="faqHeading2">
                    <a class="card-title collapsed text-dark" data-toggle="collapse" href="#faq2" aria-expanded="false"
                       aria-controls="faq2" role="button">
                                        <span class="svg-icon svg-icon-primary"><!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-right.svg--><svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <polygon points="0 0 24 0 24 24 0 24"></polygon>
        <path
            d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z"
            fill="#000000" fill-rule="nonzero"></path>
        <path
            d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z"
            fill="#000000" fill-rule="nonzero" opacity="0.3"
            transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) "></path>
    </g>
</svg><!--end::Svg Icon--></span>
                        <div class="card-label text-dark pl-4">What we do?</div>
                    </a>
                </div>
                <!--end::Header-->

                <!--begin::Body-->
                <div id="faq2" class="collapse" aria-labelledby="faqHeading2" data-parent="#faq">
                    <div class="card-body text-dark-50 font-size-lg pl-12">
                        We create new generation of trading.
                    </div>
                </div>
                <!--end::Body-->
            </div>
            <div class="border-top-0">
                <!--begin::Header-->
                <div class="card-header" id="faqHeading3">
                    <div class="card-title collapsed text-dark" data-toggle="collapse" data-target="#faq3"
                         aria-expanded="false" aria-controls="faq3" role="button">
                                        <span class="svg-icon svg-icon-primary"><!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-right.svg--><svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <polygon points="0 0 24 0 24 24 0 24"></polygon>
        <path
            d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z"
            fill="#000000" fill-rule="nonzero"></path>
        <path
            d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z"
            fill="#000000" fill-rule="nonzero" opacity="0.3"
            transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) "></path>
    </g>
</svg><!--end::Svg Icon--></span>
                        <div class="card-label text-dark pl-4">Why choose us?</div>
                    </div>
                </div>
                <!--end::Header-->

                <!--begin::Body-->
                <div id="faq3" class="collapse" aria-labelledby="faqHeading3" data-parent="#faq">
                    <div class="card-body text-dark-50 font-size-lg pl-12">
                        Because we are perfect team.
                    </div>
                </div>
                <!--end::Body-->
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
@endsection
