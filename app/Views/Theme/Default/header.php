<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title><?php echo $title;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo $description;?>" >
    <meta name="keywords" content="<?php echo $keywords;?>" >
    <link rel="shortcut icon" href="<?php echo base_url() ?>/uploads/logo/<?php echo get_lebel_by_value_in_theme_settings('favicon');?>">

    <!-- Bootstrap CSS -->
    <link href="<?php echo base_url() ?>/assets/default/css/bootstrap.min.css" rel="stylesheet"  >
    <link href="<?php echo base_url() ?>/assets/default/css/style.css" rel="stylesheet"  >

    <title>News Beacon</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600;700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</head>
<body>
<header id="header" >
    <section class="top-head pd-28" id="main_header">
        <div class="container-fluid">
            <div class="row flex-nowrap justify-content-between">
                <div class="col-3">
                    <a href="<?php echo base_url() ?>"><img class="w-100 main-logo" src="<?php echo base_url() ?>/assets/default/images/logo.PNG" alt="logo"></a>
                </div>

                <div class="res-manu d-none align-items-center gap-2">
                    <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="20px" height="20px">
                            <path d="M 13 3 C 7.4889971 3 3 7.4889971 3 13 C 3 18.511003 7.4889971 23 13 23 C 15.396508 23 17.597385 22.148986 19.322266 20.736328 L 25.292969 26.707031 A 1.0001 1.0001 0 1 0 26.707031 25.292969 L 20.736328 19.322266 C 22.148986 17.597385 23 15.396508 23 13 C 23 7.4889971 18.511003 3 13 3 z M 13 5 C 17.430123 5 21 8.5698774 21 13 C 21 17.430123 17.430123 21 13 21 C 8.5698774 21 5 17.430123 5 13 C 5 8.5698774 8.5698774 5 13 5 z"/>
                        </svg>
                    </a>
                    <span class="bor-1"></span>
                    <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" class="_8lu3j" viewBox="0 0 24 24" enable-background="new 0 0 24 24" xml:space="preserve">
                            <path fill-opacity="0.68" d="M12,12c0.904,0,1.788-0.264,2.54-0.758c0.752-0.494,1.338-1.197,1.684-2.019 c0.346-0.822,0.437-1.727,0.26-2.6c-0.176-0.873-0.612-1.675-1.251-2.304c-0.639-0.629-1.454-1.058-2.34-1.232 c-0.887-0.174-1.806-0.085-2.641,0.256C9.416,3.683,8.702,4.26,8.199,5C7.697,5.74,7.429,6.61,7.429,7.5 c0,0.591,0.118,1.176,0.348,1.722c0.23,0.546,0.566,1.042,0.991,1.46c0.425,0.418,0.928,0.749,1.483,0.976 C10.805,11.884,11.4,12,12,12z M15.2,13.125h-0.596c-0.816,0.37-1.705,0.562-2.603,0.562c-0.899,0-1.787-0.192-2.604-0.562H8.8 c-1.273,0-2.494,0.498-3.394,1.384C4.506,15.395,4,16.597,4,17.85v1.463c0,0.448,0.181,0.877,0.502,1.193 C4.824,20.822,5.26,21,5.714,21h12.571c0.455,0,0.891-0.178,1.212-0.494C19.819,20.189,20,19.76,20,19.312V17.85 c0-1.253-0.506-2.455-1.406-3.341C17.694,13.623,16.473,13.125,15.2,13.125z"></path>
                        </svg>
                        Login
                    </a>
                </div>

                <div class="heading-image d-flex col-8">
                    <div class="col-4 d-flex br-right pd-10">
                        <div class="img">
                            <img class="w-100" src="<?php echo base_url() ?>/assets/default/images/smail.jpg" alt="small">
                        </div>
                        <p class="top-text">এ আর রাহমান-সায়রা বানুর অপ্রকাশিত প্রেমের গল্প</p>
                    </div>
                    <div class="col-4 d-flex br-right pd-10">
                        <div class="img">
                            <img class="w-100" src="<?php echo base_url() ?>/assets/default/images/smail.jpg" alt="small">
                        </div>
                        <p class="top-text">এ আর রাহমান-সায়রা বানুর অপ্রকাশিত প্রেমের গল্প</p>
                    </div>
                    <div class="col-4 d-flex pd-10">
                        <div class="img">
                            <img class="w-100" src="<?php echo base_url() ?>/assets/default/images/smail.jpg" alt="small">
                        </div>
                        <p class="top-text">এ আর রাহমান-সায়রা বানুর অপ্রকাশিত প্রেমের গল্প</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="menu pd-menu menu-border" id="navBar">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="navbar navbar-light bg-light">
                        <div class="d-flex justify-content-between w-100" id="navbarSupportedContent">
                            <div class="scroll-manu">
                                <ul class="d-flex m-0 ps-0" id="sliderManu">
                                    <!--                                --><?php //echo top_menu();?>
                                    <li class="nav-item  pd-10"><a class="nav-link m-link" aria-current="page" href="#" >সর্বশেষ</a></li>
                                    <li class="nav-item  pd-10"><a class="nav-link m-link" aria-current="page" href="#" >সর্বশেষ</a></li>
                                    <li class="nav-item  pd-10"><a class="nav-link m-link" aria-current="page" href="#" >সর্বশেষ</a></li>
                                    <li class="nav-item  pd-10"><a class="nav-link m-link" aria-current="page" href="#" >সর্বশেষ</a></li>
                                    <li class="nav-item  pd-10"><a class="nav-link m-link" aria-current="page" href="#" >সর্বশেষ</a></li>
                                    <li class="nav-item  pd-10"><a class="nav-link m-link" aria-current="page" href="#" >সর্বশেষ</a></li>
                                </ul>
                            </div>

                            <div class="fixed-manu">
                                <ul class="d-flex m-0 ps-0">
                                    <li class="nav-item pd-10 border">
                                        <a class="nav-link m-link-2"  href="detail.html">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="20px" height="20px">
                                                <path d="M 13 3 C 7.4889971 3 3 7.4889971 3 13 C 3 18.511003 7.4889971 23 13 23 C 15.396508 23 17.597385 22.148986 19.322266 20.736328 L 25.292969 26.707031 A 1.0001 1.0001 0 1 0 26.707031 25.292969 L 20.736328 19.322266 C 22.148986 17.597385 23 15.396508 23 13 C 23 7.4889971 18.511003 3 13 3 z M 13 5 C 17.430123 5 21 8.5698774 21 13 C 21 17.430123 17.430123 21 13 21 C 8.5698774 21 5 17.430123 5 13 C 5 8.5698774 8.5698774 5 13 5 z"/>
                                            </svg>
                                            খুঁজুন
                                        </a>
                                    </li>
                                    <li class="nav-item pd-10 border">
                                        <a class="nav-link m-link-2" href="detail.html">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="20px" width="20px" version="1.1" id="Capa_1" viewBox="0 0 60.671 60.671" xml:space="preserve">
                                                <g>
                                                    <g>
                                                        <ellipse style="fill:#010002;" cx="30.336" cy="12.097" rx="11.997" ry="12.097"/>
                                                        <path style="fill:#010002;" d="M35.64,30.079H25.031c-7.021,0-12.714,5.739-12.714,12.821v17.771h36.037V42.9    C48.354,35.818,42.661,30.079,35.64,30.079z"/>
                                                    </g>
                                                </g>
                                            </svg>
                                            Login
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </section>
</header>