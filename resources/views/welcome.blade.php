<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sistema de Produtos</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-slate-100 to-slate-200 min-h-screen flex items-center justify-center">

    <div class="bg-white shadow-xl rounded-xl w-full max-w-xl p-10 text-center">

        <div class="flex justify-center mb-6">
            <div class="bg-blue-600 text-white rounded-full p-4">
                <svg class="h-10 w-10" fill="none" stroke="currentColor" stroke-width="1.5"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0l-8 5-8-5m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5" />
                </svg>
            </div>
        </div>

        <h1 class="text-3xl font-bold text-gray-800 mb-2">
            Sistema de Produtos
        </h1>

        <p class="text-gray-600 mb-8">
            Plataforma interna para gerenciamento de produtos
        </p>

        @auth
            <p class="text-gray-700 mb-4">
                Acessar sistema como
                <span class="font-semibold">{{ auth()->user()->name }}</span>
            </p>

            <div class="flex justify-center gap-4">
                <a href="{{ route('products.index') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-md shadow">
                    Acessar sistema
                </a>

                <form method="POST" action="{{ route('logout', ['redirect' => 'login']) }}">
                    @csrf
                    <button type="submit"
                            class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold px-6 py-3 rounded-md shadow">
                        Entrar com outra conta
                    </button>
                </form>
            </div>
        @else
            <a href="{{ route('login') }}"
            class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-md shadow">
                Entrar
            </a>
        @endauth


    </div>

</body>
</html>
