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
    <title>Gym | template</title>

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
                <li><a href="./class-details.html">Classes</a></li>
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
                            <li><a href="./index.php">Home</a></li>
                            <li><a href="./about-us.php">About Us</a></li>
                            <li><a href="./class-details.php">Classes</a></li>
                            <li><a href="./services.php">Services</a></li>
                            <li><a href="./team.php">Our Team</a></li>
                            <li class="active"><a href="./blog.php">Article</a>
                                <ul class="dropdown">
                                    <li><a href="./blog.html">Back to Article</a></li>
                                </ul>
                            </li>
                            <li><a href="./contact.html">Contact</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="top-option">
                        <div class="relative">
                            <a href="registrasi.php" class="sign-in-btn">Sign In</a>
                            <a id="btnProfile" class="user-profile fa fa-user">
                            </a>
                            <div id="listOption" hidden
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
                                    <form method="POST" action="#">
                                        <button type="submit"
                                            class="flex w-full items-center gap-2 rounded-lg px-4 py-2 text-sm text-red-700 hover:bg-red-50"
                                            role="menuitem">
                                            Logout
                                        </button>
                                    </form>
                                </div>
                            </div>
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

    <!-- Blog Details Hero Section Begin -->
    <section class="blog-details-hero set-bg" data-setbg="img/blog/details/details-hero.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 p-0 m-auto">
                    <div class="bh-text">
                        <h3>Workout nutrition explained. What to eat before, during, and after exercise.</h3>
                        <ul>
                            <li>by Admin</li>
                            <li>Aug,15, 2019</li>
                            <li>20 Comment</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Hero Section End -->

    <!-- Blog Details Section Begin -->
    <section class="blog-details-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 p-0 m-auto">
                    <div class="blog-details-text">
                        <div class="blog-details-title">
                            <p>Nutrition plays an important role in your exercise performance, muscle recovery, and
                                achieving fitness goals.
                                What you eat before, during, and after exercise can significantly impact your workout
                                results.
                                This article will provide a practical guide to sports nutrition, explaining what you
                                need to consume in each
                                phase of training to maximize results and maintain a healthy body.</p>
                            <p>Food intake before exercise is very important to provide the energy the body needs during
                                exercise.
                                Ideally, consume foods rich in complex carbohydrates and a little protein 1-2 hours
                                before exercise.
                                For example, you can choose brown rice with grilled chicken or whole wheat toast with
                                eggs.</p>
                            <p>Selama berolahraga, terutama untuk sesi latihan intensitas tinggi atau durasi panjang,
                                penting untuk menjaga asupan cairan dan energi.
                                Minumlah air secara teratur untuk menghindari dehidrasi. Anda juga dapat mengonsumsi
                                minuman olahraga yang mengandung elektrolit
                                dan karbohidrat sederhana untuk membantu mempertahankan energi.
                            </p>
                        </div>
                        <div class="blog-details-pic">
                            <div class="blog-details-pic-item">
                                <img src="./img/blog/details/det-1.jpg" alt="">
                            </div>
                            <div class="blog-details-pic-item">
                                <img src="img/blog/details/det-2.jpg" alt="">
                            </div>
                        </div>
                        <div class="blog-details-desc">
                            <p>Dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                                et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                                laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit
                                in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat
                                cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                            </p>
                        </div>
                        <div class="blog-details-quote">
                            <div class="quote-icon">
                                <img src="img/blog/details/quote-left.png" alt="">
                            </div>
                            <h5>The whole family of tiny legumes, whether red, green, yellow, or black, offers so many
                                possibilities to create an exciting lunch.</h5>
                            <span>MEIKE PETERS</span>
                        </div>
                        <div class="blog-details-more-desc">
                            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                                dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt
                                in. . Sed ut perspiciatis unde omnis iste natus error sit voluptatem.</p>
                            <p>laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure Lorem ipsum dolor sit
                                amet, consectetur adipisicing elit, sed eiusmod tempor incididunt laboris nisi ut
                                aliquip commodo consequat. Class aptent taciti sociosqu ad litora torquent per conubia
                                nostra, per inceptos himenaeos. Mauris vel magna ex. Integer gravida tincidunt accumsan.
                                Vestibulum nulla mauris, condimentum id felis ac, volutpat volutpat mi qui dolorem.</p>
                        </div>
                        <div class="blog-details-tag-share">
                            <div class="tags">
                                <a href="#">Body buiding</a>
                                <a href="#">Yoga</a>
                                <a href="#">Weightloss</a>
                                <a href="#">Streching</a>
                            </div>
                            <div class="share">
                                <span>Share</span>
                                <a href="#"><i class="fa fa-facebook"></i> 82</a>
                                <a href="#"><i class="fa fa-twitter"></i> 24</a>
                                <a href="#"><i class="fa fa-envelope"></i> 08</a>
                            </div>
                        </div>
                        <div class="blog-details-author">
                            <div class="ba-pic">
                                <img src="img/blog/details/blog-profile.jpg" alt="">
                            </div>
                            <div class="ba-text">
                                <h5>Lena Mollein.</h5>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                    exercitation.</p>
                                <div class="bp-social">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-google-plus"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-youtube-play"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="leave-comment">
                                    <h5>Leave a comment</h5>
                                    <form action="blog-details.php" method="post">
                                        <input name="nama" type="text" placeholder="Name">
                                        <input name="email" type="text" placeholder="Email">
                                        <textarea name="comment" placeholder="Comment"></textarea>
                                        <button name="submit" type="submit">Submit</button>
                                    </form>
                                </div>
                            </div>
                            <?php
                            if (isset($_POST['submit'])) {
                                if (isset($_SESSION['username'])) {
                                    $nama = $_POST['nama'];
                                    $email = $_POST['email'];
                                    $comment = $_POST['comment'];
                                    $sql = "INSERT INTO komen VALUES ('','$nama', '$email', '$comment')";
                                    $conn->query($sql) === TRUE;
                                }
                                else {
                                    ?>
                                    <script>
                                        alert("Silahkan login terlebih dahulu");
                                    </script>
                                    <?php
                                }
                            }
                            ?>

                            <div class="col-lg-6">
                                <div class="comment-option">
                                    <h5 class="co-title">Comment</h5>
                                    <?php
                                    $sql_select = "SELECT nama, comment FROM komen ORDER BY id";
                                    $result_select = $conn->query($sql_select);
                                    if ($result_select->num_rows === 0) {
                                        ?>
                                        <?php
                                    } else {
                                        while ($komen = $result_select->fetch_assoc()) {
                                            ?>
                                            <div class="co-item">
                                                <div class="co-widget">
                                                    <a href="#"><i class="fa fa-heart-o"></i></a>
                                                    <a href="#"><i class="fa fa-share-square-o"></i></a>
                                                </div>
                                                <div class="co-pic">
                                                    <img src="img/blog/details/comment-1.jpg" alt="">
                                                    <h5><?= $komen['nama'] ?></h5>
                                                </div>
                                                <div class="co-text">
                                                    <p><?= $komen['comment'] ?></p>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Section End -->

    <!-- Get In Touch Section Begin -->
    <div class="gettouch-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="gt-text">
                        <i class="fa fa-map-marker"></i>
                        <p>333 Middle Winchendon Rd, Rindge,<br /> NH 03461</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="gt-text">
                        <i class="fa fa-mobile"></i>
                        <ul>
                            <li>(0411) 123-4567</li>
                            <li>+62 812-3456-7890</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
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
                            <a href="#"><img src="img/logo.png" alt=""></a>
                        </div>
                        <p>Celebes Gym is a fitness center that provides modern facilities and professional services to
                            help you achieve your health and fitness goals.
                            With a variety of specially designed classes and programs, we are committed to providing the
                            best fitness experience for all our members..</p>
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

    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/masonry.pkgd.min.js"></script>
    <script src="js/jquery.barfiller.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>



</body>

</html>