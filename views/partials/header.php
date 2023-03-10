<?php

$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$hostname = $_SERVER['HTTP_HOST'];
$baseUrl = $protocol . "://" . $hostname . "/";
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        body {
            background-color: #131516;
            color: #e8e6e3;
            ;
        }

        header {

            background-color: #131516;
            color: #e8e6e3;
            ;
        }
    </style>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.css" rel="stylesheet" />
    <title>Ubooks</title>
</head>

<body>
    <header class="relative">
        <div class="mx-auto max-w-7xl px-4 sm:px-6">
            <div
                class="flex items-center justify-between border-b-2 border-gray-100 py-6 md:justify-between md:space-x-2">
                <div class="group flex justify-start lg:w-0 lg:flex-1">
                    <a class="flex justify-start items-center" href="<?= $baseUrl ?>">
                        <img class="group-hover:scale-110  ease-in duration-300 h-8 w-auto sm:h-10"
                            src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="logo">
                        <span class="ml-2">e-panel</span>
                    </a>
                </div>
                <div class="-my-2 -mr-2 md:hidden">
                    <button type="button"
                        class="inline-flex items-center justify-center rounded-md bg-white p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                        aria-expanded="false">
                        <span class="sr-only">Open menu</span>
                        <!-- Heroicon name: outline/bars-3 -->
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>
                </div>
                <nav class="hidden space-x-2 md:flex">
                    <?php if (isset($_SESSION['seeded'])): ?>
                        <a href="/views/user/index.php"
                            class="transition duration-500 text-gray-200 group inline-flex items-center rounded-md bg-gray-800 text-base font-medium hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2  px-4 py-2 hover:rounded-md hover:text-white   hover:bg-indigo-600">
                            <span>Users</span>
                        </a>
                        <a href="/views/group/index.php"
                            class="transition duration-500 text-gray-200 group inline-flex items-center rounded-md bg-gray-800 text-base font-medium hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2  px-4 py-2 hover:rounded-md hover:text-white   hover:bg-indigo-600">
                            <span>Groups</span>
                        </a>
                    <?php endif; ?>
                </nav>
            </div>
        </div>
        <div class="absolute inset-x-0 top-0 origin-top-right transform p-2 transition md:hidden">
            <div class="divide-y-2 divide-gray-50 rounded-lg bg-white shadow-lg ring-1 ring-black ring-opacity-5">
                <div class="px-5 pt-5 pb-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <img class="h-8 w-auto"
                                src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600"
                                alt="Your Company">
                        </div>
                        <div class="-mr-2">
                            <button type="button" id="mega-menu-button" data-collapse-toggle="mega-menu"
                                class="inline-flex items-center justify-center rounded-md bg-white p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                                <span class="sr-only">Close menu</span>
                                <!-- Heroicon name: outline/x-mark -->
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="mt-6 hidden"  id="mega-menu">
                        <nav class="grid gap-y-8 z-50">

                            <a href="/views/user/index.php"
                                class="-m-3 flex items-center rounded-md p-3 hover:bg-gray-50">
                                <!-- Heroicon name: outline/cursor-arrow-rays -->
                                <svg class="h-6 w-6 flex-shrink-0 text-indigo-600" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.042 21.672L13.684 16.6m0 0l-2.51 2.225.569-9.47 5.227 7.917-3.286-.672zM12 2.25V4.5m5.834.166l-1.591 1.591M20.25 10.5H18M7.757 14.743l-1.59 1.59M6 10.5H3.75m4.007-4.243l-1.59-1.59" />
                                </svg>
                                <span class="ml-3 text-base font-medium text-gray-900">Users</span>
                            </a>

                            <a href="/views/group/index.php"
                                class="-m-3 flex items-center rounded-md p-3 hover:bg-gray-50">
                                <!-- Heroicon name: outline/shield-check -->
                                <svg class="h-6 w-6 flex-shrink-0 text-indigo-600" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                                </svg>
                                <span class="ml-3 text-base font-medium text-gray-900">Groups</span>
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
