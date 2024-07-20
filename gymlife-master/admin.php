<?php
include "koneksi.php";
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
            $sqlSelect = "SELECT * FROM contact";
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
                    <a class="group relative inline-block text-sm font-medium text-white focus:outline-none focus:ring"
                      >
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
              if (isset($_POST['btndelete'. $contact['no']])) {
                $no = $contact['no'];
                $queryDelete = "DELETE FROM contact WHERE no = $no";
                $sqlDelete = $conn->query($queryDelete);
                if (!$sqlDelete) {
                  die("Error Delete: ". mysqli_error($conn));
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
        <span>Is there a Figma file available?</span>
        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
          xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M9 5 5 1 1 5" />
        </svg>
      </button>
    </h2>
    <div id="accordion-collapse-body-2" class="hidden" aria-labelledby="accordion-collapse-heading-2">
      <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700">
        <p class="mb-2 text-gray-500 dark:text-gray-400">Flowbite is first conceptualized and designed using the Figma
          software so everything you see in the library has a design equivalent in our Figma file.</p>
        <p class="text-gray-500 dark:text-gray-400">Check out the <a href="https://flowbite.com/figma/"
            class="text-blue-600 dark:text-blue-500 hover:underline">Figma design system</a> based on the utility
          classes from Tailwind CSS and components from Flowbite.</p>
      </div>
    </div>
    <h2 id="accordion-collapse-heading-3">
      <button type="button"
        class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3"
        data-accordion-target="#accordion-collapse-body-3" aria-expanded="false"
        aria-controls="accordion-collapse-body-3">
        <span>What are the differences between Flowbite and Tailwind UI?</span>
        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
          xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M9 5 5 1 1 5" />
        </svg>
      </button>
    </h2>
    <div id="accordion-collapse-body-3" class="hidden" aria-labelledby="accordion-collapse-heading-3">
      <div class="p-5 border border-t-0 border-gray-200 dark:border-gray-700">
        <p class="mb-2 text-gray-500 dark:text-gray-400">The main difference is that the core components from Flowbite
          are open source under the MIT license, whereas Tailwind UI is a paid product. Another difference is that
          Flowbite relies on smaller and standalone components, whereas Tailwind UI offers sections of pages.</p>
        <p class="mb-2 text-gray-500 dark:text-gray-400">However, we actually recommend using both Flowbite, Flowbite
          Pro, and even Tailwind UI as there is no technical reason stopping you from using the best of two worlds.</p>
        <p class="mb-2 text-gray-500 dark:text-gray-400">Learn more about these technologies:</p>
        <ul class="ps-5 text-gray-500 list-disc dark:text-gray-400">
          <li><a href="https://flowbite.com/pro/" class="text-blue-600 dark:text-blue-500 hover:underline">Flowbite
              Pro</a></li>
          <li><a href="https://tailwindui.com/" rel="nofollow"
              class="text-blue-600 dark:text-blue-500 hover:underline">Tailwind UI</a></li>
        </ul>
      </div>
    </div>
  </div>

  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
</body>

</html>