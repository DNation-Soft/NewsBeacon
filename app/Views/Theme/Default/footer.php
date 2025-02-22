
<section class="footer pd-28 mrt-ama mt-5" >
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 bor-top-1 pt-5 pb-5">
                <img src="assets/images/footer-logo.PNG" alt="">
            </div>

            <div class="col-md-12 bor-bot-1 pa-bot-20 row">
                <div class="col-md-2">
                    <ul class="f-menu">
                        <li>নাগরিক সংবাদ</li>
                        <li>ইপেপার</li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <ul class="f-menu">
                        <li>কিশোর আলো</li>
                        <li>প্রথমা</li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <ul class="f-menu">
                        <li>বিজ্ঞানচিন্তা</li>
                        <li>মোবাইল ভ্যাস</li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <ul class="f-menu">
                        <li>প্রথম আলো ট্রাস্ট</li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <ul class="f-menu">
                        <li>বন্ধুসভা</li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <ul class="f-menu">
                        <li>চিরন্তন ১৯৭১</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-12 bor-bot-1 p-3 d-flex justify-content-between">
                <div class="social text-center">
                    <p class="foot-tt mt-4">অনুসরণ করুন</p>
                    <i class="fa-brands fa-facebook-f  ms-3" style="font-size: 19px;"></i>
                    <i class="fa-brands fa-instagram  ms-3" style="font-size: 19px;"></i>
                    <i class="fa-brands fa-youtube  ms-3" style="font-size: 19px;"></i>
                </div>
                <div class="apps">
                    <p class="foot-tt mt-4">মোবাইল অ্যাপস ডাউনলোড করুন</p>
                </div>
            </div>

            <div class="col-md-12 bor-bot-1 foot-t">
                <ul class="d-md-flex justify-content-center mt-3 ">
                    <li class="ms-5">প্রথম আলো</li>
                    <li class="ms-5">বিজ্ঞাপন</li>
                    <li class="ms-5">সার্কুলেশন</li>
                    <li class="ms-5">শর্তাবলি ও নীতিমালা</li>
                    <li class="ms-5">গোপনীয়তা নীতি</li>
                    <li class="ms-5">যোগাযোগ</li>
                </ul>
            </div>
            <div class="col-md-12 text-center">
                <p class="foot-tt">স্বত্ব © ২০২৪ </p>
            </div>
        </div>
    </div>
</section>

<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="<?php echo base_url() ?>/assets/default/js/bootstrap.bundle.min.js" ></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"  ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"  ></script>

<script>
    (function (global) {
        "use strict";

        function getScrollY(element) {
            return element.pageYOffset !== undefined ? element.pageYOffset : element.scrollTop;
        }

        function Headroom(element, options) {
            this.elem = element;
            this.options = Object.assign({
                tolerance: { up: 0, down: 0 },
                offset: 0,
                scroller: global,
                onPin: function () {
                    this.elem.style.transform = "translateY(0)";
                },
                onUnpin: function () {
                    this.elem.style.transform = `translateY(-${this.elem.offsetHeight}px)`;
                }
            }, options);

            this.lastScrollY = getScrollY(this.options.scroller);
            this.init();
        }

        Headroom.prototype = {
            init: function () {
                this.options.scroller.addEventListener("scroll", this.update.bind(this));
            },
            update: function () {
                let currentScrollY = getScrollY(this.options.scroller);
                let direction = currentScrollY > this.lastScrollY ? "down" : "up";
                let toleranceExceeded = Math.abs(currentScrollY - this.lastScrollY) > this.options.tolerance[direction];

                if (toleranceExceeded) {
                    if (direction === "down" && currentScrollY > this.options.offset) {
                        this.options.onUnpin.call(this);
                    } else if (direction === "up") {
                        this.options.onPin.call(this);
                    }
                }

                this.lastScrollY = currentScrollY;
            }
        };

        global.Headroom = Headroom;

    })(this);

    document.addEventListener("DOMContentLoaded", function () {
        var header = document.querySelector("#header");
        let topbar = document.getElementById("main_header");
        let topbarHeight = topbar.offsetHeight;
        let options = {
            onUnpin : function() {
                this.elem.style.transform = `translateY(-${topbarHeight}px)`;
                this.elem.classList.add("headroom--unpinned")
            },
            onPin : function () {
                this.elem.style.transform = "translateY(0)";
                this.elem.classList.remove("headroom--unpinned")
            }
        };
        var headroom = new Headroom(header,options);
        headroom.init();
    });
</script>
<script>
    const stopElement = document.getElementById("stop"),
        startElement = document.getElementById("start");

    let progressBar = document.querySelector('.swiper-progress-bar');
    let slideDuration = 4000;
    let progressInterval;
    let stop = false;

    const BanglaNumberSet = {
        0 : '০',
        1 : '১',
        2 : '২',
        3 : '৩',
        4 : '৪',
        5 : '৫',
        6 : '৬',
        7 : '৭',
        8 : '৮',
        9 : '৯'
    }

    const enToBn = function (text){
        const array = `${text}`.split("");
        let outPut = '';
        array.forEach((e)=>{
            outPut += BanglaNumberSet[e]
        })
        return outPut;
    }

    const swiper = new Swiper('.swiper',{
        slidesPerView: 1,
        spaceBetween: 10,
        loop: true,
        autoplay: false,
        on: {
            slideChangeTransitionStart: function() {
                updateSlideCounter()
                clearInterval(progressInterval);
                progressBar.style.width = '0%'; // Reset progress bar
            },
            slideChangeTransitionEnd: function() {
                if (!stop){
                    startProgressBar();
                }
            }
        },
        navigation: {
            nextEl: '.swiper-next-button',
            prevEl: '.swiper-prev-button',
        },
    });

    function startProgressBar() {
        let startTime = Date.now();
        progressInterval = setInterval(function () {
            let elapsedTime = Date.now() - startTime;
            let progress = (elapsedTime / slideDuration) * 100;
            progressBar.style.width = progress + '%';

            if (progress >= 100) {
                clearInterval(progressInterval);
                swiper.slideNext();
            }
        }, 0.01);
    }

    startProgressBar();

    function resetProgressBarOnPush() {
        stop = true;
        clearTimeout(progressInterval);
        clearInterval(progressInterval);
        progressBar.style.transition = "none";
        progressBar.style.width = "0%"; // Instantly remove progress bar
    }

    stopElement.addEventListener('click',()=>{
        stopElement.style.display="none"
        startElement.style.display="block"
        resetProgressBarOnPush();
    })

    startElement.addEventListener('click',()=>{
        stop = false;
        stopElement.style.display="block"
        startElement.style.display="none"
        startProgressBar();
    })

    function updateSlideCounter() {
        let currentSlide = swiper.realIndex + 1; // Get the current slide index (1-based)
        let totalSlides = swiper.slides.length; // Get total slides in loop mode
        document.querySelector(".count").innerHTML = `${enToBn(currentSlide)} / ${enToBn(totalSlides)}`;
    }

    updateSlideCounter()

    document.querySelector('.swiper-next-button').addEventListener('click', ()=>{
        stopElement.style.display="none"
        startElement.style.display="block"
        resetProgressBarOnPush()
    });

    document.querySelector('.swiper-prev-button').addEventListener('click',  ()=>{
        stopElement.style.display="none"
        startElement.style.display="block"
        resetProgressBarOnPush()
    });

</script>
</body>
</html>