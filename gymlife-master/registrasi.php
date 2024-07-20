<?php 
include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrasi</title>

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
            Isi formulir dengan benar!
          </p>

          <form method="post" class="mt-8 grid grid-cols-6 gap-6">
            <div class="col-span-6 sm:col-span-3">
              <label for="Nama" class="block text-sm font-medium text-gray-700">
                Nama
              </label>

              <input type="text" id="nama" name="nama"
                class="mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm" />
            </div>

            <div class="col-span-6 sm:col-span-3">
              <label for="Stambuk" class="block text-sm font-medium text-gray-700">
                Stambuk
              </label>

              <input type="text" id="stambuk" name="stambuk"
                class="mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm" />
            </div>

            <div class="col-span-6 sm:col-span-3">
              <label for="Alamat" class="block text-sm font-medium text-gray-700">
                Alamat
              </label>

              <input type="text" id="alamat" name="alamat"
                class="mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm" />
            </div>

            <div class="col-span-6 sm:col-span-3">
              <label for="tanggalLahir" class="block text-sm font-medium text-gray-700">
                Tanggal Lahir
              </label>

              <input type="date" id="tanggalLahir" name="tanggalLahir"
                class="mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm" />
            </div>

            <div class="col-span-6">
              <label for="Username" class="block text-sm font-medium text-gray-700"> Username </label>

              <input type="text" id="username" name="username"
                class="mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm" />
            </div>

            <div class="col-span-6 sm:col-span-3">
              <label for="Password" class="block text-sm font-medium text-gray-700"> Password </label>

              <input type="password" id="password" name="password"
                class="mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm" />
            </div>

            <div class="col-span-6 sm:col-span-3">
              <label for="PasswordConfirmation" class="block text-sm font-medium text-gray-700">
                Password Confirmation
              </label>

              <input type="password" id="passwordConfirmation" name="password_confirmation"
                class="mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm" />
            </div>

            <div class="col-span-6">
              <div id="alert" hidden class="alert alert-danger" role="alert">
                Password yang Anda masukkan tidak sama! Silahkan ulangi lagi
              </div>
            </div>

            <div class="col-span-6">
              <div id="alert2" hidden class="alert alert-danger" role="alert">
                Masukkan formulir dengan valid!
              </div>
            </div>

            <div class="col-span-6 sm:flex sm:items-center sm:gap-4">
              <button name="btnkonfirmasi"
                class="inline-block shrink-0 rounded-md border border-blue-600 bg-blue-600 px-12 py-3 text-sm font-medium text-white transition hover:bg-transparent hover:text-blue-600 focus:outline-none focus:ring active:text-blue-500">
                Konfirmasi
              </button>

              <p class="mt-4 text-sm text-gray-500 sm:mt-0">
                Sudah punya akun?
                <a href="index.php" class="text-gray-700 underline">Log in</a>.
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
if (isset($_POST["btnkonfirmasi"])) {
  $nama = $_POST["nama"];
  $stambuk = $_POST["stambuk"];
  $username = $_POST["username"];
  $password = $_POST["password"];
  $alamat = $_POST["alamat"];
  $tanggalLahir = $_POST["tanggalLahir"];
  $passwordConfirmation = $_POST["password_confirmation"];

  if ($nama == NULL || $stambuk == NULL || $username == NULL || $password == NULL || $alamat == NULL || $tanggalLahir == NULL || $passwordConfirmation == NULL) {
    ?>
    <script>
      document.getElementById('alert2').removeAttribute('hidden');
    </script>
    <?php
  } else {
    // Pengecekan password sama atau tidak
    if ($password == $passwordConfirmation) {
      $sqlRegistrasi = "INSERT INTO registrasi VALUES('', '$stambuk', '$username', '$password')";
      $sqlMahasiswa = "INSERT INTO mahasiswa VALUES('','$stambuk', '$nama', '$alamat', '$tanggalLahir')";
      // Upload no(Auto Increment), stambuk, username, password ke database registrasi
      $queryRegistrasi = mysqli_query($conn, $sqlRegistrasi);
      if (!$queryRegistrasi) {
        die("Query gagal: " . mysqli_error($conn));
      }
      // Upload no(Auto Increment), stambuk, nama, alamat, tanggal_lahir ke database mahasiswa
      $queryMahasiswa = mysqli_query($conn, $sqlMahasiswa);
      if (!$queryMahasiswa) {
        die("Query gagal: " . mysqli_error($conn));
      }
    }
    // 
    else {
      ?>
      <script>
        document.getElementById('alert').removeAttribute('hidden');
      </script>
      <?php
    }
  }
}
?>