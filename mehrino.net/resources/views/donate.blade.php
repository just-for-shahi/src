@extends('partials.front')
@section('page.title', 'همراهی نقدی')
@section('wrapper')
    <main class="main">
        <section class="promo-primary">
            <picture>
                <source srcset="img/cause_details.jpg" media="(min-width: 992px)"/><img class="img--bg" src="img/cause_details.jpg" alt="img"/>
            </picture>
            <div class="promo-primary__description"> <span>Charity</span></div>
            <div class="container">
                <div class="row">
                    <div class="col-auto">
                        <div class="align-container">
                            <div class="align-container__item"><span class="promo-primary__pre-title">Helpo</span>
                                <h1 class="promo-primary__title"><span>Healthy</span> <span>Food</span></h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section donation">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="donation-item">
                            <div class="donation-item__body">
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="donation-item__title">Healthy Food</h5>
                                    </div>
                                </div>
                                <form class="form donation-form" action="javascript:void(0);">
                                    <div class="row align-items-baseline margin-bottom">
                                        <div class="col-lg-5 col-xl-6">
                                            <label class="form__label"><span class="form__icon">$</span>
                                                <input class="form__field form__input-number" type="number"/>
                                            </label>
                                        </div>
                                        <div class="col-lg-7 col-xl-6 text-lg-right">
                                            <label class="form__radio-label"><span class="form__label-text">$100.00</span>
                                                <input class="form__input-radio" type="radio" name="value-select" value="100" checked="checked"/><span class="form__radio-mask form__radio-mask"></span>
                                            </label>
                                            <label class="form__radio-label"><span class="form__label-text">$200.00</span>
                                                <input class="form__input-radio" type="radio" name="value-select" value="200"/><span class="form__radio-mask form__radio-mask"></span>
                                            </label>
                                            <label class="form__radio-label"><span class="form__label-text">$500.00</span>
                                                <input class="form__input-radio" type="radio" name="value-select" value="500"/><span class="form__radio-mask form__radio-mask"></span>
                                            </label>
                                            <label class="form__radio-label"><span class="form__label-text">$1000.00</span>
                                                <input class="form__input-radio" type="radio" name="value-select" value="1000"/><span class="form__radio-mask form__radio-mask"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row margin-bottom">
                                        <div class="col-12">
                                            <h6 class="form__title">Payment Method</h6>
                                        </div>
                                        <div class="col-12">
                                            <label class="form__radio-label"><img class="form__label-img" src="img/paypal.png" alt="paypal"/>
                                                <input class="form__input-radio" type="radio" name="method-select" value="paypal" checked="checked"/><span class="form__radio-mask form__radio-mask"></span>
                                            </label>
                                            <label class="form__radio-label"><img class="form__label-img" src="img/klarna.png" alt="klarna"/>
                                                <input class="form__input-radio" type="radio" name="method-select" value="klarna"/><span class="form__radio-mask form__radio-mask"></span>
                                            </label>
                                            <label class="form__radio-label"><img class="form__label-img" src="img/visa.png" alt="visa"/>
                                                <input class="form__input-radio" type="radio" name="method-select" value="visa"/><span class="form__radio-mask form__radio-mask"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <h6 class="form__title">Personal Info</h6>
                                        </div>
                                        <div class="col-lg-4 margin-30">
                                            <input class="form__field" type="text" name="first-name" placeholder="First Name"/>
                                        </div>
                                        <div class="col-lg-4 margin-30">
                                            <input class="form__field" type="text" name="last-name" placeholder="Last Name"/>
                                        </div>
                                        <div class="col-lg-4 margin-30">
                                            <input class="form__field" type="email" name="email" placeholder="Email"/>
                                        </div>
                                        <div class="col-lg-4">
                                            <button class="form__submit" type="submit">+ Donate</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section causes causes--style-2"><img class="causes__bg" src="img/causes_img-2.png" alt="img"/>
            <div class="container">
                <div class="row align-items-end margin-bottom">
                    <div class="col-md-6 col-xl-5">
                        <div class="heading heading--primary no-margin-bottom"><span class="heading__pre-title">What we Do</span>
                            <h2 class="heading__title no-margin-bottom"><span>Helpo</span> <span>Causes</span></h2>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-6 offset-xl-1 d-flex justify-content-md-end">
                        <!-- slider nav start-->
                        <div class="slider__nav causes-slider__nav">
                            <div class="slider__arrows">
                                <div class="slider__prev"><i class="fa fa-chevron-left" aria-hidden="true"></i>
                                </div>
                                <div class="slider__next"><i class="fa fa-chevron-right" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                        <!-- slider nav end-->
                    </div>
                </div>
            </div>
            <div class="causes-holder offset-margin">
                <div class="causes-holder__wrapper">
                    <div class="causes-slider offset-margin">
                        <div class="causes-slider__item">
                            <div class="causes-item causes-item--primary">
                                <div class="causes-item__body">
                                    <div class="causes-item__top">
                                        <h6 class="causes-item__title"> <a href="cause-details.html">Water Delivery in Africa</a></h6>
                                        <p>Sharksucker sea toad candiru rocket danio tilefish stingray deepwater stingray Sacramento splittail</p>
                                    </div>
                                    <div class="causes-item__img">
                                        <div class="causes-item__badge" style="background-color: #49C2DF">Water Delivery</div><img class="img--bg" src="img/causes_1.jpg" alt="img"/>
                                    </div>
                                    <div class="causes-item__lower">
                                        <div class="progress-bar">
                                            <div class="progress-bar__inner" style="width: 78%;">
                                                <div class="progress-bar__value">78%</div>
                                            </div>
                                        </div>
                                        <div class="causes-item__details-holder">
                                            <div class="causes-item__details-item"><span>Goal: </span><span>25 000$</span></div>
                                            <div class="causes-item__details-item text-right"><span>Pledged: </span><span>20 350$</span></div>
                                        </div>
                                    </div>
                                </div><a class="button causes-item__button button--primary" href="#">+ Donate</a>
                            </div>
                        </div>
                        <div class="causes-slider__item">
                            <div class="causes-item causes-item--primary">
                                <div class="causes-item__body">
                                    <div class="causes-item__top">
                                        <h6 class="causes-item__title"> <a href="cause-details.html">Health in other Countries</a></h6>
                                        <p>Sharksucker sea toad candiru rocket danio tilefish stingray deepwater stingray Sacramento splittail</p>
                                    </div>
                                    <div class="causes-item__img">
                                        <div class="causes-item__badge" style="background-color: #F36F8F">Medicine</div><img class="img--bg" src="img/causes_2.jpg" alt="img"/>
                                    </div>
                                    <div class="causes-item__lower">
                                        <div class="progress-bar">
                                            <div class="progress-bar__inner" style="width: 23%;">
                                                <div class="progress-bar__value">23%</div>
                                            </div>
                                        </div>
                                        <div class="causes-item__details-holder">
                                            <div class="causes-item__details-item"><span>Goal: </span><span>14 000$</span></div>
                                            <div class="causes-item__details-item text-right"><span>Pledged: </span><span>6 098$</span></div>
                                        </div>
                                    </div>
                                </div><a class="button causes-item__button button--primary" href="#">+ Donate</a>
                            </div>
                        </div>
                        <div class="causes-slider__item">
                            <div class="causes-item causes-item--primary">
                                <div class="causes-item__body">
                                    <div class="causes-item__top">
                                        <h6 class="causes-item__title"> <a href="cause-details.html">We Build and Create</a></h6>
                                        <p>Sharksucker sea toad candiru rocket danio tilefish stingray deepwater stingray Sacramento splittail</p>
                                    </div>
                                    <div class="causes-item__img">
                                        <div class="causes-item__badge" style="background-color: #2EC774">Education</div><img class="img--bg" src="img/causes_3.jpg" alt="img"/>
                                    </div>
                                    <div class="causes-item__lower">
                                        <div class="progress-bar">
                                            <div class="progress-bar__inner" style="width: 51%;">
                                                <div class="progress-bar__value">51%</div>
                                            </div>
                                        </div>
                                        <div class="causes-item__details-holder">
                                            <div class="causes-item__details-item"><span>Goal: </span><span>150 000$</span></div>
                                            <div class="causes-item__details-item text-right"><span>Pledged: </span><span>76 500$</span></div>
                                        </div>
                                    </div>
                                </div><a class="button causes-item__button button--primary" href="#">+ Donate</a>
                            </div>
                        </div>
                        <div class="causes-slider__item">
                            <div class="causes-item causes-item--primary">
                                <div class="causes-item__body">
                                    <div class="causes-item__top">
                                        <h6 class="causes-item__title"> <a href="cause-details.html">Healthy Food</a></h6>
                                        <p>Sharksucker sea toad candiru rocket danio tilefish stingray deepwater stingray Sacramento splittail</p>
                                    </div>
                                    <div class="causes-item__img">
                                        <div class="causes-item__badge" style="background-color: #F8AC3A">Food</div><img class="img--bg" src="img/causes_4.jpg" alt="img"/>
                                    </div>
                                    <div class="causes-item__lower">
                                        <div class="progress-bar">
                                            <div class="progress-bar__inner" style="width: 50%;">
                                                <div class="progress-bar__value">50%</div>
                                            </div>
                                        </div>
                                        <div class="causes-item__details-holder">
                                            <div class="causes-item__details-item"><span>Goal: </span><span>50 000$</span></div>
                                            <div class="causes-item__details-item text-right"><span>Pledged: </span><span>25 000$</span></div>
                                        </div>
                                    </div>
                                </div><a class="button causes-item__button button--primary" href="#">+ Donate</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
