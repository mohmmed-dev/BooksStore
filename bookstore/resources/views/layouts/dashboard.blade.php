
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{str_replace('_', '-', app()->getLocale()) == 'ar' ? 'rtl' : 'ltr'}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tailwind Admin Template</title>
    <meta name="author" content="David Grzyb">
    <meta name="description" content="">

    <!-- Tailwind -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');
        .font-family-karla { font-family: karla; }
        .bg-sidebar { background: #0a0d1a; }
        .cta-btn { color: #252d48; }
        .upgrade-btn { background: #151a2d; }
        .upgrade-btn:hover { background: #202745; }
        .active-nav-link { background: #202745; }
        .nav-item:hover { background: #202745; }
        .account-link:hover { background: #202745; }
    </style>
</head>
<body class="bg-gray-100 font-family-karla flex">
    <aside class="relative bg-sidebar h-screen w-64 hidden sm:block shadow-xl">
            <div class="p-6">
                <a href="#" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Books Store </a>
            </div>
            <nav class="text-white text-base font-semibold pt-3">
                @include('theme.sidebar')
            </nav>
    </aside>

    <div class="w-full flex flex-col h-screen overflow-y-hidden">
    @include('theme.header')
    <div>
        @if(Session::has("flash_message"))
        <div onclick="delete()" id="flash_message" class=" text-center bg-green-700 text-xl py-2 text-white mx-3 rounded-md my-1">{{session("flash_message")}}</div>
        @endif
    </div>
    <div class="w-full flex flex-col h-screen overflow-y-hidden justify-between">
        <div class="w-full overflow-x-hidden border-t flex flex-col">
                <main class="w-full flex-grow p-6">
                    @yield('title')
                    @yield('content')
                </main>
            </div>
            @include('theme.footer')
        </div>
    </div>
    @yield('script')
    <script>
        function delete() {
            // document.getElementById('flash_message').remove();
            console.log(document.getElementById('flash_message'))
        }
    </script>
    <!-- AlpineJS -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
</body>
</html>
