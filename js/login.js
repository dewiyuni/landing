// ==========================================
// 1. FUNGSI UI (Buka/Tutup Modal)
// ==========================================
function openLogin() {
  const modal = document.getElementById("loginModal");
  const overlay = document.getElementById("login");
  if (modal) modal.classList.remove("hidden");
  if (overlay) overlay.classList.remove("hidden");
}

function closeLogin() {
  const modal = document.getElementById("loginModal");
  const overlay = document.getElementById("login");
  if (modal) modal.classList.add("hidden");
  if (overlay) overlay.classList.add("hidden");
}

// ==========================================
// 2. FUNGSI LOGIKA (Login/Logout)
// ==========================================
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
    // Simpan status login di browser
    localStorage.setItem("admin_token", "isLoggedIn");
    // Pindah ke halaman admin
    window.location.href = "admin.html";
  }
}

function logout() {
  localStorage.removeItem("admin_token");
  window.location.href = "index.html";
}
