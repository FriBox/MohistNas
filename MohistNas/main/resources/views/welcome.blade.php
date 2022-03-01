<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Styles -->
        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.dark\:text-gray-500{--tw-text-opacity:1;color:#6b7280;color:rgba(107,114,128,var(--tw-text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="250px" height="58px" viewBox="0 0 250 58" enable-background="new 0 0 250 58" xml:space="preserve">  <image id="image0" width="250" height="58" x="0" y="0"
    href="data:image/png;base64,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
IaubTKpdlF2mqtIMnvpt7J3te2644Tq+851vUlJakrVpTZnMWrTJVOyJSFpxLGlkbQ7TSuZcVqlk
urZ8PAVMZTlaQCa6wm2YymBHx2946fjjDMf7000rUl8wlUh2drzBWecrOFJZ1Jc0sXH+dTm1RV24
WFS8PLPqzvFcv9++hYQZS49vSZOeyNksiWkn6mT6AOJWbMYNFsbWy0mXXfGHtMzbmJfPwKW5aShb
ldUxZzgxwEvHH+fs6EkMK0HMjHBq6CBPH/onTg4dyqoilErSNnICU5rp0tbUaN2RdpIywcc97/Lc
kZ/a1YlOspQ2rlvPnu5tnBw65KyDpC60hCvqPjfjlN4ZSXRDJumJttsERaELV1bl1WSQSrKkpIk1
VVew/eyrCCHw6n4uqb1+Wh00/O4gGlrm6SYEkeQww4kBysapmlJK6uuX8L3v/SU///fHefW1LYTD
YTRNO+dJr5RCSkl5eRl33XUn999/D8XFxTkr35JWMntDTXA05YYgZkQcdW+8fW+rsbnsVamsCZmB
OLXUhu3BFiJ9X8KKcaBvJ1JamBq83foCxwb20lx5MXWhevzuIAkzxpGBj9nd9Xa6h1xNcBF3Nj5C
qa9i0lBec+UG3mmrozuj/lqwvf1V+mJd1Jc2IRCcGT6Kruk82PKdrJ64pjRIWsl0pCBhxrGUhQtP
Xntq8rWTlPoquLvpG5jS4HD/nim1BKUUa6quYHfXVk4OHUwznUBwsH8XHeHTVPhrMKVBb7SDiDHC
pbU34NG9bGt7OcM03Nn5JuHkMG7dw/VLvkh1cCGmNDjQ94HTAFLnvY4tnBo+THPlxSwILSPoDmHI
BMcHD/Bh55skrFg6JHpH4yPMC9adv8w4u1Z8lP5Yt93/TYAutCnrlrMeqrm4YsHn2d/7AQPxHpaX
rWJ5+appvYTPFXS6blpjrZSUJGZG6Y22Ox05xiClpKqqim9/55tc8ZnLee65F/n4472MjIykD4Tx
5axgq/bl5WVs3Hgxd955O6tWrUTTtJxMbredtjfoWHsnhaEs4laUqTasAMLGCKY0MvKkpXPvWHeW
sTWwlJV2YKVSTi1lYVhJJ2Mw9US7e+iC0FL6op30x3uwpEHbyHHaRk/gcnLsLSXTmodb89JYsZpb
lj3EopLlk/pMlFJU+udzy7Iv8esjP2Eo0W9/2VXYPod9vTvY1/t+mp5rqz+T4+VtNdWQSTRNT6u9
pkzi0/2zYHNn3R1Guafpj3jy4D+mczVyHZ4KRYmvgrsav84vD/8zbSPH7dQjZ18Mxvvoj9nRoYC7
iM8uup2blz5A1IxwZvgYZ0aOplcpYoywq2srNcGF6WaSUlnUBBdRW7SYvlgXpkzSET5NR/hMeh2k
khjSABQu4aa+rIVbGr5EQ+nKWeW6i1jCmBYtU98mP9j3IX63bV9EjTCr5l1KyFM6jeYGkl1dW+kI
n+aiivU0VqzJv4Wy04dtb8/7BFxFaelufxpqmEXFDSwtbZ50LrquE4vGOHb8OB999DFHjx6ju7sn
XQQTDAaoqanhoouaWLt2DfVLluD2uKesXxdCo3X4KMcG9xHylOB3FWEpk9HEENXBBTSWr5l0PkII
Tg8d4cTQAYo9pfhdQRSKiDGK31XEqnmXZKlsSSvB7q6tTugyhK65SJgxosYoq6oup9RbkfE8hWIo
3sfJoYMcG9hL++gphhP9JKyEvak0N0F3iNqiJayquozmyosJukN5Z2KlOpqeHj5ifwtPWuiajt9V
RHVwAU0Va2mu3EiFv3rK/WRYSRJWnHXVVznm4NyEtDSh0TF6mldP/idxM8rnlt7PsrLcjl8hNPqj
XezsfIPD/Xvs5ioyiRAaQXeIhcUNrK+5msby1bicngBdkTY+7HyTjvAZlJKU+6tYUtJEfWkTZb6q
DE1iODHAqaFDHBvYS9voCYbifXZGp6MdB9wh5hctpGXeJWm+mvWXjqbL6GOEmxjjm75NlcrnHftg
wLTunjLNMJ8DJ6W6G4ZBIpHAMGzHl8fjwev14nK50qp7fjPKndeez3wmvXeKunD7/bNNj8nWIvWh
AKlMokaE0eQgUSOCQuLV/RR5SijylNje8ml+2sluj2wymhwinBzGlElcmoegO0SRp8SptZ98nTP3
k5r1xp6MxqYyUEqly3knvdaR4jEjSsQYJmkl0r3ci9zF6VbWY9drkEr8UaRbeuVav9RaS2URMyOM
JoaImqNIJfHoPorcxYQ8pbh1z5x9wGHGjP77hkxbXc0kjPs7BeGo2GNlGHPzVZCJxTJztVE/VUqJ
cYW/c/w+n9Q6ZD2nwOgFFPD7j7ltv1FAAQX8VqLA6AUUcAGgwOgFFHABoMDoBRRwAaDA6AUUcAGg
wOgFFHABwAXMrJK9gAIK+J2BCzj3t38LKKCA32mIWMKY/SgFFFDAbzX+P+fihAXBM3FqAAAAJXRF
WHRkYXRlOmNyZWF0ZQAyMDIyLTAyLTE1VDA4OjIyOjI4KzAwOjAw3NdMXQAAACV0RVh0ZGF0ZTpt
b2RpZnkAMjAyMi0wMi0xNVQwODoyMjozMCswMDowMFLPuhgAAAAASUVORK5CYII=" />
</svg>
                </div>

                <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2">
                        <div class="p-6">
                            <div class="flex items-center">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                <div class="ml-4 text-lg leading-7 font-semibold"><a href="https://laravel.com/docs" class="underline text-gray-900 dark:text-white">Documentation</a></div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                    Laravel has wonderful, thorough documentation covering every aspect of the framework. Whether you are new to the framework or have previous experience with Laravel, we recommend reading all of the documentation from beginning to end.
                                </div>
                            </div>
                        </div>

                        <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l">
                            <div class="flex items-center">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500"><path d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <div class="ml-4 text-lg leading-7 font-semibold"><a href="https://laracasts.com" class="underline text-gray-900 dark:text-white">Laracasts</a></div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                    Laracasts offers thousands of video tutorials on Laravel, PHP, and JavaScript development. Check them out, see for yourself, and massively level up your development skills in the process.
                                </div>
                            </div>
                        </div>

                        <div class="p-6 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex items-center">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500"><path d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path></svg>
                                <div class="ml-4 text-lg leading-7 font-semibold"><a href="https://laravel-news.com/" class="underline text-gray-900 dark:text-white">Laravel News</a></div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                    Laravel News is a community driven portal and newsletter aggregating all of the latest and most important news in the Laravel ecosystem, including new package releases and tutorials.
                                </div>
                            </div>
                        </div>

                        <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-l">
                            <div class="flex items-center">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500"><path d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <div class="ml-4 text-lg leading-7 font-semibold text-gray-900 dark:text-white">Vibrant Ecosystem</div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                    Laravel's robust library of first-party tools and libraries, such as <a href="https://forge.laravel.com" class="underline">Forge</a>, <a href="https://vapor.laravel.com" class="underline">Vapor</a>, <a href="https://nova.laravel.com" class="underline">Nova</a>, and <a href="https://envoyer.io" class="underline">Envoyer</a> help you take your projects to the next level. Pair them with powerful open source libraries like <a href="https://laravel.com/docs/billing" class="underline">Cashier</a>, <a href="https://laravel.com/docs/dusk" class="underline">Dusk</a>, <a href="https://laravel.com/docs/broadcasting" class="underline">Echo</a>, <a href="https://laravel.com/docs/horizon" class="underline">Horizon</a>, <a href="https://laravel.com/docs/sanctum" class="underline">Sanctum</a>, <a href="https://laravel.com/docs/telescope" class="underline">Telescope</a>, and more.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-center mt-4 sm:items-center sm:justify-between">
                    <div class="text-center text-sm text-gray-500 sm:text-left">
                        <div class="flex items-center">
                            <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="-mt-px w-5 h-5 text-gray-400">
                                <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>

                            <a href="https://laravel.bigcartel.com" class="ml-1 underline">
                                Shop
                            </a>

                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="ml-4 -mt-px w-5 h-5 text-gray-400">
                                <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>

                            <a href="https://github.com/sponsors/taylorotwell" class="ml-1 underline">
                                Sponsor
                            </a>
                        </div>
                    </div>

                    <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
                        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
