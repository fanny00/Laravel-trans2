<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Transacciones App - @yield('titulo')</title>
        @vite('resources/css/app.css')
    </head>
    <body class="bg-gray-100">
        <header class="p-5 border-b bg-white shadow">
            <div class="container mx-auto flex justify-between items-center">
                <h1 class="text-3xl font-black">
                   <a class="text-sky-600 hover:text-sky-700 transition-colors cursor-pointer">
                     Dashboar Transacciones 
                    </a>
                </h1>

                @auth
                    <nav class="flex gap-2 items-center">
                        <a class="font-bold text-gray-600 text-sm mt-1" href="#">
                            Hola: <span>{{ auth()->user()->username }}</span></a>
                            |
                        
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="font-bold text-gray-600 text-sm">
                                Cerrar Sesión
                            </button>
                        </form>
                    </nav>
                @endauth

                @guest
                    <nav class="flex gap-2 items-center">
                        <a class="font-bold text-gray-600 text-sm" href="{{ route('login') }}">Login</a>
                        <a class="font-bold text-gray-600 text-sm" href="{{ route('register') }}">
                            Crear Cuenta
                        </a>
                    </nav>
                @endguest       
            </div>
            
        </header>


            <nav class="bg-gray-50 dark:bg-sky-600 flex justify-center">
                <div class="max-w-screen-xl px-4 py-3 mx-auto md:px-6">
                    <div class="flex items-center">
                        <ul class="flex flex-row mt-0 mr-6 space-x-8 text-sm font-medium">
                            <span class="dark:text-white">|</span>
                            <li>
                                <a href="{{ route('ingresos.index') }}" class="text-gray-900 dark:text-white hover:underline uppercase">Ingresos</a>
                            </li>
                            <span class="dark:text-white">|</span>
                            <li>
                                <a href="{{ route('egresos.index') }}" class="text-gray-900 dark:text-white hover:underline uppercase">Egresos</a>
                            </li>
                            <span class="dark:text-white">|</span>
                        </ul>
                    </div>
                </div>
            </nav>


        <main class="container mx-auto mt-10">
            <h2 class="text-gray-700 font-bold text-center text-3xl mb-10">
                @yield('titulo')
            </h2>
            @yield('contenido')

        </main>

       <footer class="mt-10 text-center p-5 text-gray-500">
           <span class="font-bold">Transacciones</span> - Todos los derechos reservados {{ now()->year }}
       </footer>

    </body>
</html>
