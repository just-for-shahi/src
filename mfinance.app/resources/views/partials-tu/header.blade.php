<?php
$luri = explode('/', SITE_URI);
$clanguage = '/tu';
$cfolder = '/pages';
$cpage = $enUrl = $arUrl = $peUrl = $tuUrl = "";

if(count($luri) === 3):
    $cpage = $luri[2];
    $enUrl = SITE_URL.'/';
    $arUrl = SITE_URL.$cfolder.'/ar';
    $peUrl = SITE_URL.$cfolder.'/pe';
    $tuUrl = SITE_URL.$cfolder.'/tu';
elseif(count($luri) === 4):
    $cpage = $luri[3];
    $enUrl = SITE_URL.'/pages/'.$cpage;
    $arUrl = SITE_URL.$cfolder.'/ar/'.$cpage;
    $peUrl = SITE_URL.$cfolder.'/pe/'.$cpage;
    $tuUrl = SITE_URL.$cfolder.'/tu/'.$cpage;
endif;
?>
<section class="header header--8">
    <div class="top_bar top--bar2 d-flex align-items-center bg-primary">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex topbar_content justify-content-between">
                        <div class="top_bar--lang align-self-center order-2">
                            <div class="dropdown">
                                <div class="dropdown-toggle d-flex align-items-center" id="dropdownMenuButton1" role="menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="lang">TU</span>
                                    <img class="lang_flag" src="{{asset('front/img/turkey.png')}}" alt="Persian">
                                    <span class="la la-angle-down"></span>
                                </div>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <a class="dropdown-item" data-lang="en" href="{{ $enUrl }}"><img src="{{asset('front/img/united-states.png')}}" alt="">English</a>
                                    <a class="dropdown-item" data-lang="ar" href="{{ $arUrl }}"><img src="{{asset('front/img/united-arab-emirates.png')}}" alt="">Arabic</a>
                                    <a class="dropdown-item" data-lang="pe" href="{{ $peUrl }}"><img src="{{asset('front/img/iran.png')}}" alt="">Persian</a>
                                    <a class="dropdown-item" data-lang="tr" href="{{ $tuUrl }}"><img src="{{asset('front/img/turkey.png')}}" alt="">Turkish</a>
                                </div>
                            </div>
                            <div class="drop-down">
                                <div class="options">
                                    <ul>
                                        <li><a href="#">User1<span class="value">1</span></a></li>
                                        <li><a href="#">User2<span class="value">2</span></a></li>
                                        <li><a href="#">User3<span class="value">3</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="top_bar--info order-0 d-none d-lg-block align-self-center">
                            <ul>
                                <li><span class="la la-envelope"></span>
                                    <p>support@email.com</p>
                                </li>
                                <li><span class="la la-headphones"></span>
                                    <p>800 567.890.576</p>
                                </li>
                                <li><span class="la la-clock-o"></span>
                                    <p>Mon-Sat 8.00 - 18.00</p>
                                </li>
                            </ul>
                        </div>
                        <div class="top_bar--social">
                            <ul>
                                <li><a href="#"><span class="fab fa-facebook-f"></span></a></li>
                                <li><a href="#"><span class="fab fa-twitter"></span></a></li>
                                <li><a href="#"><span class="fab fa-vimeo-v"></span></a></li>
                                <li><a href="#"><span class="fab fa-linkedin-in"></span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- start menu area -->
    <div class="menu_area menu8">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light px-0 ">
                <a class="navbar-brand" href="#"><img src="{{asset('front/img/logo.png')}}" alt="" /></a>

                <div class="collapse navbar-collapse  justify-content-end" id="navbarSupportedContent22">
                    <div class="m-right-15">
                        <ul class="navbar-nav ">
                            <li class="nav-item active">
                                <a class="nav-link" href="{{ $cfolder.$clanguage.'/' }}">Home</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="{{ $cfolder.$clanguage.'/' }}#investment">Investment</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ $cfolder.$clanguage.'/' }}#signals">Signals</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ $cfolder.$clanguage.'/' }}#account-management">MAccounts</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ $cfolder.$clanguage.'/about' }}">About</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ $cfolder.$clanguage.'/contact' }}">Contact</a></li>
                        </ul>
                        <!-- end: .navbar-nav -->
                    </div>
                </div>
                <div class="nav_right_content d-flex align-items-center ml-auto mr-4">
                    @if(auth()->check()===false)
                    <a class="btn btn-sm btn--rounded btn-light text-primary" href="{{route('login.show')}}">Login/Register</a>
                    @else
                    <a class="btn btn-sm btn--rounded btn-light text-primary" href="{{route('dashboard')}}">Dashboard</a>
                    @endif
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent22" aria-controls="navbarSupportedContent22" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="la la-bars"></span>
                </button> 
            </nav>
        </div>
    </div>
    <!-- end menu area -->
</section><!-- end: .header -->