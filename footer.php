<!-- FOOTER TRANSPARAN CLEAN GHOST -->
<footer class="bg-white/10 backdrop-blur-lg border-t border-white/20 py-12 px-8">
    <div class="max-w-6xl mx-auto flex flex-col md:flex-row justify-between items-center gap-8">

        <!-- Bagian Kiri: Branding (Dikasih sedikit jarak antar huruf biar mewah) -->
        <div class="text-center md:text-left">
            <h3 class="text-xl font-extrabold text-gray-800 tracking-tight">IT Bakery 🥐</h3>
            <p class="text-[10px] uppercase tracking-widest text-gray-500 mt-1">Baking code • Serving happiness</p>
        </div>

        <!-- Bagian Tengah: Kontak (Pakai icon yang lebih rapi) -->
        <div class="flex flex-wrap justify-center gap-8 text-sm text-gray-600 font-medium">
            <div class="flex items-center gap-2 hover:text-amber-600 transition-colors cursor-default">
                <span>📍</span> Jakarta
            </div>
            <div class="flex items-center gap-2 hover:text-amber-600 transition-colors cursor-default">
                <span>📱</span> @itbakery.id
            </div>
            <div class="flex items-center gap-2 hover:text-amber-600 transition-colors cursor-default">
                <span>⏰</span> 07:00 - 21:00
            </div>
        </div>

        <!-- Bagian Kanan: Copyright -->
        <div class="text-[11px] text-gray-400 font-light">
            &copy; 2024 IT Bakery x <span class="hover:text-amber-500 transition-colors cursor-pointer">@fdweb.id</span>
        </div>

    </div>
</footer>


<div id="overlay" onclick="toggleCart()" class="fixed inset-0 bg-black/40 hidden"></div>
<!-- CART -->
<div id="cart"
    class="fixed right-0 top-0 w-80 h-screen bg-white/20 backdrop-blur-xl border-l border-white/20 shadow-2xl p-6 pt-24 transform translate-x-full transition-transform duration-500 z-50">

    <h2 class="text-2xl font-bold text-grey-800 text-white mb-5">Keranjang Roti 🥐</h2>
    <ul id="cart-items" class="space-y-2"></ul>

    <p class="mt-4 font-bold text-white">Total: Rp <span id="total">0</span></p>

    <button onclick="checkout()" class="mt-4 w-full bg-green-500 text-white py-2 rounded">
        Checkout WA
    </button>

    <button onclick="toggleCart()" class="mt-2 w-full bg-gray-300 py-2 rounded">
        Tutup
    </button>
</div>
<script>
    let cart = {};

    function increase(key, price, name) {
        if (!cart[key]) {
            cart[key] = { qty: 0, price: price, name: name };
        }
        cart[key].qty++;
        updateCart();
    }

    function decrease(key) {
        if (cart[key]) {
            cart[key].qty--;
            if (cart[key].qty <= 0) {
                delete cart[key];
            }
            updateCart();
        }
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

            const qtyEl = document.getElementById("qty-" + key);
            if (qtyEl) qtyEl.innerText = item.qty;

            list.innerHTML += `
      <li class="bg-gray-100 p-3 rounded">
        <div class="flex justify-between">
          <span>${item.name}</span>
          <button onclick="removeItem('${key}')" class="text-red-500">❌</button>
        </div>

        <div class="flex justify-between items-center mt-2">
          <div class="flex gap-2">
            <button onclick="decrease('${key}')" class="bg-gray-300 px-2 rounded">-</button>
            <span>${item.qty}</span>
            <button onclick="increase('${key}', ${item.price}, '${item.name}')" class="bg-amber-500 text-white px-2 rounded">+</button>
          </div>
          <span>Rp${subtotal}</span>
        </div>
      </li>
    `;
        }

        totalEl.innerText = total;
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

        let message = "Pesanan saya:%0A";

        for (let key in cart) {
            const item = cart[key];
            message += `- ${item.name} x${item.qty} (Rp${item.qty * item.price})%0A`;
        }

        window.open(`https://wa.me/6285865334840?text=${message}`);
    }
</script>
</body>

</html>