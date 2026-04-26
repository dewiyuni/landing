// ==========================================
// 1. FUNGSI UNTUK PRODUK (Tabel: products)
// ==========================================
let cart = {};

async function fetchProducts() {
  const container = document.getElementById("product-container");

  // Sesuai dashboard kamu: nama tabel adalah 'products'
  const { data: products, error } = await _supabase
    .from("products")
    .select("*");

  if (error) {
    console.error("Error fetching products:", error);
    if (container)
      container.innerHTML = `<p class="text-red-500 text-center">Gagal memuat produk: ${error.message}</p>`;
    return;
  }

  if (!products || products.length === 0) {
    if (container)
      container.innerHTML = `<p class="text-gray-500 text-center col-span-full">Belum ada produk hari ini. 🥐</p>`;
    return;
  }

  // Tampilkan Produk ke HTML
  if (container) {
    // Tampilkan Produk ke HTML
    container.innerHTML = products
      .map((item) => {
        // Cek apakah item ini sudah ada di keranjang atau belum
        const qty = cart[item.id] ? cart[item.id].qty : 0;

        return `
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 hover:shadow-2xl transition duration-300">
        <img src="${item.image_url || "assets/img/no-image.jpg"}" class="w-full h-56 object-cover" alt="${item.name}">
        <div class="p-6">
            <h3 class="text-xl font-bold mb-2">${item.name}</h3>
            <p class="text-gray-600 text-sm mb-4 line-clamp-2">${item.description || ""}</p>
            <div class="flex justify-between items-center">
                <span class="text-amber-500 font-bold text-lg">Rp ${Number(item.price).toLocaleString("id-ID")}</span>
                
                <!-- BAGIAN KONTROL JUMLAH -->
                <div id="ctrl-${item.id}">
                    ${
                      qty > 0
                        ? `
                        <div class="flex items-center gap-3 bg-amber-100 px-3 py-1 rounded-lg border border-amber-200">
                            <button onclick="decrease('${item.id}')" class="text-amber-600 font-bold text-lg">-</button>
                            <span class="font-bold text-amber-700 min-w-[20px] text-center">${qty}</span>
                            <button onclick="increase('${item.id}', ${item.price}, '${item.name}')" class="text-amber-600 font-bold text-lg">+</button>
                        </div>
                    `
                        : `
                        <button 
                            onclick="increase('${item.id}', ${item.price}, '${item.name}')" 
                            class="bg-amber-500 text-white px-6 py-2 rounded-lg text-sm font-bold hover:bg-amber-600 transition shadow-md">
                            Tambah
                        </button>
                    `
                    }
                </div>
            </div>
        </div>
    </div>`;
      })
      .join("");
  }
}

// ==========================================
// 2. LOGIKA KERANJANG BELANJA (CART)
// ==========================================
function increase(id, price, name) {
  if (!cart[id]) {
    cart[id] = { name: name, price: price, qty: 0 };
  }
  cart[id].qty++;
  updateCart();
}

function decrease(id) {
  if (cart[id] && cart[id].qty > 0) {
    cart[id].qty--;
    if (cart[id].qty === 0) delete cart[id];
  }
  updateCart();
}

function removeItem(key) {
  delete cart[key];
  updateCart();
}

