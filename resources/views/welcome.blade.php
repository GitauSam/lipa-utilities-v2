<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1"> 

        <title>Lipa Utilities</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="preconnect" href="https://fonts.gstatic.com" />
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet"/>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" rel="stylesheet" />

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/styles-beta.css') }}">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js" defer></script>
        
    </head>
    <body class="antialiased">
        <!-- banner section -->
        <section x-data="{ open: false }" id="banner" class="banner">
            <div class="navbar">
                <nav class="nav container">
                    <div class="logo">
                        @auth
                            @if(auth()->user()->hasRole(config('services.general.user_role'))) 
                                <a href="{{ url('/utility') }}">lipa utilities</a>
                            @else
                                <a href="{{ url('/admin/utility') }}">lipa utilities</a>
                            @endif
                        @else
                            <a href="{{ url('/') }}">lipa utilities</a>
                        @endauth
                    </div>
                    <ul>
                        <li><a href="#services">Services</a></li>
                        <li><a href="#about">About</a></li>
                        <li><a href="#start-now">Discover</a></li>
                    </ul>
                    @auth
                        <x-settings-link />
                    @else
                        <div class="signin signin-lg pill">
                            <a href="{{ url('/register') }}">Sign Up</a>
                            <i class="fas fa-chevron-right"></i>
                        </div>
                    @endauth
                </nav>
                <button @click="open = ! open" 
                    class="hamburger items-center w-12
                            inline-flex justify-center
                            rounded-md text-white 
                            hover:text-gray-500 hover:bg-gray-200 
                            focus:outline-none focus:bg-gray-100 focus:text-gray-500 
                            transition duration-150 ease-in-out"
                >
                    <svg class="h-8 w-12" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div x-show="open" class="welcome-sub-nav">
                <ul>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#start-now">Discover</a></li>
                    @auth
                        <li><a href="{{ route('profile.show') }}">Profile</a></li>
                    @else
                        <li><a href="{{ route('login') }}">Sign In</a></li>
                        <li><a href="{{ route('register') }}">Sign Up</a></li>
                    @endauth

                </ul>
            </div>
            <div class="container">
                <div class="banner-left">
                    <h1>Utility <br />
                        management <br />
                        and payment <br />
                        via the internet
                    </h1>
                    <h3>
                        Scores of users use<br /> 
                        lipa utilities features <br />
                        to manage and pay for their<br /> 
                        utilities online
                    </h3>
                    @auth
                    @else
                        <div class="signin pill">
                            <a href="{{ url('/login') }}">Sign In</a>
                            <i class="fas fa-chevron-right"></i>
                        </div>
                    @endauth
                </div>
                <div class="banner-right">
                </div>
            </div>
            <img src="{{ asset('images/banner2.svg') }}" alt="banner">
            <div class="banner-gradient-diagonal">
            </div>
        </section>
        <!-- end banner section -->
        <!-- services section start -->
        <section id="services" class="services container">
            <h3>Everything in one platform</h3>
            <h2>A myriad of utility services <br />
                with several fully intergrated  <br />
                payment options
            </h2>
            <div class="service-cards">
                <x-service-card>
                    <x-slot name="img">
                        {{ asset('images/bolt.png') }}
                    </x-slot>
                    <x-slot name="name">
                        <div class="service-card-label">
                            Electricity
                        </div>
                    </x-slot>
                    <x-slot name="description">
                            No more dark <br />
                            nights. Easily <br />
                            pay for your postpaid <br />
                            bills and buy tokens <br />
                            to ensure your <br />
                            environment is <br />
                            always illuminated.
                    </x-slot>
                </x-service-card>
                <x-service-card>
                    <x-slot name="img">
                        {{ asset('images/garbage.png') }}
                    </x-slot>
                    <x-slot name="name">
                        <div class="service-card-label">
                            Garbage
                        </div>
                    </x-slot>
                    <x-slot name="description">
                        We play our<br /> 
                        part in conserving <br />
                        the environment by<br />
                        partnering with <br />
                        reliable garbage <br />
                        collectors who will<br />
                        leave your <br />
                        neighbourhood clean<br />
                        if not sparkling.

                    </x-slot>
                </x-service-card>
                <x-service-card>
                    <x-slot name="img">
                        {{ asset('images/internet.png') }}
                    </x-slot>
                    <x-slot name="name">
                        <div class="service-card-label">
                            Internet
                        </div>
                    </x-slot>
                    <x-slot name="description">
                        Easily pay for your <br />
                        needs to any service <br />
                        provider that we <br />
                        have partnered with.<br />
                        Our platform gives <br />
                        you the chance <br />
                        to clear the bills <br />
                        and keep track of your <br />
                        payments.
                    </x-slot>
                </x-service-card>
                <x-service-card>
                    <x-slot name="img">
                        {{ asset('images/television.png') }}
                    </x-slot>
                    <x-slot name="name">
                        <div class="service-card-label">
                            Cable
                        </div>
                    </x-slot>
                    <x-slot name="description">
                        We have <br />
                        partnered with <br />
                        several cable <br />
                        providers to <br />
                        ensure that it is <br />
                        easier for you to pay <br />
                        for your <br />
                        service plan <br />
                        and enjoy <br />
                        qualityentertainment.
                    </x-slot>
                </x-service-card>
                <x-service-card>
                    <x-slot name="img">
                        {{ asset('images/water-utility.png') }}
                    </x-slot>
                    <x-slot name="name">
                        <div class="service-card-label">
                            Water
                        </div>
                    </x-slot>
                    <x-slot name="description">
                        Water is life <br />
                        We make a <br />
                        point to simplify <br />
                        your access to <br />
                        this vital resource <br />
                        by helping you <br />
                        pay your water <br />
                    </x-slot>
                </x-service-card>
            </div>
        </section>
        <!-- services section end -->
        <!-- payment options section -->
        <section id="payment-options" class="payment-options">
            <div class="container payment-options-cards">
                <div class="card payment-option-card">
                    <img src="{{ asset('images/mpesa-logo.svg') }}" alt="mpesa logo" />
                </div>
                <div class="card payment-option-card">
                    <img src="{{ asset('images/airtel-logo.svg') }}" alt="airtel logo" />
                </div>
                <div class="card payment-option-card">
                    <img src="{{ asset('images/credit-card.svg') }}" alt="credit card" />
                </div>
            </div>
            <div class="payment-options-diagonal">
            </div>
        </section>
        <!-- payment options section end-->
        <!-- about section start -->
        <section id="about" class="about container">
            <div class="about-card">
                <img src="{{ asset('images/bank-notes.png') }}" />
                <p>
                    Pay for your every day utilities through an array of payment technologies that are powered by the Lipa Utilities platform. <br />
                    Just select a utility from the several utilities that are listed then select a method of payment for the amount you wish to pay. 
                </p>
            </div>
            <div class="about-card transition ease-in-out duration-150">
                <img src="{{ asset('images/cashbook.png') }}" />
                <p>
                    Keep track of your utility payments and be able to <br />
                    review how much you spend on each utility. <br />
                </p>
            </div>
            <div class="about-card">
                <img src="{{ asset('images/laptop-and-phone.png') }}" />
                <p>
                    Pay your bills through your mobile phone and <br />
                    other devices through M-Pesa and Airtel Money. <br />
                </p>
            </div>
        </section>
        <!-- about section end -->
        <!-- start now section start -->
        <section id="start-now" class="start-now">
            <div class="container">
                <div class="call-to-action">
                    <h3>Ready to get started?</h3>
                    <p>
                        Create an account with us 
                        and easily pay for your 
                        household
                        utilities and also track your 
                        expenditure.
                    </p>
                    @auth
                    @else
                        <div class="pill">
                            <a href="{{ url('/register') }}">Start Now</a>
                            <i class="fas fa-chevron-right"></i>
                        </div>
                    @endauth
                </div>
                <div class="benefits">
                    <div class="benefit">
                        <img src="{{ asset('images/coins.png') }}" alt="ease of payments" />
                        <h4>Easily pay for your needs</h4>
                        <p>
                            Allow technology to
                            take care of you and be
                            more at peace
                        </p>
                    </div>
                    <div class="benefit">
                        <img src="{{ asset('images/price-tag.png') }}" alt="ease of tracking payments" />
                        <h4>Always know how much you've paid</h4>
                        <p>
                            Be upto date with the finances you
                            dedicate to your household 
                            utilities
                        </p>
                    </div>
                </div>
            </div>
            <div class="start-now-diagonal">
            </div>
        </section>
        <!-- start now section end -->
        <!-- footer section start -->
        <section class="footer">
            <div class="container">
                <div>
                    <h1>lipa utilities</h1>
                    <p>Copyright &copy; 2021</p>
                </div>
                <div class="social">
                    <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-twitter fa-2x"></i></a>
                </div>
            </div>
        </section>
        <!-- footer section end -->
    </body>
</html>
