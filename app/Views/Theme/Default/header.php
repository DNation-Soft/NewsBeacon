<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title><?php echo $title;?></title>
    <meta name="description" content="<?php echo $description;?>" >
    <meta name="keywords" content="<?php echo $keywords;?>" >
    <link rel="shortcut icon" href="<?php echo base_url() ?>/uploads/logo/<?php echo get_lebel_by_value_in_theme_settings('favicon');?>">

    <!-- Bootstrap CSS -->
    <link href="<?php echo base_url() ?>/assets/default/css/style.css" rel="stylesheet"  >
    <link href="<?php echo base_url() ?>/assets/default/css/bootstrap.min.css" rel="stylesheet"  >

    <title>News Beacon</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600;700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
    />

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <style>

        /*#header {*/
        /*    background: #FFF;*/
        /*    top: 0;*/
        /*    left: 0;*/
        /*    right: 0;*/
        /*    z-index: 1;*/
        /*    !*transform: translate3d(0px, 0px, 0px);*!*/
        /*    !*transition: 0.4s ease-in-out;*!*/
        /*}*/

        /*.sticky {*/
        /*    !*position: fixed;*!*/
        /*    top: 0;*/
        /*    left: 0;*/
        /*    right: 0;*/
        /*    z-index: 1;*/
        /*    !*transform: translate3d(0px, 0px, 0px);*!*/
        /*    !*transition: 0.4s ease-in-out;*!*/
        /*    !*background: #fff;*!*/
        /*}*/

        /*.headroom--unpinned {*/
            /*border-bottom:  2px solid #0000001f;*/
            /*box-shadow: 0 0.333rem 0.333rem 0 #00000040;*/
        /*}*/

        #header {
            background: white;
            /*box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);*/
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            transition: transform 0.3s ease-in-out;
        }

         .headroom--unpinned {
            /*border-bottom:  2px solid #0000001f;*/
            box-shadow: 0 0.333rem 0.333rem 0 #00000040;
        }

        .mr-top {
            border-top: 1px solid #dbdbdb;
            margin-top: 212px;
        }

        .swiper-container {
            width: 100%;
            height: 300px;
            position: relative;
        }

        /* Progress Bar */
        .swiper-progress-bar {
            position: absolute;
            top: 0;
            left: 0;
            width: 0%;
            height: 4px;
            background: red;
            z-index: 9;
            transition: width linear;
        }

        .swiper-button-prevs {
            position: absolute;
            top: 0;
            left: 0;
            z-index: 9;
        }

        .swiper-row {
            display: flex;
            position: absolute;
            z-index: 9;
            top: 10px;
            right: 10px;
        }

        #start {
            display: none;
        }

        .count {
            background: #00000099;
            padding: 7px 14px;
            color: #ffffff99;
            position: absolute;
            top: 10px;
            left: 10px;
            z-index: 9;
            border-radius: 30px;
            font-weight: 700;
        }
    </style>
</head>
<body>
<header id="header" >
    <section class="top-head pd-28" id="main_header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3">
                    <a href="<?php echo base_url() ?>"><img src="<?php echo base_url() ?>/assets/default/images/logo.PNG" alt="logo"></a>
                </div>
                <div class="col-lg-3 d-flex br-right pd-10">
                    <div class="img">
                        <img src="<?php echo base_url() ?>/assets/default/images/smail.jpg" alt="small">
                    </div>
                    <p class="top-text">এ আর রাহমান-সায়রা বানুর অপ্রকাশিত প্রেমের গল্প</p>
                </div>
                <div class="col-lg-3 d-flex br-right pd-10">
                    <div class="img">
                        <img src="<?php echo base_url() ?>/assets/default/images/smail.jpg" alt="small">
                    </div>
                    <p class="top-text">এ আর রাহমান-সায়রা বানুর অপ্রকাশিত প্রেমের গল্প</p>
                </div>
                <div class="col-lg-3 d-flex pd-10">
                    <div class="img">
                        <img src="<?php echo base_url() ?>/assets/default/images/smail.jpg" alt="small">
                    </div>
                    <p class="top-text">এ আর রাহমান-সায়রা বানুর অপ্রকাশিত প্রেমের গল্প</p>
                </div>
            </div>
        </div>
    </section>

    <section class="menu pd-menu menu-border" id="navBar">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav mn-hight me-auto mb-2 mb-lg-0">

                                <?php echo top_menu();?>

                            </ul>

                            <ul class="navbar-nav mn-hight float-end  mb-2 mb-lg-0">
                                <li class="nav-item pd-10 border">
                                    <a class="nav-link m-link-2"  href="detail.html">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="20px" height="20px"><path d="M 13 3 C 7.4889971 3 3 7.4889971 3 13 C 3 18.511003 7.4889971 23 13 23 C 15.396508 23 17.597385 22.148986 19.322266 20.736328 L 25.292969 26.707031 A 1.0001 1.0001 0 1 0 26.707031 25.292969 L 20.736328 19.322266 C 22.148986 17.597385 23 15.396508 23 13 C 23 7.4889971 18.511003 3 13 3 z M 13 5 C 17.430123 5 21 8.5698774 21 13 C 21 17.430123 17.430123 21 13 21 C 8.5698774 21 5 17.430123 5 13 C 5 8.5698774 8.5698774 5 13 5 z"/></svg>
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
                    </nav>
                </div>
            </div>
        </div>
    </section>

</header>