function updateCart() {
  const list = document.getElementById("cart-items");
  const checkoutSection = document.getElementById("checkout-section");
  const emptyMsg = document.getElementById("empty-msg");
  const totalEl = document.getElementById("total");
  const countEl = document.getElementById("cart-count");

  list.innerHTML = "";
  let total = 0;
  let count = 0;
  const hasItems = Object.keys(cart).length > 0;

  // Tampilkan atau sembunyikan section checkout
  if (hasItems) {
    checkoutSection.classList.remove("hidden");
    emptyMsg.classList.add("hidden");
  } else {
    checkoutSection.classList.add("hidden");
    emptyMsg.classList.remove("hidden");
  }

  for (let key in cart) {
    const item = cart[key];
    const subtotal = item.qty * item.price;
    total += subtotal;
    count += item.qty;

    list.innerHTML += `
      <li class="bg-white/10 border border-white/20 p-4 rounded-xl text-white shadow-sm mb-3">
        <div class="flex justify-between items-center mb-2">
          <span class="font-semibold text-sm">${item.name}</span>
          <button onclick="removeItem('${key}')" class="text-red-400 hover:text-red-600 transition">✕</button>
        </div>
        <div class="flex justify-between items-center mt-2">
          <div class="flex items-center gap-3 bg-black/40 px-3 py-1 rounded-lg border border-white/10">
            <button onclick="decrease('${key}')" class="text-white hover:text-amber-500 font-bold px-2">-</button>
            <span class="text-xs font-bold w-4 text-center">${item.qty}</span>
            <button onclick="increase('${key}', ${item.price}, '${item.name}')" class="text-white hover:text-amber-500 font-bold px-2">+</button>
          </div>
          <span class="font-bold text-amber-400 text-sm">Rp ${subtotal.toLocaleString("id-ID")}</span>
        </div>
      </li>
    `;
  }
  // Update Angka Total dan Counter di UI Navbar
  if (totalEl) totalEl.innerText = total.toLocaleString("id-ID");
  if (countEl) countEl.innerText = count;

  // SIMPAN KE MEMORI
  localStorage.setItem("jaza_cart", JSON.stringify(cart));

  // PENTING: Panggil kembali fetchProducts agar tombol di kartu produk ikut update angkanya
  fetchProducts();
}

function checkout() {
  // 1. Ambil inputan user
  const name = document.getElementById("cust-name").value.trim();
  const address = document.getElementById("cust-address").value.trim();

  // 2. Cek apakah Keranjang kosong
  if (Object.keys(cart).length === 0) {
    return alert("Keranjang masih kosong, pilih roti dulu ya! 🥐");
  }

  // 3. VALIDASI: Cek Nama & Alamat (Syarat wajib)
  if (!name || !address) {
    alert(
      "Mohon isi NAMA dan ALAMAT lengkap kamu dulu ya, supaya Admin bisa langsung cek stok & ongkir! 😊",
    );
    document.getElementById("cust-name").focus(); // Arahkan kursor ke Nama
    return; // Berhenti di sini, jangan buka WA
  }

  // 4. SUSUN PESAN WHATSAPP (Jika validasi lolos)
  let message = `Halo Jaza Bakery, saya ingin tanya stok untuk pesanan berikut:%0A%0A`;
  message += `👤 *Nama:* ${name}%0A`;
  message += `📍 *Alamat:* ${address}%0A`;
  message += `-----------------------------------%0A`;

  let totalHarga = 0;
  for (let key in cart) {
    const item = cart[key];
    const sub = item.qty * item.price;
    message += `🍞 *${item.name}* (x${item.qty}) = Rp ${sub.toLocaleString("id-ID")}%0A`;
    totalHarga += sub;
  }

  message += `-----------------------------------%0A`;
  message += `*Total Estimasi: Rp ${totalHarga.toLocaleString("id-ID")}*%0A%0A`;
  message += `Apakah bisa dikirim ke alamat tersebut? Terima kasih! ✨`;

  // 5. Buka WhatsApp
  window.open(`https://wa.me/6288232839006?text=${message}`, "_blank");

  // 6. OPSIONAL: Kosongkan keranjang & input setelah berhasil kirim
  cart = {};
  localStorage.removeItem("jaza_cart");
  document.getElementById("cust-name").value = "";
  document.getElementById("cust-address").value = "";
  updateCart();
  toggleCart();

  alert("Pertanyaan terkirim! Lanjutkan diskusi di WhatsApp ya. 🙏");
}

