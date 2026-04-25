// 1. Inisialisasi Supabase
const supabaseUrl = "https://supabase.co"; // Pakai URL kamu
const supabaseKey = "KODE_SB_PUBLISHABLE_KAMU"; // Pakai Key kamu
const _supabase = supabase.createClient(supabaseUrl, supabaseKey);

async function login() {
  const email = document.getElementById("email").value;
  const password = document.getElementById("password").value;

  if (!email || !password) {
    alert("Email dan password harus diisi!");
    return;
  }

  // Cek ke tabel users di Supabase
  const { data, error } = await _supabase
    .from("users")
    .select("*")
    .eq("email", email)
    .eq("password", password)
    .single();

  if (error || !data) {
    alert("Login Gagal: Email atau Password salah!");
  } else {
    alert("Login Berhasil!");
    // Simpan status login di browser agar tidak hilang
    localStorage.setItem("admin_token", "isLoggedIn");
    window.location.href = "admin.html"; // Pastikan sudah ganti admin.php jadi admin.html
  }
}
function toggleMobileMenu() {
  const menu = document.getElementById("mobile-menu");
  const overlay = document.getElementById("menu-overlay");
  menu.classList.toggle("translate-x-full");
  overlay.classList.toggle("hidden");
}
// 2. Fungsi Ambil Data Produk (Pengganti get_product.php)

async function fetchProducts() {
  const { data: products, error } = await _supabase
    .from("products")
    .select("*");

  const container = document.getElementById("product-container");

  if (error) {
    console.error("Error fetching products:", error);
    container.innerHTML = `<p class="text-red-500">Gagal memuat produk.</p>`;
    return;
  }

  if (products.length === 0) {
    container.innerHTML = `<p class="text-gray-500 text-center col-span-full">Belum ada produk.</p>`;
    return;
  }

  // Tampilkan Produk ke HTML
  container.innerHTML = products
    .map(
      (item) => `
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 hover:shadow-2xl transition duration-300">
        <img src="${item.image || "assets/img/no-image.jpg"}" class="w-full h-56 object-cover" alt="${item.name}">
        <div class="p-6">
            <h3 class="text-xl font-bold mb-2">${item.name}</h3>
            <p class="text-gray-600 text-sm mb-4 line-clamp-2">${item.description || ""}</p>
            <div class="flex justify-between items-center">
                <span class="text-amber-500 font-bold text-lg">Rp ${item.price.toLocaleString()}</span>
                <!-- PERBAIKAN: Tambahkan onclick="increase(...)" -->
                <button 
                  onclick="increase('${item.id}', ${item.price}, '${item.name}')" 
                  class="bg-amber-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-amber-600 transition">
                  Tambah
                </button>
            </div>
        </div>
    </div>
`,
    )
    .join("");
}

// Jalankan fungsi saat halaman dibuka
document.addEventListener("DOMContentLoaded", fetchProducts);

let cart = {};

function increase(id, price, name) {
  if (!cart[id]) {
    cart[id] = { name: name, price: price, qty: 0 };
  }
  cart[id].qty++;

  // Sinkronkan angka di kartu produk
  const qtyEl = document.getElementById(`qty-${id}`);
  if (qtyEl) qtyEl.innerText = cart[id].qty;

  // Update tampilan keranjang samping
  updateCart();
}

function decrease(id) {
  if (cart[id] && cart[id].qty > 0) {
    cart[id].qty--;

    // Update angka di kartu produk
    const qtyEl = document.getElementById(`qty-${id}`);
    if (qtyEl) qtyEl.innerText = cart[id].qty;

    // Jika qty 0, hapus dari objek keranjang agar tidak muncul di list
    if (cart[id].qty === 0) {
      delete cart[id];
    }
  }
  updateCart();
}

function removeItem(key) {
  delete cart[key];
  updateCart();
}

