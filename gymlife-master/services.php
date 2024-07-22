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

    //masa membership
    $sqlCekMembership = "SELECT * FROM langganan WHERE username = '$usernames'";
    $queryCekMembership = mysqli_query($conn, $sqlCekMembership);
    if (mysqli_num_rows($queryCekMembership) > 0) {
        //waktu sekarang
        $date = date('Y-m-d');
        // waktu membership
        $sqlMembership = "SELECT ABS(DATEDIFF('$date', langganan_berakhir)) AS membership FROM langganan WHERE username = '$usernames'";
        $queryMembership = mysqli_query($conn, $sqlMembership);
        if (!$queryMembership) {
            die("Query gagal membership: " . mysqli_error($conn));
        }
        $masaMembershipRow = mysqli_fetch_assoc($queryMembership);
        $masaMembership = $masaMembershipRow['membership'];
    } else {
        $masaMembership = 0;
    }
    ?>
    <script>
        function confirmSubscription() {
            var result = confirm("Apakah Anda yakin ingin melanjutkan langganan?");
            if (result) {
                document.getElementById('subscriptionForm').submit();
            } else {
                event.preventDefault();
            }
        }
    </script>
    <?php
}

//Jika user belum melakukan login maka akan di arahkan login terlebih dahulu
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
}

if (isset($_POST['btn3Month'])) {
    $biaya = 350000;
    $kelas = "SINGLE CLASS";
    if ($biaya >= $saldo) {
        ?>
        <script>
            alert("SALDO ANDA TIDAK CUKUP!");
        </script>
        <?php
        die();
    } else {
        // Inisialisasi tanggal saat ini
        $tanggalLangganan = new DateTime(); // Tanggal saat ini
        // Tambahkan 30 hari ke tanggal saat ini
        $tanggalLangganan->modify('+90 days');
        // Format tanggal baru
        $tanggalBerakhir = $tanggalLangganan->format('Y-m-d'); // Ubah format menjadi Y-m-d
        $date = date('Y-m-d'); // Ubah format menjadi Y-m-d

        //upload usernames, date, tanggal berakhir ke table langganan
        $sqlLangganan = "INSERT INTO langganan (username, kelas, tanggal_langganan, langganan_berakhir) VALUES ('$usernames', '$kelas', '$date', '$tanggalBerakhir')";
        $queryLangganan = mysqli_query($conn, $sqlLangganan);
        if (!$queryLangganan) {
            die("Query langganan gagal: " . mysqli_error($conn));
        }

        //UPDATE SALDO DI DATABASE
        $sqlUpdateSaldo = "UPDATE user SET saldo = saldo - $biaya WHERE username = $usernames";
        $queryUpdateSaldo = mysqli_query($conn, $sqlUpdateSaldo);
        if (!$queryUpdateSaldo) {
            die("Query Update saldo gagal: " . mysqli_error($conn));
        }
        //UPDATE SALDO DI TAMPILAN
        $saldo -= $biaya;
        header("Location: index.php");
    }
}

if (isset($_POST['btn6Month'])) {
    $biaya = 600000;
    $kelas = "DOUBLE CLASS";
    if ($biaya >= $saldo) {
        ?>
        <script>
            alert("SALDO ANDA TIDAK CUKUP!");
        </script>
        <?php
        die();
    } else {
        // Inisialisasi tanggal saat ini
        $tanggalLangganan = new DateTime(); // Tanggal saat ini
        // Tambahkan 30 hari ke tanggal saat ini
        $tanggalLangganan->modify('+180 days');
        // Format tanggal baru
        $tanggalBerakhir = $tanggalLangganan->format('Y-m-d'); // Ubah format menjadi Y-m-d
        $date = date('Y-m-d'); // Ubah format menjadi Y-m-d

        //upload usernames, date, tanggal berakhir ke table langganan
        $sqlLangganan = "INSERT INTO langganan (username, kelas, tanggal_langganan, langganan_berakhir) VALUES ('$usernames', '$kelas', '$date', '$tanggalBerakhir')";
        $queryLangganan = mysqli_query($conn, $sqlLangganan);
        if (!$queryLangganan) {
            die("Query langganan gagal: " . mysqli_error($conn));
        }

        //UPDATE SALDO DI DATABASE
        $sqlUpdateSaldo = "UPDATE user SET saldo = saldo - $biaya WHERE username = $usernames";
        $queryUpdateSaldo = mysqli_query($conn, $sqlUpdateSaldo);
        if (!$queryUpdateSaldo) {
            die("Query Update saldo gagal: " . mysqli_error($conn));
        }
        //UPDATE SALDO DI TAMPILAN
        $saldo -= $biaya;
        header("Location: index.php");
    }
}

