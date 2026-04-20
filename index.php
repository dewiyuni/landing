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

<!-- PRODUK -->
<section id="produk" class="py-20 px-6 bg-neutral-900 text-white">
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
<!-- ABOUT -->
<section id="about" class="py-20 px-6 bg-white">
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
<section class="py-20 text-center px-6">
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

<!-- CTA -->
<section class="py-20 text-center bg-amber-100">
  <h2 class="text-3xl font-semibold mb-4">Pesan Sekarang</h2>
  <p class="mb-6">Langsung order via WhatsApp</p>

  <a href="https://wa.me/6285865334840"
    class="bg-green-500 hover:bg-green-600 text-white px-8 py-3 rounded-full shadow-lg">
    Order Sekarang
  </a>
</section>
<?php include 'footer.php'; ?>