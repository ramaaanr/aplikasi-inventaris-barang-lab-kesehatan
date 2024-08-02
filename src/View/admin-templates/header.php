<?php include __DIR__ . '/../templates/header.php'; ?>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const navLinks = document.querySelectorAll('nav a');

        navLinks.forEach(link => {
            // Remove any existing active class
            link.classList.remove('text-gray-100', 'bg-gray-700', 'bg-opacity-25');

            // Get the current URL path
            const currentPath = window.location.pathname;

            // Check if the link's href matches the current path
            if (link.getAttribute('href') === currentPath) {
                // Add the active class
                link.classList.add('text-gray-100', 'bg-gray-700', 'bg-opacity-25');
            } else {
                // Ensure other links are not active
                link.classList.add('text-gray-500', 'hover:bg-gray-700', 'hover:bg-opacity-25', 'hover:text-gray-100');
            }
        });
    });
</script>


<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200">
    <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed inset-0 z-20 transition-opacity bg-zinc opacity-50 lg:hidden"></div>

    <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-gray-900 lg:translate-x-0 lg:static lg:inset-0">
        <div class="flex items-center justify-center mt-8">
            <div class="flex items-center justify-center w-full">
                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAADLElEQVR4nO2Y22vTUBzHs8Zt+OANby+KjtK/QLygD8OSI3V7EXHYpNtgSxy6IeKDgiDsUh0oaOq2F1/sEDab4ezAKj4Op9hkusdtCCK2wwdlw/WyJUM9cro2pjGtadZtDcsXfg89aU6+n/M7l1+CYZYsWbKkFs4lYK7AzCDc7ABIgGKgOjAzCZgVAM8zfUwxjXALYJ21ITIAVIuboBgJkLRAuJtrTQkAFHGKbD5jGgD7rSCsGJyFdm9QkQ06SZC0F9Rf3FPyABUDc6nflQOz/04rkokBD3OupAHs3mAKwt71LNeU+r3mECtfA7SXIJlpRSbmXXVNu0t+FyIohidIugb1UUtd2kFQTERxvaukAPT0Ayi6TgE5gZkNwOXxbFUuaMOGWF586xMkqA6WF8dWEwCpKJUsMqoF4BPE16YAQNICwNbgfQBYABs5A8UQsADWMQMuxTlgyikE3IxTWQ8Z7uje+NIR7XNg6TC2igIUEypKKcEKYn+Og8xvtM/yoeQhnEtMqg64SdSeNn9TtYN1GnpQLw93soK4mKOUEB9MwMLL3JHvW/BAPKp1QpcPzn2rbrr8Kts8/aOabNllCMAXFq9rj34aQhCvqe/JV+ujONj9UjbsaOegs6ENOjo4ua2qO5T1QkNQ9FlD5iGEZawgfURGp4/fhknsvBxTJ7qXIXjpUzuENr0Ax1o74aZATDbrbGxNtZ9sbJPb0HX0PzTyhs0j3Q+Ltcjko+AMTNjcWQDJMjf0D0eWIcbFGj0AhKcFbn84lTVlHB1cCsLROZTVvtkf/XqUvrEXW4lYXnqBDIbr+7PNp+Ndw+PMVArp6c/Gxa/qqVTxdNiG4lcMm+/7sHCAFcSffWNxOLeN0QRA7b1vEtDHi796wotVeTt8srAfDyRihQDggUQMG07uMwTg46W7aHSfe0c1zWci5B1NL2bpTr7+bFx8pCDzXDoLXDxoFCCCjA2zAoxV1Guan69sgE973mcWcyRzL/o8CEh65n+7kd4gSDoKqAunCwJgeelLvu1TIz7LAKkHFsc8+PtVQh4g3TsQK0hRXeZRthQ7UbHNg2IUc5YsWcJKVn8A+qRdTQcXbKwAAAAASUVORK5CYII=">
                <span class="mx-2  text-2xl font-semibold text-white">Sistem Invetaris Lab Kesehatan</span>
            </div>
        </div>

        <nav class="mt-10">
            <!-- Updated absolute paths for navigation links -->
            <a class="flex items-center px-6 py-2 mt-4 text-gray-100 bg-gray-700 bg-opacity-25" href="/barang/show">
                <span class="material-symbols-outlined">
                    package
                </span>
                <span class="mx-3">Data Barang</span>
            </a>

            <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="/barangmasuk/show">
                <span class="material-symbols-outlined">
                    box_add
                </span>
                <span class="mx-3">Kelola Barang Masuk</span>
            </a>

            <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="/barangkeluar/show">
                <span class="material-symbols-outlined">
                    outbound
                </span>
                <span class="mx-3">Kelola Barang Keluar</span>
            </a>

            <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="/barangrusak/show">
                <span class="material-symbols-outlined">
                    handyman
                </span>
                <span class="mx-3">Kelola Barang Rusak</span>
            </a>

            <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="/baranghabis/show">
                <span class="material-symbols-outlined">
                    indeterminate_question_box
                </span>
                <span class="mx-3">Barang Habis</span>
            </a>
        </nav>

    </div>
    <div class="flex flex-col flex-1 overflow-hidden">
        <header class="flex items-center justify-between px-6 py-4 bg-white border-b-4 border-lime-600">
            <div class="flex items-center">
                <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </button>


            </div>

            <div class="flex pl-4 w-full items-center text-zinc-700 justify-between">
                <p>Selamat datang, <span class="font-bold">Admin</span></p>
                <button class="px-4 py-2 bg-red-600 text-white font-semibold rounded-lg shadow-md hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-75">
                    Log Out
                </button>
            </div>
        </header>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">

        