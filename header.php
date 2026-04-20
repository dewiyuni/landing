<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BBakery</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet" />

    <style>
        body {
            font-family: "Poppins", sans-serif;
        }
    </style>
</head>

<body class="bg-[#fffaf5] text-gray-800">
    <!-- NAVBAR -->
    <nav class="flex justify-between items-center px-8 py-4 bg-gray-100/30 shadow-md fixed w-full top-0 z-50">
        <h1 class="text-xl font-bold text-amber-600">B Bakery</h1>
        <div class="space-x-6 hidden md:block text-amber-500">
            <a href="#home" class="hover:text-white">Home</a>
            <a href="#produk" class="hover:text-white">Produk</a>
            <a href="#about" class="hover:text-white">About</a>
            <a href="#contact" class="hover:text-white">Contact</a>
        </div>
        <button onclick="toggleCart()" class="bg-amber-500 text-white px-4 py-2 rounded">
            🛒 Cart (<span id="cart-count">0</span>)
        </button>
    </nav>