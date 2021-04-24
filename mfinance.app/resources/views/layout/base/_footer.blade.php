{{-- Footer --}}

<div class="footer bg-white py-4 d-flex flex-lg-column {{ Metronic::printClasses('footer', false) }}" id="kt_footer">
    {{-- Container --}}
    <div class="{{ Metronic::printClasses('footer-container', false) }} d-flex flex-column flex-md-row align-items-center justify-content-between">
        {{-- Copyright --}}
        <div class="text-dark order-2 order-md-1">
            <span class="text-muted font-weight-bold mr-2">2018 - {{ date("Y") }} &copy;</span>
            <a href="https://uinvest.io" target="_blank" class="text-dark-75 text-hover-primary">MFinance LLC</a>
        </div>

        {{-- Nav --}}
        <div class="nav nav-dark order-1 order-md-2">
            <a href="https://mfinance.app/pages/terms/" target="_blank" class="nav-link pr-3 pl-0">Terms of Service</a>
            <a href="https://mfinance.app/pages/about/" target="_blank" class="nav-link px-3">About us</a>
            <a href="https://mfinance.app/pages/contact/" target="_blank" class="nav-link pl-3 pr-0">Contact us</a>
        </div>
    </div>
</div>
