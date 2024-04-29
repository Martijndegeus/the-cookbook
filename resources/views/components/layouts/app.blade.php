@php
    $latestRecipe = \App\Models\Recipe::latest()->first();
@endphp
    <!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @livewireStyles
    @vite('resources/css/app.css')
    <title>The Cookbook</title>
</head>
<body class="bg-gray-100 dark:bg-slate-900 font-sans leading-normal tracking-normal">
<nav id="header" class="fixed w-full z-10 top-0 dark:bg-slate-900">

    <div id="progress" class="h-1 z-20 top-0"
         style="background:linear-gradient(to right, #4dc0b5 var(--scroll), transparent 0);"></div>

    <div class="w-full md:max-w-4xl mx-auto flex flex-wrap items-center justify-between mt-0 py-3">

        <div class="pl-4">
            <a class="text-gray-900 dark:text-gray-500 text-base no-underline hover:no-underline font-extrabold text-xl"
               href="{{ route('recipe.search') }}">
                {{ config('app.name') }}
            </a>
        </div>

        <div class="block lg:hidden pr-4">
            <button id="nav-toggle"
                    class="flex items-center px-3 py-2 border rounded text-gray-500 border-gray-600 hover:text-gray-900 hover:border-green-500 appearance-none focus:outline-none">
                <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <title>Menu</title>
                    <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/>
                </svg>
            </button>
        </div>

        <div
            class="w-full flex-grow lg:flex lg:items-center lg:w-auto hidden lg:block mt-2 lg:mt-0 bg-gray-100 md:bg-transparent dark:md:bg-slate-900 z-20"
            id="nav-content">
            <ul class="list-reset lg:flex justify-end flex-1 items-center">
                <li class="mr-3">
                    <a class="inline-block py-2 px-4 text-gray-900 font-bold no-underline dark:text-gray-300" href="#">Active</a>
                </li>
                <li class="mr-3">
                    <a class="inline-block text-gray-600 dark:text-gray-500 no-underline hover:text-gray-900 dark:hover:text-gray-300 transition-colors hover:text-underline py-2 px-4"
                       href="{{ route('recipe.view', $latestRecipe->id) }}">{{ __('Latest recipe') }}</a>
                </li>
                <li class="mr-3">
                    <a class="inline-block text-gray-600 dark:text-gray-500 no-underline hover:text-gray-900 dark:hover:text-gray-300 transition-colors hover:text-underline py-2 px-4"
                       href="/admin">{{ __('Sign in') }}</a>
                </li>
                <li class="mr-3">
                    <x-layouts.locale-switch />
                </li>
            </ul>
        </div>
    </div>
</nav>

{{ $slot }}

<footer class="bg-white dark:bg-gray-950 border-t border-gray-400 dark:border-gray-800 shadow">
    <div class="container max-w-4xl mx-auto flex py-8">

        <div class="w-full mx-auto flex flex-wrap">
            <div class="flex w-full md:w-1/2 ">
                <div class="px-8">
                    <h3 class="font-bold text-gray-900 dark:text-gray-400">{{ __('About') }} {{ config('app.name') }}</h3>
                    <p class="py-4 text-gray-600 text-sm bg-slate-500 dark:text-gray-500 dark:bg-transparent">
                        {{ __('Collection of randomly found and liked recipes from around the internet, and from family and friends.') }}
                    </p>
                </div>
            </div>

            <div class="flex w-full md:w-1/2">
                <div class="px-8">
                    <h3 class="font-bold text-gray-900 dark:text-gray-400">{{ __('Stats') }}</h3>
                    <ul class="list-reset items-center text-sm pt-3">
                        <li>
                            <a class="inline-block text-gray-600 no-underline hover:text-gray-900 hover:text-underline py-1"
                               href="#"><x-icons.play />
                                {{ __('Most prepared') }}</a>
                        </li>
                        <li>
                            <a class="inline-block text-gray-600 no-underline hover:text-gray-900 hover:text-underline py-1"
                               href="#"><x-icons.heart />
                                {{ __('Most liked') }}</a>
                        </li>
                        <li>
                            <a class="inline-block text-gray-600 no-underline hover:text-gray-900 hover:text-underline py-1"
                               href="#"><x-icons.stop />
                                {{ __('Least prepared') }}</a>
                        </li>
                        <li>
                            <a class="inline-block text-gray-600 no-underline hover:text-gray-900 hover:text-underline py-1"
                               href="#"><x-icons.heart-o />
                                {{ __('Least liked') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>


    </div>
</footer>
@livewireScripts
</body>
<script>
    /* Progress bar */
    //Source: https://alligator.io/js/progress-bar-javascript-css-variables/
    var h = document.documentElement,
        b = document.body,
        st = 'scrollTop',
        sh = 'scrollHeight',
        progress = document.querySelector('#progress'),
        scroll;
    var scrollpos = window.scrollY;
    var header = document.getElementById("header");
    var navcontent = document.getElementById("nav-content");

    document.addEventListener('scroll', function () {

        /*Refresh scroll % width*/
        scroll = (h[st] || b[st]) / ((h[sh] || b[sh]) - h.clientHeight) * 100;
        progress.style.setProperty('--scroll', scroll + '%');

        /*Apply classes for slide in bar*/
        scrollpos = window.scrollY;

        if (scrollpos > 10) {
            header.classList.add("bg-white dark:bg-slate-900");
            header.classList.add("shadow");
            navcontent.classList.remove("bg-gray-100");
            navcontent.classList.add("bg-white dark:bg-slate-900");
        } else {
            header.classList.remove("bg-white dark:bg-slate-900");
            header.classList.remove("shadow");
            navcontent.classList.remove("bg-white dark:bg-slate-900");
            navcontent.classList.add("bg-gray-100");

        }

    });


    //Javascript to toggle the menu
    document.getElementById('nav-toggle').onclick = function () {
        document.getElementById("nav-content").classList.toggle("hidden");
    }
</script>
@stack('scripts')
</html>