// ==========================================
// 3. FUNGSI TESTIMONI (Tabel: testimoni)
// ==========================================
async function fetchTestimonials() {
  const container = document.getElementById("testimoni-container");

  // Sesuai dashboard kamu: kolomnya bernama 'komentar'
  const { data: testimonials, error } = await _supabase
    .from("testimoni")
    .select("*")
    .order("id", { ascending: false });

  if (error) return console.error("Error testimoni:", error.message);

  if (container) {
    container.innerHTML = testimonials
      .map((testi) => {
        // Membuat tampilan bintang sederhana (misal: ⭐⭐⭐⭐⭐)
        const starIcon = "⭐".repeat(testi.bintang || 5);

        return `
    <div class="bg-neutral-800 p-8 rounded-2xl shadow-xl border border-neutral-700 hover:border-amber-500/50 transition-all duration-300 flex flex-col w-full md:w-[calc(50%-1rem)] lg:w-[calc(33.33%-2rem)]">
        <div class="text-amber-500 mb-4">${starIcon}</div>
        <p class="text-neutral-300 leading-relaxed italic mb-6">"${testi.komentar}"</p>
        <div class="flex items-center gap-4 mt-auto pt-6 border-t border-neutral-700">
            <img src="assets/img/${testi.foto || "default.jpg"}" class="w-12 h-12 rounded-full object-cover border-2 border-amber-500/30" />
            <div>
                <strong class="block text-white font-semibold">${testi.nama}</strong>
                <span class="text-xs text-amber-500/80 uppercase font-medium">${testi.status}</span>
            </div>
        </div>
    </div>
    `;
      })
      .join("");
  }
}

// Handler untuk Kirim Testimoni
// Handler Kirim
const formTesti = document.getElementById("formTestimoni");
if (formTesti) {
  formTesti.addEventListener("submit", async (e) => {
    e.preventDefault();

    const nama = document.getElementById("nama_testi").value;
    const status = document.getElementById("status_testi").value;
    const komentar = document.getElementById("komentar_testi").value;
    const bintang = document.getElementById("bintang_testi")?.value || 5;

    const { error } = await _supabase.from("testimoni").insert([
      {
        nama,
        status,
        komentar,
        bintang: parseInt(bintang),
        foto: "default.jpg",
      },
    ]);

    if (error) {
      console.error("Gagal: " + error.message);
    } else {
      // 1. Reset Form
      formTesti.reset();

      await fetchTestimonials();

      // 3. SCROLL: Meluncur halus ke bagian testimoni
      const target = document.getElementById("testimoni");
      if (target) {
        target.scrollIntoView({
          behavior: "smooth",
          block: "start",
        });
      }
    }
  });
}

// ==========================================
// 4. JALANKAN SAAT LOAD
// ==========================================
document.addEventListener("DOMContentLoaded", () => {
  fetchProducts();
  fetchTestimonials();

  const savedCart = localStorage.getItem("jaza_cart");
  if (savedCart) {
    cart = JSON.parse(savedCart);
    updateCart();
  }
});

// ==========================================
// 4. JALANKAN SAAT HALAMAN DIBUKA
// ==========================================
document.addEventListener("DOMContentLoaded", () => {
  console.log("Memulai ambil data Jaza Bakery...");

  // Ambil data produk & testimoni
  fetchProducts();
  fetchTestimonials();

  // Muat keranjang dari memori browser (jika ada)
  const savedCart = localStorage.getItem("jaza_cart");
  if (savedCart) {
    cart = JSON.parse(savedCart);
    updateCart();
  }
});
// FUNGSI UNTUK BUKA/TUTUP KERANJANG
function toggleCart() {
  const cartEl = document.getElementById("cart");
  const overlay = document.getElementById("overlay");

  // Pastikan elemennya ada dulu supaya nggak error lagi
  if (cartEl && overlay) {
    cartEl.classList.toggle("translate-x-full");
    overlay.classList.toggle("hidden");
  } else {
    console.error("Elemen keranjang atau overlay tidak ditemukan di HTML!");
  }
}

function toggleMobileMenu() {
  const menu = document.getElementById("mobile-menu");
  const overlay = document.getElementById("menu-overlay");

  if (menu && overlay) {
    menu.classList.toggle("translate-x-full");
    overlay.classList.toggle("hidden");
  }
}
