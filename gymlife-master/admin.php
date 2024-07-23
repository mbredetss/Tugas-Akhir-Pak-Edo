<?php
include "koneksi.php";

if (isset($_POST['btnSaldo'])) {
  $username = $_POST['username'];
  $jumlahSaldo = $_POST['saldo'];

  // Pengecekan apakah username tersedia atau tidak
  $sqlCekUsernameAvailable = "SELECT username FROM registrasi";
  $CekUsernameAvailable = mysqli_query($conn, $sqlCekUsernameAvailable);
  if (!$CekUsernameAvailable) {
    die("Query Cek Username gagal: " . mysqli_error($conn));
  }
  while ($cek = $CekUsernameAvailable->fetch_assoc()) {
    if ($cek['username'] == $username) {
      $sqlAddSaldo = "UPDATE user SET saldo = $jumlahSaldo WHERE username = $username";
      $queryAddSaldo = mysqli_query($conn, $sqlAddSaldo);
      if (!$queryAddSaldo) {
        die("Query add saldo Gagal: " . mysqli_error($conn));
      }
    } else {
      ?>
      <script>
        document.getElementById('alert3').removeAttribute('hidden');
      </script>
      <?php
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>admin</title>
</head>

<body>

  <div id="accordion-collapse" data-accordion="collapse">
    <h2 id="accordion-collapse-heading-1">
      <button type="button"
        class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3"
        data-accordion-target="#accordion-collapse-body-1" aria-expanded="true"
        aria-controls="accordion-collapse-body-1">
        <span>CONTACT LOG</span>
        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
          xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M9 5 5 1 1 5" />
        </svg>
      </button>
    </h2>
    <div id="accordion-collapse-body-1" class="hidden" aria-labelledby="accordion-collapse-heading-1">
      <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <th scope="col" class="px-6 py-3">
                No
              </th>
              <th scope="col" class="px-6 py-3">
                Nama
              </th>
              <th scope="col" class="px-6 py-3">
                Email
              </th>
              <th scope="col" class="px-6 py-3">
                Pesan
              </th>
              <th scope="col" class="px-6 py-3">
                Waktu
              </th>
            </tr>
          </thead>



          <tbody>
            <?php
            $sqlSelect = "SELECT * FROM contact ORDER BY waktu DESC";
            $resultSelect = $conn->query($sqlSelect);
            if (!$resultSelect) {
              die("Error Select: " . mysqli_error($conn));
            }

            while ($contact = $resultSelect->fetch_assoc()) {
              ?>
              <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                  <?= $contact['no'] ?>
                </th>
                <td class="px-6 py-4">
                  <?= $contact['nama'] ?>
                </td>
                <td class="px-6 py-4">
                  <?= $contact['email'] ?>
                </td>
                <td class="px-6 py-4">
                  <?= $contact['komentar'] ?>
                </td>
                <td class="px-6 py-4">
                  <?= $contact['waktu'] ?>
                </td>
                <td class="px-6 py-4">
                  <form method="post">
                    <button name="btndelete<?php echo $contact['no']; ?>">
                      <!-- Base -->
                      <a class="group relative inline-block text-sm font-medium text-white focus:outline-none focus:ring">
                        <span class="absolute inset-0 border border-red-600 group-active:border-red-500"></span>
                        <span
                          class="block border border-red-600 bg-red-600 px-12 py-3 transition-transform active:border-red-500 active:bg-red-500 group-hover:-translate-x-1 group-hover:-translate-y-1">
                          DELETE
                        </span>
                      </a>
                    </button>
                  </form>
                </td>
              </tr>
              <?php
              if (isset($_POST['btndelete' . $contact['no']])) {
                $no = $contact['no'];
                $queryDelete = "DELETE FROM contact WHERE no = $no";
                $sqlDelete = $conn->query($queryDelete);
                if (!$sqlDelete) {
                  die("Error Delete: " . mysqli_error($conn));
                }
              }
            }
            ?>


          </tbody>
        </table>
      </div>
    </div>
    <h2 id="accordion-collapse-heading-2">
      <button type="button"
        class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3"
        data-accordion-target="#accordion-collapse-body-2" aria-expanded="false"
        aria-controls="accordion-collapse-body-2">
        <span>ISI SALDO</span>
        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
          xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M9 5 5 1 1 5" />
        </svg>
      </button>
    </h2>

    <form method="post">
      <div id="accordion-collapse-body-2" class="hidden" aria-labelledby="accordion-collapse-heading-2">
        <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700">
          <div class="relative mb-3" data-twe-input-wrapper-init>
            <input type="text" name="username"
              class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[twe-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-white dark:placeholder:text-neutral-300 dark:autofill:shadow-autofill dark:peer-focus:text-primary [&:not([data-twe-input-placeholder-active])]:placeholder:opacity-0"
              id="exampleFormControlInput1" placeholder="Example label" />
            <label for="exampleFormControlInput1"
              class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[twe-input-state-active]:-translate-y-[0.9rem] peer-data-[twe-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-400 dark:peer-focus:text-primary">Username
            </label>
          </div>
        </div>

        <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700">
          <div class="relative mb-3" data-twe-input-wrapper-init>
            <input type="text" name="saldo"
              class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[twe-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-white dark:placeholder:text-neutral-300 dark:autofill:shadow-autofill dark:peer-focus:text-primary [&:not([data-twe-input-placeholder-active])]:placeholder:opacity-0"
              id="exampleFormControlInput1" placeholder="Example label" />
            <label for="exampleFormControlInput1"
              class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[twe-input-state-active]:-translate-y-[0.9rem] peer-data-[twe-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-400 dark:peer-focus:text-primary">Jumlah
              Saldo
            </label>
          </div>
          <button type="submit" name="btnSaldo"
            class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Isi
            Saldo</button>
          <div class="col-span-6">
            <div id="alert3" hidden class="alert alert-danger" role="alert">
              Username belum terdaftar!
            </div>
          </div>
        </div>
      </div>
    </form>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
</body>

</html>