<?php
include "koneksi.php";
session_start();

//function langganan
function langganan() {
    ?>
        <script>
            window.onload = function () {
                const btnLangganan = document.querySelectorAll('.btnLangganan');
                btnLangganan.forEach(function (button) {
                    button.setAttribute('data-modal-target', 'popup-modal');
                    button.setAttribute('data-modal-toggle', 'popup-modal');
                });
                document.querySelectorAll('.btnLangganan').forEach(button => {
                    button.addEventListener('click', function (e) {
                        e.preventDefault(); // Mencegah aksi default yang mungkin menyebabkan reload
                        // Lakukan aksi lain
                    });
                });
            }
        </script>
    <?php
}

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

//BUTTON LOGIN
if (isset($_POST["btnLogin"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    if ($username == NULL || $password == NULL) {
        ?>
        <script>
            document.getElementById('loginAlert').innerText = "Username dan password harus diisi!";
            document.getElementById('loginAlert').removeAttribute('hidden');
        </script>
        <?php
    } else {
        $sqlLogin = "SELECT * FROM user WHERE username='$username' AND password='$password'";
        $result = mysqli_query($conn, $sqlLogin);
        if (mysqli_num_rows($result) > 0) {
            // Login berhasil, simpan username dan password di session
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            header("Location: index.php");
        } else {
            ?>
            <script>
                document.getElementById('loginAlert').removeAttribute('hidden');
            </script>
            <?php
        }
    }
}
//LANGGANAN 3MONTH
if (!isset($_SESSION['username'])) {
    ?>
    <script>
        window.onload = function () {
            const btnLangganan = document.querySelectorAll('.btnLangganan');
            btnLangganan.forEach(function (button) {
                button.setAttribute('data-modal-target', 'authentication-modal');
                button.setAttribute('data-modal-toggle', 'authentication-modal');
            });
            document.querySelectorAll('.btnLangganan').forEach(button => {
                button.addEventListener('click', function (e) {
                    e.preventDefault(); // Mencegah aksi default yang mungkin menyebabkan reload
                    // Lakukan aksi lain
                });
            });
        }
    </script>
    <?php
    
} else if (isset($_SESSION['username'])) {
    if (isset($_POST['btn3Month'])) {
        langganan();
        
    }
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
                <li><a href="./index.html">Home</a></li>
                <li><a href="./about-us.html">About Us</a></li>
                <li><a href="./classes.html">Classes</a></li>
                <li><a href="./services.html">Services</a></li>
                <li><a href="./team.html">Our Team</a></li>
                <li><a href="./blog.html">Article</a></li>
                <li><a href="./contact.html">Contact</a></li>
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
                        <a href="./index.html">
                            <img src="img/logoCelebes.png" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="nav-menu">
                        <ul>
                            <li class="active"><a href="./index.html">Home</a></li>
                            <li><a href="./about-us.html">About Us</a></li>
                            <li><a href="./class-details.html">Classes</a></li>
                            <li><a href="./services.html">Services</a></li>
                            <li><a href="./team.html">Our Team</a></li>
                            <li><a href="./blog.html">Article</a></li>
                            <li><a href="./contact.html">Contact</a></li>
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

                            <div id="popup-modal" tabindex="-1"
                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <button type="button"
                                            class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                            data-modal-hide="popup-modal">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                        <div class="p-4 md:p-5 text-center">
                                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200"
                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 20 20">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                                                Apakah Anda yakin untuk berlangganan?</h3>
                                            <button data-modal-hide="popup-modal" type="button"
                                                class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                Ya
                                            </button>
                                            <button data-modal-hide="popup-modal" type="button"
                                                class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                                Tidak</button>
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

    <!-- Hero Section Begin -->
    <section class="hero-section">
        <div class="hs-slider owl-carousel">
            <div class="hs-item set-bg" data-setbg="img/hero/hero-1.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 offset-lg-6">
                            <div class="hi-text">
                                <span>Shape your body</span>
                                <h1>Be <strong>strong</strong> traning hard</h1>
                                <a href="#" class="primary-btn">Get info</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hs-item set-bg" data-setbg="img/hero/hero-2.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 offset-lg-6">
                            <div class="hi-text">
                                <span>Shape your body</span>
                                <h1>Be <strong>strong</strong> traning hard</h1>
                                <a href="#" class="primary-btn">Get info</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

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

    <!-- Classes Section Begin -->
    <section class="classes-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Our Classes</span>
                        <h2>WHAT WE CAN OFFER</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="class-item">
                        <div class="ci-pic">
                            <img src="img/classes/class-1.jpg" alt="">
                        </div>
                        <div class="ci-text">
                            <span>STRENGTH</span>
                            <h5>Weightlifting</h5>
                            <a href="#"><i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="class-item">
                        <div class="ci-pic">
                            <img src="img/classes/class-2.jpg" alt="">
                        </div>
                        <div class="ci-text">
                            <span>Cardio</span>
                            <h5>Indoor cycling</h5>
                            <a href="#"><i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="class-item">
                        <div class="ci-pic">
                            <img src="img/classes/class-3.jpg" alt="">
                        </div>
                        <div class="ci-text">
                            <span>STRENGTH</span>
                            <h5>Kettlebell power</h5>
                            <a href="#"><i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="class-item">
                        <div class="ci-pic">
                            <img src="img/classes/class-4.jpg" alt="">
                        </div>
                        <div class="ci-text">
                            <span>Cardio</span>
                            <h4>Indoor cycling</h4>
                            <a href="#"><i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="class-item">
                        <div class="ci-pic">
                            <img src="img/classes/class-5.jpg" alt="">
                        </div>
                        <div class="ci-text">
                            <span>Training</span>
                            <h4>Boxing</h4>
                            <a href="#"><i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ChoseUs Section End -->



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

    <!-- Pricing Section Begin -->
    <section class="pricing-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Our Plan</span>
                        <h2>Choose your pricing plan</h2>
                    </div>
                </div>
            </div>
            <form id="myForm" method="post">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-8">
                        <div class="ps-item">
                            <h3>3 Month unlimited</h3>
                            <div class="pi-price">
                                <h2>Rp. 350.000</h2>
                                <span>SINGLE CLASS</span>
                            </div>
                            <ul>
                                <li>Free riding</li>
                                <li>Limited equipments</li>
                                <li>Group trainer</li>
                                <li>Weight loss classes</li>
                                <li>Monthly membership</li>
                                <li>Time restrictions apply</li>
                            </ul>
                            <button class="btnLangganan" name="btn3Month">
                                <a href="" class="primary-btn pricing-btn">Enroll now</a>
                            </button>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-8">
                        <div class="ps-item">
                            <h3>6 Month unlimited</h3>
                            <div class="pi-price">
                                <h2>Rp. 600.000</h2>
                                <span>DOUBLE CLASS</span>
                            </div>
                            <ul>
                                <li>Free riding</li>
                                <li>Unlimited equipments</li>
                                <li>Personal trainer</li>
                                <li>Weight loss classes</li>
                                <li>Monthly membership</li>
                                <li>No time restrictions</li>
                            </ul>
                            <button class="btnLangganan" name="btn6Month">
                                <a class="primary-btn pricing-btn">Enroll now</a>
                            </button>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-8">
                        <div class="ps-item">
                            <h3>1 Year unlimited</h3>
                            <div class="pi-price">
                                <h2>Rp. 1.150.000</h2>
                                <span>SPECIAL CLASS</span>
                            </div>
                            <ul>
                                <li>Free riding</li>
                                <li>Unlimited premium equipments</li>
                                <li>Personal elite trainer</li>
                                <li>Weight loss & muscle gain classes</li>
                                <li>Yearly membership</li>
                                <li>No time restrictions</li>
                                <li>Access to exclusive events</li>
                                <li>Free nutritional guidance</li>
                            </ul>
                            <button class="btnLangganan" name="btn1Year">
                                <a href="" class="primary-btn pricing-btn">Enroll now</a>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- Pricing Section End -->

    <!-- Gallery Section Begin -->
    <div class="gallery-section">
        <div class="gallery">
            <div class="grid-sizer"></div>
            <div class="gs-item grid-wide set-bg" data-setbg="img/gallery/gallery-1.jpg">
                <a href="img/gallery/gallery-1.jpg" class="thumb-icon image-popup"><i class="fa fa-picture-o"></i></a>
            </div>
            <div class="gs-item set-bg" data-setbg="img/gallery/gallery-2.jpg">
                <a href="img/gallery/gallery-2.jpg" class="thumb-icon image-popup"><i class="fa fa-picture-o"></i></a>
            </div>
            <div class="gs-item set-bg" data-setbg="img/gallery/gallery-3.jpg">
                <a href="img/gallery/gallery-3.jpg" class="thumb-icon image-popup"><i class="fa fa-picture-o"></i></a>
            </div>
            <div class="gs-item set-bg" data-setbg="img/gallery/gallery-4.jpg">
                <a href="img/gallery/gallery-4.jpg" class="thumb-icon image-popup"><i class="fa fa-picture-o"></i></a>
            </div>
            <div class="gs-item set-bg" data-setbg="img/gallery/gallery-5.jpg">
                <a href="img/gallery/gallery-5.jpg" class="thumb-icon image-popup"><i class="fa fa-picture-o"></i></a>
            </div>
            <div class="gs-item grid-wide set-bg" data-setbg="img/gallery/gallery-6.jpg">
                <a href="img/gallery/gallery-6.jpg" class="thumb-icon image-popup"><i class="fa fa-picture-o"></i></a>
            </div>
        </div>
    </div>
    <!-- Gallery Section End -->

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
                                <span>Yoga & Fitness Trainer</span>
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

    <!-- Get In Touch Section Begin -->
    <div class="gettouch-section">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="gt-text">
                        <i class="fa fa-map-marker"></i>
                        <p>Jl. Abdullah Daeng Sirua No.84, Masale, Kec. Panakkukang, Kota Makassar, Sulawesi
                            Selatan,<br /> 90231</p>
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
                            <a href="#"><i class="fa fa-youtube-play"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa  fa-envelope-o"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="fs-widget">
                        <h4>Useful links</h4>
                        <ul>
                            <li><a href="#">About</a></li>
                            <li><a href="#">Blog</a></li>
                            <li><a href="#">Classes</a></li>
                            <li><a href="#">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="fs-widget">
                        <h4>Support</h4>
                        <ul>
                            <li><a href="#">Login</a></li>
                            <li><a href="#">My account</a></li>
                            <li><a href="#">Subscribe</a></li>
                            <li><a href="#">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="fs-widget">
                        <h4>Tips & Guides</h4>
                        <div class="fw-recent">
                            <h6><a href="#">Physical fitness may help prevent depression, anxiety</a></h6>
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
                            Copyright &copy;
                            <script>document.write(new Date().getFullYear());</script> All rights reserved | This
                            template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a
                                href="https://colorlib.com" target="_blank">Colorlib</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </p>
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