function updateCart() {
  const list = document.getElementById("cart-items");
  const totalEl = document.getElementById("total");
  const countEl = document.getElementById("cart-count");

  list.innerHTML = "";
  let total = 0;
  let count = 0;

  for (let key in cart) {
    const item = cart[key];
    const subtotal = item.qty * item.price;

    total += subtotal;
    count += item.qty;

    // BAGIAN INI YANG DIGANTI:
    list.innerHTML += `
      <li class="bg-white/10 border border-white/20 p-4 rounded-xl text-white shadow-sm">
        <div class="flex justify-between items-center mb-2">
          <span class="font-semibold">${item.name}</span>
          <button onclick="removeItem('${key}')" class="text-red-400 hover:text-red-600 transition">✕</button>
        </div>

        <div class="flex justify-between items-center mt-2">
          <div class="flex items-center gap-3 bg-black/20 px-3 py-1 rounded-lg">
            <button onclick="decrease('${key}')" class="text-white hover:text-amber-500 font-bold">-</button>
            <span class="text-sm w-4 text-center">${item.qty}</span>
            <button onclick="increase('${key}', ${item.price}, '${item.name}')" class="text-white hover:text-amber-500 font-bold">+</button>
          </div>
          <span class="font-medium text-amber-400">Rp${subtotal.toLocaleString("id-ID")}</span>
        </div>
      </li>
    `;
  }

  totalEl.innerText = total.toLocaleString("id-ID");
  countEl.innerText = count;
}

function toggleCart() {
  const cartEl = document.getElementById("cart");
  const overlay = document.getElementById("overlay");

  cartEl.classList.toggle("translate-x-full");
  overlay.classList.toggle("hidden");
}
function checkout() {
  if (Object.keys(cart).length === 0) {
    alert("Keranjang masih kosong!");
    return;
  }

  let message = "Halo Admin, saya mau pesan:%0A%0A";
  let totalHarga = 0;

  for (let key in cart) {
    const item = cart[key];
    const sub = item.qty * item.price;
    message += `* ${item.name} (x${item.qty}) = Rp ${sub.toLocaleString("id-ID")}%0A`;
    totalHarga += sub;
  }

  message += `%0A*Total Bayar: Rp ${totalHarga.toLocaleString("id-ID")}*%0A%0ATerima kasih!`;

  window.open(`https://wa.me/6288232839006?text=${message}`);
}
// 1. FUNGSI TAMPILKAN TESTIMONI
async function fetchTestimonials() {
  const { data: testimonials, error } = await _supabase
    .from("testimoni")
    .select("*")
    .order("id", { ascending: false })
    .limit(6);

  const container = document.getElementById("testimoni-container");
  if (error) return console.error(error);

  container.innerHTML = testimonials
    .map(
      (testi) => `
        <div class="bg-neutral-800 p-8 rounded-2xl shadow-xl border border-neutral-700 hover:border-amber-500/50 transition-all duration-300 flex flex-col w-full md:w-[calc(50%-1rem)] lg:w-[calc(33.33%-2rem)] max-w-[400px]">
            <div class="mb-6">
                <p class="text-neutral-300 leading-relaxed italic">"${testi.komentar}"</p>
            </div>
            <div class="flex items-center gap-4 mt-auto pt-6 border-t border-neutral-700">
                <img src="${testi.foto || "assets/img/default.jpg"}" class="w-12 h-12 rounded-full object-cover border-2 border-amber-500/30" />
                <div>
                    <strong class="block text-white font-semibold">${testi.nama}</strong>
                    <span class="text-xs text-amber-500/80 uppercase font-medium">${testi.status}</span>
                </div>
            </div>
        </div>
    `,
    )
    .join("");
}

// 2. FUNGSI KIRIM TESTIMONI (Ganti proses_testimoni.php)
const formTesti = document.getElementById("formTestimoni");
if (formTesti) {
  formTesti.addEventListener("submit", async (e) => {
    e.preventDefault();

    const nama = document.getElementById("nama_testi").value;
    const status = document.getElementById("status_testi").value;
    const komentar = document.getElementById("komentar_testi").value;

    const { error } = await _supabase
      .from("testimoni")
      .insert([{ nama, status, komentar }]);

    if (error) {
      alert("Gagal mengirim testimoni: " + error.message);
    } else {
      alert("Terima kasih! Testimoni Anda berhasil dikirim.");
      formTesti.reset();
      fetchTestimonials(); // Refresh tampilan testimoni
    }
  });
}

// Jalankan saat load
document.addEventListener("DOMContentLoaded", () => {
  fetchProducts();
  fetchTestimonials();
});