if (isset($_POST['btn1Year'])) {
    $biaya = 1150000;
    $kelas = "SPECIAL CLASS";
    if ($biaya >= $saldo) {
        ?>
        <script>
            alert("SALDO ANDA TIDAK CUKUP!");
        </script>
        <?php
        die();
    } else {
        // Inisialisasi tanggal saat ini
        $tanggalLangganan = new DateTime(); // Tanggal saat ini
        // Tambahkan 30 hari ke tanggal saat ini
        $tanggalLangganan->modify('+365 days');
        // Format tanggal baru
        $tanggalBerakhir = $tanggalLangganan->format('Y-m-d'); // Ubah format menjadi Y-m-d
        $date = date('Y-m-d'); // Ubah format menjadi Y-m-d

        //upload usernames, date, tanggal berakhir ke table langganan
        $sqlLangganan = "INSERT INTO langganan (username, kelas, tanggal_langganan, langganan_berakhir) VALUES ('$usernames', '$kelas', '$date', '$tanggalBerakhir')";
        $queryLangganan = mysqli_query($conn, $sqlLangganan);
        if (!$queryLangganan) {
            die("Query langganan gagal: " . mysqli_error($conn));
        }

        //UPDATE SALDO DI DATABASE
        $sqlUpdateSaldo = "UPDATE user SET saldo = saldo - $biaya WHERE username = $usernames";
        $queryUpdateSaldo = mysqli_query($conn, $sqlUpdateSaldo);
        if (!$queryUpdateSaldo) {
            die("Query Update saldo gagal: " . mysqli_error($conn));
        }
        //UPDATE SALDO DI TAMPILAN
        $saldo -= $biaya;
        header("Location: index.php");
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
                            <li><a href="./class-details.php">Classes</a></li>
                            <li class="active"><a href="./services.php">Services</a></li>
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
                                    <p class="flex w-full items-center gap-2 rounded-lg px-4 py-2 text-sm "
                                        role="menuitem">
                                        Masa aktif: <?php echo +$masaMembership; ?> hari
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
                        <h2>Services</h2>
                        <div class="bt-option">
                            <a href="./index.php">Home</a>
                            <span>Services</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Services Section Begin -->
    <section class="services-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>What we do?</span>
                        <h2>PUSH YOUR LIMITS FORWARD</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 order-lg-1 col-md-6 p-0">
                    <div class="ss-pic">
                        <img src="img/services/yoga.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-3 order-lg-2 col-md-6 p-0">
                    <div class="ss-text">
                        <h4>Yoga</h4>
                        <p>Yoga is a holistic practice that combines physical postures, breath control, meditation, and
                            ethical principles to promote overall well-being. </p>
                        <a href="class-details.php">Explore</a>
                    </div>
                </div>
                <div class="col-lg-3 order-lg-3 col-md-6 p-0">
                    <div class="ss-pic">
                        <img src="img/services/cardio.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-3 order-lg-4 col-md-6 p-0">
                    <div class="ss-text">
                        <h4>Cardio</h4>
                        <p>Cardio exercise is a type of physical exercise that increases heart rate and breathing.</p>
                        <a href="#">Explore</a>
                    </div>
                </div>
                <div class="col-lg-3 order-lg-8 col-md-6 p-0">
                    <div class="ss-pic">
                        <img src="img/services/services-4.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-3 order-lg-7 col-md-6 p-0">
                    <div class="ss-text second-row">
                        <h4>Body Building</h4>
                        <p>Bodybuilding is a physical activity that focuses on muscle development and body definition.
                        </p>
                        <a href="#">Explore</a>
                    </div>
                </div>
                <div class="col-lg-3 order-lg-6 col-md-6 p-0">
                    <div class="ss-pic">
                        <img src="img/services/services-3.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-3 order-lg-5 col-md-6 p-0">
                    <div class="ss-text second-row">
                        <h4>Weight Loss</h4>
                        <p>Weight loss is the process of reducing the amount of body fat.</p>
                        <a href="#">Explore</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Services Section End -->

    <!-- Banner Section Begin -->
    <section class="banner-section set-bg" data-setbg="img/banner-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="bs-text service-banner">
                        <h2>Exercise until the body obeys.</h2>
                        <div class="bt-tips">Where health, beauty and fitness meet.</div>
                        <a href="./video/video.mp4" class="play-btn video-popup"><i class="fa fa-caret-right"></i></a>
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
                            <button onclick="confirmSubscription()" type="submit" class="btnLangganan text-orange-500"
                                name="btn3Month">
                                <a class="primary-btn pricing-btn">Enroll now</a>
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
                            <button onclick="confirmSubscription()" class="btnLangganan text-orange-500"
                                name="btn6Month">
                                <a class="primary-btn pricing-btn ">Enroll now</a>
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
                            <button onclick="confirmSubscription()" class="btnLangganan text-orange-500"
                                name="btn1Year">
                                <a class="primary-btn pricing-btn">Enroll now</a>
                            </button>
                        </div>
                    </div>
                </div>
        </div>
    </section>
    <!-- Pricing Section End -->

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
                            <a href="https://youtu.be/FOJHzV5ERgQ?si=9oxEa6r1_nlYvDbs"><i
                                    class="fa fa-youtube-play"></i></a>
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
                            <h6><a href="./blog.php">Fitness: The best exercise to lose belly fat and tone up...</a>
                            </h6>
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