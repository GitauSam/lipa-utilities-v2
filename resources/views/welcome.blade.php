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
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        
    </head>
    <body class="antialiased">
        
        <!-- Hero Section -->
        <section id="hero" class="hero">
            @if (Route::has('login'))
                <div class="nav-content">
                    <div class="nav-content-logo">
                        <a href="{{ url('/') }}">Lipia Utilities</a>
                    </div>
                    <div class="nav-content-links">
                        @auth
                            <a href="{{ url('/dashboard') }}">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}">Login</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ml-4">Register</a>
                            @endif
                        @endauth
                    </div>
                </div>
            @endif
            <div class="hero-content">
                <h1>Lipa Utilities</h1>
                <h2>with ease.</h2>
                <p>
                    Easily pay for your household and other utilities 
                    <br /> through a myriad of payment methods
                    <br /> offered by Lipa Utilities.
                </p>
            </div>
        </section>
        <!-- End Hero Section -->

        <!-- Services Section -->
        <section id="services" class="services">
            <h1>Services</h1>
            <div class="services-container">
                <div class="feature-card">
                    <h4>Internet</h4>
                    <img src="{{ asset('images/internet-utility.png') }}" alt="">
                    <p>
                        Easily pay for your <br /> 
                        needs to any service <br />
                        provider that we have <br />
                        partnered with. <br />
                        Our platform gives <br />
                        you the chance to <br />
                        clear your bills and <br />
                        keep track <br />
                        of your payments.
                    </p>
                </div>
                <div class="feature-card">
                    <h4>Cable Television</h4>
                    <img src="{{ asset('images/television-utility.png') }}" alt="">
                    <p>
                        We have partnered <br /> 
                        with several cable <br />
                        providers to ensure <br />
                        that we have make it <br />
                        simple for you to <br />
                        pay for your service <br />
                        plans and enjoy <br />
                        high quality <br />
                        entertainment.
                    </p>
                </div>
                <div class="feature-card">
                    <h4>Garbage Collection</h4>
                    <img src="{{ asset('images/garbage-utility.png') }}" alt="">
                    <p>
                        We play our part <br />
                        in conserving the <br />
                        environment by <br />
                        partnering with a <br />
                        number of garbage <br />
                        collectors. By that <br />
                        we have made it <br />
                        easy for you to <br />
                        pay for this service. <br>
                    </p>
                </div>
                <div class="feature-card">
                    <h4>Water</h4>
                    <img src="{{ asset('images/water-utility.png') }}" alt="">
                    <p>
                        Water is life! <br />
                        Thus we endeavour <br />
                        to make it easy for <br />
                        you to access this <br />
                        utility by paying <br />
                        your bills to water <br />
                        simply.
                    </p>
                </div>
                <div class="feature-card">
                    <h4>Electricity</h4>
                    <img src="{{ asset('images/electric-utility.png') }}" alt="">
                    <p>
                        No more dark nights. <br />
                        Easily pay for your <br />
                        postpaid bills and <br />
                        buy tokens to ensure <br />
                        your environment is always <br />
                        illuminated.
                    </p>
                </div>
            </div>
        </section>
        <!-- End Services Section -->

        <!-- Discover Section -->
        <section id="discover" class="discover">
            <h1>Discover</h1>

            <div class="w3-content w3-section">
                <div class="mySlides w3-animate-fading">
                    <img src="{{ asset('images/digital-payment-one.jpg') }}">
                    <div class="discover-text-centered dtc-l">
                        Ease of digital payments.
                    </div>
                </div>
                <div class="mySlides w3-animate-fading">
                    <img src="{{ asset('images/services-ledger.jpg') }}">
                    <div class="discover-text-centered dtc-md">
                        Track how much you spend <br />
                        on your utilities.
                    </div>
                </div>
                <div class="mySlides w3-animate-fading">
                    <img src="{{ asset('images/generic-mobile-payment.jpg') }}">
                    <div class="discover-text-centered dtc-sm">
                        All payments transacted securely <br />
                        through our platform. 
                    </div>
                </div>
            </div>
        </section>
        <!-- End Discover Section -->
        
        <!-- About Section -->
        <section id="about" class="about">
            <h1>About</h1>
            <div class="about-container">
                <div class="about-feature-card">
                    <i class="fas fa-money-bill-wave fa-4x"></i>
                    <p>
                        Pay for your every day utilities through an array of payment
                        technologies that are powered by the Lipa Utilities platform.
                        Just select a utility from the several utilities that are listed
                        then select a method of payment for the amount you wish to pay.
                    </p>
                </div>
                <div class="about-feature-card">
                    <i class="far fa-list-alt fa-4x"></i>
                    <p>
                        Keep track of your utility payments and be able to review how
                        much you spend on each utility. Lipa Utilities keeps the history of successful 
                        utility payments enabling you to budget your future expenses efficiently.
                    </p>
                </div>
                <div class="about-feature-card">
                    <i class="fas fa-mobile fa-4x"></i>
                    <p>
                        Pay your bills through your mobile phone and other devices
                        through M-Pesa and Airtel Money.
                    </p>
                </div>
                <div class="about-feature-card">
                    <i class="far fa-credit-card fa-4x"></i>
                    <p>
                        Alternatively pay the bills through the bank.
                    </p>
                </div>
                <div class="about-feature-card">
                    <i class="fas fa-power-off fa-3x"></i>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                        Amet eum rem perferendis reiciendis, 
                        eos sapiente aliquid beatae cumque itaque mollitia ullam 
                        porro laudantium nobis, tempore dolore ipsa cum! 
                        Illo, eveniet.
                    </p>
                </div>
                <div class="about-feature-card">
                    <i class="fas fa-upload fa-3x"></i>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                        Amet eum rem perferendis reiciendis, 
                        eos sapiente aliquid beatae cumque itaque mollitia ullam 
                        porro laudantium nobis, tempore dolore ipsa cum! 
                        Illo, eveniet.
                    </p>
                </div>
            </div>
        </section>
        <!-- About Section End -->

        <!-- Footer Section -->
        <footer class="footer bg-dark py-16">
            <div class="container mx-auto flex flex-row justify-between px-36">
                <div>
                    <h1 class="text-white">Lipia Utilities</h1>
                    <p class="text-white">Copyright &copy; 2021</p>
                </div>
                <div class="social py-12">
                    <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-twitter fa-2x"></i></a>
                </div>
            </div>
        </footer>
        <!-- Footer Section End -->

        <!-- Scripts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
        <script language="JavaScript" text="text/javascript" src="{{ asset('js/custom.js') }}"></script>
    </body>
</html>
