<header class="header d-flex align-items-center" data-page="{{ $page ?? 'home' }}">
    <div class="container position-relative d-flex justify-content-between align-items-center">
        <a class="brand d-flex align-items-center" href="{{ route('home') }}">
            <img src="{{ asset('storage/' . (setting('brand_logo') ?? 'img/brand.jpg')) }}" width="50" height="55" alt="Brand Logo" />
        </a>


        <div class="header_offcanvas offcanvas offcanvas-end" id="menuOffcanvas">
            <div class="header_offcanvas-header d-flex justify-content-between align-content-center">
                <a class="brand d-flex align-items-center" href="{{ route('home') }}">
                    <span class="brand_logo theme-element">
                        <img src="{{ asset('storage/' . (setting('brand_logo') ?? 'img/brand.jpg')) }}" width="50" height="55" alt="Brand Logo" />
                    </span>
                    <span class="brand_name">{{ setting('name', 'Luxury') }}</span>
                </a>
                <button class="close" type="button" data-bs-dismiss="offcanvas">
                    <i class="icon-close--entypo"></i>
                </button>
            </div>

            <nav class="header_nav">
                <ul class="header_nav-list">
                    <li class="header_nav-list_item">
                        <a class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}" data-page="home">{{__('Home')}}</a>
                    </li>
                    <li class="header_nav-list_item">
                        <a class="nav-item {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}" data-page="about">{{ __('About') }}</a>
                    </li>
                    <li class="header_nav-list_item">
                        <a
                            class="nav-item {{ request()->routeIs('properties.*') ? 'active' : '' }}"
                            href="{{ route('properties.index') }}"
                            data-page="properties">
                            {{__('Properties')}}
                        </a>
                    </li>
                    <!-- <li class="header_nav-list_item dropdown">
                        <a
                            class="nav-link dropdown-toggle d-inline-flex align-items-center"
                            href="#"
                            data-bs-toggle="collapse"
                            data-bs-target="#pagesMenu"
                            aria-expanded="false"
                            aria-controls="pagesMenu">
                            Pages
                            <i class="icon-chevron_down--entypo icon"></i>
                        </a>
                        <div class="dropdown-menu collapse" id="pagesMenu">
                            <ul class="dropdown-list">
                                <li class="list-item">
                                    <a class="dropdown-item nav-item" data-page="gallery" href="{{ route('gallery') }}">Gallery</a>
                                </li>
                                <li class="list-item">
                                    <a class="dropdown-item nav-item" data-page="faq01" href="{{ route('faq') }}">FAQ</a>
                                </li>
                                <li class="list-item">
                                    <a class="dropdown-item nav-item" data-page="privacy" href="{{ route('privacy_policy') }}">Privacy Policy</a>
                                </li>
                                <li class="list-item">
                                    <a class="dropdown-item nav-item" data-page="refund" href="{{ route('refund_policy') }}">Refund Policy</a>
                                </li>
                                <li class="list-item">
                                    <a class="dropdown-item nav-item" data-page="term" href="{{ route('term') }}">Terms and Condition</a>
                                </li>
                                <!-- <li class="list-item">
                                    <a class="dropdown-item nav-item" data-page="faq02" href="{{ route('faq2') }}">FAQ V2</a>
                                </li>
                                <li class="list-item">
                                    <a class="dropdown-item nav-item" data-page="error01" href="{{ route('error') }}">Error Page V1</a>
                                </li>
                                <li class="list-item">
                                    <a class="dropdown-item nav-item" data-page="error02" href="{{ route('404') }}">Error Page V2</a>
                                </li> 
                            </ul>
                        </div>
                    </li> -->
                    <li class="header_nav-list_item">
                        <a class="nav-item" href="{{ route('gallery') }}">{{ __('Gallery')}}</a>
                    </li>
                    <li class="header_nav-list_item">
                        <a class="nav-item {{ request()->routeIs('contacts') ? 'active' : '' }}" href="{{ route('contacts.index') }}">{{ __('Contacts')}}</a>
                    </li>
                    <li class="header_nav-list_item dropdown">
                        <a
                            class="nav-link nav-link--contacts dropdown-toggle d-inline-flex align-items-center {{ request()->routeIs('contacts.*') ? 'active' : '' }}"
                            href="#"
                            data-bs-toggle="collapse"
                            data-bs-target="#contactsMenu"
                            aria-expanded="false"
                            aria-controls="contactsMenu">
                            {{__('Language')}}
                            <i class="icon-chevron_down--entypo icon"></i>
                        </a>
                        <div class="dropdown-menu collapse" id="contactsMenu">
                            <ul class="dropdown-list">
                                <li class="list-item">
                                    <a class="dropdown-item nav-item" href="{{ url('/lang/en') }}">English</a>
                                </li>
                                <li class="list-item">
                                    <a class="dropdown-item nav-item" href="{{ url('/lang/ar') }}">العربية</a>
                                </li>

                            </ul>
                        </div>
                    </li>
                </ul>
            </nav>

            <ul class="socials d-flex align-items-center">
                <li class="list-item">
                    <a class="link" href="{{ config('social.facebook', '#') }}">
                        <i class="icon-facebook"></i>
                    </a>
                </li>
                <li class="list-item">
                    <a class="link" href="{{ config('social.instagram', '#') }}">
                        <i class="icon-instagram"></i>
                    </a>
                </li>
                <li class="list-item">
                    <a class="link" href="{{ config('social.twitter', '#') }}">
                        <i class="icon-twitter"></i>
                    </a>
                </li>
                <li class="list-item">
                    <a class="link" href="{{ config('social.whatsapp', '#') }}">
                        <i class="icon-whatsapp"></i>
                    </a>
                </li>
            </ul>
        </div>

        <button class="header_trigger d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#menuOffcanvas">
            <i class="icon-stream"></i>
        </button>
    </div>
</header>