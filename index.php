<?php include 'header.php';
include 'koneksi.php'; ?>
<!-- HERO -->
<section id="home"
  class="h-screen flex items-center justify-center text-center px-6 bg-[url('assets/img/herosection.jpg')] bg-cover bg-center">
  <div class="bg-black/50 p-10 rounded-2xl text-white max-w-xl">
    <h1 class="text-4xl md:text-5xl font-bold mb-4">
      Fresh Bakery Everyday
    </h1>
    <p class="mb-6">Roti & cake premium, fresh langsung dari oven 🍞</p>
    <a href="#produk" class="bg-amber-500 hover:bg-amber-600 px-6 py-3 rounded-lg">
      Lihat Menu
    </a>
  </div>
</section>

<!-- ABOUT -->
<section id="about" class="pt-32 pb-20 px-6 bg-white">
  <div class="max-w-5xl mx-auto grid md:grid-cols-2 gap-10 items-center">
    <img src="https://source.unsplash.com/500x400/?bakery,kitchen" class="rounded-2xl shadow" />

    <div>
      <h2 class="text-3xl font-semibold mb-4">Tentang Kami</h2>
      <p class="mb-4">
        Sweet Bakery menghadirkan roti dan cake berkualitas premium dengan
        bahan terbaik tanpa pengawet.
      </p>
      <p>Kami percaya setiap gigitan harus memberikan kebahagiaan ✨</p>
    </div>
  </div>
</section>

<!-- KEUNGGULAN -->
<section class="py-10 text-center px-6">
  <h2 class="text-3xl font-semibold mb-12">Kenapa Kami?</h2>

  <div class="grid md:grid-cols-4 gap-8 max-w-5xl mx-auto">
    <div class="bg-white p-6 rounded-xl shadow">
      <p class="text-2xl mb-2">🍞</p>
      <p>Fresh setiap hari</p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow">
      <p class="text-2xl mb-2">🌿</p>
      <p>Tanpa pengawet</p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow">
      <p class="text-2xl mb-2">🎂</p>
      <p>Custom cake</p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow">
      <p class="text-2xl mb-2">💰</p>
      <p>Harga terjangkau</p>
    </div>
  </div>
</section>

<!-- PRODUK -->
<section id="produk" class="pt-32 pb-20 px-6 bg-neutral-900 text-white">
  <h2 class="text-3xl font-semibold text-center mb-12">Produk Favorit</h2>
  <div class="grid md:grid-cols-3 gap-10 max-w-6xl mx-auto ">
    <!-- CROISSANT -->
    <div class="bg-neutral-600 text-white rounded-2xl shadow-lg overflow-hidden hover:-translate-y-2 transition">
      <img src="https://source.unsplash.com/400x300/?croissant" class="w-full" />
      <div class="p-5 text-center">
        <h3 class="text-lg font-semibold">Croissant Butter</h3>
        <p class="text-orange-300 text-sm mb-2">Lembut & Flaky</p>

        <div class="flex justify-center items-center gap-3 mt-3">
          <button onclick="decrease('croissant')" class="bg-gray-300 px-3 py-1 rounded">
            -
          </button>
          <span id="qty-croissant">0</span>
          <button onclick="increase('croissant', 15000, 'Croissant Butter')"
            class="bg-amber-500 text-white px-3 py-1 rounded">
            +
          </button>
        </div>
      </div>
    </div>

    <!-- DONAT -->
    <div class="bg-neutral-600 text-white rounded-2xl shadow-lg overflow-hidden hover:-translate-y-2 transition">
      <img src="https://source.unsplash.com/400x300/?donut" class="w-full" />
      <div class="p-5 text-center">
        <h3 class="text-lg font-semibold">Donat Glaze</h3>
        <p class="text-orange-300 text-sm mb-2">Manis & lembut</p>

        <div class="flex justify-center items-center gap-3 mt-3">
          <button onclick="decrease('donat')" class="bg-gray-300 px-3 py-1 rounded">
            -
          </button>
          <span id="qty-donat">0</span>
          <button onclick="increase('donat', 10000, 'Donat Glaze')" class="bg-amber-500 text-white px-3 py-1 rounded">
            +
          </button>
        </div>
      </div>
    </div>

    <!-- CHEESE CAKE -->
    <div class="bg-neutral-600 text-white rounded-2xl shadow-lg overflow-hidden hover:-translate-y-2 transition">
      <img src="https://source.unsplash.com/400x300/?cake" class="w-full" />
      <div class="p-5 text-center">
        <h3 class="text-lg font-semibold">Cheese Cake</h3>
        <p class="text-orange-300 text-sm mb-2">Creamy premium</p>

        <div class="flex justify-center items-center gap-3 mt-3">
          <button onclick="decrease('cheese')" class="bg-gray-300 px-3 py-1 rounded">
            -
          </button>
          <span id="qty-cheese">0</span>
          <button onclick="increase('cheese', 80000, 'Cheese Cake')" class="bg-amber-500 text-white px-3 py-1 rounded">
            +
          </button>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Floating Contact Button -->
