<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <section class="bg-white">
    <div class="lg:grid lg:min-h-screen lg:grid-cols-12">
      <aside class="relative block h-16 lg:order-last lg:col-span-5 lg:h-full xl:col-span-6">
        <img alt="gambar gym" src="img/hero/hero-1.jpg" class="absolute inset-0 h-full w-full object-cover" />
      </aside>

      <main class="flex items-center justify-center px-8 py-8 sm:px-12 lg:col-span-7 lg:px-16 lg:py-12 xl:col-span-6">
        <div class="max-w-xl lg:max-w-3xl">
          <img src="img/logoCelebes.png" alt="logo celebesgym" width="150px" height="70px">

          <h1 class="mt-6 text-2xl font-bold text-gray-900 sm:text-3xl md:text-4xl">
            Selamat Datang di Celebes GYM
          </h1>

          <p class="mt-4 leading-relaxed text-gray-500">
            Silakan login untuk melanjutkan.
          </p>

          <form method="post" class="mt-8 grid grid-cols-6 gap-6">
            <div class="col-span-6">
              <label for="username" class="block text-sm font-medium text-gray-700"> Username </label>
              <input type="text" id="username" name="username"
                class="mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm" />
            </div>

            <div class="col-span-6">
              <label for="password" class="block text-sm font-medium text-gray-700"> Password </label>
              <input type="password" id="password" name="password"
                class="mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm" />
            </div>

            <div class="col-span-6">
              <div id="loginAlert" hidden class="alert alert-danger" role="alert">
                Username atau password salah!
              </div>
            </div>

            <div class="col-span-6 sm:flex sm:items-center sm:gap-4">
              <button name="btnLogin"
                class="inline-block shrink-0 rounded-md border border-blue-600 bg-blue-600 px-12 py-3 text-sm font-medium text-white transition hover:bg-transparent hover:text-blue-600 focus:outline-none focus:ring active:text-blue-500">
                Login
              </button>

              <p class="mt-4 text-sm text-gray-500 sm:mt-0">
                Belum punya akun?
                <a href="registrasi.php" class="text-gray-700 underline">Register</a>.
              </p>
            </div>
          </form>
        </div>
      </main>
    </div>
  </section>
  <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
</body>

</html>

<?php
include "koneksi.php";
session_start();

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
      $_SESSION['username'] = $username;
      header("Location: dashboard.php");
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
