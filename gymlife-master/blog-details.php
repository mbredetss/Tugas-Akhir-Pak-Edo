<?php
include "koneksi.php";
session_start();
// Periksa apakah session username dan password ada
if (isset($_SESSION['username'])) {
    $usernames = $_SESSION['username'];
    $passwords = $_SESSION['password'];
    ?>

                            <?php
                            if (isset($_POST['submit'])) {
                                if (isset($_SESSION['username'])) {
                                    $nama = $_POST['nama'];
                                    $email = $_POST['email'];
                                    $comment = $_POST['comment'];
                                    $sql = "INSERT INTO komen VALUES ('','$nama', '$email', '$comment')";
                                    $conn->query($sql) === TRUE;
                                } else {
                                    
                                    echo "<script>alert('Silahkan login terlebih dahulu');</script>";
                                }
                            }

                            if (isset($_POST['delete_comment'])) {
                                $id = $_POST['comment_id'];
                                $sql_delete = "DELETE FROM komen WHERE id = $id";
                                $conn->query($sql_delete);
                            }
                            
                        
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
    <style>
        .red-heart {
    color: red;
}
    </style>
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
                                    <li><a href="./blog.php">Back to Article</a></li>
                                </ul>
                            </li>
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
                            <p>Proper nutrition is very important to support sports performance and speed up the body's recovery. Understanding what to eat before, during, 
                                and after exercise can help you achieve your fitness goals more effectively. The following is an explanation of the foods that should be consumed at each stage.</p>
                            <p>Pre-workout meals should contain complex carbohydrates, protein and a little fat to provide stable energy. Carbohydrates such as whole wheat bread, oatmeal, 
                                or fruit provide the body with the glucose it needs for energy. Adding protein, such as yogurt or eggs, helps in building and repairing muscle. 
                                Avoid foods that are high in fat or fiber because they can slow digestion and cause discomfort during exercise. Consume these foods about 2-3 hours before training for optimal results.</p>
                            <p>During physical activity, especially those lasting more than an hour, it is important to maintain hydration and replace lost electrolytes. Drinking water is the most important step, but for longer sessions, 
                                a sports drink containing electrolytes and carbohydrates can help maintain energy and prevent fatigue. 
                                If training is very intense or long, eating light snacks such as bananas or low-fat energy bars can also be beneficial.
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
                            <p>Recovery after exercise requires a combination of carbohydrates and protein to replenish depleted glycogen and repair damaged muscles. Consuming food within 30 minutes to two hours after exercise is most effective. Examples of good foods are smoothies with whey protein, fruits, 
                                and vegetables; or chicken with brown rice and green vegetables. Drinking plenty of water is also important to rehydrate after sweating during exercise.
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
                            <p>Protein is essential for muscle repair and growth. Before exercise, foods such as eggs, yogurt, or protein shakes provide the amino acids your muscles need. After exercise, protein helps repair damaged muscle fibers. 
                                Good sources of protein after exercise include lean meat, fish, nuts, or a protein shake. Adding a little healthy fat, such as from avocado or nuts, can also help in the recovery process.</p>
                            <p>Hydration is key to maintaining optimal performance and recovery after training. Before exercising, make sure your body is sufficiently hydrated by drinking enough water. During exercise, especially if it lasts longer than an hour, consider drinking a sports drink that contains electrolytes. 
                                After exercise, continue drinking water to replace lost fluids and support muscle recovery.
                                 Adding a small amount of salt to food or drinks can help replace electrolytes lost through sweat. By paying attention to what you eat before, during, and after exercise, you can improve your performance, speed recovery, and achieve your fitness goals more effectively.</p>
                        </div>
                        <div class="blog-details-tag-share">
                            <div class="tags">
                                <a href="#">Body buiding</a>
                                <a href="#">Yoga</a>
                                <a href="#">Weightloss</a>
                                <a href="#">Body Building</a>
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
                                <h5>Lena Sabrina.</h5>
                                <p>Welcome to my blog! Here, I will share experiences, knowledge and tips about the world of fitness, nutrition 
                                    and a healthy lifestyle.</p>
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
                            

    <div class="col-lg-6">
        <div class="comment-option">
            <h5 class="co-title">Comment</h5>
            <?php
            $sql_select = "SELECT id, nama, comment FROM komen ORDER BY id limit 4";
            $result_select = $conn->query($sql_select);
            if ($result_select->num_rows > 0) {
                while ($komen = $result_select->fetch_assoc()) {
                    ?>
                    <div class="co-item">
                        <div class="co-widget">
                        <a href="#" id="heart-icon"><i class="fa fa-heart-o" style="font-size: 18px;"></i></a>
                        <script>
        document.getElementById('heart-icon').addEventListener('click', function(event) {
            event.preventDefault();
            this.querySelector('i').classList.toggle('red-heart');
        });
    </script>                           
                            <form action="blog-details.php" method="post" style="display:inline;">
                                <input type="hidden" name="comment_id" value="<?= $komen['id'] ?>">
                                <button type="submit" name="delete_comment" style="background:none; border:none; padding:0; margin:0; cursor:pointer;">
                                    <i class="fa fa-trash" style="color: grey; font-size: 20px;"></i>
                                </button>
                            </form>
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
            } else {
                echo "<p>No comments yet.</p>";
            }
            ?>
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
                        <p>Jl. Abdullah Daeng Sirua No.84, Masale, Kec. Panakkukang, Kota Makassar, Sulawesi
                        Selatan,<br /> 90231</p>
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
                            <a href="#"><img src="img/logoCelebes.png" alt=""></a>
                        </div>
                        <p>Celebes Gym is a fitness center that provides modern facilities and professional services to
                            help you achieve your health and fitness goals.
                            With a variety of specially designed classes and programs, we are committed to providing the
                            best fitness experience for all our members..</p>
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
                            <li><a href="./blog.php">Blog</a></li>
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
    <script src="js/script.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>

</body>

</html>