<div class="fixed bottom-6 right-6 z-[999] flex flex-col gap-4">

  <!-- Tombol WhatsApp (Contoh) -->
  <a href="https://wa.me/6285865334840" target="_blank"
    class="bg-green-500 hover:bg-green-600 text-white p-4 rounded-full shadow-lg transition-all duration-300 hover:scale-110 flex items-center justify-center group">
    <svg xmlns="http://w3.org" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
      <path
        d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.588-5.946 0-6.556 5.332-11.891 11.891-11.891 3.181 0 6.167 1.24 8.413 3.488 2.246 2.248 3.484 5.232 3.484 8.413 0 6.556-5.332 11.891-11.891 11.891-2.012 0-3.987-.511-5.733-1.482l-6.263 1.643zm6.311-3.535l.351.21c1.511.9 3.298 1.375 5.132 1.375 5.394 0 9.782-4.387 9.782-9.782 0-2.618-1.02-5.08-2.871-6.932-1.851-1.852-4.311-2.872-6.93-2.872-5.394 0-9.782 4.388-9.782 9.782 0 2.115.672 4.175 1.943 5.922l.213.295-.989 3.611 3.702-.971z" />
    </svg>
    <!-- Tooltip Label (Muncul saat di-hover) -->
    <span
      class="absolute left-16 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">Chat
      WhatsApp</span>
  </a>

  <!-- Tombol Instagram -->
  <a href="https://instagram.com/dewiyuniz" target="_blank"
    class="bg-gradient-to-tr from-yellow-400 via-red-500 to-purple-500 hover:opacity-90 text-white p-4 rounded-full shadow-lg transition-all duration-300 hover:scale-110 flex items-center justify-center group">
    <svg xmlns="http://w3.org" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
      <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
      <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"></path>
      <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
    </svg>
    <span
      class="absolute left-16 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">Follow
      IG</span>
  </a>

</div>

<!-- testimoni -->
<section id="testimoni" class="pt-32 pb-20 px-5 bg-[#fafafa]">
  <div class="max-w-[1100px] mx-auto">
    <h2 class="text-3xl md:text-4xl font-bold text-center text-[#4a4a4a] mb-10">
      Apa Kata Pelanggan Kami?
    </h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <?php
      include 'koneksi.php';
      $ambil_testi = mysqli_query($koneksi, "SELECT * FROM testimoni ORDER BY id DESC LIMIT 6");
      while ($testi = mysqli_fetch_array($ambil_testi)) {
        ?>
        <div
          class="bg-white p-8 rounded-[15px] shadow-[0_10px_20px_rgba(0,0,0,0.05)] border border-[#eee] transition-transform duration-300 hover:-translate-y-1.5 flex flex-col justify-between">
          <div>
            <div class="text-[#ffc107] text-sm mb-4">
              <?php
              for ($i = 1; $i <= $testi['bintang']; $i++) {
                echo "⭐";
              }
              ?>
            </div>
            <p class="italic text-[#666] leading-relaxed mb-5">
              "<?php echo $testi['komentar']; ?>"
            </p>
          </div>

          <!-- TARUH DI SINI (BAGIAN BAWAH KARTU) -->
          <div class="flex items-center gap-4 mt-auto">
            <img src="assets/img/<?php echo ($testi['foto'] ? $testi['foto'] : 'default.jpg'); ?>"
              class="w-12 h-12 rounded-full object-cover border-2 border-amber-100" alt="Profil">
            <div>
              <strong class="block text-[#333] text-base leading-tight"><?php echo $testi['nama']; ?></strong>
              <span class="text-[#999] text-[0.85rem]"><?php echo $testi['status']; ?></span>
            </div>
          </div>

        </div>
      <?php } ?>
    </div>

  </div>
  <!-- Form Input Testimoni -->
  <div class="mt-20 max-w-[600px] mx-auto bg-white p-8 rounded-[15px] shadow-lg border border-[#eee]">
    <h3 class="text-2xl font-bold text-center text-[#4a4a4a] mb-6">Kirim Testimoni Kamu ✍️</h3>

    <form action="proses_testimoni.php" method="POST" enctype="multipart/form-data" class="space-y-4">
      <div>
        <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
        <input type="text" name="nama" required
          class="w-full mt-1 p-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-amber-500 outline-none">
      </div>

      <!-- Dropdown Status -->
      <div>
        <label class="block text-sm font-medium text-gray-700">Siapa Kamu?</label>
        <select name="status" required
          class="w-full mt-1 p-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-amber-500 outline-none">
          <option value="Pelanggan Setia">Pelanggan Setia</option>
          <option value="Pembeli Pertama">Pembeli Pertama</option>
          <option value="Pecinta Roti">Pecinta Roti</option>
          <option value="Wirausaha">Wirausaha</option>
        </select>
      </div>

      <!-- Input Foto -->
      <div>
        <label class="block text-sm font-medium text-gray-700">Foto Kamu (Profil)</label>
        <input type="file" name="foto" accept="image/*"
          class="w-full mt-1 p-2 border border-gray-200 rounded-lg outline-none file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100">
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700">Testimoni</label>
        <textarea name="komentar" rows="3" required
          class="w-full mt-1 p-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-amber-500 outline-none"></textarea>
      </div>
      <!-- Input Bintang -->
      <div>
        <label class="block text-sm font-medium text-gray-700">Rating Bintang</label>
        <select name="bintang" required
          class="w-full mt-1 p-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-amber-500 outline-none">
          <option value="5">⭐⭐⭐⭐⭐ (Sempurna)</option>
          <option value="4">⭐⭐⭐⭐ (Enak)</option>
          <option value="3">⭐⭐⭐ (Biasa Saja)</option>
          <option value="2">⭐⭐ (Perlu Perbaikan)</option>
          <option value="1">⭐ (Kecewa)</option>
        </select>
      </div>
      <button type="submit"
        class="w-full bg-amber-500 hover:bg-amber-600 text-white font-bold py-3 rounded-lg transition-all shadow-md">
        Kirim Testimoni ✨
      </button>
    </form>
  </div>


</section>
<?php include 'footer.php'; ?>