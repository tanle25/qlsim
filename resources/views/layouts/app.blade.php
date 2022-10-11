<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div id="app">


        <nav class=" border-gray-200 px-2 rounded bg-primary">
            <div class="container flex flex-wrap justify-between items-center mx-auto relative">
                <a href="https://flowbite.com/" class="flex items-center">
                    <img src="https://flowbite.com/docs/images/logo.svg" class="mr-3 h-6 sm:h-9" alt="Flowbite Logo">
                    <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Flowbite</span>
                </a>
                <div class="flex md:order-2">
                    <button type="button" data-collapse-toggle="navbar-search" aria-controls="navbar-search"
                        aria-expanded="false"
                        class="md:hidden text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5 mr-1">
                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Search</span>
                    </button>
                    <div class="hidden relative md:block">
                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500" aria-hidden="true" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Search icon</span>
                        </div>
                        <input type="text" id="search-navbar"
                            class="block p-2 pl-10 w-full text-gray-900 rounded-2xl border  sm:text-sm focus:ring-blue-500 focus:border-blue-500  dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Bạn cần tìm gì?">
                    </div>
                    <button data-collapse-toggle="navbar-search" type="button"
                        class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                        aria-controls="navbar-search" aria-expanded="false">
                        <span class="sr-only">Open menu</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <div class="hidden justify-between items-center w-full md:flex md:w-auto md:order-1" id="navbar-search">
                    <div class="relative mt-3 md:hidden">
                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500" aria-hidden="true" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <input type="text" id="search-navbar"
                            class="block p-2 pl-10 w-full text-gray-900 bg-gray-50 rounded-lg border  sm:text-sm focus:ring-blue-500 focus:border-blue-500  dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Search...">
                    </div>
                    <ul
                        class="flex flex-col p-4 mt-4 rounded-lg border border-gray-100 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 ">
                        <li class="group">
                            <a href="#" class="block py-2 pr-4 pl-3 text-white  rounded" aria-current="page">Sản
                                phẩm</a>
                            <div
                                class="hidden md:grid shadow-md bg-primary border-2 grid-cols-4 w-full p-5 absolute top-full left-0 mt-14 opacity-0 invisible group-hover:opacity-100 group-hover:visible group-hover:mt-0 transition-all duration-500">
                                <ul>
                                    <li class="text-white">item</li>
                                    <li class="text-white">item</li>
                                    <li class="text-white">item</li>
                                    <li class="text-white">item</li>
                                </ul>
                                <ul>
                                    <li class="text-white">item</li>
                                    <li class="text-white">item</li>
                                    <li class="text-white">item</li>
                                    <li class="text-white">item</li>
                                </ul>
                                <ul>
                                    <li class="text-white">item</li>
                                    <li class="text-white">item</li>
                                    <li class="text-white">item</li>
                                    <li class="text-white">item</li>
                                </ul>
                                <ul>
                                    <li class="text-white">item</li>
                                    <li class="text-white">item</li>
                                    <li class="text-white">item</li>
                                    <li class="text-white">item</li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="#" class="block py-2 pr-4 pl-3 rounded text-white">Khuyến mãi</a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 pr-4 pl-3 rounded text-white">Dịch vụ</a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 pr-4 pl-3 rounded text-white">Tin tức</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
            @yield('content')
            <div class="bg-gray-50">
                <div
                    class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 lg:flex lg:items-center lg:justify-between">
                    <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl sm:tracking-tight">
                        <span class="block">Ready to dive in?</span>
                        <span class="block text-indigo-600">Start your free trial today.</span>
                    </h2>
                    <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
                        <div class="inline-flex rounded-md shadow">
                            <a href="#"
                                class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                Get started </a>
                        </div>
                        <div class="ml-3 inline-flex rounded-md shadow">
                            <a href="#"
                                class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-indigo-600 bg-white hover:bg-indigo-50">
                                Learn more </a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="https://unpkg.com/flowbite@1.5.2/dist/flowbite.js"></script>
</body>

</html>
