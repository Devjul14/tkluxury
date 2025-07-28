@extends('layouts.app')

@section('title', 'About Us')

@php
$page = 'about';
@endphp

@section('content')
<header class="page">
    <div class="container">
        <!-- <ul class="breadcrumbs d-flex flex-wrap align-content-center">
            <li class="list-item">
                <a class="link" href="index.html">Home</a>
            </li>

            <li class="list-item">
                <a class="link" href="#">About Hosteller</a>
            </li>
        </ul> -->
        <h1 class="page_title">About</h1>
        <p class="page_header-text" data-aos="fade-up" data-aos-delay="50">
            Discover our story and what makes us the perfect choice for your stay
        </p>
    </div>
</header>

<main>
    <!-- benefits section start -->
    <section class="about_benefits section">
        <div class="container">
            <div class="about_benefits-header d-md-flex align-items-center justify-content-between">
                <h2 class="text-center" data-aos="fade-up">Our Story</h2>
            </div>
            <div class="text-center mb-4">
                <p class="about_main-content_text" data-aos="fade-up" data-aos-delay="50">
                    Founded in 2010, Hosteller has been providing exceptional accommodation experiences for travelers from around the world.
                    What started as a small hostel has grown into a beloved destination for backpackers, students, and budget-conscious travelers.
                </p>
                <p class="about_main-content_text" data-aos="fade-up" data-aos-delay="100">
                    Our mission is to create a welcoming, safe, and comfortable environment where travelers can connect, share stories,
                    and create lasting memories. We believe that great accommodation should be accessible to everyone, regardless of budget.
                </p>
            </div>
            <ul class="about_benefits-list d-md-flex">
                <li class="about_benefits-list_item col-12 col-md-4 mb-3 mb-md-0">
                    <span class="countNum number h1 d-flex align-items-center" data-suffix="+" data-value="500">0</span>
                    <p class="number-label">Happy Guests</p>
                </li>
                <li class="about_benefits-list_item col-12 col-md-4 mb-3 mb-md-0">
                    <span class="countNum number h1 d-flex align-items-center" data-suffix="+" data-value="50">0</span>
                    <p class="number-label">Rooms</p>
                </li>
                <li class="about_benefits-list_item col-12 col-md-4">
                    <span class="countNum number h1 d-flex align-items-center" data-suffix="%" data-value="10">0</span>
                    <p class="number-label">Years Experience</p>
                </li>
            </ul>
            <div class="about_benefits-video" data-aos="fade-in">
                <picture>
                    <source data-srcset="img/hero.webp" srcset="img/hero.webp" />
                    <img class="lazy" data-src="img/hero.webp" src="img/hero.webp" alt="media" />
                </picture>
                <a class="video-play d-inline-flex align-items-center justify-content-center" href="#">
                    <i class="icon-play icon"></i>
                </a>
            </div>
        </div>
    </section>
    <!-- benefits section end -->

    <!-- stages section start -->
    <section class="about_benefits section">
        <div class="container d-xl-flex align-items-center">
            <div class="about_stages-main col-xl-6">
                <h2 class="about_benefits-header">Why Choose Hosteller?</h2>
                <!-- <p class="benefits_header-text" data-aos="fade-up" data-aos-delay="50">
                    We offer everything you need for a comfortable and memorable stay
                </p> -->
                <ul class="about_stages-main_list">
                    <li class="list-item d-flex align-items-sm-center" data-aos="fade-up">
                        <div class="media">
                            <span class="theme-element">
                                <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M13 21.6667C13 12.4769 20.8507 5 30.5 5C40.1493 5 48 12.4769 48 21.6666C48 24.4254 47.2758 27.1608 45.9043 29.5788L31.457 54.4629C31.2647 54.7945 30.8984 55 30.5 55C30.1016 55 29.7353 54.7945 29.543 54.4629L15.101 29.587C13.7242 27.1608 13 24.4255 13 21.6667ZM30.5 51.8059L43.9849 28.5789C45.1791 26.4742 45.8124 24.0806 45.8124 21.6667C45.8124 13.6254 38.9434 7.0834 30.5 7.0834C22.0566 7.0834 15.1876 13.6253 15.1876 21.6667C15.1876 24.0807 15.8209 26.4742 17.0204 28.5881L30.5 51.8059Z" fill="currentColor" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M22 21.1764C22 16.5815 25.8132 12.8431 30.5 12.8431C35.1868 12.8431 39 16.5816 39 21.1765C39 25.7714 35.1868 29.5098 30.5 29.5098C25.8132 29.5098 22 25.7714 22 21.1764ZM24.125 21.1765C24.125 24.623 26.9846 27.4265 30.5 27.4265C34.0154 27.4265 36.875 24.6229 36.875 21.1765C36.875 17.73 34.0154 14.9265 30.5 14.9265C26.9846 14.9265 24.125 17.73 24.125 21.1765Z" fill="currentColor" />
                                </svg>
                            </span>
                        </div>
                        <div class="main">
                            <h4 class="main_title">Prime Location</h4>
                            <p class="main_text">Located in the heart of the city, we're just minutes away from major attractions, public transportation, and local hotspots.
                            </p>
                        </div>
                    </li>
                    <li class="list-item d-flex align-items-sm-center" data-aos="fade-up" data-aos-delay="50">
                        <div class="media">
                            <span class="theme-element">
                                <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5 18.8178L6.08615 20C20.1515 8.74369 40.8485 8.74369 54.9138 20L56 18.8178C41.3088 7.06075 19.6912 7.06075 5 18.8178Z" fill="currentColor" />
                                    <path d="M11 27.8499L12.212 29C22.595 19.1685 39.4049 19.1685 49.788 29L51 27.8499C39.9476 17.3834 22.0525 17.3834 11 27.8499Z" fill="currentColor" />
                                    <path d="M18 36.5799L19.263 38C25.1969 31.3432 34.8031 31.3432 40.737 38L42 36.5799C35.3681 29.14 24.6319 29.14 18 36.5799Z" fill="currentColor" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M27.3176 43.3159C29.0767 41.5614 31.9234 41.5614 33.6824 43.3159C35.4392 45.0737 35.4392 47.9232 33.6824 49.6812C31.9253 51.4393 29.076 51.4396 27.3184 49.682C25.5608 47.9243 25.5605 45.0741 27.3176 43.3159ZM28.5906 48.4085C29.645 49.4633 31.3553 49.4639 32.4105 48.4098C33.4632 47.354 33.4632 45.646 32.4105 44.5902C31.3558 43.5366 29.6465 43.5366 28.5918 44.5902C27.5366 45.6442 27.536 47.3537 28.5906 48.4085Z" fill="currentColor" />
                                </svg>
                            </span>
                        </div>
                        <div class="main">
                            <h4 class="main_title">Free WiFi</h4>
                            <p class="main_text">Stay connected with complimentary high-speed WiFi throughout the property, perfect for work or staying in touch with loved ones.
                        </div>
                    </li>
                    <li class="list-item d-flex align-items-sm-center" data-aos="fade-up" data-aos-delay="100">
                        <div class="media">
                            <span class="theme-element">
                                <svg width="40" height="38" viewBox="0 0 40 38" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M10 20H36.6667C38.5047 20 40 18.5047 40 16.6667V3.33333C40 1.49533 38.5047 0 36.6667 0H10C8.162 0 6.66667 1.49533 6.66667 3.33333V10.226C2.75067 11.912 0 15.8067 0 20.3333C0 24.8647 2.75533 28.7627 6.678 30.446C6.67691 30.4763 6.67481 30.5063 6.67272 30.5362L6.67271 30.5362C6.66969 30.5794 6.66667 30.6226 6.66667 30.6667C6.66667 34.71 9.95667 38 14 38C16.7653 38 19.2827 36.444 20.53 34H36.6667C36.8693 34 37.0607 33.908 37.1873 33.75L39.854 30.4167C39.9667 30.2753 40.0173 30.0953 39.9947 29.916C39.972 29.7367 39.8773 29.5747 39.7333 29.4667L37.0667 27.4667C36.9513 27.38 36.8113 27.3333 36.6667 27.3333H35.3333C35.1107 27.3333 34.9027 27.4447 34.7787 27.63L33.8967 28.9533L32.4713 27.528C32.3467 27.4033 32.1773 27.3333 32 27.3333H30.6667C30.298 27.3333 30 27.6313 30 28V29.3333H28.4807L27.966 27.7893C27.8747 27.5167 27.6207 27.3333 27.3333 27.3333H24.6667C24.444 27.3333 24.236 27.4447 24.112 27.63L23.3333 28.798L22.5547 27.63C22.4307 27.4447 22.2227 27.3333 22 27.3333H20.53C19.2827 24.8893 16.766 23.3333 14 23.3333C10.512 23.3333 7.59 25.7833 6.852 29.0513C3.59467 27.4947 1.33333 24.1773 1.33333 20.3333C1.33333 16.562 3.50933 13.2973 6.66667 11.7047V16.6667C6.66667 18.5047 8.162 20 10 20ZM8 11.1493C8.674 10.9287 9.37933 10.7793 10.1087 10.712C10.422 11.8353 11.444 12.6667 12.6667 12.6667C14.1373 12.6667 15.3333 11.4707 15.3333 10C15.3333 8.52933 14.1373 7.33333 12.6667 7.33333C11.4107 7.33333 10.3613 8.20867 10.08 9.38C9.36467 9.43933 8.67 9.56933 8 9.76V3.33333C8 2.23067 8.89733 1.33333 10 1.33333H36.6667C37.7693 1.33333 38.6667 2.23067 38.6667 3.33333V16.6667C38.6667 17.7693 37.7693 18.6667 36.6667 18.6667H10C8.89733 18.6667 8 17.7693 8 16.6667V11.1493ZM12.6667 8.66667C12.1753 8.66667 11.75 8.93667 11.5187 9.33333H12.6667V10.6667H11.5187C11.75 11.0633 12.1753 11.3333 12.6667 11.3333C13.402 11.3333 14 10.7353 14 10C14 9.26467 13.402 8.66667 12.6667 8.66667ZM11 30C10.9744 30 10.9494 29.9982 10.9243 29.9963C10.9017 29.9946 10.8791 29.993 10.856 29.9927C11.0887 29.6 11.512 29.3333 12 29.3333C12.7353 29.3333 13.3333 29.9313 13.3333 30.6667C13.3333 31.402 12.7353 32 12 32C11.506 32 11.078 31.7267 10.848 31.3253C10.8709 31.3259 10.8933 31.3276 10.9158 31.3292L10.9158 31.3292L10.9159 31.3292C10.9437 31.3313 10.9716 31.3333 11 31.3333H12V30H11ZM14.6667 30.6667C14.6667 32.1373 13.4707 33.3333 12 33.3333C10.7127 33.3333 9.63533 32.4167 9.38733 31.2013C8.91867 31.132 8.45933 31.0367 8.012 30.91C8.14133 34.1053 10.7733 36.6667 14 36.6667C16.3833 36.6667 18.5413 35.2533 19.4973 33.0667C19.6033 32.8233 19.8433 32.6667 20.108 32.6667H36.3467L38.3827 30.1207L36.4447 28.6667H35.69L34.5547 30.37C34.444 30.536 34.2647 30.644 34.066 30.6633C33.8647 30.682 33.67 30.6127 33.5287 30.4713L31.724 28.6667H31.3333V30C31.3333 30.3687 31.0353 30.6667 30.6667 30.6667H28C27.7127 30.6667 27.4587 30.4833 27.3673 30.2107L26.8527 28.6667H25.0233L23.888 30.37C23.6407 30.7413 23.026 30.7413 22.7787 30.37L21.6433 28.6667H20.108C19.8433 28.6667 19.6033 28.5093 19.4973 28.2667C18.5413 26.08 16.3833 24.6667 14 24.6667C11.0713 24.6667 8.62933 26.7773 8.10733 29.5567C8.54733 29.6953 9.00467 29.792 9.46933 29.8667C9.81133 28.7887 10.81 28 12 28C13.4707 28 14.6667 29.196 14.6667 30.6667Z"
                                        fill="currentColor" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M10 20H36.6667C38.5047 20 40 18.5047 40 16.6667V3.33333C40 1.49533 38.5047 0 36.6667 0H10C8.162 0 6.66667 1.49533 6.66667 3.33333V10.226C2.75067 11.912 0 15.8067 0 20.3333C0 24.8647 2.75533 28.7627 6.678 30.446C6.67691 30.4763 6.67481 30.5063 6.67272 30.5362L6.67271 30.5362C6.66969 30.5794 6.66667 30.6226 6.66667 30.6667C6.66667 34.71 9.95667 38 14 38C16.7653 38 19.2827 36.444 20.53 34H36.6667C36.8693 34 37.0607 33.908 37.1873 33.75L39.854 30.4167C39.9667 30.2753 40.0173 30.0953 39.9947 29.916C39.972 29.7367 39.8773 29.5747 39.7333 29.4667L37.0667 27.4667C36.9513 27.38 36.8113 27.3333 36.6667 27.3333H35.3333C35.1107 27.3333 34.9027 27.4447 34.7787 27.63L33.8967 28.9533L32.4713 27.528C32.3467 27.4033 32.1773 27.3333 32 27.3333H30.6667C30.298 27.3333 30 27.6313 30 28V29.3333H28.4807L27.966 27.7893C27.8747 27.5167 27.6207 27.3333 27.3333 27.3333H24.6667C24.444 27.3333 24.236 27.4447 24.112 27.63L23.3333 28.798L22.5547 27.63C22.4307 27.4447 22.2227 27.3333 22 27.3333H20.53C19.2827 24.8893 16.766 23.3333 14 23.3333C10.512 23.3333 7.59 25.7833 6.852 29.0513C3.59467 27.4947 1.33333 24.1773 1.33333 20.3333C1.33333 16.562 3.50933 13.2973 6.66667 11.7047V16.6667C6.66667 18.5047 8.162 20 10 20ZM8 11.1493C8.674 10.9287 9.37933 10.7793 10.1087 10.712C10.422 11.8353 11.444 12.6667 12.6667 12.6667C14.1373 12.6667 15.3333 11.4707 15.3333 10C15.3333 8.52933 14.1373 7.33333 12.6667 7.33333C11.4107 7.33333 10.3613 8.20867 10.08 9.38C9.36467 9.43933 8.67 9.56933 8 9.76V3.33333C8 2.23067 8.89733 1.33333 10 1.33333H36.6667C37.7693 1.33333 38.6667 2.23067 38.6667 3.33333V16.6667C38.6667 17.7693 37.7693 18.6667 36.6667 18.6667H10C8.89733 18.6667 8 17.7693 8 16.6667V11.1493ZM12.6667 8.66667C12.1753 8.66667 11.75 8.93667 11.5187 9.33333H12.6667V10.6667H11.5187C11.75 11.0633 12.1753 11.3333 12.6667 11.3333C13.402 11.3333 14 10.7353 14 10C14 9.26467 13.402 8.66667 12.6667 8.66667ZM11 30C10.9744 30 10.9494 29.9982 10.9243 29.9963C10.9017 29.9946 10.8791 29.993 10.856 29.9927C11.0887 29.6 11.512 29.3333 12 29.3333C12.7353 29.3333 13.3333 29.9313 13.3333 30.6667C13.3333 31.402 12.7353 32 12 32C11.506 32 11.078 31.7267 10.848 31.3253C10.8709 31.3259 10.8933 31.3276 10.9158 31.3292L10.9158 31.3292L10.9159 31.3292C10.9437 31.3313 10.9716 31.3333 11 31.3333H12V30H11ZM14.6667 30.6667C14.6667 32.1373 13.4707 33.3333 12 33.3333C10.7127 33.3333 9.63533 32.4167 9.38733 31.2013C8.91867 31.132 8.45933 31.0367 8.012 30.91C8.14133 34.1053 10.7733 36.6667 14 36.6667C16.3833 36.6667 18.5413 35.2533 19.4973 33.0667C19.6033 32.8233 19.8433 32.6667 20.108 32.6667H36.3467L38.3827 30.1207L36.4447 28.6667H35.69L34.5547 30.37C34.444 30.536 34.2647 30.644 34.066 30.6633C33.8647 30.682 33.67 30.6127 33.5287 30.4713L31.724 28.6667H31.3333V30C31.3333 30.3687 31.0353 30.6667 30.6667 30.6667H28C27.7127 30.6667 27.4587 30.4833 27.3673 30.2107L26.8527 28.6667H25.0233L23.888 30.37C23.6407 30.7413 23.026 30.7413 22.7787 30.37L21.6433 28.6667H20.108C19.8433 28.6667 19.6033 28.5093 19.4973 28.2667C18.5413 26.08 16.3833 24.6667 14 24.6667C11.0713 24.6667 8.62933 26.7773 8.10733 29.5567C8.54733 29.6953 9.00467 29.792 9.46933 29.8667C9.81133 28.7887 10.81 28 12 28C13.4707 28 14.6667 29.196 14.6667 30.6667Z"
                                        fill="currentColor" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M29.7 4H35.3C35.6871 4 36 4.298 36 4.66667V15.3333C36 15.702 35.6871 16 35.3 16H29.7C29.3129 16 29 15.702 29 15.3333V4.66667C29 4.298 29.3129 4 29.7 4ZM30.4 14.6667H34.6V5.33333H30.4V14.6667Z"
                                        fill="currentColor" />
                                </svg>
                            </span>
                        </div>
                        <div class="main">
                            <h4 class="main_title">24/7 Security</h4>
                            <p class="main_text">Your safety is our priority. We have 24/7 security and secure lockers to keep your belongings safe during your stay.</p>
                        </div>
                    </li>
                </ul>

            </div>
            <div class="about_stages-main col-xl-6">
                <h2 class="about_benefits-header"> <br></h2>
                <ul class="about_stages-main_list">
                    <li class="list-item d-flex align-items-sm-center" data-aos="fade-up">
                        <div class="media">
                            <span class="theme-element">
                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M27.9997 14.7341V7.33329C27.9997 7.15648 27.9294 6.98691 27.8044 6.86189C27.6794 6.73686 27.5098 6.66663 27.333 6.66663H4.66634C4.48953 6.66663 4.31996 6.73686 4.19494 6.86189C4.06991 6.98691 3.99967 7.15648 3.99967 7.33329V14.7341C3.24737 14.8887 2.57136 15.2979 2.0856 15.8928C1.59985 16.4877 1.33405 17.2319 1.33301 18V26C1.33301 26.1768 1.40325 26.3463 1.52827 26.4714C1.65329 26.5964 1.82286 26.6666 1.99967 26.6666H4.66634C4.84315 26.6666 5.01272 26.5964 5.13775 26.4714C5.26277 26.3463 5.33301 26.1768 5.33301 26V22.6666H26.6663V26C26.6663 26.1768 26.7366 26.3463 26.8616 26.4714C26.9866 26.5964 27.1562 26.6666 27.333 26.6666H29.9997C30.1765 26.6666 30.3461 26.5964 30.4711 26.4714C30.5961 26.3463 30.6663 26.1768 30.6663 26V18C30.6654 17.2319 30.3996 16.4877 29.9138 15.8928C29.4281 15.2979 28.752 14.8886 27.9997 14.7341ZM5.33301 7.99996H26.6663V14.6666H23.9997V11.3333C23.9997 11.1565 23.9294 10.9869 23.8044 10.8619C23.6794 10.7369 23.5098 10.6666 23.333 10.6666H17.9997C17.8229 10.6666 17.6533 10.7369 17.5283 10.8619C17.4032 10.9869 17.333 11.1565 17.333 11.3333V14.6666H14.6663V11.3333C14.6663 11.1565 14.5961 10.9869 14.4711 10.8619C14.3461 10.7369 14.1765 10.6666 13.9997 10.6666H8.66634C8.48953 10.6666 8.31996 10.7369 8.19494 10.8619C8.06991 10.9869 7.99967 11.1565 7.99967 11.3333V14.6666H5.33301V7.99996ZM22.6663 14.6666H18.6663V12H22.6663V14.6666ZM13.333 14.6666H9.33301V12H13.333V14.6666ZM29.333 25.3333H27.9997V22C27.9997 21.8231 27.9294 21.6536 27.8044 21.5286C27.6794 21.4035 27.5098 21.3333 27.333 21.3333H4.66634C4.48953 21.3333 4.31996 21.4035 4.19494 21.5286C4.06991 21.6536 3.99967 21.8231 3.99967 22V25.3333H2.66634V18C2.66692 17.4697 2.87782 16.9613 3.25277 16.5864C3.62772 16.2114 4.13609 16.0005 4.66634 16H27.333C27.8633 16.0005 28.3716 16.2114 28.7466 16.5864C29.1215 16.9613 29.3324 17.4697 29.333 18V25.3333Z"
                                        fill="currentColor" />
                                </svg>
                            </span>
                        </div>
                        <div class="main">
                            <h4 class="main_title">Social Atmosphere</h4>
                            <p class="main_text">Meet fellow travelers in our common areas, join organized activities, and make new friends from around the world.
                            </p>
                        </div>
                    </li>
                    <li class="list-item d-flex align-items-sm-center" data-aos="fade-up" data-aos-delay="50">
                        <div class="media">
                            <span class="theme-element">
                                <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M39.3333 23.4906C39.702 23.4906 40 23.1947 40 22.8302V14.9057C40 14.5411 39.702 14.2453 39.3333 14.2453H29.0353C28.6387 13.3577 27.8647 12.6716 26.9153 12.4022L26.4793 12.2787C27.0153 11.5265 27.3333 10.6112 27.3333 9.62264C27.3333 7.07359 25.2393 5 22.6667 5C20.094 5 18 7.07359 18 9.62264C18 10.6997 18.3767 11.6896 19.0027 12.4768L18.2607 12.7707C17.838 12.9377 17.462 13.1841 17.1413 13.5017L15.0573 15.566H10.3333C9.04667 15.566 8 16.6028 8 17.8774C8 18.2333 8.08867 18.5668 8.234 18.8679H2C1.63133 18.8679 1.33333 19.1638 1.33333 19.5283V24.8113H0.666667C0.298 24.8113 0 25.1072 0 25.4717V28.1132C0 28.3338 0.111333 28.5398 0.296667 28.6626L2.29667 29.9834C2.406 30.0554 2.53533 30.0943 2.66667 30.0943H3.33333V39.3396C3.33333 39.7042 3.63133 40 4 40H36C36.3687 40 36.6667 39.7042 36.6667 39.3396V30.0943H37.3333C37.4647 30.0943 37.594 30.0554 37.7033 29.9834L39.7033 28.6626C39.8887 28.5398 40 28.3338 40 28.1132V25.4717C40 25.1072 39.702 24.8113 39.3333 24.8113H34.6667V23.4906H39.3333ZM22.6667 6.32075C24.5047 6.32075 26 7.80198 26 9.62264C26 10.6858 25.4813 11.6236 24.6907 12.2278C24.602 12.2952 24.5133 12.3619 24.4193 12.4193C24.382 12.4424 24.3432 12.4623 24.3043 12.4823C24.2842 12.4926 24.264 12.503 24.244 12.5138C23.4507 12.9278 22.5047 13.0124 21.6527 12.7522C21.6457 12.7499 21.6387 12.7478 21.6316 12.7458L21.6191 12.7421L21.619 12.7421L21.619 12.7421L21.619 12.7421C21.6034 12.7376 21.5878 12.7331 21.5727 12.7277C21.4387 12.6835 21.3093 12.6254 21.182 12.564C21.1087 12.5276 21.0367 12.4893 20.9667 12.4477C20.8747 12.3942 20.7847 12.3361 20.698 12.2734C19.8747 11.6705 19.3333 10.7109 19.3333 9.62264C19.3333 7.80198 20.8287 6.32075 22.6667 6.32075ZM15.3333 16.8868H10.3333C9.782 16.8868 9.33333 17.3312 9.33333 17.8774C9.33333 18.4235 9.782 18.8679 10.3333 18.8679H11.3333H16.4447L18.9333 17.0189C19.1353 16.869 19.406 16.8445 19.6313 16.9561C19.8573 17.0684 20 17.2969 20 17.5472V24.8113H28V23.4906H26.6667C26.298 23.4906 26 23.1947 26 22.8302V14.9057C26 14.5411 26.298 14.2453 26.6667 14.2453H27.472C27.2267 13.9752 26.908 13.7738 26.5487 13.6721L25.4187 13.3525C25.4127 13.3567 25.4063 13.3602 25.4 13.3637L25.4 13.3637C25.3937 13.3671 25.3873 13.3706 25.3813 13.3749C24.6153 13.9204 23.6793 14.2453 22.6667 14.2453C21.9713 14.2453 21.314 14.0894 20.7207 13.818C20.7119 13.8141 20.7033 13.8099 20.6949 13.8057L20.678 13.7975C20.4787 13.7038 20.2847 13.5994 20.102 13.4799C20.0992 13.4781 20.0962 13.4766 20.0934 13.4752C20.0901 13.4737 20.0868 13.4721 20.084 13.47L18.756 13.9963C18.5027 14.0974 18.2767 14.2446 18.0853 14.4348L15.8047 16.6933C15.68 16.8175 15.5107 16.8868 15.3333 16.8868ZM18.6667 18.8679V24.8113H12V20.1887H16.6667C16.8113 20.1887 16.9513 20.1425 17.0667 20.0566L18.6667 18.8679ZM10.3333 20.1887H2.66667V24.8113H10.6667V20.1887H10.3333ZM38.6667 26.1321V27.7599L37.1313 28.7736H36C35.6313 28.7736 35.3333 29.0694 35.3333 29.434V38.6792H4.66667V29.434C4.66667 29.0694 4.36867 28.7736 4 28.7736H2.86867L1.33333 27.7599V26.1321H2H11.3333H19.3333H28.6667H31.3333H34H38.6667ZM29.3333 23.4906V24.8113H30.6667V23.4906H29.3333ZM32 24.8113V23.4906H33.3333V24.8113H32ZM31.3333 22.1698H34H38.6667V15.566H28.57H27.3333V22.1698H28.6667H31.3333Z"
                                        fill="currentColor" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M0 6C0 2.692 2.69133 0 6 0C9.30867 0 12 2.692 12 6C12 9.308 9.30867 12 6 12C2.69133 12 0 9.308 0 6ZM6.66667 9.33333V10.6133C8.706 10.3193 10.3193 8.706 10.6133 6.66667H9.33333V5.33333H10.6133C10.3193 3.294 8.706 1.68067 6.66667 1.38667V2.66667H5.33333V1.38667C3.294 1.68067 1.68067 3.294 1.38667 5.33333H2.66667V6.66667H1.38667C1.68067 8.706 3.294 10.3193 5.33333 10.6133V9.33333H6.66667Z"
                                        fill="currentColor" />
                                    <path
                                        d="M7.01644 3L5.59705 5.19896L4.86922 4.35167L4 5.36185L5.22945 6.79068C5.34501 6.9257 5.50115 7 5.66405 7C5.67819 7 5.69295 6.99929 5.7077 6.99857C5.88535 6.98357 6.04887 6.87998 6.15583 6.71495L8 3.8573L7.01644 3Z"
                                        fill="currentColor" />
                                </svg>
                            </span>
                        </div>
                        <div class="main">
                            <h4 class="main_title">Clean & Comfortable</h4>
                            <p class="main_text">Our rooms are cleaned daily and equipped with comfortable beds, fresh linens, and all the essentials you need.</p>
                        </div>
                    </li>
                    <li class="list-item d-flex align-items-sm-center" data-aos="fade-up" data-aos-delay="100">
                        <div class="media">
                            <span class="theme-element">

                                <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M35.5133 23.6979L35.3079 23.8084C34.4779 22.8045 33.0399 22.4154 31.9444 22.9688L31.9327 22.9748L31.4477 23.2351C30.2625 22.2348 28.5752 22.0828 27.2293 22.8552L24.6173 24.2712H21.1416C20.389 24.2702 19.6463 24.1006 18.9683 23.7748L18.4902 23.5443C15.7145 22.1981 12.4156 22.5193 9.95364 24.3753C9.94229 24.384 9.9312 24.3926 9.92064 24.4024L8.76626 25.4267C8.33 25.8129 7.81433 26.0994 7.25535 26.2662L6.59973 24.121C6.53304 23.903 6.33126 23.754 6.10262 23.754H0.519728C0.370932 23.754 0.229272 23.8176 0.130628 23.9286C0.0319839 24.0397 -0.0141828 24.1875 0.00382146 24.3348L1.86476 39.5445C1.89654 39.8045 2.11795 39.9999 2.38066 39.9999H10.7545C10.9192 39.9999 11.0742 39.9221 11.1722 39.7901C11.2702 39.6582 11.2997 39.4878 11.2516 39.3307L10.1516 35.7326L13.5777 33.5741C14.0361 33.3212 14.574 33.2519 15.0819 33.3801C15.0926 33.3827 15.1034 33.3852 15.1143 33.3871L22.0837 34.6663C23.9777 35.0041 25.9304 34.7293 27.6565 33.882C27.6786 33.8711 27.6998 33.8587 27.7201 33.8448L39.7744 25.5948C40.0011 25.4397 40.0673 25.1354 39.9255 24.9005C39.0143 23.3878 37.07 22.8579 35.5133 23.6979ZM32.4195 23.8903C33.0532 23.574 33.8508 23.8333 34.3603 24.3179L29.7893 26.776L29.5207 26.917C29.376 26.5074 29.1645 26.1243 28.8946 25.7833L32.4195 23.8903ZM27.7367 23.7596L27.7323 23.7621L26.6244 24.3616C27.1603 24.4784 27.6659 24.7052 28.1089 25.0276L30.433 23.7803C29.6084 23.2843 28.5784 23.2746 27.7446 23.7551C27.7422 23.7566 27.7395 23.7581 27.7367 23.7596ZM2.84044 38.9638L1.10675 24.7901H5.71742L10.0527 38.9638H2.84044ZM22.2696 33.6467C23.9312 33.9427 25.6442 33.7055 27.1618 32.9691L38.7394 25.0459C38.0331 24.3001 36.9119 24.1209 36.0071 24.6093L30.2773 27.6896L29.7349 27.9745C29.7401 28.0572 29.7436 28.1402 29.7436 28.2241C29.7436 28.5102 29.5109 28.7421 29.2239 28.7421C29.2161 28.7421 29.2082 28.7416 29.2003 28.7416L25.2456 28.5633C24.0873 28.5112 22.9267 28.5646 21.7782 28.7228C21.4954 28.7591 21.2362 28.5615 21.1971 28.2801C21.158 27.9986 21.3536 27.7383 21.6356 27.6966C22.8469 27.5298 24.071 27.4734 25.2927 27.5282L28.6531 27.6797C28.389 26.3038 27.1827 25.3082 25.7773 25.3062H21.141C20.2317 25.305 19.3343 25.1 18.5151 24.7065L18.0371 24.4759C15.6185 23.3029 12.7447 23.5785 10.5949 25.1895L9.45679 26.1997C8.90867 26.6858 8.26081 27.047 7.55835 27.258L9.83644 34.705L13.034 32.69C13.0419 32.685 13.0499 32.6802 13.058 32.6758C13.7449 32.2915 14.5528 32.1824 15.3175 32.3706L22.2696 33.6467Z" fill="currentColor" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M4.62732 38.125H5.99768C6.48221 38.125 6.875 37.7323 6.875 37.2478V35.8772C6.875 35.3927 6.48221 35 5.99768 35H4.62732C4.14279 35 3.75 35.3927 3.75 35.8772V37.2478C3.75 37.7323 4.14279 38.125 4.62732 38.125ZM4.79167 37.0833V36.0417H5.83333V37.0833H4.79167Z" fill="currentColor" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M24.0862 3.88411V5.57826C24.0762 7.72633 22.346 9.46237 20.2152 9.46237C18.0844 9.46237 16.3542 7.72633 16.3442 5.57826V3.88411C16.3542 1.73604 18.0844 0 20.2152 0C22.346 0 24.0762 1.73604 24.0862 3.88411ZM17.3642 3.88411V5.57826C17.3727 7.15948 18.6467 8.43675 20.2152 8.43675C21.7837 8.43675 23.0577 7.15948 23.0662 5.57826V3.88411C23.0577 2.30289 21.7837 1.02562 20.2152 1.02562C18.6467 1.02562 17.3727 2.30289 17.3642 3.88411Z" fill="currentColor" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M26.3728 20.2152H13.6411C13.3538 20.2152 13.1208 19.9855 13.1208 19.7022V18.5249H4.39139C4.10404 18.5249 3.87109 18.2952 3.87109 18.0119V14.6826C3.8714 12.5984 5.55676 10.8943 7.67017 10.8413C7.83973 10.8373 8.00063 10.9149 8.10158 11.0493C8.53964 11.6329 9.22637 11.9846 9.96259 12.0023C10.6988 12.02 11.4021 11.7018 11.8686 11.14L11.8689 11.1396C11.9844 11.0006 12.1281 10.8277 12.4044 10.8478C13.0322 10.8859 13.6411 11.0743 14.1783 11.3968C14.2391 11.3271 14.3015 11.2584 14.3672 11.1922C15.1627 10.3854 16.2478 9.91877 17.3888 9.89276C17.5584 9.88832 17.7195 9.96597 17.8202 10.1007C18.3342 10.7856 19.1401 11.1984 20.004 11.2192C20.868 11.24 21.6934 10.8665 22.2407 10.2071C22.3724 10.0495 22.5084 9.88857 22.7772 9.89934C23.9575 9.96963 25.0586 10.5081 25.8296 11.3919C26.4076 11.0462 27.0676 10.8564 27.7434 10.8414C27.913 10.8373 28.0741 10.9149 28.1749 11.0494C28.6129 11.6331 29.2997 11.9847 30.0359 12.0025C30.7722 12.0202 31.4755 11.702 31.9419 11.1401L31.9436 11.1382C32.059 10.9994 32.2016 10.8279 32.4778 10.8479C34.5301 10.9771 36.128 12.6552 36.1292 14.6826V18.0119C36.1292 18.2952 35.8962 18.5249 35.6089 18.5249H26.8931V19.7022C26.8931 19.9855 26.6602 20.2152 26.3728 20.2152ZM30.085 13.0292C29.1035 13.0267 28.1701 12.6096 27.5213 11.8835C27.1301 11.926 26.7523 12.0489 26.4123 12.2444C26.7288 12.852 26.8937 13.5254 26.8931 14.2084V17.499H35.0886V14.6826C35.0873 13.2886 34.053 12.1048 32.6548 11.8968C32.0021 12.6195 31.0666 13.0318 30.085 13.0292ZM17.1645 10.9342C17.8924 11.7649 18.95 12.2436 20.0635 12.2462C21.177 12.2488 22.2369 11.7751 22.9687 10.9478C24.6207 11.173 25.8513 12.5644 25.8529 14.2084V19.1893H14.1614V14.2084C14.1721 12.5229 15.4645 11.1138 17.1645 10.9342ZM4.91168 14.6826V17.499H13.1208V14.2084C13.1199 13.5277 13.2829 12.8565 13.5966 12.25C13.2841 12.0695 12.9394 11.9496 12.5812 11.8968C11.9286 12.6193 10.9932 13.0316 10.0119 13.0291C9.03053 13.0266 8.0973 12.6097 7.44844 11.8839C6.00814 12.053 4.92077 13.2527 4.91168 14.6826Z" fill="currentColor" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M33.5482 5.69622V7.2072C33.5482 9.16537 32.0077 10.7528 30.1074 10.7528C28.207 10.7528 26.6665 9.16537 26.6665 7.2072V5.69622C26.6665 3.73805 28.207 2.15063 30.1074 2.15063C32.0077 2.15063 33.5482 3.73805 33.5482 5.69622ZM27.6832 5.69622V7.2072C27.6832 8.58677 28.7685 9.70514 30.1074 9.70514C31.4462 9.70514 32.5315 8.58677 32.5315 7.2072V5.69622C32.5315 4.31665 31.4462 3.19828 30.1074 3.19828C28.7685 3.19828 27.6832 4.31665 27.6832 5.69622Z" fill="currentColor" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M13.3334 5.69622V7.2072C13.3334 9.16537 11.7929 10.7528 9.89252 10.7528C7.99219 10.7528 6.45166 9.16537 6.45166 7.2072V5.69622C6.45166 4.42951 7.10748 3.25901 8.17209 2.62565C9.2367 1.9923 10.5483 1.9923 11.613 2.62565C12.6776 3.25901 13.3334 4.42951 13.3334 5.69622ZM7.46836 5.69622V7.2072C7.46836 8.09962 7.9304 8.92426 8.68044 9.37048C9.43048 9.81669 10.3546 9.81669 11.1046 9.37048C11.8546 8.92426 12.3167 8.09962 12.3167 7.2072V5.69622C12.3167 4.31665 11.2313 3.19828 9.89252 3.19828C8.55369 3.19828 7.46836 4.31665 7.46836 5.69622Z" fill="currentColor" />
                                </svg>

                            </span>

                        </div>
                        <div class="main">
                            <h4 class="main_title">Friendly Staff</h4>
                            <p class="main_text">Our knowledgeable staff is always ready to help with recommendations, directions, and any questions you might have.</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <!-- stages section end -->



    <!-- rules section start -->
    <section class="about_rules section">
        <div class="container d-xl-flex justify-content-between align-items-center">
            <div class="about_rules-main col-xl-5">
                <h2 class="about_rules-main_header" data-aos="fade-right">House Rules</h2>
                <p class="page_header-text mb-3" data-aos="fade-up" data-aos-delay="50">
                    To ensure everyone has a pleasant stay, please follow these guidelines :
                </p>
                <ul class="about_rules-main_list">
                    <h3>Check-in/Check-out</h3>
                    <li class="list-item d-flex align-items-baseline" data-aos="fade-up">
                        &bull; Check-in: 2:00 PM - 10:00 PM <br>
                        &bull; Check-out: 11:00 AM <br>
                        &bull; Late check-in available with prior notice <br>
                    </li>
                    <h3>Quiet Hours</h3>
                    <li class="list-item d-flex align-items-baseline" data-aos="fade-up">
                        &bull; Quiet hours: 11:00 PM - 7:00 AM <br>
                        &bull; Please respect other guests <br>
                        &bull; No loud music or parties <br>
                    </li>
                    <h3>Smoking Policy</h3>
                    <li class="list-item d-flex align-items-baseline" data-aos="fade-up">
                        &bull; No smoking inside the building <br>
                        &bull; Designated smoking areas available <br>
                        &bull; Smoking fee applies if violated <br>
                    </li>
                    <h3>Pet Policy</h3>
                    <li class="list-item d-flex align-items-baseline" data-aos="fade-up">
                        &bull; Pet Policy <br>
                        &bull; Additional cleaning fee applies <br>
                        &bull; Please inform us in advance <br>
                    </li>
                </ul>
            </div>
            <div class="contacts col-xl-6" data-aos="fade-up">
                <div class="contacts_header">
                    <h2 class="contacts_header-title">We are ready answer your question</h2>
                    <p class="contacts_header-text">
                        Egestas pretium aenean pharetra magna ac. Et tortor consequat id porta nibh venenatis cras
                        sed
                    </p>
                </div>
                <form class="contacts_form form d-sm-flex flex-wrap justify-content-between" action="form.php"
                    method="post" data-type="feedback">
                    <div class="field-wrapper">
                        <label class="label" for="feedbackName">
                            <i class="icon-user icon"></i>
                        </label>
                        <input class="field required" id="feedbackName" type="text" placeholder="Name" />
                    </div>
                    <div class="field-wrapper">
                        <label class="label" for="feedbackEmail">
                            <i class="icon-email icon"></i>
                        </label>
                        <input class="field required" id="feedbackEmail" type="text" data-type="email"
                            placeholder="Email" />
                    </div>
                    <textarea class="field textarea required" id="feedbackMessage" placeholder="Message"></textarea>
                    <button class="btn theme-element theme-element--accent" type="submit">Send message</button>
                </form>
            </div>
        </div>
    </section>
    <!-- rules section end -->

    <!-- FAQ section start -->
    <section class="about_faq section">
        <div class="container">
            <div class="about_faq-header d-lg-flex justify-content-between align-items-center">
                <h2 class="about_faq-header_title">Frequently Asked Questions</h2>
                <p class="about_faq-header_text">Find answers to common questions about your stay</p>
            </div>
            <div class="about_faq-main d-grid">
                <!-- item 1 -->
                <div class="accordion_component-item">
                    <div class="item-wrapper d-flex flex-column justify-content-between">
                        <h4 class="accordion_component-item_header d-flex justify-content-between align-items-center collapsed"
                            data-bs-toggle="collapse" data-bs-target="#item-1" aria-expanded="true">
                            What time is check-in and check-out?
                            <span class="wrapper">
                                <i class="icon-chevron_down icon transform"></i>
                            </span>
                        </h4>
                        <div id="item-1" class="accordion-collapse collapse show">
                            <div class="accordion_component-item_body">
                                Check-in is from 2:00 PM to 10:00 PM, and check-out is at 11:00 AM. If you need to arrive earlier or later, please contact us in advance and we'll do our best to accommodate you.
                            </div>
                        </div>
                    </div>
                </div>
                <!-- item 2 -->
                <div class="accordion_component-item">
                    <div class="item-wrapper d-flex flex-column justify-content-between">
                        <h4 class="accordion_component-item_header d-flex justify-content-between align-items-center"
                            data-bs-toggle="collapse" data-bs-target="#item-2" aria-expanded="true">
                            Do you provide towels and linens?
                            <span class="wrapper">
                                <i class="icon-chevron_down icon transform"></i>
                            </span>
                        </h4>
                        <div id="item-2" class="accordion-collapse collapse show">
                            <div class="accordion_component-item_body">
                                Yes, we provide fresh towels and linens for all guests. Towels are changed daily, and linens are changed every 3 days for longer stays.
                            </div>
                        </div>
                    </div>
                </div>
                <!-- item 3 -->
                <div class="accordion_component-item">
                    <div class="item-wrapper d-flex flex-column justify-content-between">
                        <h4 class="accordion_component-item_header d-flex justify-content-between align-items-center collapsed"
                            data-bs-toggle="collapse" data-bs-target="#item-3" aria-expanded="true">
                            Is breakfast included?
                            <span class="wrapper">
                                <i class="icon-chevron_down icon transform"></i>
                            </span>
                        </h4>
                        <div id="item-3" class="accordion-collapse collapse show">
                            <div class="accordion_component-item_body">
                                We offer a complimentary continental breakfast from 7:00 AM to 10:00 AM daily. This includes coffee, tea, bread, jam, and seasonal fruits.
                            </div>
                        </div>
                    </div>
                </div>
                <!-- item 4 -->
                <div class="accordion_component-item">
                    <div class="item-wrapper d-flex flex-column justify-content-between">
                        <h4 class="accordion_component-item_header d-flex justify-content-between align-items-center collapsed"
                            data-bs-toggle="collapse" data-bs-target="#item-4" aria-expanded="true">
                            Can I cancel my booking?
                            <span class="wrapper">
                                <i class="icon-chevron_down icon transform"></i>
                            </span>
                        </h4>
                        <div id="item-4" class="accordion-collapse collapse show">
                            <div class="accordion_component-item_body">
                                Yes, you can cancel your booking up to 24 hours before check-in for a full refund. Cancellations within 24 hours may be subject to a cancellation fee.
                            </div>
                        </div>
                    </div>
                </div>
                <!-- item 5 -->
                <div class="accordion_component-item">
                    <div class="item-wrapper d-flex flex-column justify-content-between">
                        <h4 class="accordion_component-item_header d-flex justify-content-between align-items-center collapsed"
                            data-bs-toggle="collapse" data-bs-target="#item-5" aria-expanded="true">
                            Do you have parking available?
                            <span class="wrapper">
                                <i class="icon-chevron_down icon transform"></i>
                            </span>
                        </h4>
                        <div id="item-5" class="accordion-collapse collapse show">
                            <div class="accordion_component-item_body">
                                We have limited parking spaces available on a first-come, first-served basis. There's also public parking nearby. Please contact us in advance if you need parking.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="about_faq-main_card accent d-flex flex-column justify-content-between">
                    <h4 class="title">Do you have any questions?</h4>
                    <p class="text flex-grow-1">Diam phasellus vestibulum lorem sed risus ultricies tristique</p>
                    <a class="btn theme-element theme-element--light" href="contacts.html">Ask a question</a>
                </div>
            </div>
        </div>
    </section>
    <!-- FAQ section end -->
</main>
@endsection

@push('scripts')
<script src="{{ asset('asset/js/common.min.js') }}"></script>
@endpush