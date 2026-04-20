<!-- FOOTER -->
<footer id="contact" class="bg-white py-10 text-center text-gray-600">
    <p>📍 Jl. Bakery No. 123</p>
    <p>📱 Instagram: @sweetbakery</p>
    <p>⏰ 07.00 - 20.00</p>
</footer>

<div id="overlay" onclick="toggleCart()" class="fixed inset-0 bg-black/40 hidden"></div>
<!-- CART -->
<div id="cart"
    class="fixed right-0 top-16 w-80 h-[calc(100%-4rem)] bg-white shadow-lg p-5 transform translate-x-full transition duration-300 z-50">
    <h2 class="text-xl font-bold mb-4">Keranjang</h2>

    <ul id="cart-items" class="space-y-2"></ul>

    <p class="mt-4 font-bold">Total: Rp <span id="total">0</span></p>

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