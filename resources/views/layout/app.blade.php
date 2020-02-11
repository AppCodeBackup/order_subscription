<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('shopify-app.app_name') }}</title>
        <link href="{!! asset('public/css/style.css') !!}" media="all" rel="stylesheet" type="text/css" />
        <link href="{!! asset('public/css/style1.css') !!}" media="all" rel="stylesheet" type="text/css" />
        <link href="{!! asset('public/css/bevy.min.css') !!}" media="all" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
            .bcr-product-selector .pagination .nav-link, .bcr-product-selector .pagination .nav-stub{
                padding:0px !important;
            }
        </style>
        @yield('styles')
    </head>
    <body>
        <div id="root">
            <div class="bv-app">
                <div class="bv-sidebar bv-sidebar--collapsable">
                    <div class="bv-sidebar__view">
                        <div class="bv-sidebar__content">
                            <nav class="bv-nav bv-sidebar__nav">
                                <ul class="bv-nav__items">
                                    <li class="bv-nav__item bv-sidebar__nav-item">
                                        <a class="bv-nav__link" href="{{url('/homeadmin')}}?shop={{$shop}}">
                                            <span class="bv-icon bv-nav__icon-before">
                                                <svg class="bv-icon__icon" viewBox="0 0 24 24">
                                                    <title class="bv-icon__title">Dashboard</title>
                                                    <path class="bv-icon__path" fill="currentColor" d="M11.6271008,7.10812094 C11.8434341,6.89628521 12.1881008,6.89628521 12.4053508,7.10812094 L18.8101008,13.366063 L18.8101008,20.1124297 C18.8101008,20.8783685 18.1950174,21.5 17.4351008,21.5 L14.2854341,21.5 L14.2854341,15.7110567 C14.2854341,14.3863896 13.1561008,13.328136 11.8159341,13.4631929 C10.7040174,13.5760486 9.80843409,14.7120061 9.80843409,15.8396383 L9.80843409,21.5 L6.59735075,21.5 C5.83743409,21.5 5.22235075,20.8783685 5.22235075,20.1124297 L5.22235075,13.366063 L11.6271008,7.10812094 Z M12.0004288,4.71261972 L2.55201,13.9571292 C2.18881235,14.3124885 1.60933225,14.3030093 1.25770498,13.9359568 C0.906077699,13.5689042 0.91545734,12.9832737 1.27865499,12.6279143 L11.3637802,2.76043944 C11.7187038,2.41317553 12.282257,2.41318845 12.637165,2.76046862 L22.7213748,12.6279435 C23.0845565,12.9833195 23.0939099,13.5689505 22.7422661,13.9359869 C22.3906224,14.3030233 21.8111419,14.312476 21.4479602,13.9571 L12.0004288,4.71261972 Z"></path>
                                                </svg>
                                            </span>
                                            <span class="bv-nav__details"><span class="bv-nav__label">Dashboard</span></span>
                                        </a>
                                    </li>
                                    <li class="bv-nav__item bv-sidebar__nav-item-parent--is-active bv-sidebar__nav-item bv-sidebar__nav-item-parent--is-expanded">
                                        <span class="bv-nav__link">
                                            <span class="bv-icon bv-nav__icon-before">
                                                <svg class="bv-icon__icon" viewBox="0 0 24 24">
                                                    <title class="bv-icon__title">Subscriptions</title>
                                                    <path class="bv-icon__path" fill="currentColor" d="M16.0950844,3.51549627 C18.6829717,5.23656691 20.280088,8.05958851 20.4518716,11.1243383 L21.3426898,10.2145088 C21.7443433,9.80428334 22.4025013,9.79733447 22.8127267,10.198988 C23.2229522,10.6006416 23.2299011,11.2587996 22.8282475,11.669025 L20.1285518,14.4263361 C19.7268502,14.8366107 19.0685956,14.8435049 18.6583891,14.4417338 L15.901078,11.7411236 C15.4909205,11.3394005 15.4840831,10.6812414 15.8858061,10.271084 C16.2875291,9.86092653 16.9456883,9.85408909 17.3558457,10.2558121 L18.3769032,11.2558727 C18.2460881,8.83673197 16.9880789,6.60623807 14.9436605,5.24660059 C11.3957549,2.88643356 6.60663577,3.84995758 4.24629451,7.39853074 C1.8863374,10.9465264 2.84990583,15.7369768 6.39803905,18.0956836 C9.80716378,20.36389 14.3974241,19.5717546 16.8452704,16.3001294 C17.1892124,15.8404399 17.8406844,15.746608 18.3003739,16.09055 C18.7600634,16.434492 18.8538953,17.085964 18.5099533,17.5456535 C15.4012558,21.7005275 9.57475102,22.7064436 5.24671647,19.8268553 C0.742444358,16.8325323 -0.480747333,10.7512451 2.51520122,6.24709022 C5.51144728,1.74248805 11.591165,0.519361839 16.0950844,3.51549627 Z M11.0110583,11.4464525 L14.5357868,14.4899481 C14.9538031,14.8508925 15.0000691,15.4823648 14.6391247,15.9003811 C14.2781804,16.3183974 13.646708,16.3646634 13.2286917,16.0037191 L9.01294175,12.3635475 L9.00000212,6.07725214 C8.9988653,5.52496856 9.44565804,5.07633269 9.99794162,5.07519587 C10.5502252,5.07405906 10.9988611,5.52085179 10.9999979,6.07313537 L11.0110583,11.4464525 Z"></path>
                                                </svg>
                                            </span>
                                            <span class="bv-nav__details"><span class="bv-nav__label">Subscriptions</span></span>
                                            <span class="bv-icon bv-nav__icon-after">
                                                <svg class="bv-icon__icon" viewBox="0 0 24 24">
                                                    <title class="bv-icon__title">Subscriptions</title>
                                                    <path class="bv-icon__path" fill="currentColor" d="M3.75261265,6.34153452 C3.38894463,5.92588561 2.75718344,5.88374677 2.34153452,6.24741478 C1.92588561,6.6110828 1.88374677,7.24284399 2.24741478,7.65849291 L11.2524148,18.2364929 C11.6508167,18.6918404 12.3591606,18.6918563 12.757583,18.2365268 L21.763583,7.6585268 C22.1272697,7.24289426 22.0851593,6.61113117 21.6695268,6.24744443 C21.2538943,5.8837577 20.6221312,5.9258681 20.2584444,6.34150064 L12.0050479,16.0594019 L3.75261265,6.34153452 Z"></path>
                                                </svg>
                                            </span>
                                        </span>
                                        <nav class="bv-nav bv-sidebar__subnav">
                                            <ul class="bv-nav__items">
                                                <li class="bv-nav__item bv-nav__item--is-active bv-sidebar__nav-item bv-sidebar__nav-item-child {{ (isset($page) && $page == 'subscription') ? 'bv-sidebar__nav-item--is-active bv-sidebar__nav-item-child--is-active' : '' }} ">
                                                      <a class="bv-nav__link" href="{{url('/SubscriptionGroups')}}?shop={{$shop}}">
                                                      <span class="bv-nav__details"><span class="bv-nav__label">My Subscriptions</span></span>
                                                      </a>
                                                </li>
                                                <li class="bv-nav__item bv-sidebar__nav-item bv-sidebar__nav-item-child {{ (isset($page) && $page == 'subscriptioncustomers') ? 'bv-sidebar__nav-item--is-active bv-sidebar__nav-item-child--is-active' : '' }}">
                                                    <a class="bv-nav__link" href="{{url('/SubScriptionCustomers')}}?shop={{$shop}}">
                                                      <span class="bv-nav__details"><span class="bv-nav__label">Customers</span>
                                                      </span>
                                                    </a>
                                                </li>
                                                <li  style="display:none;" class="bv-nav__item bv-sidebar__nav-item bv-sidebar__nav-item-child {{ (isset($page) && $page == 'discount') ? 'bv-sidebar__nav-item--is-active bv-sidebar__nav-item-child--is-active' : '' }}">
                                                    <a class="bv-nav__link"  href="{{url('/DiscountCodes')}}?shop={{$shop}}">
                                                      <span class="bv-nav__details">
                                                        <span class="bv-nav__label">Discount Codes </span>
                                                      </span>
                                                    </a>
                                                </li>
                                                <li  style="display:none;" class="bv-nav__item bv-sidebar__nav-item bv-sidebar__nav-item-child"><a class="bv-nav__link" href="/s/scarflings-test/recurring_settings/manage_buy_button_list"><span class="bv-nav__details"><span class="bv-nav__label">Create Buy Button</span></span></a></li>
                                                <li  style="display:none;" class="bv-nav__item bv-sidebar__nav-item bv-sidebar__nav-item-child"><a class="bv-nav__link" href="/s/scarflings-test/recurring_settings"><span class="bv-nav__details"><span class="bv-nav__label">Cart Mode</span></span></a></li>
                                            </ul>
                                        </nav>
                                    </li>
                                    <li style="display:none;"  class="bv-nav__item bv-sidebar__nav-item">
                                        <span class="bv-nav__link">
                                            <span class="bv-icon bv-nav__icon-before">
                                                <svg class="bv-icon__icon" viewBox="0 0 24 24">
                                                    <title class="bv-icon__title">Settings</title>
                                                    <path class="bv-icon__path" fill="currentColor" d="M14.1388621,1 C14.4462769,1 14.755345,1.23943657 14.8267463,1.52504179 L15.3441183,3.59452965 L15.578838,3.6918332 L17.4080866,2.59428404 C17.6643974,2.4404976 18.0458772,2.489528 18.2657707,2.7094215 L21.2905785,5.73422931 C21.5079536,5.95160441 21.5571862,6.33946301 21.405716,6.59191336 L20.3081668,8.42116196 L20.4054704,8.65588172 L22.4749582,9.17325368 C22.7649308,9.24574682 23,9.55016152 23,9.86113789 L23,14.1388621 C23,14.4462769 22.7605634,14.755345 22.4749582,14.8267463 L20.4054704,15.3441183 L20.3081668,15.578838 L21.405716,17.4080866 C21.5595024,17.6643974 21.510472,18.0458772 21.2905785,18.2657707 L18.2657707,21.2905785 C18.0483956,21.5079536 17.660537,21.5571862 17.4080866,21.405716 L15.578838,20.3081668 L15.3441183,20.4054704 L14.8267463,22.4749582 C14.7542532,22.7649308 14.4498385,23 14.1388621,23 L9.86113789,23 C9.55372307,23 9.24465498,22.7605634 9.17325368,22.4749582 L8.65588172,20.4054704 L8.42116196,20.3081668 L6.59191336,21.405716 C6.33560264,21.5595024 5.95412281,21.510472 5.73422931,21.2905785 L2.7094215,18.2657707 C2.4920464,18.0483956 2.44281382,17.660537 2.59428404,17.4080866 L3.6918332,15.578838 L3.59452965,15.3441183 L1.52504179,14.8267463 C1.23506922,14.7542532 1,14.4498385 1,14.1388621 L1,9.86113789 C1,9.55372307 1.23943657,9.24465498 1.52504179,9.17325368 L3.59452965,8.65588172 L3.6918332,8.42116196 L2.59428404,6.59191336 C2.4404976,6.33560264 2.489528,5.95412281 2.7094215,5.73422931 L5.73422931,2.7094215 C5.95160441,2.4920464 6.33946301,2.44281382 6.59191336,2.59428404 L8.42116196,3.6918332 L8.65588172,3.59452965 L9.17325368,1.52504179 C9.24574682,1.23506922 9.55016152,1 9.86113789,1 L14.1388621,1 Z M5.11362604,13.5554898 C5.29293982,14.3527579 5.60716247,15.0989757 6.03105867,15.768908 L4.87000662,17.7039947 L6.2960053,19.1299934 L8.23109204,17.9689413 C8.90102432,18.3928375 9.64724214,18.7070602 10.4445102,18.886374 L10.9916667,21.075 L13.0083333,21.075 L13.5554898,18.886374 C14.3527579,18.7070602 15.0989757,18.3928375 15.768908,17.9689413 L17.7039947,19.1299934 L19.1299934,17.7039947 L17.9689413,15.768908 C18.3928375,15.0989757 18.7070602,14.3527579 18.886374,13.5554898 L21.075,13.0083333 L21.075,10.9916667 L18.886374,10.4445102 C18.7070602,9.64724214 18.3928375,8.90102432 17.9689413,8.23109204 L19.1299934,6.2960053 L17.7039947,4.87000662 L15.768908,6.03105867 C15.0989757,5.60716247 14.3527579,5.29293982 13.5554898,5.11362604 L13.0083333,2.925 L10.9916667,2.925 L10.4445102,5.11362604 C9.64724214,5.29293982 8.90102432,5.60716247 8.23109204,6.03105867 L6.2960053,4.87000662 L4.87000662,6.2960053 L6.03105867,8.23109204 C5.60716247,8.90102432 5.29293982,9.64724214 5.11362604,10.4445102 L2.925,10.9916667 L2.925,13.0083333 L5.11362604,13.5554898 Z M12,16.4 C9.5699471,16.4 7.6,14.4300529 7.6,12 C7.6,9.5699471 9.5699471,7.6 12,7.6 C14.4300529,7.6 16.4,9.5699471 16.4,12 C16.4,14.4300529 14.4300529,16.4 12,16.4 Z M12,14.475 C13.3669048,14.475 14.475,13.3669048 14.475,12 C14.475,10.6330952 13.3669048,9.525 12,9.525 C10.6330952,9.525 9.525,10.6330952 9.525,12 C9.525,13.3669048 10.6330952,14.475 12,14.475 Z"></path>
                                                </svg>
                                            </span>
                                            <span class="bv-nav__details"><span class="bv-nav__label">Settings</span></span>
                                            <span class="bv-icon bv-nav__icon-after">
                                                <svg class="bv-icon__icon" viewBox="0 0 24 24">
                                                    <title class="bv-icon__title">Settings</title>
                                                    <path class="bv-icon__path" fill="currentColor" d="M3.75261265,6.34153452 C3.38894463,5.92588561 2.75718344,5.88374677 2.34153452,6.24741478 C1.92588561,6.6110828 1.88374677,7.24284399 2.24741478,7.65849291 L11.2524148,18.2364929 C11.6508167,18.6918404 12.3591606,18.6918563 12.757583,18.2365268 L21.763583,7.6585268 C22.1272697,7.24289426 22.0851593,6.61113117 21.6695268,6.24744443 C21.2538943,5.8837577 20.6221312,5.9258681 20.2584444,6.34150064 L12.0050479,16.0594019 L3.75261265,6.34153452 Z"></path>
                                                </svg>
                                            </span>
                                        </span>
                                        <nav class="bv-nav bv-sidebar__subnav">
                                            <ul class="bv-nav__items">
                                                <li class="bv-nav__item bv-sidebar__nav-item bv-sidebar__nav-item-child"><a class="bv-nav__link" href="/s/scarflings-test/general_settings"><span class="bv-nav__details"><span class="bv-nav__label">General</span></span></a></li>
                                                <li class="bv-nav__item bv-sidebar__nav-item bv-sidebar__nav-item-child"><a class="bv-nav__link" href="/s/scarflings-test/payment_settings"><span class="bv-nav__details"><span class="bv-nav__label">Payment Gateway</span></span></a></li>
                                                <li class="bv-nav__item bv-sidebar__nav-item bv-sidebar__nav-item-child"><a class="bv-nav__link" href="/s/scarflings-test/tax_settings"><span class="bv-nav__details"><span class="bv-nav__label">Taxes</span></span></a></li>
                                                <li class="bv-nav__item bv-sidebar__nav-item bv-sidebar__nav-item-child"><a class="bv-nav__link" href="/s/scarflings-test/display_settings"><span class="bv-nav__details"><span class="bv-nav__label">Display Settings</span></span></a></li>
                                                <li class="bv-nav__item bv-sidebar__nav-item bv-sidebar__nav-item-child"><a class="bv-nav__link" href="/s/scarflings-test/language_settings"><span class="bv-nav__details"><span class="bv-nav__label">Language Settings</span></span></a></li>
                                                <li class="bv-nav__item bv-sidebar__nav-item bv-sidebar__nav-item-child"><a class="bv-nav__link" href="/s/scarflings-test/cancellations"><span class="bv-nav__details"><span class="bv-nav__label">Cancellation Flow</span></span></a></li>
                                                <li class="bv-nav__item bv-sidebar__nav-item bv-sidebar__nav-item-child"><a class="bv-nav__link" href="/s/scarflings-test/email_settings"><span class="bv-nav__details"><span class="bv-nav__label">Email Notifications</span></span></a></li>
                                                <li class="bv-nav__item bv-sidebar__nav-item bv-sidebar__nav-item-child"><a class="bv-nav__link" href="/s/scarflings-test/manage_subscription"><span class="bv-nav__details"><span class="bv-nav__label">Manage Subscriptions Page</span></span></a></li>
                                                <li class="bv-nav__item bv-sidebar__nav-item bv-sidebar__nav-item-child"><a class="bv-nav__link" href="/api/admin/view/billing?shop=scarflings-test.myshopify.com"><span class="bv-nav__details"><span class="bv-nav__label">Account &amp; Billing</span></span></a></li>
                                            </ul>
                                        </nav>
                                    </li>
                                    <li  style="display:none;"  class="bv-nav__item bv-sidebar__nav-item">
                                        <span class="bv-nav__link">
                                            <span class="bv-icon bv-nav__icon-before">
                                                <svg class="bv-icon__icon" viewBox="0 0 24 24">
                                                    <title class="bv-icon__title">Reports</title>
                                                    <path class="bv-icon__path" fill="currentColor" d="M1.91666667,22 C1.41040565,22 1,21.5912165 1,21.0869565 C1,20.5826965 1.41040565,20.173913 1.91666667,20.173913 L22.0833333,20.173913 C22.5895944,20.173913 23,20.5826965 23,21.0869565 C23,21.5912165 22.5895944,22 22.0833333,22 L1.91666667,22 Z M13.7596152,10.9082014 L9.53552586,5.86017087 L5.2155372,12.0864869 C4.89650946,12.5462954 4.26365877,12.661443 3.80202563,12.3436762 C3.34039249,12.0259094 3.22478797,11.3955601 3.54381571,10.9357516 L8.62403141,3.61373513 C9.00611948,3.06303899 9.81009798,3.02693745 10.2403848,3.54115502 L14.4686833,8.59421571 L18.7872169,2.43279815 C19.1084345,1.9745047 19.7418274,1.86235352 20.2019394,2.18230147 C20.6620515,2.50224943 20.7746477,3.13313873 20.4534302,3.59143218 L15.3732145,10.8395707 C14.9896509,11.3868155 14.1886189,11.4208856 13.7596152,10.9082014 Z M5.90374116,15.748983 L5.90374116,17.6686813 C5.90374116,18.5066398 5.22096017,19.1867221 4.37967645,19.1867221 C3.53839273,19.1867221 2.85561174,18.5066398 2.85561174,17.6686813 L2.85561174,15.748983 C2.85561174,14.9110245 3.53839273,14.2309422 4.37967645,14.2309422 C5.22096017,14.2309422 5.90374116,14.9110245 5.90374116,15.748983 Z M10.9839569,11.2828059 L10.9839569,17.6685801 C10.9839569,18.5065386 10.3011759,19.1866209 9.45989215,19.1866209 C8.61860843,19.1866209 7.93582744,18.5065386 7.93582744,17.6685801 L7.93582744,11.2828059 C7.93582744,10.4438354 8.61860843,9.76476518 9.45989215,9.76476518 C10.3011759,9.76476518 10.9839569,10.4438354 10.9839569,11.2828059 Z M16.0641726,14.2605946 L16.0641726,17.6679729 C16.0641726,18.5069434 15.3813916,19.1860136 14.5401078,19.1860136 C13.6988241,19.1860136 13.0160431,18.5069434 13.0160431,17.6679729 L13.0160431,14.2605946 C13.0160431,13.4216241 13.6988241,12.7425539 14.5401078,12.7425539 C15.3813916,12.7425539 16.0641726,13.4216241 16.0641726,14.2605946 Z M21.1443883,9.04926198 L21.1443883,17.6685801 C21.1443883,18.5065386 20.4616073,19.1866209 19.6203235,19.1866209 C18.7790398,19.1866209 18.0962588,18.5065386 18.0962588,17.6685801 L18.0962588,9.04926198 C18.0962588,8.21130349 18.7790398,7.53122124 19.6203235,7.53122124 C20.4616073,7.53122124 21.1443883,8.21130349 21.1443883,9.04926198 Z"></path>
                                                </svg>
                                            </span>
                                            <span class="bv-nav__details"><span class="bv-nav__label">Reports</span></span>
                                            <span class="bv-icon bv-nav__icon-after">
                                                <svg class="bv-icon__icon" viewBox="0 0 24 24">
                                                    <title class="bv-icon__title">Reports</title>
                                                    <path class="bv-icon__path" fill="currentColor" d="M3.75261265,6.34153452 C3.38894463,5.92588561 2.75718344,5.88374677 2.34153452,6.24741478 C1.92588561,6.6110828 1.88374677,7.24284399 2.24741478,7.65849291 L11.2524148,18.2364929 C11.6508167,18.6918404 12.3591606,18.6918563 12.757583,18.2365268 L21.763583,7.6585268 C22.1272697,7.24289426 22.0851593,6.61113117 21.6695268,6.24744443 C21.2538943,5.8837577 20.6221312,5.9258681 20.2584444,6.34150064 L12.0050479,16.0594019 L3.75261265,6.34153452 Z"></path>
                                                </svg>
                                            </span>
                                        </span>
                                        <nav class="bv-nav bv-sidebar__subnav">
                                            <ul class="bv-nav__items">
                                                <li class="bv-nav__item bv-sidebar__nav-item bv-sidebar__nav-item-child"><a class="bv-nav__link" href="/s/scarflings-test/analytics"><span class="bv-nav__details"><span class="bv-nav__label">Reporting &amp; Analytics</span></span></a></li>
                                                <li class="bv-nav__item bv-sidebar__nav-item bv-sidebar__nav-item-child"><a class="bv-nav__link" href="/s/scarflings-test/customers/failed_transactions"><span class="bv-nav__details"><span class="bv-nav__label">Failed Transactions Log</span></span></a></li>
                                                <li class="bv-nav__item bv-sidebar__nav-item bv-sidebar__nav-item-child"><a class="bv-nav__link" href="/s/scarflings-test/customers/insufficient_products"><span class="bv-nav__details"><span class="bv-nav__label">Insufficient Products</span></span></a></li>
                                            </ul>
                                        </nav>
                                    </li>
                                    <li  style="display:none;"  class="bv-nav__item bv-sidebar__nav-item">
                                        <span class="bv-nav__link">
                                            <span class="bv-icon bv-nav__icon-before">
                                                <svg class="bv-icon__icon" viewBox="0 0 24 24">
                                                    <title class="bv-icon__title">Tools</title>
                                                    <path class="bv-icon__path" fill="currentColor" d="M3.64151411,5.59715885 L7.47842131,1.63737249 C7.72185877,1.2522239 8.13182443,1 8.59562207,1 L16.2649536,1 C17.0106085,1 17.6159373,1.6524687 17.6159373,2.45775966 L17.6159373,18.1151782 C17.6159373,18.9213843 17.0106085,19.573853 16.2649536,19.573853 L4.35190082,19.573853 C3.60532873,19.573853 3,18.9213843 3,18.1151782 L3,6.83835947 C3,6.31414413 3.25651046,5.85430006 3.64151411,5.59715885 Z M15.7816078,2.83020673 L9.0707134,2.83020673 L9.02302083,5.13169169 C9.00376038,6.2746558 8.05999786,7.20989144 6.91996209,7.20989144 L4.83432948,7.20989144 L4.83432948,17.7436463 L15.7816078,17.7436463 L15.7816078,2.83020673 Z M7.2151057,9.94275612 C6.70856961,9.94275612 6.29794097,9.53305039 6.29794097,9.02765276 C6.29794097,8.52225513 6.70856961,8.11254939 7.2151057,8.11254939 L13.4013819,8.11254939 C13.907918,8.11254939 14.3185466,8.52225513 14.3185466,9.02765276 C14.3185466,9.53305039 13.907918,9.94275612 13.4013819,9.94275612 L7.2151057,9.94275612 Z M7.2151057,15.8811364 C6.70856961,15.8811364 6.29794097,15.4714307 6.29794097,14.966033 C6.29794097,14.4606354 6.70856961,14.0509297 7.2151057,14.0509297 L13.4013819,14.0509297 C13.907918,14.0509297 14.3185466,14.4606354 14.3185466,14.966033 C14.3185466,15.4714307 13.907918,15.8811364 13.4013819,15.8811364 L7.2151057,15.8811364 Z M7.2151057,12.9320328 C6.70856961,12.9320328 6.29794097,12.522327 6.29794097,12.0169294 C6.29794097,11.5115318 6.70856961,11.101826 7.2151057,11.101826 L11.8073495,11.101826 C12.3138856,11.101826 12.7245143,11.5115318 12.7245143,12.0169294 C12.7245143,12.522327 12.3138856,12.9320328 11.8073495,12.9320328 L7.2151057,12.9320328 Z M6.07314389,21.1697933 L19.1656705,21.1697933 L19.1656705,3.37011772 C19.1656705,2.86472008 19.5762992,2.45501435 20.0828353,2.45501435 C20.5893714,2.45501435 21,2.86472008 21,3.37011772 L21,22.0848966 C21,22.5902943 20.5893714,23 20.0828353,23 L6.07314389,23 C5.56660779,23 5.15597915,22.5902943 5.15597915,22.0848966 C5.15597915,21.579499 5.56660779,21.1697933 6.07314389,21.1697933 Z"></path>
                                                </svg>
                                            </span>
                                            <span class="bv-nav__details"><span class="bv-nav__label">Tools</span></span>
                                            <span class="bv-icon bv-nav__icon-after">
                                                <svg class="bv-icon__icon" viewBox="0 0 24 24">
                                                    <title class="bv-icon__title">Tools</title>
                                                    <path class="bv-icon__path" fill="currentColor" d="M3.75261265,6.34153452 C3.38894463,5.92588561 2.75718344,5.88374677 2.34153452,6.24741478 C1.92588561,6.6110828 1.88374677,7.24284399 2.24741478,7.65849291 L11.2524148,18.2364929 C11.6508167,18.6918404 12.3591606,18.6918563 12.757583,18.2365268 L21.763583,7.6585268 C22.1272697,7.24289426 22.0851593,6.61113117 21.6695268,6.24744443 C21.2538943,5.8837577 20.6221312,5.9258681 20.2584444,6.34150064 L12.0050479,16.0594019 L3.75261265,6.34153452 Z"></path>
                                                </svg>
                                            </span>
                                        </span>
                                        <nav class="bv-nav bv-sidebar__subnav">
                                            <ul class="bv-nav__items">
                                                <li class="bv-nav__item bv-sidebar__nav-item bv-sidebar__nav-item-child"><a class="bv-nav__link" href="/s/scarflings-test/reports"><span class="bv-nav__details"><span class="bv-nav__label">Export Data</span></span></a></li>
                                                <li class="bv-nav__item bv-sidebar__nav-item bv-sidebar__nav-item-child"><a class="bv-nav__link" href="/s/scarflings-test/price_settings"><span class="bv-nav__details"><span class="bv-nav__label">Manage Pricing</span></span></a></li>
                                                <li class="bv-nav__item bv-sidebar__nav-item bv-sidebar__nav-item-child"><a class="bv-nav__link" href="/s/scarflings-test/customers/deleted_products"><span class="bv-nav__details"><span class="bv-nav__label">Manage Deleted Products</span></span></a></li>
                                                <li class="bv-nav__item bv-sidebar__nav-item bv-sidebar__nav-item-child"><a class="bv-nav__link" href="/s/scarflings-test/inventory_forcastings"><span class="bv-nav__details"><span class="bv-nav__label">Inventory Forecasting</span></span></a></li>
                                            </ul>
                                        </nav>
                                    </li>
                                    <li style="display:none;"  class="bv-nav__item bv-sidebar__nav-item">
                                        <span class="bv-nav__link">
                                            <span class="bv-icon bv-nav__icon-before">
                                                <svg class="bv-icon__icon" viewBox="0 0 24 24">
                                                    <title class="bv-icon__title">Integrations</title>
                                                    <path class="bv-icon__path" fill="currentColor" d="M10.7139555,12.0237069 L9.59388861,13.1437737 C9.12439343,13.6132689 8.36230345,13.6116364 7.89079252,13.1401255 L2.35437642,7.60370936 C1.88231054,7.13164349 1.88243796,6.37021635 2.35138461,5.90126971 L5.90126971,2.35138461 C6.37021635,1.88243796 7.13164349,1.88231054 7.60370936,2.35437642 L13.1401255,7.89079252 C13.6116364,8.36230345 13.6132689,9.12439343 13.1437737,9.59388861 L12.0035749,10.7340874 L13.2790381,12.0095506 L14.4192369,10.8693518 C14.8888439,10.3997448 15.6515894,10.4022564 16.122333,10.873 L21.6449638,16.3956309 C22.1159264,16.8665935 22.1193137,17.6293382 21.6492685,18.0993834 L18.0993834,21.6492685 C17.6293382,22.1193137 16.8665935,22.1159264 16.3956309,21.6449638 L10.873,16.122333 C10.4022564,15.6515894 10.3997448,14.8888439 10.8693518,14.4192369 L11.9894187,13.29917 L10.7139555,12.0237069 Z M12.6397757,15.2745735 L17.2440468,19.8788446 L19.8788446,17.2440468 L15.2745735,12.6397757 L14.5919184,13.3224308 L15.9600053,14.6905177 C16.3177651,15.0482776 16.3183491,15.6266738 15.9621187,15.9829042 C15.6058883,16.3391347 15.0281457,16.3378971 14.6703858,15.9801372 L13.3022989,14.6120503 L12.6397757,15.2745735 Z M11.3733498,8.738552 L6.75660632,4.12180853 L4.12180853,6.75660632 L8.738552,11.3733498 L9.4010752,10.7108266 L8.04493553,9.35468691 C7.68717565,8.99692704 7.68528162,8.418528 8.04151203,8.06229758 C8.39774244,7.70606717 8.97679512,7.70730758 9.33455499,8.06506745 L10.6906947,9.42120712 L11.3733498,8.738552 Z"></path>
                                                </svg>
                                            </span>
                                            <span class="bv-nav__details"><span class="bv-nav__label">Integrations</span></span>
                                            <span class="bv-icon bv-nav__icon-after">
                                                <svg class="bv-icon__icon" viewBox="0 0 24 24">
                                                    <title class="bv-icon__title">Integrations</title>
                                                    <path class="bv-icon__path" fill="currentColor" d="M3.75261265,6.34153452 C3.38894463,5.92588561 2.75718344,5.88374677 2.34153452,6.24741478 C1.92588561,6.6110828 1.88374677,7.24284399 2.24741478,7.65849291 L11.2524148,18.2364929 C11.6508167,18.6918404 12.3591606,18.6918563 12.757583,18.2365268 L21.763583,7.6585268 C22.1272697,7.24289426 22.0851593,6.61113117 21.6695268,6.24744443 C21.2538943,5.8837577 20.6221312,5.9258681 20.2584444,6.34150064 L12.0050479,16.0594019 L3.75261265,6.34153452 Z"></path>
                                                </svg>
                                            </span>
                                        </span>
                                        <nav class="bv-nav bv-sidebar__subnav">
                                            <ul class="bv-nav__items">
                                                <li class="bv-nav__item bv-sidebar__nav-item bv-sidebar__nav-item-child"><a class="bv-nav__link" href="/api/admin/view/api_keys?shop=scarflings-test.myshopify.com"><span class="bv-nav__details"><span class="bv-nav__label">API Keys</span></span></a></li>
                                                <li class="bv-nav__item bv-sidebar__nav-item bv-sidebar__nav-item-child"><a class="bv-nav__link" href="/api/admin/view/webhooks?shop=scarflings-test.myshopify.com"><span class="bv-nav__details"><span class="bv-nav__label">Webhooks</span></span></a></li>
                                                <li class="bv-nav__item bv-sidebar__nav-item bv-sidebar__nav-item-child"><a class="bv-nav__link" href="/s/scarflings-test/integrations_settings"><span class="bv-nav__details"><span class="bv-nav__label">View All Integrations</span></span></a></li>
                                            </ul>
                                        </nav>
                                    </li>
                                    <li style="display:none;"  class="bv-nav__item bv-sidebar__nav-item">
                                        <span class="bv-nav__link">
                                            <span class="bv-icon bv-nav__icon-before">
                                                <svg class="bv-icon__icon" viewBox="0 0 24 24">
                                                    <title class="bv-icon__title">Help</title>
                                                    <path class="bv-icon__path" fill="currentColor" d="M4.9677727,6.38198626 C2.34407577,9.65784611 2.34407577,14.3421539 4.9677727,17.6180137 L7.8280828,14.7577036 C6.7239724,13.0911853 6.7239724,10.9088147 7.8280828,9.24229636 L4.9677727,6.38198626 L4.9677727,6.38198626 Z M6.38198626,4.9677727 L9.24229636,7.8280828 C10.9088147,6.7239724 13.0911853,6.7239724 14.7577036,7.8280828 L17.6180137,4.9677727 C14.3421539,2.34407577 9.65784611,2.34407577 6.38198626,4.9677727 L6.38198626,4.9677727 Z M17.6180137,19.0322273 L14.7577036,16.1719172 C13.0911853,17.2760276 10.9088147,17.2760276 9.24229636,16.1719172 L6.38198626,19.0322273 C9.65784611,21.6559242 14.3421539,21.6559242 17.6180137,19.0322273 L17.6180137,19.0322273 Z M19.0322273,17.6180137 C21.6559242,14.3421539 21.6559242,9.65784611 19.0322273,6.38198626 L16.1719172,9.24229636 C17.2760276,10.9088147 17.2760276,13.0911853 16.1719172,14.7577036 L19.0322273,17.6180137 L19.0322273,17.6180137 Z M4.22182541,19.7781746 C-0.0739418023,15.4824074 -0.0739418023,8.51759262 4.22182541,4.22182541 C8.51759262,-0.0739418023 15.4824074,-0.0739418023 19.7781746,4.22182541 C24.0739418,8.51759262 24.0739418,15.4824074 19.7781746,19.7781746 C15.4824074,24.0739418 8.51759262,24.0739418 4.22182541,19.7781746 Z M9.87867966,14.1213203 C11.0502525,15.2928932 12.9497475,15.2928932 14.1213203,14.1213203 C15.2928932,12.9497475 15.2928932,11.0502525 14.1213203,9.87867966 C12.9497475,8.70710678 11.0502525,8.70710678 9.87867966,9.87867966 C8.70710678,11.0502525 8.70710678,12.9497475 9.87867966,14.1213203 Z"></path>
                                                </svg>
                                            </span>
                                            <span class="bv-nav__details"><span class="bv-nav__label">Help</span></span>
                                            <span class="bv-icon bv-nav__icon-after">
                                                <svg class="bv-icon__icon" viewBox="0 0 24 24">
                                                    <title class="bv-icon__title">Help</title>
                                                    <path class="bv-icon__path" fill="currentColor" d="M3.75261265,6.34153452 C3.38894463,5.92588561 2.75718344,5.88374677 2.34153452,6.24741478 C1.92588561,6.6110828 1.88374677,7.24284399 2.24741478,7.65849291 L11.2524148,18.2364929 C11.6508167,18.6918404 12.3591606,18.6918563 12.757583,18.2365268 L21.763583,7.6585268 C22.1272697,7.24289426 22.0851593,6.61113117 21.6695268,6.24744443 C21.2538943,5.8837577 20.6221312,5.9258681 20.2584444,6.34150064 L12.0050479,16.0594019 L3.75261265,6.34153452 Z"></path>
                                                </svg>
                                            </span>
                                        </span>
                                        <nav class="bv-nav bv-sidebar__subnav">
                                            <ul class="bv-nav__items">
                                                <li class="bv-nav__item bv-sidebar__nav-item bv-sidebar__nav-item-child"><a class="bv-nav__link" href="https://boldapps.zendesk.com/hc/en-us" target="_blank"><span class="bv-nav__details"><span class="bv-nav__label">Support &amp; FAQ</span></span></a></li>
                                                <li class="bv-nav__item bv-sidebar__nav-item bv-sidebar__nav-item-child"><a class="bv-nav__link" href="/s/scarflings-test/terms_and_conditions"><span class="bv-nav__details"><span class="bv-nav__label">Terms &amp; Conditions</span></span></a></li>
                                                <li class="bv-nav__item bv-sidebar__nav-item bv-sidebar__nav-item-child"><a class="bv-nav__link" href="/s/scarflings-test/installation"><span class="bv-nav__details"><span class="bv-nav__label">Install to Theme</span></span></a></li>
                                            </ul>
                                        </nav>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <div class="bv-sidebar__edge">
                            <button class="bv-sidebar__toggle-button">
                                <span class="bv-icon">
                                    <svg class="bv-icon__icon" viewBox="0 0 24 24">
                                        <path class="bv-icon__path" fill="currentColor" d="M17.2364792,3.75261265 C17.6521281,3.38894463 17.6942669,2.75718344 17.3305989,2.34153452 C16.9669309,1.92588561 16.3351697,1.88374677 15.9195208,2.24741478 L5.34152081,11.2524148 C4.88617335,11.6508167 4.8861574,12.3591606 5.34148692,12.757583 L15.9194869,21.763583 C16.3351195,22.1272697 16.9668826,22.0851593 17.3305693,21.6695268 C17.694256,21.2538943 17.6521456,20.6221312 17.2365131,20.2584444 L7.5186118,12.0050479 L17.2364792,3.75261265 Z"></path>
                                    </svg>
                                </span>
                            </button>
                        </div>
                        <button class="bv-iconbutton bv-sidebar__hamburger-toggle">
                            <span class="bv-icon bv-iconbutton__icon">
                                <svg class="bv-icon__icon" viewBox="0 0 24 24">
                                    <path class="bv-icon__path" fill="currentColor" d="M2,7 C1.448,7 1,6.552 1,6 C1,5.448 1.448,5 2,5 L22,5 C22.552,5 23,5.448 23,6 C23,6.552 22.552,7 22,7 L2,7 Z M2,13 C1.448,13 1,12.552 1,12 C1,11.448 1.448,11 2,11 L22,11 C22.552,11 23,11.448 23,12 C23,12.552 22.552,13 22,13 L2,13 Z M2,19 C1.448,19 1,18.552 1,18 C1,17.448 1.448,17 2,17 L22,17 C22.552,17 23,17.448 23,18 C23,18.552 22.552,19 22,19 L2,19 Z"></path>
                                </svg>
                            </span>
                        </button>
                    </div>
                </div>
                <main class="bv-page">
                    @yield('content')
                </main>
            </div>
        </div>
        <div id="dialog-root"></div>
        <div id="popover-root"></div>
        <div id="portal-root"></div>
        @if(config('shopify-app.appbridge_enabled'))
        <script src="https://unpkg.com/@shopify/app-bridge"></script>
        <script>
              var shop='{{$shop}}';
              var AppBridge = window['app-bridge'];
              window.AppURL = '{{$appUrl}}';
              var AppURL = '{{$appUrl}}';
              var createApp = AppBridge.default;
              var app = createApp({
                  apiKey: '{{ config('shopify-app.api_key') }}',
                  shopOrigin: '{{ ShopifyApp::shop()->shopify_domain }}',
                  forceRedirect: true,
              });
              var actions = window['app-bridge'].actions;
              var Button = actions.Button;
              var Modal = actions.Modal;
              var TitleBar = actions.TitleBar;
              var Redirect = actions.Redirect;
              var Loading = actions.Redirect;


        </script>
        @include('shopify-app::partials.flash_messages')
          <script src="{!! asset('public/js/jquery-3.4.1.min.js') !!}" ></script>
          <script src="{!! asset('public/js/pagination.js') !!}" ></script>
          <script src="{!! asset('public/js/custom.js') !!}" ></script>
        @endif
        @yield('scripts')
    </body>
</html>
