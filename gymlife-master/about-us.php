<?php
include "koneksi.php";
session_start();
// Periksa apakah session username dan password ada
if (isset($_SESSION['username'])) {
    $usernames = $_SESSION['username'];
    $passwords = $_SESSION['password'];
    ?>
    <script>
        window.onload = function () {
            document.getElementById('btnProfile').removeAttribute('hidden');
            document.getElementById('textBase').removeAttribute('hidden');
            document.getElementById('signIn').setAttribute('hidden', true);
        };
    </script>
    <?php
    $sqlnama = "SELECT user.nama FROM registrasi INNER JOIN user ON user.username = registrasi.username WHERE registrasi.username = '$usernames' AND registrasi.password = '$passwords'";
    $queryNama = mysqli_query($conn, $sqlnama);
    if (!$queryNama) {
        die("Query nama gagal :" . mysqli_error($conn));
    }
    $namaRow = mysqli_fetch_assoc($queryNama);
    $nama = $namaRow['nama'];

    $sqlSaldo = "SELECT saldo FROM user WHERE username = '$usernames'";
    $querySaldo = mysqli_query($conn, $sqlSaldo);
    if (!$querySaldo) {
        die("Query saldo gagal: " . mysqli_error($conn));
    }

    $saldoRow = mysqli_fetch_assoc($querySaldo);
    $saldo = $saldoRow['saldo'];
}
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Gym Template">
    <meta name="keywords" content="Gym, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gym | Template</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oswald:300,400,500,600,700&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/flaticon.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/barfiller.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

 <!-- Offcanvas Menu Section Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="canvas-close">
            <i class="fa fa-close"></i>
        </div>
        <div class="canvas-search search-switch">
            <i class="fa fa-search"></i>
        </div>
        <nav class="canvas-menu mobile-menu">
            <ul>
                <li><a href="./index.php">Home</a></li>
                <li><a href="./about-us.php">About Us</a></li>
                <li><a href="./classes.php">Classes</a></li>
                <li><a href="./services.php">Services</a></li>
                <li><a href="./team.php">Our Team</a></li>
                <li><a href="./blog.php">Article</a></li>
                <li><a href="./contact.php">Contact</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="canvas-social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-youtube-play"></i></a>
            <a href="#"><i class="fa fa-instagram"></i></a>
        </div>
    </div>
    <!-- Offcanvas Menu Section End -->

    <!-- Header Section Begin -->
    <header class="header-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3">
                    <div class="logo">
                        <a href="./index.php">
                            <img src="img/logoCelebes.png" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="nav-menu">
                        <ul>
                            <li><a href="./index.php">Home</a></li>
                            <li class="active"><a href="./about-us.php">About Us</a></li>
                            <li><a href="./class-details.php">Classes</a></li>
                            <li><a href="./services.php">Services</a></li>
                            <li><a href="./team.php">Our Team</a></li>
                            <li><a href="./blog.php">Article</a></li>
                            <li><a href="./contact.php">Contact</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="top-option">
                        <div class="relative">
                            <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal"
                                type="button">
                                <a id="signIn" class="sign-in-btn">Sign In</a>
                            </button>

                            <!-- Main modal -->
                            <div id="authentication-modal" tabindex="-1" aria-hidden="true"
                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <!-- Modal header -->
                                        <div
                                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                Masuk ke akun Anda!
                                            </h3>
                                            <button type="button"
                                                class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                data-modal-hide="authentication-modal">
                                                <svg class="w-3 h-3" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="p-4 md:p-5">
                                            <form method="post" class="space-y-4">
                                                <div>
                                                    <label for="username"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                        Username
                                                    </label>
                                                    <input type="text" name="username" id="username"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                                        required />
                                                </div>
                                                <div>
                                                    <label for="password"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                        Password</label>
                                                    <input type="password" name="password" id="password"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                                        required />
                                                </div>
                                                <div class="col-span-6">
                                                    <div id="loginAlert" hidden class="alert alert-danger" role="alert">
                                                        Username atau password salah!
                                                    </div>
                                                </div>
                                                <button type="submit" name="btnLogin"
                                                    class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login
                                                    to your account</button>
                                                <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
                                                    Not registered? <a href="registrasi.php"
                                                        class="text-blue-700 hover:underline dark:text-blue-500">Create
                                                        account</a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Profile -->
                            <a hidden id="btnProfile" class="user-profile fa fa-user"></a>
                            <span id="textBase" hidden class="text-base font-medium text-orange-500">
                                <?php echo $nama; ?>
                            </span>
                            <div hidden id="listOption"
                                class="absolute end-0 z-10 mt-2 w-56 divide-y divide-gray-100 rounded-md border border-gray-100 bg-white shadow-lg"
                                role="menu">
                                <div class="p-2">
                                    <a href="#"
                                        class="flex w-full items-center gap-2 rounded-lg px-4 py-2 text-sm  hover:bg-orange-500"
                                        role="menuitem">
                                        Edit profile
                                    </a>
                                </div>

                                <div class="p-2">
                                    <p class="flex w-full items-center gap-2 rounded-lg px-4 py-2 text-sm "
                                        role="menuitem">
                                        Saldo : <?php echo $saldo; ?>
                                    </p>
                                </div>

                                <div class="p-2">
                                    <form method="POST" action="logout.php">
                                        <button type="submit"
                                            class="flex w-full items-center gap-2 rounded-lg px-4 py-2 text-sm text-red-700 hover:bg-red-50"
                                            role="menuitem">
                                            Logout
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <!-- Profile -->
                        </div>

                    </div>
                </div>
            </div>
            <div class="canvas-open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header End -->

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb-text">
                        <h2>About us</h2>
                        <div class="bt-option">
                            <a href="./index.html">Home</a>
                            <span>About</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- ChoseUs Section Begin -->
    <section class="choseus-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Why chose us?</span>
                        <h2>PUSH YOUR LIMITS FORWARD</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="cs-item">
                        <span class="flaticon-034-stationary-bike"></span>
                        <h4>Modern equipment</h4>
                        <p>We provide modern equipment to ensure your training is more effective and safe.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="cs-item">
                        <span class="flaticon-033-juice"></span>
                        <h4>Healthy nutrition plan</h4>
                        <p>A healthy nutrition plan specifically designed to help you achieve your health and fitness
                            goals.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="cs-item">
                        <span class="flaticon-002-dumbell"></span>
                        <h4>Professional training plan</h4>
                        <p>Professional training plans tailored to your personal needs and goals.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="cs-item">
                        <span class="flaticon-014-heart-beat"></span>
                        <h4>Unique to your needs</h4>
                        <p>Services that are unique and tailored to your specific needs for the best results.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ChoseUs Section End -->

    <!-- About US Section Begin -->
    <section class="aboutus-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 p-0">
                    <div class="about-video set-bg" data-setbg="img/about-us.jpg">
                        <a href="./video/video.mp4" class="play-btn video-popup"><i
                                class="fa fa-caret-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-6 p-0">
                    <div class="about-text">
                        <div class="section-title">
                            <span>About Us</span>
                            <h2>What we have done</h2>
                        </div>
                        <div class="at-desc">
                            <p>At Celebes Gym, we have helped many individuals achieve maximum fitness through effective training programs and comprehensive facilities. 
                                We are proud of our achievements in improving the fitness and health of hundreds of members, providing fitness classes ranging from yoga to strength training, 
                                and creating a supportive community where every member feels welcome and motivated. Come join Celebes Gym and start your fitness journey with us!</p>
                        </div>
                        <div class="about-bar">
                            <div class="ab-item">
                                <p>Body building</p>
                                <div id="bar1" class="barfiller">
                                    <span class="fill" data-percentage="80"></span>
                                    <div class="tipWrap">
                                        <span class="tip"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="ab-item">
                                <p>Training</p>
                                <div id="bar2" class="barfiller">
                                    <span class="fill" data-percentage="85"></span>
                                    <div class="tipWrap">
                                        <span class="tip"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="ab-item">
                                <p>Fitness</p>
                                <div id="bar3" class="barfiller">
                                    <span class="fill" data-percentage="75"></span>
                                    <div class="tipWrap">
                                        <span class="tip"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About US Section End -->

    <!-- Team Section Begin -->
    <section class="team-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="team-title">
                        <div class="section-title">
                            <span>Our Team</span>
                            <h2>TRAIN WITH EXPERTS</h2>
                        </div>
                        <a href="#" class="primary-btn btn-normal appoinment-btn">appointment</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="ts-slider owl-carousel">
                    <div class="col-lg-4">
                        <div class="ts-item set-bg" data-setbg="img/team/tes-1.jpg">
                            <div class="ts_text">
                                <h4>Bobby Ida</h4>
                                <span>Youtuber & Gym Trainer</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="ts-item set-bg" data-setbg="img/team/tes-2.jpg">
                            <div class="ts_text">
                                <h4>Kevin Hendrawan</h4>
                                <span>Gym Trainer</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="ts-item set-bg" data-setbg="img/team/tes-3.jpg">
                            <div class="ts_text">
                                <h4>Ade Rai</h4>
                                <span>Bodybuilder & Gym Trainer</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="ts-item set-bg" data-setbg="img/team/tes-4.jpg">
                            <div class="ts_text">
                                <h4>Jennifer Bachdim</h4>
                                <span>Yoga and Fitness Trainer</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="ts-item set-bg" data-setbg="img/team/tes-5.jpg">
                            <div class="ts_text">
                                <h4>Anjasmara</h4>
                                <span>Yoga Trainer</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="ts-item set-bg" data-setbg="img/team/tes-6.jpg">
                            <div class="ts_text">
                                <h4>Melanie Putria</h4>
                                <span>Fitness Trainer</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Team Section End -->

    <!-- Banner Section Begin -->
    <section class="banner-section set-bg" data-setbg="img/banner-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="bs-text">
                        <h2>registration now to get more deals</h2>
                        <div class="bt-tips">Where health, beauty and fitness meet.</div>
                        <a href="#" class="primary-btn  btn-normal">Appointment</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Section End -->

    <!-- Testimonial Section Begin -->
    <section class="testimonial-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Testimonial</span>
                        <h2>Our cilent say</h2>
                    </div>
                </div>
            </div>
            <div class="ts_slider owl-carousel">
                <div class="ts_item">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <div class="ti_pic">
                                <img src="img/testimonial/testimonial-1.jpg" alt="">
                            </div>
                            <div class="ti_text">
                                <p>Program latihan di gym ini luar biasa, hasilnya sangat memuaskan.
                                    <br /> Instruktur yang profesional dan fasilitas yang lengkap membuat pengalaman latihan menjadi optimal.
                                    <br /> Sangat direkomendasikan bagi siapa saja yang ingin mencapai tujuan kebugaran mereka.</p>
                                <h5>Marselino Pratama</h5>
                                <div class="tt-rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ts_item">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <div class="ti_pic">
                                <img src="img/testimonial/testimonial-2.jpg" alt="">
                            </div>
                            <div class="ti_text">
                                <p>Latihan yoga di gym ini benar-benar mengubah hidup saya.
                                    <br /> Instruktur yang berpengalaman dan suasana yang nyaman membuat setiap sesi yoga menjadi momen relaksasi.
                                    <br /> Saya merasa lebih sehat dan seimbang setelah kelas yoga dan fitness.</p>
                                <h5>Sabrina Lie</h5>
                                <div class="tt-rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Testimonial Section End -->

    <!-- Get In Touch Section Begin -->
    <div class="gettouch-section">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="gt-text">
                        <i class="fa fa-map-marker"></i>
                        <p>Jl. Abdullah Daeng Sirua No.84, Masale, Kec. Panakkukang, Kota Makassar, Sulawesi
                            Selatan,<br/> 90231</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="gt-text">
                        <i class="fa fa-mobile"></i>
                        <ul>
                            <li>(0411) 123-4567</li>
                            <li>+62 812-3456-7890</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="gt-text email">
                        <i class="fa fa-envelope"></i>
                        <p>celebesgym@gmail.com</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Get In Touch Section End -->

    <!-- Footer Section Begin -->
    <section class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="fs-about">
                        <div class="fa-logo">
                            <a href="#"><img src="img/logoCelebes.png" alt=""></a>
                        </div>
                        <p>Celebes Gym is a fitness center that provides modern facilities and professional services to
                            help you achieve your health and fitness goals.
                            With a variety of specially designed classes and programs, we are committed to providing the
                            best fitness experience for all our members.</p>
                        <div class="fa-social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="https://youtu.be/FOJHzV5ERgQ?si=9oxEa6r1_nlYvDbs"><i class="fa fa-youtube-play"></i></a>
                            <a href="https://www.instagram.com/celebes_gym/"><i class="fa fa-instagram"></i></a>
                            <a href="mailto:celebesgym@gmail.com"><i class="fa  fa-envelope-o"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="fs-widget">
                        <h4>Useful links</h4>
                        <ul>
                            <li><a href="./about-us.php">About</a></li>
                            <li><a href="./blog.php">Article</a></li>
                            <li><a href="./class-details.php">Classes</a></li>
                            <li><a href="./contact.php">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="fs-widget">
                        <h4>Support</h4>
                        <ul>
                            <li><a href="./login.php">Login</a></li>
                            <li><a href="./logout.php">Logout</a></li>
                            <li><a href="#">My account</a></li>
                            <li><a href="https://youtu.be/FOJHzV5ERgQ?si=9oxEa6r1_nlYvDbs">Subscribe</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="fs-widget">
                        <h4>Tips & Guides</h4>
                        <div class="fw-recent">
                            <h6><a href="./blog.php">Physical fitness may help prevent depression, anxiety</a></h6>
                            <ul>
                                <li>3 min read</li>
                                <li>20 Comment</li>
                            </ul>
                        </div>
                        <div class="fw-recent">
                            <h6><a href="./blog.php">Fitness: The best exercise to lose belly fat and tone up...</a></h6>
                            <ul>
                                <li>3 min read</li>
                                <li>20 Comment</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="copyright-text">
                        <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer Section End -->

    <!-- Search model Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Search model end -->

    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/masonry.pkgd.min.js"></script>
    <script src="js/jquery.barfiller.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/script.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>


</body>

</html>