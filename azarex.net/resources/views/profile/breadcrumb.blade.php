<div class="subheader py-2 py-lg-6  subheader-transparent " id="kt_subheader">
    <div class=" container  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <button class="burger-icon burger-icon-left mr-4 d-inline-block d-lg-none" id="kt_subheader_mobile_toggle">
                <span></span>
            </button>
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <h5 class="text-dark font-weight-bold my-1 mr-5">پروفایل</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{route('panel.dashboard')}}" class="text-muted">پیشخوان</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#" class="text-muted">پروفایل</a>
                    </li>
                    @if(\Illuminate\Support\Facades\Route::currentRouteName() === 'panel.profile.overview')
                        <li class="breadcrumb-item">
                            <a href="{{route('panel.profile.overview')}}" class="text-muted">اطلاعات شخصی</a>
                        </li>
                    @elseif(\Illuminate\Support\Facades\Route::currentRouteName() === 'panel.profile.addresses.index')
                        <li class="breadcrumb-item">
                            <a href="{{route('panel.profile.addresses.index')}}" class="text-muted">نشانی ها</a>
                        </li>
                    @elseif(\Illuminate\Support\Facades\Route::currentRouteName() === 'panel.profile.verifications.index')
                        <li class="breadcrumb-item">
                            <a href="{{route('panel.profile.verifications.index')}}" class="text-muted">احراز هویت</a>
                        </li>
                    @endif
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page Heading-->
        </div>
    </div>
</div>
