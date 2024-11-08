<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Beasiswa Universitas Telemundo</title>
    <!-- CDN Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- CDN Alpine.js untuk handling interaksi JavaScript di Tailwind UI -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.4.2/dist/cdn.min.js"></script>
    <style>
        /* Custom color for Tailwind */
        .bg-custom-red { background-color: #D91E2A; }
        .text-custom-red { color: #D91E2A; }
        .hover\:bg-custom-red:hover { background-color: #B81A25; } /* warna hover yang lebih gelap */
    </style>
</head>
<body class="bg-white">

<div class="bg-white" x-data="{ open: false }">
  <!-- Header and Navigation -->
  <header class="absolute inset-x-0 top-0 z-50">
    <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
      <div class="flex lg:flex-1">
        <a href="#" class="-m-1.5 p-1.5">
          <span class="sr-only">Universitas Telemundo</span>
          <img class="h-8 w-auto" src="assets/images/logo.png" alt="Telemundo Logo">
        </a>
      </div>
      <div class="flex lg:hidden">
        <!-- Tambahkan Alpine.js untuk menu toggle -->
        <button type="button" @click="open = true" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
          <span class="sr-only">Open main menu</span>
          <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>
        </button>
      </div>
      <div class="hidden lg:flex lg:gap-x-12">
        <a href="#" class="text-sm font-semibold text-gray-900">Informasi Beasiswa</a>
        <a href="#" class="text-sm font-semibold text-gray-900">Panduan</a>
        
      </div>
      <div class="hidden lg:flex lg:flex-1 lg:justify-end">
        <a href="login.php" class="text-sm font-semibold text-gray-900">Login <span aria-hidden="true">&rarr;</span></a>
      </div>
    </nav>

    <!-- Mobile menu -->
    <div x-show="open" @click.away="open = false" class="lg:hidden" role="dialog" aria-modal="true">
      <!-- Background overlay, for mobile menu -->
      <div class="fixed inset-0 z-50"></div>
      <div class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
        <div class="flex items-center justify-between">
          <a href="#" class="-m-1.5 p-1.5">
            <span class="sr-only">Kampus XYZ</span>
            <img class="h-8 w-auto" src="https://tailwindui.com/plus/img/logos/mark.svg?color=indigo&shade=600" alt="Logo Kampus XYZ">
          </a>
          <!-- Tombol X untuk menutup menu -->
          <button type="button" @click="open = false" class="-m-2.5 rounded-md p-2.5 text-gray-700">
            <span class="sr-only">Close menu</span>
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
        <div class="mt-6 flow-root">
          <div class="-my-6 divide-y divide-gray-500/10">
            <div class="space-y-2 py-6">
              <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold text-gray-900 hover:bg-gray-50">Informasi Beasiswa</a>
              <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold text-gray-900 hover:bg-gray-50">Panduan</a>
              <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold text-gray-900 hover:bg-gray-50">Tentang Kami</a>
            </div>
            <div class="py-6">
              <a href="login.php" class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold text-gray-900 hover:bg-gray-50">Login</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Hero Section -->
  <div class="relative isolate px-4 pt-20 lg:px-6">
    <div class="mx-auto max-w-xl py-20 sm:py-24 lg:py-32">
      <div class="text-center">
        <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl">Dukung Masa Depan Anda dengan Beasiswa</h1>
        <p class="mt-4 text-base leading-6 text-gray-600">Portal beasiswa Universitas Telemundo menyediakan berbagai program beasiswa untuk mahasiswa berprestasi dan yang membutuhkan dukungan finansial.</p>
        <div class="mt-6 flex items-center justify-center gap-x-4">
          <a href="informasi_beasiswa.php" class="rounded-md bg-custom-red px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-custom-red focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-custom-red">Daftar Sekarang</a>
          <a href="#" class="text-sm font-semibold text-gray-900">Pelajari lebih lanjut <span aria-hidden="true">→</span></a>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>