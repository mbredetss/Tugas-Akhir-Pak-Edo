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
            document.getElementById('listOption').removeAttribute('hidden');
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
                <li><a href="./class-details.php">Classes</a></li>
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
                            <li><a href="./about-us.php">About Us</a></li>
                            <li class="active"><a href="./class-details.php">Classes</a></li>
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
                            <a id="signIn" href="login.php" class="sign-in-btn">Sign In</a>

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
                        <h2>Classes</h2>
                        <div class="bt-option">
                            <a href="./index.php">Home</a>
                            <a href="#">Classes</a>
                            <span>Yoga</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Class Details Section Begin -->
    <section class="class-details-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="class-details-text">
                        <div class="cd-pic">
                            <img src="img/classes/class-details/class-detailsl.jpg" alt="">
                        </div>
                        <div class="cd-text">
                            <div class="cd-single-item">
                                <h3>Yoga</h3>
                                <p>Yoga is a holistic practice that combines physical postures, breath control, meditation, and ethical principles to promote overall well-being. 
                                    Originating in ancient India, yoga aims to harmonize the body, mind, and spirit, offering benefits such as increased flexibility, strength, relaxation, and mental clarity. 
                                    It is a versatile discipline that can be adapted to various fitness levels and health conditions.</p>
                            </div>
                            <div class="cd-single-item">
                                <h3>Trainer</h3>
                                <p>Jennifer Bachdim is a renowned yoga trainer known for her dynamic teaching style and comprehensive knowledge of the practice. 
                                    With a background in both fitness and wellness, she integrates traditional yoga techniques with modern fitness principles to create engaging and effective sessions. 
                                    Jennifer is passionate about helping her students achieve their personal wellness goals, emphasizing the importance of mindfulness, balance, and strength in her classes.</p>
                            </div>
                        </div>
                        <div class="cd-trainer">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="cd-trainer-pic">
                                        <img src="img/classes/class-details/trainer-profile.jpg" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="cd-trainer-text">
                                        <div class="trainer-title">
                                            <h4>Jennifer Bachdim</h4>
                                            <span>Yoga & Fitness Trainer</span>
                                        </div>
                                        <div class="trainer-social">
                                            <a href="#"><i class="fa  fa-envelope-o"></i></a>
                                            <a href="https://www.instagram.com/jenniferbachdim/?hl=id"><i class="fa fa-instagram"></i></a>
                                            <a href="#"><i class="fa fa-twitter"></i></a>
                                        </div>
                                        <p>Jennifer Bachdim is a fitness enthusiast and yoga trainer known for her dedication to promoting a healthy lifestyle.</p>
                                        <ul class="trainer-info">
                                            <li><span>Age</span>37</li>
                                            <li><span>Weight</span>47kg</li>
                                            <li><span>Height</span>165cm</li>
                                            <li><span>Occupation</span>Selebgram</li>
                                        </ul>
                                        <p> With a strong social media presence, she inspires many with her workouts, yoga routines, and wellness tips. 
                                            Jennifer's approach combines physical fitness with mental well-being, making her a popular figure in the fitness community. </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-8">
                    <div class="sidebar-option">
                        <div class="so-categories">
                            <h5 class="title">Categories</h5>
                            <ul>
                                <li><a href="#">Yoga <span>12</span></a></li>
                                <li><a href="#">Runing <span>32</span></a></li>
                                <li><a href="#">Weightloss <span>86</span></a></li>
                                <li><a href="#">Cardio <span>25</span></a></li>
                                <li><a href="#">Body buiding <span>36</span></a></li>
                                <li><a href="#">Nutrition <span>15</span></a></li>
                            </ul>
                        </div>
                        <div class="so-latest">
                            <h5 class="title">Latest posts</h5>
                            <div class="latest-large set-bg" data-setbg="img/letest-blog/latest-1.jpg">
                                <div class="ll-text">
                                    <h5><a href="./blog.php">This Japanese Way of Making Iced Coffee Is a Game...</a></h5>
                                    <ul>
                                        <li>Aug 20, 2019</li>
                                        <li>20 Comment</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="latest-item">
                                <div class="li-pic">
                                    <img src="img/letest-blog/latest-2.jpg" alt="">
                                </div>
                                <div class="li-text">
                                    <h6><a href="./blog.php">Grilled Potato and Green Bean Salad</a></h6>
                                    <span class="li-time">Aug 15, 2019</span>
                                </div>
                            </div>
                            <div class="latest-item">
                                <div class="li-pic">
                                    <img src="img/letest-blog/latest-3.jpg" alt="">
                                </div>
                                <div class="li-text">
                                    <h6><a href="./blog.php">The $8 French Rosé I Buy in Bulk Every Summer</a></h6>
                                    <span class="li-time">Aug 15, 2019</span>
                                </div>
                            </div>
                            <div class="latest-item">
                                <div class="li-pic">
                                    <img src="img/letest-blog/latest-4.jpg" alt="">
                                </div>
                                <div class="li-text">
                                    <h6><a href="./blog.php">Ina Garten's Skillet-Roasted Lemon Chicken</a></h6>
                                    <span class="li-time">Aug 15, 2019</span>
                                </div>
                            </div>
                            <div class="latest-item">
                                <div class="li-pic">
                                    <img src="img/letest-blog/latest-5.jpg" alt="">
                                </div>
                                <div class="li-text">
                                    <h6><a href="./blog.php">The Best Weeknight Baked Potatoes, 3 Creative Ways</a></h6>
                                    <span class="li-time">Aug 15, 2019</span>
                                </div>
                            </div>
                        </div>
                        <div class="so-banner set-bg" data-setbg="img/sidebar-banner.jpg">
                            <h5>Our Brand New Gym Equipment</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Class Details Section End -->

    <!-- Class Timetable Section Begin -->
    <section class="class-timetable-section class-details-timetable spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="class-details-timetable_title">
                        <a href="class-timetable.php"><h5>Classes timetable</h5></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="class-timetable details-timetable">
                        <table>
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Monday</th>
                                    <th>Tuesday</th>
                                    <th>Wednesday</th>
                                    <th>Thursday</th>
                                    <th>Friday</th>
                                    <th>Saturday</th>
                                    <th>Sunday</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="class-time">6.00am - 8.00am</td>
                                    <td class="dark-bg hover-dp ts-meta" data-tsmeta="workout">
                                        <h5>WEIGHT LOOSE</h5>
                                        <span>Kevin Hendrawan</span>
                                    </td>
                                    <td class="hover-dp ts-meta" data-tsmeta="fitness">
                                        <h5>Cardio</h5>
                                        <span>Ade Rai</span>
                                    </td>
                                    <td class="dark-bg hover-dp ts-meta" data-tsmeta="workout">
                                        <h5>Yoga</h5>
                                        <span>Jennifer Bachdim</span>
                                    </td>
                                    <td class="hover-dp ts-meta" data-tsmeta="fitness">
                                        <h5>Fitness</h5>
                                        <span>Jennifer Bachdim</span>
                                    </td>
                                    <td class="dark-bg blank-td"></td>
                                    <td class="hover-dp ts-meta" data-tsmeta="motivation">
                                        <h5>Boxing</h5>
                                        <span>Chris John</span>
                                    </td>
                                    <td class="dark-bg hover-dp ts-meta" data-tsmeta="workout">
                                        <h5>Body Building</h5>
                                        <span>Ade Rai</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="class-time">10.00am - 12.00am</td>
                                    <td class="blank-td"></td>
                                    <td class="dark-bg hover-dp ts-meta" data-tsmeta="fitness">
                                        <h5>Fitness</h5>
                                        <span>Melanie Putria</span>
                                    </td>
                                    <td class="hover-dp ts-meta" data-tsmeta="workout">
                                        <h5>WEIGHT LOOSE</h5>
                                        <span>Kevin Hendrawan</span>
                                    </td>
                                    <td class="dark-bg hover-dp ts-meta" data-tsmeta="motivation">
                                        <h5>Cardio</h5>
                                        <span>Ade Rai/span>
                                    </td>
                                    <td class="hover-dp ts-meta" data-tsmeta="workout">
                                        <h5>Body Building</h5>
                                        <span>Ade Rai</span>
                                    </td>
                                    <td class="dark-bg hover-dp ts-meta" data-tsmeta="motivation">
                                        <h5>Karate</h5>
                                        <span>Idris Gusti</span>
                                    </td>
                                    <td class="blank-td"></td>
                                </tr>
                                <tr>
                                    <td class="class-time">5.00pm - 7.00pm</td>
                                    <td class="dark-bg hover-dp ts-meta" data-tsmeta="fitness">
                                        <h5>Boxing</h5>
                                        <span>Chris John</span>
                                    </td>
                                    <td class="hover-dp ts-meta" data-tsmeta="motivation">
                                        <h5>Karate</h5>
                                        <span>Idris Gusti</span>
                                    </td>
                                    <td class="dark-bg hover-dp ts-meta" data-tsmeta="workout">
                                        <h5>Body Building</h5>
                                        <span>Ade Rai</span>
                                    </td>
                                    <td class="blank-td"></td>
                                    <td class="dark-bg hover-dp ts-meta" data-tsmeta="workout">
                                        <h5>Yoga</h5>
                                        <span>Anjasmara</span>
                                    </td>
                                    <td class="hover-dp ts-meta" data-tsmeta="motivation">
                                        <h5>Cardio</h5>
                                        <span>Bobby Ida</span>
                                    </td>
                                    <td class="dark-bg hover-dp ts-meta" data-tsmeta="fitness">
                                        <h5>Fitness</h5>
                                        <span>Melanie Putria</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="class-time">7.00pm - 9.00pm</td>
                                    <td class="hover-dp ts-meta" data-tsmeta="motivation">
                                        <h5>Cardio</h5>
                                        <span>Bobby Ida</span>
                                    </td>
                                    <td class="dark-bg blank-td"></td>
                                    <td class="hover-dp ts-meta" data-tsmeta="fitness">
                                        <h5>Boxing</h5>
                                        <span>Chris John</span>
                                    </td>
                                    <td class="dark-bg hover-dp ts-meta" data-tsmeta="workout">
                                        <h5>Yoga</h5>
                                        <span>Anjasmara</span>
                                    </td>
                                    <td class="hover-dp ts-meta" data-tsmeta="motivation">
                                        <h5>Karate</h5>
                                        <span>Idris Gusti</span>
                                    </td>
                                    <td class="dark-bg hover-dp ts-meta" data-tsmeta="fitness">
                                        <h5>Boxing</h5>
                                        <span>Chris John</span>
                                    </td>
                                    <td class="hover-dp ts-meta" data-tsmeta="workout">
                                        <h5>WEIGHT LOOSE</h5>
                                        <span>Kevin Hendrawan</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Class Timetable Section End -->

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
                            <h6><a href="#">Fitness: The best exercise to lose belly fat and tone up...</a></h6>
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