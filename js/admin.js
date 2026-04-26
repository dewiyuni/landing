// ==========================================
// 1. PROTEKSI HALAMAN (SATPAM)
// ==========================================
if (localStorage.getItem("admin_token") !== "isLoggedIn") {
  alert("Akses ditolak! Silakan login terlebih dahulu.");
  window.location.href = "index.html";
}

// Variabel penampung ID saat edit
let editId = "";

// ==========================================
// 2. FUNGSI MUAT DATA (Tabel: products)
// ==========================================
async function loadProducts() {
  const { data, error } = await _supabase
    .from("products")
    .select("*")
    .order("id", { ascending: false });

  if (error) {
    console.error("Gagal muat data:", error.message);
    return;
  }

  const list = document.getElementById("product-list");
  if (!list) return; // Mencegah error jika elemen tidak ada

  list.innerHTML = "";

  data.forEach((p) => {
    list.innerHTML += `
        <tr class="hover:bg-amber-50/50 transition border-b border-gray-100">
            <td class="p-4 py-5 align-middle">
                <img src="${p.image_url || "assets/img/no-image.jpg"}" class="w-16 h-16 object-cover rounded-lg shadow-sm border">
            </td>
            <td class="p-4 align-middle font-semibold text-gray-700">${p.name}</td>
            <td class="p-4 align-middle text-center text-gray-600">${p.stock}</td>
            <td class="p-4 align-middle text-center font-bold text-amber-600">
                Rp ${Number(p.price).toLocaleString("id-ID")}
            </td>
            <td class="p-4 align-middle text-gray-500 text-sm max-w-[200px] leading-relaxed">
                ${p.description || "-"}
            </td>
            <td class="p-4 align-middle text-center">
                <div class="flex justify-center gap-2">
                    <button onclick="editProduct('${p.id}', '${p.name}', ${p.stock}, ${p.price}, '${p.description || ""}', '${p.image_url || ""}')" class="p-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-600 hover:text-white transition">✏️</button>
                    <button onclick="deleteProduct('${p.id}')" class="p-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-600 hover:text-white transition">❌</button>
                </div>
            </td>
        </tr>`;
  });
}

// ==========================================
// 3. FUNGSI MODAL (Buka/Tutup)
// ==========================================
function openModal(isEdit = false) {
  document.getElementById("modal").classList.remove("hidden");
  document.getElementById("modal-title").innerText = isEdit
    ? "Edit Produk"
    : "Tambah Produk";

  // Reset input file
  document.getElementById("image").value = "";

  if (!isEdit) {
    editId = "";
    document.getElementById("name").value = "";
    document.getElementById("stock").value = "";
    document.getElementById("price").value = "";
    document.getElementById("description").value = "";
    document.getElementById("preview-old").classList.add("hidden");
  }
}

function closeModal() {
  document.getElementById("modal").classList.add("hidden");
}

// ==========================================
// 4. FUNGSI EDIT & SIMPAN
// ==========================================
function editProduct(id, name, stock, price, desc, imageUrl) {
  openModal(true);
  editId = id;
  document.getElementById("name").value = name;
  document.getElementById("stock").value = stock;
  document.getElementById("price").value = price;
  document.getElementById("description").value = desc;

  const preview = document.getElementById("preview-old");
  if (imageUrl) {
    preview.src = imageUrl;
    preview.classList.remove("hidden");
  } else {
    preview.classList.add("hidden");
  }
}

async function saveProduct() {
  const name = document.getElementById("name").value;
  const stock = document.getElementById("stock").value;
  const price = document.getElementById("price").value;
  const description = document.getElementById("description").value;
  const fileInput = document.getElementById("image"); // Sesuaikan ID input file di admin.html
  const file = fileInput.files[0];

  if (!name || !stock || !price)
    return alert("Harap isi Nama, Stok, dan Harga!");

  let imageUrl = "";

  // 1. PROSES UPLOAD FOTO (Jika ada file yang dipilih)
  if (file) {
    const fileExt = file.name.split(".").pop();
    const fileName = `${Date.now()}.${fileExt}`; // Nama file unik pakai timestamp
    const filePath = fileName;

    // Upload ke bucket 'foto-product'
    const { data: uploadData, error: uploadError } = await _supabase.storage
      .from("foto-product")
      .upload(filePath, file);

    if (uploadError) {
      return alert("Gagal upload gambar: " + uploadError.message);
    }

    // Ambil URL Publiknya
    const { data } = _supabase.storage
      .from("foto-product")
      .getPublicUrl(filePath);

    imageUrl = data.publicUrl;
  } else if (editId) {
    // Kalau lagi EDIT dan gak ganti foto, pakai foto yang lama
    imageUrl = document.getElementById("preview-old").src;
  }

  // 2. SIMPAN DATA KE TABEL 'products'
  const productData = {
    name,
    stock,
    price,
    description,
    image_url: imageUrl, // Link dari Storage tadi masuk ke sini
  };

  try {
    if (editId) {
      // Logika Update
      const { error } = await _supabase
        .from("products")
        .update(productData)
        .eq("id", editId);
      if (error) throw error;
    } else {
      // Logika Tambah Baru
      const { error } = await _supabase.from("products").insert([productData]);
      if (error) throw error;
    }

    closeModal();
    loadProducts(); // Refresh tabel admin
  } catch (err) {
    alert("Terjadi kesalahan: " + err.message);
  }
}

// ==========================================
// 5. FUNGSI HAPUS
// ==========================================
async function deleteProduct(id) {
  if (!confirm("Hapus produk ini dari gudang?")) return;

  const { error } = await _supabase.from("products").delete().eq("id", id);
  if (error) {
    alert("Gagal menghapus: " + error.message);
  } else {
    loadProducts();
  }
}

// ==========================================
// 6. LOGOUT
// ==========================================
function logout() {
  localStorage.removeItem("admin_token");
  window.location.href = "index.html";
}

// Jalankan load data saat halaman admin terbuka
document.addEventListener("DOMContentLoaded", loadProducts);
