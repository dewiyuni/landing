const supabaseUrl = "https://wapcxcgvzvgqhycjvcpm.supabase.co";
const supabaseKey = "sb_publishable_z21dA64xzBBzNWI49sGF6A_ND09Glzc";

// Gunakan window._supabase agar terbaca global
window._supabase = supabase.createClient(supabaseUrl, supabaseKey);

console.log("Koneksi Supabase Siap!");
